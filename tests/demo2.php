<?php

//composer require illuminate/view:5.0.*
//composer require illuminate/events:5.0.*

include "vendor/autoload.php";

// your view file path, it's an array
$path = ['./views'];

// compiled file path
$cachePath = './cache';

if (!file_exists($cachePath)) {
    mkdir($cachePath);
}

$files = new Illuminate\Filesystem\Filesystem();

$compiler = new \Illuminate\View\Compilers\BladeCompiler($files, $cachePath);

// 5.4 you can add a custom directive if you want
//$compiler->directive('datetime', function ($timestamp) {
/*    return preg_replace('/(\(\d+\))/', '<?php echo date("Y-m-d H:i:s", $1); ?>', $timestamp);*/
//});
//

$finder = new \Illuminate\View\FileViewFinder($files, $path);

$resolver = new \Illuminate\View\Engines\EngineResolver();

$resolver->register('blade', function () use ($compiler) {
    return new \Illuminate\View\Engines\CompilerEngine($compiler);
});

$resolver->register('php', function () {
    return new \Illuminate\View\Engines\PhpEngine();
});


//5.4
//$resolver->register('file', function () {
//    return new \Illuminate\View\Engines\FileEngine();
//});


$event = new \Illuminate\Events\Dispatcher();

$factory = new \Illuminate\View\Factory($resolver, $finder, $event);

echo $factory->make('a', ['name' => 'Ethan'])->render();
echo $factory->make('b', ['name' => 'Ethan'])->render();
