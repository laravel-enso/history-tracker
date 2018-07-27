# HistoryTracker
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/71c1e5e3e2c940fa8f3fb0ebda9db1fb)](https://www.codacy.com/app/laravel-enso/HistoryTracker?utm_source=github.com&utm_medium=referral&utm_content=laravel-enso/HistoryTracker&utm_campaign=badger)
[![StyleCI](https://styleci.io/repos/85500161/shield?branch=master)](https://styleci.io/repos/85500161)
[![License](https://poser.pugx.org/laravel-enso/historytracker/license)](https://packagist.org/packages/laravel-enso/historytracker)
[![Total Downloads](https://poser.pugx.org/laravel-enso/historytracker/downloads)](https://packagist.org/packages/laravel-enso/historytracker)
[![Latest Stable Version](https://poser.pugx.org/laravel-enso/historytracker/version)](https://packagist.org/packages/laravel-enso/historytracker)

Simple to use, customizable Laravel Model history tracking utility trait

[Laravel Enso](https://github.com/laravel-enso/Enso) already includes this package

### Details

The trait helps keep track of the changes made to a model by saving a snapshot for each relevant update of the model to a different 'history' table.

The records in the history table are linked via FK to the original model. Setting a FK *constraint* on the DB column may be set if necessary.

### Configuration & Usage

Be sure to check out the full documentation for this package available at [docs.laravel-enso.com](https://docs.laravel-enso.com/packages/history-tracker.html)

### Contributions

are welcome. Pull requests are great, but issues are good too.

### License

This package is released under the MIT license.
<!--/h-->
