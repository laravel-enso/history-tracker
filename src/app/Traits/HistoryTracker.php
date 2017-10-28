<?php

namespace LaravelEnso\HistoryTracker\app\Traits;

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
        if ($this->needsHistory()) {
            $history = $this->historyModel::create($this->toArray());
            $this->histories()->save($history);
        }
    }

    private function needsHistory()
    {
        return collect($this->getDirty())
            ->keys()
            ->intersect((new $this->historyModel())->getFillable())
            ->isNotEmpty();
    }
}
