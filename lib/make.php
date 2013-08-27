<?php

include UTIL_PATH . DS . 'file.php';
if (empty($ARGS[2]))
{
    _verbose("You must specify a class [type].\n\n");
    _help('make');
}

$type = $ARGS[2];

$class_map = include CONFIG_PATH . DS .'class.php';


if (empty($class_map[$type]))
{
    _verbose("Unknown class type.\n\n");
    _help('make');
}

$deploys = $class_map[$type];

if (empty($ARGS[3]))
{
    _verbose("You must specify a class [name].\n\n");
    _help('make');
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
    _verbose("You must specify a valid class name for the application name.\n\n[examples]\n"
        . "\tUsers\n"
        . "\tUsers_Accounts\n"
        . "\tUsers_Accounts_Types");
    exit("\n");
}

$actions = array_slice($ARGS, 4);
$clean_actions = array();

foreach ($actions as $action)
{
    $match = preg_match('/^([a-z][a-z0-9]*_)*([a-z][a-z0-9]*)$/', $action);
    if (!empty($match))
    {
        $clean_actions[] = $action;
    }
}

$actions = array_merge(array_unique($clean_actions));

$class_keys = array('[:ClassName]', '[:ModuleName]');
$class_values = array($name, MOD_NAME);

$files = array();

echo "\nBuilding [${type}] scaffolding...\n";

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
        
        $file = file_get_contents($source);
        
        if (is_array($fg))
        {
            $keys = array_keys($fg);
            $values = array_values($fg);
            
            $file = str_replace($class_keys, $class_values, str_replace($keys, $values, $file));
        }
        
        $content = '';
        
        if (!empty($actions))
        {
            $action_keys = array('[:action_names]', '[:Action_Names]');
            
            $subsource = SOURCE_PATH . DS . $type . DS . 'Action.php';
            if (is_file($subsource) && false !== strpos($file, '[:SourceActions]'))
            {
                reset($actions); // make sure we begin from the start
                
                $tmp_content = file_get_contents($subsource);
                $content = '';
                
                foreach ($actions as $action)
                {
                    $action_values = array(strtolower($action), $action);
                    $content .= str_replace($action_keys, $action_values, $tmp_content);
                }
            }
            
            // create file copy for each action files.
            if (false !== strpos($path, '[:action_names]'))
            {
                reset($actions); // make sure we begin from the start
                
                foreach ($actions as $action)
                {
                    $action_values = array(strtolower($action), $action);
                    $action_path = str_replace($action_keys, $action_values, $path);
                    $files[$action_path] = array('type' => $type, 'contents' => $file);
                }
                
                break;
            }
        }
        
        $file = str_replace('[:SourceActions]', $content, $file);
        
        $files[$path] = array('type' => $type, 'contents' => $file);
    }
}

foreach ($files as $path => $file)
{
    if (!is_dir(dirname($path)))
    {
        mkdir(dirname($path), 0744, true);
    }
    
    if (is_file($path))
    {
        _verbose("[" . $file['type'] ."] ${path}... Skipped!");
        continue;
    }
    _verbose("[" . $file['type'] ."] ${path}... OK");
    
    file_put_contents($path, $file['contents']);
}