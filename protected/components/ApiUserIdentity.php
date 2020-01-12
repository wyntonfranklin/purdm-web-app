<?php
/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class ApiUserIdentity extends CUserIdentity
{
    private $_id;

    public function authenticate()
    {
        $this->_id = '1';
        $userModel = Users::model()->findByAttributes(['email'=>$this->password,'username'=>$this->username]);
        $this->setState('userid', $userModel->id);
        $this->setState('email', $userModel->email);
        $this->setState('username', $userModel->username);
        $this->errorCode=self::ERROR_NONE;
        return !$this->errorCode;
    }
    /**
     * @return integer the ID of the user record
     */
    public function getId()
    {
        return $this->_id;
    }
}
