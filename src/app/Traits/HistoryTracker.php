<?php

namespace LaravelEnso\HistoryTracker\app\Traits;

use LogicException;

trait HistoryTracker
{
    // protected $historyModel = HistoryModel::class;

    protected static function bootHistoryTracker()
    {
        self::created(fn($model) => $model->saveHistory());

        self::updated(fn($model) => $model->saveHistory());

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
            throw new LogicException(__(
                'You forgot to set up the historyModel property for class: :class',
                ['class' => self::class]
            ));
        }

        if ($this->needsHistory()) {
            $this->histories()->save($this->historyModelInstance());
        }
    }

    private function missesHistoryModel()
    {
        return ! property_exists($this, 'historyModel');
    }

    private function needsHistory()
    {
        return collect($this->getDirty())
            ->keys()
            ->intersect((new $this->historyModel())->getFillable())
            ->isNotEmpty();
    }

    private function historyModelInstance()
    {
        $history = new $this->historyModel();

        return collect($history->getFillable())
            ->reduce(function ($history, $attribute) {
                $history->{$attribute} = $this->{$attribute};

                return $history;
            }, $history);
    }
}
