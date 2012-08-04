<?php
function D()
{
    echo '---Debug-output-start--', "\n";
    foreach (func_get_args() AS $debug)
    {
        var_dump($debug);
    }
    echo '---Debug-output-end----', "\n";
}

function DE()
{
    foreach (func_get_args() AS $debug)
    {
        var_dump($debug);
    }
    exit(0);
}