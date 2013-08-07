<?php

class GuestIdentity extends CUserIdentity
{
	public function authenticate()
	{
		Yii::app()->user->login($this);	
		return true;
	}

}