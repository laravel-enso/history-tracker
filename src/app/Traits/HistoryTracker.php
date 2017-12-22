<?php

namespace LaravelEnso\HistoryTracker\app\Traits;

use LogicException;

trait HistoryTracker
{
    // protected $historyModel = HistoryModel::class;

    protected static function bootHistoryTracker()
    {
        self::created(function ($model) {
            $model->saveHistory();
        });

        self::updated(function ($model) {
            $model->saveHistory();
        });

        self::deleted(function ($model) {
            if (method_exists($model, 'bootSoftDeletes')) {
                $model->saveHistory();
            }
        });
    }

    public function histories()
    {
        return $this->hasMany($this->historyModel);
    }

    private function saveHistory()
    {
        if ($this->missesHistoryModel()) {
            throw new LogicException(
                sprintf(
                __('You forgot to set up the historyModel property for %s'),
                get_class($this)
            )
            );
        }

        if ($this->needsHistory()) {
            $history = new $this->historyModel($this->toArray());
            $this->histories()->save($history);
        }
    }

    private function missesHistoryModel()
    {
        return !property_exists($this, 'historyModel');
    }

    private function needsHistory()
    {
        return collect($this->getDirty())
            ->keys()
            ->intersect((new $this->historyModel())->getFillable())
            ->isNotEmpty();
    }
}
