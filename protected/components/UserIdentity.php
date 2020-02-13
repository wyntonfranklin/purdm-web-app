<?php
/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;

    public function authenticate()
    {
        $record = Users::model()->findByAttributes(array('email'=>$this->username));
        $this->errorMessage = "";
        if($record === null ){
            $record = Users::model()->findByAttributes(array('username'=>$this->username));
        }
        $ph=new PasswordHash(Yii::app()->params['phpass']['iteration_count_log2'],
            Yii::app()->params['phpass']['portable_hashes']);
        if($record===null){
            $this->errorMessage = "This account does not exists.";
        }else if(!$ph->CheckPassword($this->password, $record->password)){
            $this->errorMessage = "Username or password is incorrect.";
        }else{
            $name = $record->username;
            $this->_id = $record->id;
            $this->setState('userid', $record->id);
            $this->setState('email', $record->email);
            $this->setState('username', $name);
            $this->setState('role', $record->getUserRole());
            $this->errorCode=self::ERROR_NONE;
        }
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
