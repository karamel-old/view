<?php
namespace Karamel\View\Compiler;
class Convertor{

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
    public function replaceEndForeach()
    {
        return $this->replaceEnd();
    }
    public function replaceEnd()
    {
        return "<?php } ?>";
    }
    public function replaceForeach()
    {
        return "<?php foreach($1){ ?>";
    }
}