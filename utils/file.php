<?php

function copy_r($path, $dest)
{
    if (is_dir($path))
    {
        mkdir($dest);
        
        $objects = scandir($path);
        if (sizeof($objects) > 0)
        {
            foreach ($objects as $file)
            {
                if ($file == '.' || $file == '..')
                {
                    continue;
                }
                
                // go on
                if (is_dir($path . DS . $file))
                {
                    copy_r($path.DS.$file, $dest.DS.$file);
                }
                else
                {
                    copy($path.DS.$file, $dest.DS.$file);
                }
            }
        }
        return true;
    }
    elseif (is_file($path))
    {
        return copy($path, $dest);
    }
    else
    {
        return false;
    }
}

function is_dir_empty($dir)
{
  if (!is_readable($dir))
  {
    return -1;
  }
  
  return 2 == count(scandir($dir));
}

function rm_dir($dir)
{
    foreach(glob($dir . '/*') as $file)
    {
        if(is_dir($file))
        {
            rm_dir($file);
        }
        else
        {
            unlink($file);
        }
    }
    
    rmdir($dir);
}

function fs_parse($class, $path)
{
    $filename = str_replace('_', DS, $class);
    $fs_keys = array('[:ClassRoot]', '[:ViewRoot]', '[:ModuleName]', '[:modulename]', '[:ClassName]', '[:classname]');
    $fs_values = array(CLASS_PATH, VIEW_PATH, MOD_NAME, strtolower(MOD_NAME), $filename, strtolower($filename));
    
    return ROOT_PATH . DS . str_replace($fs_keys, $fs_values, $path);
}

function normal_ds($path)
{
    return str_replace('\\', DS, str_replace('/', DS, $path));
}