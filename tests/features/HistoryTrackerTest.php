<?php

use Faker\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use LaravelEnso\HistoryTracker\app\Traits\HistoryTracker;
use Tests\TestCase;

class HistoryTrackerTest extends TestCase
{
    private $faker;
    private $testModel;

    public function setUp(): void
    {
        parent::setUp();

        // $this->withoutExceptionHandling();

        $this->faker = Factory::create();

        $this->testModel = $this->model();
    }

    /** @test */
    public function saves_created_model_in_history_table()
    {
        $this->assertEquals(
            $this->testModel->name,
            TrackedModelHistory::first()->name
        );
    }

    /** @test */
    public function saves_updated_model_in_history_table()
    {
        $this->testModel->name = 'Updated';
        $this->testModel->save();

        $this->assertEquals(
            $this->testModel->name,
            $this->testModel->histories->last()->name
        );
    }

    /** @test */
    public function keeps_model_in_history_table_after_deleting_it()
    {
        $id = $this->testModel->id;

        $this->testModel->delete();

        $this->assertNull($this->testModel->fresh());

        $count = TrackedModelHistory::whereTrackedModelId($id)->count();

        $this->assertEquals(1, $count);
    }

    private function model()
    {
        $this->createTestTables();

        return TrackedModel::create([
            'name' => $this->faker->word
        ]);
    }

    private function createTestTables()
    {
        Schema::create('tracked_models', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

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

    protected $historyModel = TrackedModelHistory::class;
    protected $fillable = ['name'];
}

class TrackedModelHistory extends Model
{
    protected $fillable = ['name'];
}
