<?php
function request()
{
    return \Karamel\Http\Request::getInstance();
}

function redirect($path)
{
    header('Location: ' . $path);
    exit;
}