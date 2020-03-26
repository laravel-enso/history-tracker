<?php

namespace LaravelEnso\HistoryTracker\App\Traits;

use Illuminate\Support\Collection;
use LogicException;

trait HistoryTracker
{
    // protected $historyModel = HistoryModel::class; //mandatory

    public static function bootHistoryTracker()
    {
        self::created(fn ($model) => $model->attemptHistoryCreate());

        self::updated(fn ($model) => $model->attemptHistoryCreate());

        self::deleted(fn ($model) => $model
            ->attemptHistoryCreate(method_exists($model, 'bootSoftDeletes')));
    }

    public function histories()
    {
        return $this->hasMany($this->historyModel);
    }

    private function attemptHistoryCreate($qualifies = true)
    {
        if ($qualifies && $this->historyModelExists()
            && $this->monitoredAttributesChanged()) {
            $this->histories()->save($this->historyModelInstance());
        }
    }

    private function historyModelExists()
    {
        if (property_exists($this, 'historyModel')) {
            return true;
        }

        throw new LogicException(__(
            'You did not to set up the "historyModel" property for model: :model',
            ['model' => self::class]
        ));
    }

    private function monitoredAttributesChanged()
    {
        return (new Collection($this->getDirty()))->keys()
            ->intersect((new $this->historyModel())->getFillable())
            ->isNotEmpty();
    }

    private function historyModelInstance()
    {
        $history = new $this->historyModel();

        return (new Collection($history->getFillable()))
            ->reduce(fn ($history, $attribute) => tap($history)
                ->fill([$attribute => $this->{$attribute}]), $history);
    }
}
