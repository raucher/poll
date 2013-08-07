<?php

/**
 * Class DemoModeDbConnection
 * Changes db connection according to user's id and cdn
 *
 * @package photo
 * @author Maxim Muizhinikas
 */
class DemoModeDbConnection extends CDbConnection
{
    public function init()
    {
       if(Yii::app()->user->getState('demoUserId') === 'demo_mode_user' && Yii::app()->user->hasState('cdn'))
        {
            $this->setActive(false); // Disable current connection
            $this->connectionString = Yii::app()->user->getState('cdn'); // And change cdn
        }
        parent::init(); // init() in super class activates connection again
    }
}