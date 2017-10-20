<!--h-->
# HistoryTracker
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/71c1e5e3e2c940fa8f3fb0ebda9db1fb)](https://www.codacy.com/app/laravel-enso/HistoryTracker?utm_source=github.com&utm_medium=referral&utm_content=laravel-enso/HistoryTracker&utm_campaign=badger)
[![StyleCI](https://styleci.io/repos/85500161/shield?branch=master)](https://styleci.io/repos/85500161)
[![License](https://poser.pugx.org/laravel-enso/historytracker/license)](https://https://packagist.org/packages/laravel-enso/historytracker)
[![Total Downloads](https://poser.pugx.org/laravel-enso/historytracker/downloads)](https://packagist.org/packages/laravel-enso/historytracker)
[![Latest Stable Version](https://poser.pugx.org/laravel-enso/historytracker/version)](https://packagist.org/packages/laravel-enso/historytracker)
<!--/h-->

Model history tracking dependency for [Laravel Enso](https://github.com/laravel-enso/Enso).

### Details

The trait helps keep the history for a model by saving each version of the model in a different 'history' table.
Each record in the history table is linked via a FK to the original model and is recommended to have a `created_at` column,
since the records should not be updated.

### Use

1. Create a histories table such as `model_histories`, where model is what you need to keep track of.

2. In ModelHistory model add

    `protected $fillable = ['id', 'model_id', 'all', 'attributes', 'from', 'the', original', 'model']`

3. Add to the tracked Model the following trait:

    `use HistoryTracker;`

4. Add to the tracked model the following property:

    `protected static $historyModel = 'ModelHistory'`

5. Now, each time the a tracked model instance is created or updated, an entry will be inserted in the corresponding history table, mirroring the data from model and having a link (fk) to the tracked model.

### Notes

The [Core](https://github.com/laravel-enso/Core) package comes with this library included.

<!--h-->
### Contributions

are welcome. Pull requests are great, but issues are good too.

### License

This package is released under the MIT license.
<!--/h-->