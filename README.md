# Discounts

An implementation of the [Teamleader Discounts coding test](https://github.com/teamleadercrm/coding-test/blob/master/1-discounts.md).

## Installation

Clone this repository and run `composer install`.

## Running

I mean, if you want to...

```
php -S localhost:port -t public/
```

## Tests

All tests are in the `tests/` folder. They're split up into three kinds: Functional, Integration and Unit. Run them with

``` 
vendor/bin/phpunit tests/
```

The functional tests confirm all three orders specified in the original challenge and add a fourth order that includes all three discounts.
