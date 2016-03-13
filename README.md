# MultiColumnAuthenticate Plugin

Provides multi column form authentications.

## Requirements

* CakePHP 3.x
* PHP 5.4.16 or greater

## Installation

_[Using [Composer](http://getcomposer.org/)]_

```
composer require steefaan/cakephp-multi-column-authenticate:dev-master
```

### Enable plugin

Load the plugin in your app's `config/bootstrap.php` file:

```
Plugin::load('MultiColumnAuthenticate');
```

### Usage

```
$this->loadComponent('Auth', [
    'authenticate' => [
        'MultiColumnAuthenticate.MultiColumn' => [
            'columns' => [
                'username',
                'email'
            ]
        ]
    ]
]);
```
