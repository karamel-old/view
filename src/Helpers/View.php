<?php
function view($viewName, $variables)
{
    return \Karamel\View\View::getInstance()->make($viewName,$variables);
}