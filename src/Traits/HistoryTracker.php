<?php

namespace LaravelEnso\HistoryTracker\Traits;

trait HistoryTracker
{
    protected static $historyModel = '';

    protected static function bootTrackHistory()
    {
        self::created(function ($model) {
            self::saveHistory($model);
        });

        self::updated(function ($model) {
            self::saveHistory($model);
        });
    }

    private static function saveHistory($model)
    {
        $history = new $this->historyModel();

        //the history model needs  to have both updated_by and created_by
        //attributes as fillable
        $history->fill($model->toArray());
        $model->histories()->save($history);
    }

    public function histories()
    {
        return $this->hasMany($this->historyModel);
    }
}
