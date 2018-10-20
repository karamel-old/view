<?php

namespace Karamel\View;

use Karamel\View\Compiler\Searcher;
use Karamel\View\Exceptions\ViewNotFoundException;
use Karamel\View\Interfaces\IView;

class View implements IView
{
    private $dist_path;
    private $base_path;
    private $view_delimeter;
    private $view_name;
    private $response;
    private static $instace;
    public static function getInstance()
    {
        if(self::$instace !== null)
            return self::$instace;
        self::$instace = new View();
        return self::$instace;
    }
    public function __construct()
    {
        if(!defined('KM_VIEW_BASE_PATH'))
            throw new \Exception("KM_VIEW_BASE_PATH Must be defined at start of your application");

        if(!defined('KM_VIEW_DIST_PATH'))
            throw new \Exception('KM_VIEW_DIST_PATH Must be defined at start of your application');

        if(!defined('KM_VIEW_DELIMETER'))
            throw new \Exception('KM_VIEW_DELIMETER Must be defined at start of your application');

        $this->base_path = KM_VIEW_BASE_PATH;
        $this->dist_path = KM_VIEW_DIST_PATH;
        $this->view_delimeter = KM_VIEW_DELIMETER;
        $this->response = new ViewResponse($this);
    }

    public function setViewName($view)
    {
        $this->view_name = $view;
        return $this;
    }

    public function getViewName()
    {
        return $this->view_name;
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

    public function getCompiledViewPath()
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

        if ($this->checkExistsCompiledView())
            if ($this->getCompiledViewMD5() == md5($content))
                return;

        $file = fopen($this->getCompiledViewPath(), 'w+');
        fwrite($file, $content);
        fclose($file);
    }
    private function processBeforeMake($view){

        $this->view_name = $view;

        $viewContent = $this->getViewFile();

        $newView = $this->compile($viewContent);
        $this->writeCompiledView($newView);

        $parentView = $this->findParentView($viewContent);

        if ($parentView !== null)
            $this->processBeforeMake($parentView);
    }
    //panel.admin.index
    public function make($view,$variables)
    {

        $this->processBeforeMake($view);
        return $this->response->render($view,$variables);

    }

    private function findParentView($content)
    {
        return Searcher::extededView($content);
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
        return str_replace($this->view_delimeter, "/", $this->view_name) . '.klade.php';
    }

    public function loadTemplet($template)
    {
        // TODO: Implement loadTemplet() method.
    }
}