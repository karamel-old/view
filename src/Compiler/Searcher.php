<?php

namespace Karamel\View\Compiler;
class Searcher
{
    private $content;
    private $convertor;

    public static function start($content)
    {
        $search = new Searcher($content);
        foreach (get_class_methods($search) as $method) {
            if (in_array($method, ['start', '__construct', 'getFinalContent']))
                continue;
            $search->{$method}();
        }
        return $search->getFinalContent();
    }

    public function __construct($content)
    {
        $this->content = $content;
        $this->convertor = new Convertor();
    }

    public function getFinalContent()
    {
        return $this->content;
    }

    private function findIf()
    {

        $this->content = preg_replace("/\#if\((.+)\)/i", $this->convertor->replaceIf(), $this->content);
    }

    private function findElse()
    {
        $this->content = preg_replace("/\#else/i", $this->convertor->replaceElse(), $this->content);
    }

    private function findElseif()
    {
    }

    private function findEndif()
    {
        $this->content = preg_replace("/\#endif/i", $this->convertor->replaceEndIf(), $this->content);
    }

    private function findFor()
    {
    }

    private function findEndfor()
    {
    }

    private function findForeach()
    {
        $this->content = preg_replace("\#foreach\((.+)\)", $this->convertor->replaceForeach(), $this->content);
    }

    private function findEndforeach()
    {
        $this->content = preg_replace("/\#endforeach/i", $this->convertor->replaceEndForeach(), $this->content);
    }

    private function findWhile()
    {
    }

    private function findEndwhile()
    {
    }

    private function findBreak()
    {
    }

    private function findContinue()
    {
    }

    private function findIsset()
    {
    }

    private function findInclude()
    {

        $this->content = preg_replace('/\#include\((.*)\)/i', '<?php $view->loadTemplate(\'$1\') ?>', $this->content);

    }

    private function findSection()
    {
    }

    private function findEndsection()
    {
    }

    private function findExtends()
    {
    }

    private function findYield()
    {
    }

    private function findSwitch()
    {
    }

    private function findCase()
    {
    }

    private function findEndswitch()
    {
    }

    private function findPush()
    {
    }

    private function findComponent()
    {
    }
}