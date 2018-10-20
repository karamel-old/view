<?php

namespace Karamel\View;
class ViewResponse
{
    private $view;
    private $sectionName;
    public static $renderedView;
    public static $renderedVariables;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function render($view, $variables=null)
    {
        if(self::$renderedVariables == null)
            self::$renderedVariables = $variables;
        $viewCompiledPath = $this->view->setViewName($view)->getCompiledViewPath();

        $__view = $this;
        foreach (self::$renderedVariables as $__KARAMEL_VIEW_VARIABLES_KEY => $__KARAMEL_VIEW_VARIABLES_VALUE) {
            $$__KARAMEL_VIEW_VARIABLES_KEY = $__KARAMEL_VIEW_VARIABLES_VALUE;
        }

        include $viewCompiledPath;

    }

    public function _extends($extendsName)
    {
        if (self::$renderedView == null)
            self::$renderedView = [];
        $this->render($extendsName);
    }

    public function _startSection($sectionName)
    {
        $this->sectionName = $sectionName;
        ob_start();
    }

    public function _endSection()
    {
        $content = ob_get_contents();
        ob_end_clean();
        self::$renderedView[$this->sectionName] = $content;
    }

    public function _yield($yieldName)
    {
        echo self::$renderedView[$yieldName];
    }

    public function _escape($string)
    {
        return htmlspecialchars($string);
    }
}