<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $createdAt
 * @property integer $userType
 */
class Users extends Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, email, password', 'length', 'max'=>125),
            array('username, email', 'required','on'=>'create-user'),
            array('email', 'unique'),
            array('username', 'unique'),
            array('createdAt, userType', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, email, createdAt, password', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'email' => 'Email',
			'createdAt' => 'Created At',
		);
	}

	public function getType(){
	    if(isset($this->userType)){
	        if($this->userType == null ){
	            return 0;
            }else{
                return $this->userType;
            }
        }else{
	        return 0;
        }
    }

    public function getUserRole(){
	    if($this->getType() == 0 || $this->getType() == null){
	        return "normal";
        }
	    return "admin";
    }

    public function assignUserType($val){
	    if($val){
	        $this->userType = $val;
        }else{
	        $this->userType = 0;
        }
    }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('createdAt',$this->createdAt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function session_validate(  )
    {
        // Encrypt information about this session
        $user_agent = $this->session_hash_string($_SERVER['userid'], $this->email);
        // Check for instance of session
        if ( $this->session_exists() == false )
        {
            // The session does not exist, create it
            $this->session_reset($user_agent);
        }
        // Match the hashed key in session against the new hashed string
        if ( $this->session_match($user_agent) )
        {
            return true;
        }
        // The hashed string is different, reset session
        $this->session_reset($user_agent);
        return false;
    }
    /**
     * session_exists()
     * Will check if the needed session keys exists.
     *
     * @return {boolean} True if keys exists, else false
     */
    private function session_exists()
    {
        return isset($_SESSION['userid']) && isset($_SESSION['INIT']);
    }
    /**
     * session_match()
     * Compares the session secret with the current generated secret.
     *
     * @param {String} $user_agent The encrypted key
     */
    private function session_match( $user_agent )
    {
        // Validate the agent and initiated
        return $_SESSION['userid'] == $user_agent && $_SESSION['INIT'] == true;
    }
    /**
     * session_encrypt()
     * Generates a unique encrypted string
     *
     * @param {String} $user_agent      The http_user_agent constant
     * @param {String} $unique_string    Something unique for the user (email, etc)
     */
    private function session_hash_string( $user_agent, $unique_string )
    {
        return md5($user_agent.$unique_string);
    }
    /**
     * session_reset()
     * Will regenerate the session_id (the local file) and build a new
     * secret for the user.
     *
     * @param {String} $user_agent
     */
    private function session_reset( $user_agent )
    {
        // Create new id
        session_regenerate_id(TRUE);
        $_SESSION = array();
        $_SESSION['INIT'] = true;
        // Set hashed http user agent
        $_SESSION['userid'] = $user_agent;
    }
    /**
     * Destroys the session
     */
    private function session_destroy()
    {
        // Destroy session
        session_destroy();
    }
    public function validatePassword(){
        return true;
    }
}
