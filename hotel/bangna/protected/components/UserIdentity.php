<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

    private $_id;
    private $_branchID;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
        /*
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
        */

        $users = Employee::model()->findByAttributes(array('username'=>strtolower($this->username)));

        if($users == null)
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        elseif($users->password !== md5($this->password)){
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        }
        elseif($users->active !== "1"){
            $this->errorMessage = "Message";
        }
        else
        {
            $this->_id = $users->id;
            $this->setState('username', $users->username);
            $this->setState('role', $users->admin);
            $this->setState('avtar', $users->avatar);
            $this->errorCode = self::ERROR_NONE;
        }

        return !$this->errorCode;
	}


    public function getId()
    {
        return $this->_id;
    }

}