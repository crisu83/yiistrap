yii-less
========

Less is an extension for the [Yii PHP framework](http://www.yiiframework.com) that allows developers to compile [LESS](http://www.lesscss.org) files into CSS using the native JavaScript compiler.
LESS can be compiled both client-side using less.js and server-side using lessc. 
Less comes with two compilers, a client compiler that uses less.js and a server compiler that uses lessc.

### Requirements

* [Node.js](http://nodejs.org/download/) and [lessc](http://lesscss.org/#usage) to use the server-side compiler

### Credits

Thanks to my friend Sam Stenvall (negge) for providing me with his version of the server-side compiler.

## Usage

### Setup

Download the latest version, unzip the extension under ***protected/extensions/less*** and add the less component to your application configuration. 
Below you can find example configurations for both compilers.

#### Client-side

```php
return array(
  'components'=>array(
    .....
    'less'=>array(
      'class'=>'ext.less.components.Less',
      'mode'=>'client'
      'files'=>array(
        'less/styles.less'=>'css/styles.less',
      ),
    ),
  ),
);
```

#### Server-side

In order to compile your LESS server-side you need to download and install [Node.js](http://nodejs.org/download/). 
When you have installed Node.js use npm (Node Packaged Modules) to download lessc.

```php
return array(
  'components'=>array(
    'less'=>array(
      'class'=>'ext.less.components.Less',
      'mode'=>'server'
      'files'=>array(
        'less/styles.less'=>'css/styles.less',
      ),
      'options'=>array(
        'nodePath'=>'path/to/node.exe',
        'compilerPath'=>'path/to/lessc',
      ),
    ),
  ),
);
```

### Configuration

Below you can find a list of the available configurations (with default values) for each compiler.

#### Client-side

```php
'less'=>array(
  'class'=>'ext.less.components.Less',
  'mode'=>'client' // client or server
  'files'=>array( // files to compile (relative from your base path)
    'less/styles.less'=>'css/styles.less',
  ),
  'options'=>array( // compiler options
    'env'=>'production', // compiler environment, either production or development
    'async'=>false, // load imports asynchronous?
    'fileAsync'=>false, // load imports asynchronous when in a page under a file protocol
    'poll'=>1000, // when in watch mode, time in ms between polls
    'dumpLineNumbers'=>'mediaQuery', // enables debugging, set to comments, mediaQuery or all
    'watch'=>true, // enable watch mode?
  ),
),
```

#### Server-side

```php
'less'=>array(
  'class'=>'ext.less.components.Less',
  'mode'=>'server' // client or server
  'files'=>array( // files to compile (relative from your base path)
    'less/styles.less'=>'css/styles.less',
  ),
  'options'=>array( // compiler options
    'basePath'=>'path/to/webroot', // base path, defaults to webroot
    'nodePath'=>'path/to/node.exe', // absolute path to nodejs executable
    'compilerPath'=>'path/to/lessc', // absolute path to lessc
    'strictMode'=>false, // force evaluation of imports?
    'compression'=>false, // enable compression, either whitespace or yui
    'optimizationLevel'=>false, // parser optimization level, set to 0, 1 or 2
    'forceCompile'=>false, // compile files on each request?
  ),
),
```

### Registering the compiler

When you have everything setup and configured you need to register the compiler.
To do that, call its register method inside the ***\<head\>*** tag in the layout(s) in which you wish to include the stylesheets.

```php
<head>
  <?php Yii::app()->less->register(); ?>
</head>
```
***protected/views/layouts/main.php***
