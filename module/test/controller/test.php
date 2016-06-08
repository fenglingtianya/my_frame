<?php

class TestController extends Base_Controller
{

    private function _callAction($action)
    {
        $class = 'Test_Action_' . $action;
        $instance = new $class();
        $instance->execute();
    }

    public function testApp()
    {
        $this->_callAction('test_app');
    }

    public function testFrame()
    {
        $this->_callAction('test_frame');
    }

}
