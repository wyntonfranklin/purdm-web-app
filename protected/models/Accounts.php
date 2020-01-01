<?php

/**
 * This is the model class for table "accounts".
 *
 * The followings are the available columns in table 'accounts':
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property  integer $user_id
 * @property string $currentBalance
 */
class Accounts extends Model
{

    public $currentBalance = "";
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'accounts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'length', 'max'=>125,'min'=>5),
			array('type', 'length', 'max'=>45),
            array('user_id', 'numerical', 'integerOnly'=>true),
            array('currentBalance', 'match', 'pattern'=>'/^[0-9]+(\.[0-9]{1,2})?$/'),
            array('name, user_id', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, type', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'type' => 'Type',
		);
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Accounts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getListing(){
        $data =  self::getUserAccounts();
        return CHtml::listData($data,'id','shortName');
    }

    public function getTransactionsViewUrl(){
	    return Yii::app()->createUrl('/account/transactions',['id'=>$this->id]);
    }

    public function getAccountViewUrl(){
        return Yii::app()->createUrl('/account/' .$this->id);
    }

    public function getReconcileViewUrl(){
        return Yii::app()->createUrl('/account/reconciliation',['id'=>$this->id]);
    }

    public function getCloseViewUrl(){
        return Yii::app()->createUrl('/account/close',['id'=>$this->id]);
    }

    public function getUpdateViewUrl(){
        return Yii::app()->createUrl('/account/update',['id'=>$this->id]);
    }

    public function getUserAccounts(){
	    return self::findAllByAttributes(['user_id'=>Utils::getCurrentUserId()]);
    }

    public function getShortName(){
        $charCount = strlen($this->name);
        if($charCount >20){
            return substr($this->name,0,20) . "...";
        }
        return $this->name;
    }
}
