<?php
function view($viewName, $variables=null)
{
    return \Karamel\View\View::getInstance()->make($viewName,$variables);
}