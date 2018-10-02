<?php

namespace Karamel\View\Compiler;
class Searcher
{
    //TODO add \s tp regex
    private $content;
    private $convertor;

    public static function start($content)
    {
        $search = new Searcher($content);
        foreach (get_class_methods($search) as $method) {
            if (in_array($method, ['start', '__construct', 'getFinalContent','extededView']))
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

    public static function extededView($content)
    {
        $matches = [];
        preg_match("/\#extends\(\'(.+)\'\)/i", $content, $matches);

        return isset($matches[1]) ? $matches[1] : null;
    }

    private function findIf()
    {

        $this->content = preg_replace("/\#if\((.+)\)/i", $this->convertor->replaceIf(), $this->content);
    }

    private function findElse()
    {
        $this->content = preg_replace("/\#else\s/i", $this->convertor->replaceElse(), $this->content);
    }

    private function findElseif()
    {
        $this->content = preg_replace("/\#elseif\((.+)\)/i", $this->convertor->replaceElseIf(), $this->content);
    }

    private function findEndif()
    {
        $this->content = preg_replace("/\#endif/i", $this->convertor->replaceEndIf(), $this->content);
    }

    private function findFor()
    {
        $this->content = preg_replace("/\#for\((.+)\)/i", $this->convertor->replaceFor(), $this->content);
    }

    private function findEndfor()
    {

        $this->content = preg_replace("/\#endfor\s/i", $this->convertor->replaceEndFor(), $this->content);

    }

    private function findForeach()
    {
        $this->content = preg_replace("/\#foreach\((.+)\)\s/i", $this->convertor->replaceForeach(), $this->content);
    }

    private function findEndforeach()
    {
        $this->content = preg_replace("/\#endforeach\s/i", $this->convertor->replaceEndForeach(), $this->content);
    }

    private function findWhile()
    {
        $this->content = preg_replace("/\#while\((.+)\)/i", $this->convertor->replaceWhile(), $this->content);
    }

    private function findEndwhile()
    {
        $this->content = preg_replace("/\#endwhile/i", $this->convertor->replaceEndWhile(), $this->content);
    }

    private function findBreak()
    {
        $this->content = preg_replace("/\#break/i", $this->convertor->replaceBreak(), $this->content);
    }

    private function findContinue()
    {
        $this->content = preg_replace("/\#continue/i", $this->convertor->replaceContinue(), $this->content);
    }

    private function findIsset()
    {
        $this->content = preg_replace("/\#isset\((.+)\)/i", $this->convertor->replaceIsset(), $this->content);
    }

    private function findEndIsset()
    {
        $this->content = preg_replace("/\#endisset/i", $this->convertor->replaceEndIsset(), $this->content);
    }

    private function findInclude()
    {

        $this->content = preg_replace('/\#include\((.*)\)/i', '<?php $view->loadTemplate(\'$1\') ?>', $this->content);

    }

    private function findSection()
    {
        $this->content = preg_replace("/\#section\((.+)\)/i", $this->convertor->replaceSection(), $this->content);
    }

    private function findEndsection()
    {
        $this->content = preg_replace("/\#endsection/i", $this->convertor->replaceEndSection(), $this->content);
    }

    private function findExtends()
    {
        $this->content = preg_replace("/\#extends\((.+)\)([\s\S]+)/i", $this->convertor->replaceExtends(), $this->content);
    }

    private function findYield()
    {
        $this->content = preg_replace("/\#yield\((.+)\)/i", $this->convertor->replaceYield(), $this->content);
    }

    private function findSwitch()
    {
        $this->content = preg_replace("/\#switch\((.+)\)/i", $this->convertor->replaceSwitch(), $this->content);

    }

    private function findCase()
    {
        $this->content = preg_replace("/\#case\((.+)\)/i", $this->convertor->replaceCase(), $this->content);

    }

    private function findDefault()
    {
        $this->content = preg_replace("/\#default/i", $this->convertor->replaceDefault(), $this->content);

    }


    private function findEndswitch()
    {
        $this->content = preg_replace("/\#endswitch/i", $this->convertor->replaceEndSwitch(), $this->content);

    }

    private function findPush()
    {
    }

    private function findComponent()
    {
    }
}