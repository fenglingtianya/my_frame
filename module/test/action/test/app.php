<?php

class Test_Action_Test_App extends Base_Action
{

    public function execute()
    {
        echo __FILE__;
        parent::execute();
    }

}
