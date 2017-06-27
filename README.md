# HistoryTracker
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/71c1e5e3e2c940fa8f3fb0ebda9db1fb)](https://www.codacy.com/app/laravel-enso/HistoryTracker?utm_source=github.com&utm_medium=referral&utm_content=laravel-enso/HistoryTracker&utm_campaign=badger)
[![StyleCI](https://styleci.io/repos/85500161/shield?branch=master)](https://styleci.io/repos/85500161)
[![Total Downloads](https://poser.pugx.org/laravel-enso/historytracker/downloads)](https://packagist.org/packages/laravel-enso/historytracker)
[![Latest Stable Version](https://poser.pugx.org/laravel-enso/historytracker/version)](https://packagist.org/packages/laravel-enso/historytracker)

Model history tracking dependency for [Laravel Enso](https://github.com/laravel-enso/Enso).

### Use

1. Create a histories table such as `model_histories`, where model is what you need to keep track of.

2. In ModelHistory model add

    ```
    protected $fillable = ['id', 'model_id', 'all', 'attributes', 'from', 'the', original', 'model']
    ```

3. Add to the tracked Model the following trait:

    ```
    use HistoryTracker;
    ```

4. Add to the tracked model the following property:

    `protected static $historyModel = 'ModelHistory'`

5. Now, each time the a tracked model instance is created or updated, an entry will be inserted in the corresponding history table, mirroring the data from model and having a link (fk) to the tracked model.

### Notes

The [laravel-enso/core](https://github.com/laravel-enso/Core) package comes with this library included.

### Contributions

are welcome