<?php

namespace Karamel\View\Compiler;
class Convertor
{

    public function replaceElse()
    {
        return "<?php }else{ ?>";
    }

    public function replaceIf()
    {
        return "<?php if($1) { ?>";
    }

    public function replaceEndIf()
    {
        return $this->replaceEnd();
    }

    public function replaceEnd()
    {
        return "<?php } ?>";
    }

    public function replaceEndForeach()
    {
        return $this->replaceEnd();
    }

    public function replaceEndFor()
    {
        return $this->replaceEnd();
    }

    public function replaceForeach()
    {
        return "<?php foreach($1){ ?>";
    }

    public function replaceFor()
    {
        return "<?php for($1){ ?>";
    }

    public function replaceElseIf()
    {
        return "<?php }else if($1) { ?>";
    }

    public function replaceWhile()
    {
        return "<?php while($1){ ?>";
    }

    public function replaceEndWhile()
    {
        return $this->replaceEnd();
    }

    public function replaceBreak()
    {
        return "<?php break; ?>";
    }

    public function replaceContinue()
    {
        return "<?php continue; ?>";
    }

    public function replaceIsset()
    {
        return "<?php if(isset($1) === true) { ?>";
    }

    public function replaceEndIsset()
    {
        return $this->replaceEnd();
    }

    public function replaceSwitch()
    {
        return "<?php switch($1){ ?>";
    }

    public function replaceCase()
    {
        return "<?php case($1): ?>";
    }


    public function replaceDefault()
    {
        return '<?php default: ?>';
    }

    public function replaceEndSwitch()
    {
        return "<?php } ?>";

    }

    public function replaceSection()
    {
        return '<?php $__view->_startSection($1)  ?>';
    }

    public function replaceEndSection()
    {
        return '<?php $__view->_endSection(); ?>';
    }

    public function replaceYield()
    {
        return '<?php $__view->_yield($1); ?>';
    }

    public function replaceExtends()
    {
        return '$2 <?php $__view->_extends($1); ?>';
    }

    public function replaceEscapedVariables()
    {
        return '<?php echo $__view->_escape($1); ?>';
    }

    public function replaceUnescapedVariables()
    {
        return '<?php echo ($1); ?>';
    }
}