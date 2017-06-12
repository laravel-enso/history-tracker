# HistoryTracker
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/71c1e5e3e2c940fa8f3fb0ebda9db1fb)](https://www.codacy.com/app/laravel-enso/HistoryTracker?utm_source=github.com&utm_medium=referral&utm_content=laravel-enso/HistoryTracker&utm_campaign=badger)
[![StyleCI](https://styleci.io/repos/85500161/shield?branch=master)](https://styleci.io/repos/85500161)
[![Total Downloads](https://poser.pugx.org/laravel-enso/historytracker/downloads)](https://packagist.org/packages/laravel-enso/historytracker)
[![Latest Stable Version](https://poser.pugx.org/laravel-enso/historytracker/version)](https://packagist.org/packages/laravel-enso/historytracker)

Trait for tracking a model's histories.

### Use

1. Create a histories table `model_histories` where model is what you need track.

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

5. Enjoy.

### Note

The laravel-enso/core package comes with this library included.

### Contributions

are welcome