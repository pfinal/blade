<?php

require __DIR__ . '/../vendor/autoload.php';

$path = ['./views'];         // your view file path, it's an array
$cachePath = './cache';     // compiled file path

$compiler = new \PFinal\Blade\Compilers\BladeCompiler($cachePath);

// you can add a custom directive if you want
$compiler->directive('datetime', function ($timestamp) {
    return preg_replace('/(\(\d+\))/', '<?php echo date("Y-m-d H:i:s", $1); ?>', $timestamp);
});

$engine = new \PFinal\Blade\Engines\CompilerEngine($compiler);
$finder = new \PFinal\Blade\FileViewFinder($path);

// if your view file extension is not php or blade.php, use this to add it
//$finder->addExtension('tpl');

// get an instance of factory
$factory = new \PFinal\Blade\Factory($engine, $finder);

// render the template file and echo it
echo $factory->make('hello', ['name' => 'Ethan'])->render();
