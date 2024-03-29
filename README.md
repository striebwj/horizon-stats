# Horizon Stats

[![Run tests](https://github.com/striebwj/horizon-stats/actions/workflows/default.yml/badge.svg)](https://github.com/striebwj/horizon-stats/actions/workflows/default.yml)
[![Format (PHP)](https://github.com/striebwj/horizon-stats/actions/workflows/FormatPHP.yml/badge.svg)](https://github.com/striebwj/horizon-stats/actions/workflows/FormatPHP.yml)

[![Packagist](https://img.shields.io/packagist/v/striebwj/horizon-stats.svg)](https://packagist.org/packages/striebwj/horizon-stats)
[![Packagist](https://poser.pugx.org/striebwj/horizon-stats/d/total.svg)](https://packagist.org/packages/striebwj/horizon-stats)
[![Packagist](https://img.shields.io/packagist/l/striebwj/horizon-stats.svg)](https://packagist.org/packages/striebwj/horizon-stats)

Store long-term stats on the health of your Horizon Queues.

This package takes the Horizon snapshot data and stores it in the database, with easy to access models, so you can
track your queue health over time.

## Installation

Install via composer
```bash
composer require striebwj/horizon-stats
```

### Publish package assets

```bash
php artisan vendor:publish --provider="striebwj\HorizonStats\ServiceProvider"
```

Update the `horizon-stats.php` config file to change the database names. Default is `horizon_stats`.

## Usage

Once migrations are run, add the `horizon-stats:store` command to your `App\Console\Kernel.php` with the same time as
your Horizon Snapshot command. **Be sure to add it before the snapshot**. It should look something like this:

```phpt
// Horizon Tasks
$schedule->command('horizon-stats:store')->everyFiveMinutes(); // Before the snapshot
$schedule->command('horizon:snapshot')->everyFiveMinutes();
```

## To-do List
- [ ] Add tests
- [ ] Allow pushing storing in DB to a queue
- [ ] Add pruning?

## Security

If you discover any security related issues, please email wade@striebel.ca
instead of using the issue tracker.

## Credits

- [Wade Striebel](https://github.com/striebwj/horizon-stats)
- [All contributors](https://github.com/striebwj/horizon-stats/graphs/contributors)
