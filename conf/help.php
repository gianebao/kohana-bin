<?php
$GLOBALS['helps'] = array(
    'config' => "= KO Configure = \n"
        . "\tdefinition: Add or modify a configuration value.\n"
        . "\tusage: ko config <name.subcontext> <value>\n",
        
    'make' => "= KO Make = \n"
        . "\tdefinition: Creates a new class scaffold.\n"
        . "\tClass names must be plural case-sensitive nouns that are separated by an underscore \"_\".\n\n"
        . "\tusage: ko make <type> <name> [actions]\n\n"
        . "\t[Options]\n"
        . "\n\t<type>\n"
        . "\t  Controller         Controller class.\n"
        . "\t  LayoutController   Layout Template Controller.\n"
        . "\t  AjaxController     Ajax Controller.\n"
        . "\t  Model              Model class.\n"
        . "\n\t<name>\n"
        . "\t  Class name in Cammel-case with each noun separated by an underscore\n"
        . "\n\t[actions]\n"
        . "\t  Lower-cased methods for the class. Can be multiple.\n",

    'delete' => "= KO Delete = \n"
        . "\tdefinition: Removes a class scaffold.\n"
        . "\tusage: kohm delete <type> <name>\n\n"
        . "\t[Options]\n"
        . "\n\t<type>\n"
        . "\t  Controller         Controller class.\n"
        . "\t  LayoutController   Layout Template Controller.\n"
        . "\t  AjaxController     Ajax Controller.\n"
        . "\t  Model              Model class.\n"
        . "\n\t<name>\n"
        . "\t  Class name in Cammel-case with each noun separated by an underscore\n",

);

function _help($key)
{
    echo $GLOBALS['helps'][$key];
    exit("\n");
}