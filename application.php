<?php

class Application
{

    private $_controller;
    private $_action;
    private $_instance;

    public function run()
    {
        $this->_autoload();

        try {
            $this->_dispatch();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    private function _dispatch()
    {
        $this->_setController();
        $this->_setAction();
        $this->_includeFile();

        $class = $this->_controller . 'Controller';
        $this->_instance = new $class;
        $this->_instance->controller = $this->_controller;
        $this->_instance->action = $this->_action;

        $action = str_replace('_', '', $this->_action);
        call_user_func(array($this->_instance, $action));
    }

    private function _autoload()
    {
        include __DIR__ . DIRECTORY_SEPARATOR . 'include/autoload.php';
        spl_autoload_register(array('Base_Autoload', 'autoload'));
    }

    private function _setController()
    {
        if (empty($_GET['controller'])) {
            throw new Exception('invalid controller');
        }
        $this->_controller = $_GET['controller'];
    }

    private function _setAction()
    {
        if (empty($_GET['action'])) {
            throw new Exception('invalid action');
        }
        $this->_action = $_GET['action'];
    }

    private function _includeFile()
    {
        $route = include CONFIG_PATH . '/router.php';
        $key = "/{$this->_controller}/{$this->_action}";
        if (empty($route[$key])) {
            throw new Exception('invalid route::' . $key);
        }

        $file = MODULE_PATH . '/' . $route[$key];
        if (!file_exists($file)) {
            throw new Exception($file . ' not found');
        }

        include $file;
    }

}
