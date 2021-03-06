# Helper/Model caching plugin for [Lithium PHP](http://lithify.me)

Will aid in the caching of expensive helper/model instance methods.

[![Build Status](https://secure.travis-ci.org/BlaineSch/li3_memoize.png?branch=master)](http://travis-ci.org/BlaineSch/li3_memoize)

## Installation

### Composer
~~~ json
{
    "require": {
        ...
        "blainesch/li3_memoize": "dev-master"
        ...
    }
}
~~~
~~~ bash
php composer.phar install
~~~

### Submodule
~~~ bash
git submodule add git://github.com/BlaineSch/li3_memoize.git libraries/li3_memoize
~~~

### Clone Directly
~~~ bash
git clone git://github.com/BlaineSch/li3_memoize.git libraries/li3_memoize
~~~

## Usage

### Load the plugin

Add the plugin to be loaded with Lithium's autoload magic

In `app/config/bootstrap/libraries.php` add:

~~~ php
<?php
	Libraries::add('li3_memoize');
?>
~~~

### Tell it which instance methods to cache
~~~ php
<?php
use li3_memoize\extensions\Memoize;
Memoize::add(array(
	array(
		'name' => 'app\extensions\helper\Prose',
		'method' => array('init')
	),
	array(
		'name' => 'app\models\Users',
		'method' => array('name')
	),
));
~~~