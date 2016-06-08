<?php

class Base_Action
{
    public function execute()
    {
        try {
            $this->getParams();
            $this->checkParams();
            $this->verify();
            $this->main();
            $this->output();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    protected function getParams()
    {
        
    }

    protected function checkParams()
    {

    }

    protected function verify()
    {

    }

    protected function main()
    {

    }

    protected function output()
    {

    }

}
