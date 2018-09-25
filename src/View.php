<?php

namespace Karamel\View;

use Karamel\View\Compiler\Searcher;
use Karamel\View\Exceptions\ViewNotFoundException;
use karamel\View\Interfaces\IView;

class View implements IView
{
    private $dist_path;
    private $base_path;
    private $view_delimeter;
    private $view_name;

    public function __construct($base_path, $dist_path, $view_delimeter = ".")
    {
        $this->base_path = $base_path;
        $this->dist_path = $dist_path;
        $this->view_delimeter = $view_delimeter;
    }

    public function getDistPath()
    {
        if (array_slice(str_split($this->dist_path), -1, 1)[0] != '/')
            $this->dist_path .= '/';
        return $this->dist_path;
    }

    public function getBasePath()
    {

        if (array_slice(str_split($this->base_path), -1, 1)[0] != '/')
            $this->base_path .= '/';
        return $this->base_path;
    }

    private function compile($content)
    {
        return Searcher::start($content);
    }

    private function getCompiledViewName()
    {
        return md5($this->view_name) . '.php';
    }

    private function getCompiledViewPath()
    {
        return $this->getDistPath() . $this->getCompiledViewName();
    }

    private function checkExistsCompiledView()
    {
        if (file_exists($this->getCompiledViewPath()))
            return true;
        return false;
    }

    private function getCompiledViewMD5()
    {
        return md5(file_get_contents($this->getCompiledViewPath()));
    }

    private function writeCompiledView($content)
    {

        if($this->checkExistsCompiledView())
            if($this->getCompiledViewMD5() == md5($content))
                return;

        $file = fopen($this->getCompiledViewPath(), 'w+');
        fwrite($file, $content);
        fclose($file);
    }

    //panel.admin.index
    public function make($view)
    {
        $this->view_name = $view;
        $newView = $this->compile($this->getViewFile());
        $this->writeCompiledView($newView);
    }

    private function getViewFile()
    {
        if (!file_exists($this->getViewPath()))
            throw new ViewNotFoundException();

        return file_get_contents($this->getViewPath());
    }

    private function getViewPath()
    {
        return $this->getBasePath() . $this->getConvertViewName();
    }

    private function getConvertViewName()
    {
        return str_replace($this->view_delimeter, "/", $this->view_name);
    }
}