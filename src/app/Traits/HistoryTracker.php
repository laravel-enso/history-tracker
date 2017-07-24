<?php

namespace LaravelEnso\HistoryTracker\app\Traits;

trait HistoryTracker
{
    // protected static $historyModel = '';

    protected static function bootHistoryTracker()
    {
        self::created(function ($model) {
            self::saveHistory($model);
        });

        self::updated(function ($model) {
            self::saveHistory($model);
        });

        self::deleted(function ($model) {
            if (method_exists($model, 'bootSoftDeletes')) {
                self::saveHistory($model);
            }
        });
    }

    private static function saveHistory($model)
    {
        self::$historyModel::create($model->toArray());
    }

    public function histories()
    {
        return $this->hasMany(self::$historyModel);
    }
}
