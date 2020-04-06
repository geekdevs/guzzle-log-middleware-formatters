### About

This is curl formatter for guzzle log middleware [rtheunissen/guzzle-log-middleware](https://github.com/rtheunissen/guzzle-log-middleware)

## Installation

```bash
composer require rtheunissen/guzzle-log-middleware
composer require geekdevs/guzzle-log-middleware-formatters
```

## Usage

```php
$loggerMiddleware = new \Concat\Http\Middleware\Logger(
    $monolog, 
    new \Geekdevs\Http\Message\Formatter\CurlCommandFormatterAdapter()
);
```

More info about middleware: https://github.com/rtheunissen/guzzle-log-middleware/blob/master/README.md
