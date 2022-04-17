Laravel Bitly Package
=====================

A laravel package for generating Bitly short URLs.

For more information see [Bitly](https://bitly.com/)

### Download laravel-bitly using composer

```
composer require elmsellem/laravel-bitly
```

### Configure Bitly credentials

```
php artisan vendor:publish --provider="Elmsellem\Bitly\BitlyServiceProvider"
```

Add this in you **.env** file

```
BITLY_ACCESS_TOKEN=your_secret_bitly_access_token
```


Usage
-----

```php
<?php

$url = app('bitly')->getShortenUrl('https://www.google.com/'); // https://bit.ly/3uOZj27
````

using facade:

```php
<?php

use Bitly;

$url = Bitly::getShortenUrl('https://www.google.com/'); // https://bit.ly/3uOZj27
```
