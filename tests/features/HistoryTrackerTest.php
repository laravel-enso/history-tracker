<?php

use Faker\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use LaravelEnso\HistoryTracker\app\Traits\HistoryTracker;
use LaravelEnso\TestHelper\app\Classes\TestHelper;

class HistoryTrackerTest extends TestHelper
{
    private $faker;

    public function setUp()
    {
        parent::setUp();

        $this->faker = Factory::create();
        $this->createTrackedModelsTable();
        $this->createTrackedModelHistoriesTable();
    }

    /** @test */
    public function saves_created_model_in_history_table()
    {
        $trackedModel = TrackedModel::create(['name' => $this->faker->word]);

        $this->assertEquals($trackedModel->name, TrackedModelHistory::first()->name);
    }

    /** @test */
    public function saves_updated_model_in_history_table()
    {
        $trackedModel = TrackedModel::create(['name' => $this->faker->word]);

        $trackedModel->name = 'Updated';
        $trackedModel->save();

        $this->assertEquals($trackedModel->name, $trackedModel->histories->last()->name);
    }

    /** @test */
    public function keeps_model_in_history_table_after_deleting_it()
    {
        $trackedModel = TrackedModel::create(['name' => $this->faker->word]);
        $id = $trackedModel->id;

        $trackedModel->delete();

        $this->assertNull($trackedModel->fresh());

        $count = TrackedModelHistory::whereTrackedModelId($id)->count();

        $this->assertEquals(1, $count);
    }

    private function createTrackedModelsTable()
    {
        Schema::create('tracked_models', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
    }

    private function createTrackedModelHistoriesTable()
    {
        Schema::create('tracked_model_histories', function ($table) {
            $table->increments('id');
            $table->integer('tracked_model_id')->unsigned();
            $table->string('name');
            $table->timestamps();
        });
    }
}

class TrackedModel extends Model
{
    use HistoryTracker;

    protected static $historyModel = TrackedModelHistory::class;
    protected $fillable = ['name'];
}

class TrackedModelHistory extends Model
{
    protected $fillable = ['name'];
}
