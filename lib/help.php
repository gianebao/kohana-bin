<?php
echo "\nKO Commands:";

foreach ($GLOBALS['helps'] as $item)
{
    echo "\n\n" . $item;
}