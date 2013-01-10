<?php

function m($msg){
    echo $msg.PHP_EOL;
    exit;
}

function glob_recursive($pattern, $flags = 0){
    $files = glob($pattern, $flags);
    foreach (glob(dirname($pattern).'/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir)
        $files = array_merge($files, glob_recursive($dir.'/'.basename($pattern), $flags));
    return $files;
}

function template($file) {
    $output = file_get_contents($file);
    $output = str_replace('{{PROJECT_NAME}}', NAME, $output);
    return $output;
}

// --------------------------------------------------

if (!isset($argv[1]))
    m('First argument must be a project name');

if (!isset($argv[2]))
    m('Secound argument must be a template name (php, node)');

define('NAME', $argv[1]);
define('TYPE', $argv[2]);
define('ROOT', getcwd());
define('TEMPLATE', dirname(__FILE__));
define('PROJ', ROOT .'/'. NAME .'/');

if (file_exists(PROJ))
	m('Folder is exist!');

mkdir(PROJ);

foreach(glob_recursive(TEMPLATE.'/'.TYPE.'/*') as $file) {
    $path = str_replace(TEMPLATE.'/'.TYPE.'/', '', $file);
    if (is_dir($file))
        mkdir(PROJ.$path);
    else
        file_put_contents(PROJ.$path, template($file));
}

m('SUCCESS!');