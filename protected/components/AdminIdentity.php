<?php

/**
* 
*/
class AdminIdentity extends CUserIdentity{
	
	private $_id;

    public function __construct($username,$password)
    {
        parent::__construct($username,$password);
        $this->init();
    }

    protected function init()
    {
        $this->attachBehaviors($this->behaviors());
    }

    /**
     * Attaches DemoModeBehavior class
     *
     * @return array Behaviors to attach
     */
    protected function behaviors()
    {
        return array(
            'demoModeBehavior' => array(
                'class' => 'application.components.DemoModeBehavior',
                'sourceDbFileName' => 'poll.db',
            ),
        );
    }

	public function authenticate(){
		/*$admin = Admin::model()->findByAttributes(array(
											'login' => $this->username,));
		if($admin==null)
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		else if($admin->passwrd != crypt($this->password, $admin->passwrd))
			$this->errorCode = self::ERROR_PASSWORD_INVALID;*/
		//if($this->password !== 'm#rsu1991@google' || $this->username !== 'oxAna')
        if(!$this->demoModeUserLogin())
        {
            $admin = Admin::model()->findByAttributes(array('login' => $this->username,));
            if($admin === null)
                $this->errorCode = self::ERROR_USERNAME_INVALID;
            else if($admin->passwrd != crypt($this->password, $admin->passwrd))
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            else{
                $this->_id = $admin->id;
                $this->setState('name', $this->name);
                $this->setState('adminId', $this->_id);
                $this->errorCode = self::ERROR_NONE;
            }
        }
		return !$this->errorCode;
	}

	public function getId(){
        return 'admin_1';
    }

    public function setId($val)
    {
        $this->_id = $val;
    }
    /**
     * Generates blowfish salt for password
     *
     * @param int $cost Cost of the blowfish algorithm
     * @return string Salt
     * @throws CHttpException
     */
    static public function getPassSalt($cost = 13)
    {
        if (!is_numeric($cost) || $cost < 4 || $cost > 31) {
            throw new CHttpException(403, "cost parameter must be between 4 and 31");
        }
        $rand = array();
        for ($i = 0; $i < 8; $i += 1) {
            $rand[] = pack('S', mt_rand(0, 0xffff));
        }
        $rand[] = substr(microtime(), 2, 6);
        $rand = sha1(implode('', $rand), true);
        $salt = '$2a$' . sprintf('%02d', $cost) . '$';
        $salt .= strtr(substr(base64_encode($rand), 0, 22), array('+' => '.'));
        return $salt;
    }
}

?>