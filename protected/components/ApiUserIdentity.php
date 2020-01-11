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
        $this->setState('userid', '1');
        $this->setState('email', 'asdfasdf');
        $this->setState('username', 'asdfasfd');
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
