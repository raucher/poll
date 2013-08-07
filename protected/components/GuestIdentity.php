<?php

/**
 * Class GuestIdentity
 * Guest authentication class
 *
 * @package poll
 * @author raucher <myplace4spam@gmail.com>
 */

class GuestIdentity extends CUserIdentity
{
	public function authenticate()
	{
		Yii::app()->user->login($this);	
		return true;
	}

}