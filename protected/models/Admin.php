<?php

/**
 * Class Admin
 * Model to store admin data
 *
 * @package poll
 * @author raucher <myplace4spam@gmail.com>
 */
class Admin extends CActiveRecord{
	
	private $_identity;

    public $currentPassCheck;
	public $newPass, $newPass_repeat;

	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	public function tableName(){ return 'tbl_admin'; }

	public function rules(){
		return array(
            array('login, passwrd', 'required'),
            array('login, passwrd', 'length', 'min'=>4),
            array('login, passwrd', 'filter', 'filter'=>'trim'),
            array('passwrd', 'authenticate', 'except'=>array('changePass')),
            // Filters for changing credentials
            array('currentPassCheck', 'required', 'on'=>'changePass'),
            array('newPass', 'compare', 'message'=>'Repeat password exactly', 'on'=>'changePass'),
            array('newPass, newPass_repeat', 'filter', 'filter'=>'trim', 'on'=>'changePass'),
            array('newPass', 'length', 'min'=>4, 'on'=>'changePass'),
            array('currentPassCheck', 'currentPassValidator', 'on' => 'changePass'),
		);
	}

    /**
     * Validates current password
     *
     * @param null $attr
     * @param null $val
     * @return bool Whether password is correct
     */
    public function currentPassValidator($attr=null, $val=null)
    {
        if($this->passwrd !== crypt($this->currentPassCheck, $this->passwrd))
            $this->addError('currentPassCheck', 'Current password is incorrect');

        return !$this->hasErrors();
    }

    /**
     * Updates the password
     *
     * @return bool Whether update process was successful
     */
    public function saveNewCredentials()
    {
        if(!$this->currentPassValidator())
            return false;
        $this->passwrd = crypt($this->newPass, AdminIdentity::getPassSalt(9));
        return $this->update(array('passwrd', 'login'));
    }

	public function attributeLabels(){
		return array(
            'passwrd' => 'Password',
            'newPass' => 'Repeat New Password',
            'newPass_repeat' => 'New Password',
            'login' => 'Login',
        );
	}

	public function authenticate($attr, $val){
        if($this->scenario==='changePass')
            return true;

        if(!$this->hasErrors()){
			$this->_identity = new AdminIdentity($this->login, $this->passwrd);
			if(!$this->_identity->authenticate())
				$this->addError('password', 'Login or password is incorrect');
		}
	}

	public function login(){
		if($this->_identity->errorCode === AdminIdentity::ERROR_NONE){
			Yii::app()->user->login($this->_identity);
			/*Yii::app()->authManager->createRole('admin');
			Yii::app()->authManager->assign('admin', Yii::app()->user->getId());
			Yii::app()->authManager->save();*/

			return true;
		}
		return false;
	}
}

?>