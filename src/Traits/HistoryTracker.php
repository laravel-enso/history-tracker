<?php

namespace LaravelEnso\HistoryTracker\Traits;

trait HistoryTracker
{
    //protected static $historyModel = '';

    protected static function bootTrackHistory()
    {
        static::created(function ($model) {
            static::saveHistory($model);
        });

        static::updated(function ($model) {
            static::saveHistory($model);
        });
    }

    private static function saveHistory($model)
    {
        $history = new static::$historyModel();

        //the history model needs  to have both updated_by and created_by
        //attributes as fillable
        $history->fill($model->toArray());
        $model->histories()->save($history);
    }

    public function histories()
    {
        return $this->hasMany(static::$historyModel);
    }
}
