<?php

include UTIL_PATH . DS . 'file.php';
if (empty($ARGS[2]))
{
    _verbose("You must specify a class [type].\n\n");
    _help('delete');
}

$type = $ARGS[2];

$class_map = include CONFIG_PATH . DS .'class.php';


if (empty($class_map[$type]))
{
    _verbose("Unknown class type.\n\n");
    _help('delete');
}

$deploys = $class_map[$type];

if (empty($ARGS[3]))
{
    _verbose("You must specify a class [name].\n\n");
    _help('delete');
}

$name = trim($ARGS[3], "_ \t\n\r\0\x0B");

if (empty($name))
{
    _verbose("Class [name] is in an invalid form.\n\n");
    _help('make');
}

$match = preg_match('/^([A-Z][a-z]*_)*([A-Z][a-z]*)$/', $name);

if (empty($match))
{
    _verbose("You must specify a valid class name for the application name.\n\t[examples]\n"
        . "\tUsers\n"
        . "\tUsers_Accounts\n"
        . "\tUsers_Accounts_Types");
    exit("\n");
}

$parent_dir_check = false !== strpos($name, '_');
$files = array();

echo "\nRemoving [${type}] scaffolding...\n";

foreach ($deploys as $type => $deploy)
{
    $source = SOURCE_PATH . DS . $type . '.php';
    
    if (!is_file($source))
    {
        _verbose("There are no set Class template for `${type}`.\n");
    }
    
    foreach ($deploy as $path => $fg)
    {
        $path = normal_ds(fs_parse($name, is_int($path) ? $fg: $path));
        
        // create file copy for each action files.
        if (false !== strpos($path, '[:action_names]'))
        {
            $path = dirname($path);
        }
        
        $files[$path] = array('type' => $type);
    }
}


foreach ($files as $path => $file)
{
    if (is_file($path))
    {
        _verbose("[" . $file['type'] ."] ${path}... OK");
        unlink($path);
    }
    elseif (is_dir($path))
    {
        _verbose("[" . $file['type'] ."] ${path}... OK");
        rm_dir($path);
    }
    else
    {
        _verbose("[" . $file['type'] ."] ${path}... Not found!");
        continue;
    }
    
    if (!$parent_dir_check)
    {
        continue;
    }
    
    $path = dirname($path);
    
    if (false === is_dir_empty($path))
    {
        _verbose("[" . $file['type'] ."] ${path}... Skipped!");
        continue;
    }
    
    _verbose("[" . $file['type'] ."] ${path}... OK");
    rm_dir($path);

}