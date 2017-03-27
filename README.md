# HistoryTracker

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/71c1e5e3e2c940fa8f3fb0ebda9db1fb)](https://www.codacy.com/app/laravel-enso/HistoryTracker?utm_source=github.com&utm_medium=referral&utm_content=laravel-enso/HistoryTracker&utm_campaign=badger)
[![StyleCI](https://styleci.io/repos/85500161/shield?branch=master)](https://styleci.io/repos/85500161)
[![Total Downloads](https://poser.pugx.org/laravel-enso/historytracker/downloads)](https://packagist.org/packages/laravel-enso/historytracker)
[![Latest Stable Version](https://poser.pugx.org/laravel-enso/historytracker/version)](https://packagist.org/packages/laravel-enso/historytracker)

Trait for tracking a model's histories.

### Use

1. Create a mirror table like 'mytable_histories' where mytable is the table/model that you want to track.

2. In MyTableHistory model add

```
protected $fillable = ['id', ......]
```

with all the attributes that you want to track.

3. In the main model that need tracking, MyTable in our case, add

```
use LaravelEnso\HistoryTracker\app\Traits\HistoryTracker
```

and `protected static $historyModel = 'MyTableHistory'`, so the Trait will know which model to use for history.

### Note

The laravel-enso/core package comes with this library included.

### Contributions

are welcome