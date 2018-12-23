<?php

namespace Karamel\View;

use Karamel\Http\Response;

class ViewResponse
{
    public static $renderedView;
    public static $renderedVariables;
    private $view;
    private $sectionName;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function _extends($extendsName)
    {
        if (self::$renderedView == null)
            self::$renderedView = [];
        $this->render($extendsName);
    }

    public function render($view, $variables = null)
    {
        if (self::$renderedVariables == null)
            self::$renderedVariables = $variables;
        $viewCompiledPath = $this->view->setViewName($view)->getCompiledViewPath();

        $__view = $this;
        foreach (self::$renderedVariables as $__KARAMEL_VIEW_VARIABLES_KEY => $__KARAMEL_VIEW_VARIABLES_VALUE) {
            $$__KARAMEL_VIEW_VARIABLES_KEY = $__KARAMEL_VIEW_VARIABLES_VALUE;
        }

        ob_start();
        include $viewCompiledPath;
        $content = ob_get_contents();
        ob_end_flush();
        return (new Response())->setStatusCode(200)->setContent($content);
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