Materialize Extension for Yii 2
===============================
This is the Materialize extension for Yii framework 2.0. It encapsulates Materialize components and plugins in terms of Yii widgets, and thus makes using Materialize components/plugins in Yii applications extremely easy.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist tuyakhov/yii2-materialize "*"
```

or add

```
"tuyakhov/yii2-materialize": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \tuyakhov\materialize\AutoloadExample::widget(); ?>```