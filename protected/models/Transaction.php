<?php

/**
 * This is the model class for table "transactions".
 *
 * The followings are the available columns in table 'transactions':
 * @property integer $transaction_id
 * @property string $trans_date
 * @property string $amount
 * @property string $description
 * @property string $category
 * @property integer $account_id
 * @property string $type
 * @property string $memo
 */
class Transaction extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'transactions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('account_id', 'numerical', 'integerOnly'=>true),
			array('amount, description, category, type', 'length', 'max'=>45),
            array('memo', 'length', 'max'=>125),
            array('amount', 'match', 'pattern'=>'/^[0-9]+(\.[0-9]{1,2})?$/'),
            array('account_id, amount, description, category, type,
            trans_date', 'required','on'=>'save-trans'),
			array('trans_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('transaction_id, trans_date, amount, description, category, account_id, type, memo', 'safe', 'on'=>'search'),
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
			'transaction_id' => 'Transaction',
			'trans_date' => 'Trans Date',
			'amount' => 'Amount',
			'description' => 'Description',
			'category' => 'Category',
			'account_id' => 'Account',
			'type' => 'Type',
		);
	}


	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('transaction_id',$this->transaction_id);
		$criteria->compare('trans_date',$this->trans_date,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getNetWorth(){

    }

    public function getAsJsonObject(){
	    $results = [];
	    $results['transDate'] = $this->trans_date;
        $results['amount'] = $this->amount;
        $results['description'] = $this->description;
        $results['category'] = $this->category;
        $results['type'] = $this->type;
        $results["account"] = $this->account_id;
        $results['frequency'] = $this->getFrequency();
        $results['memo'] = $this->memo;
				$results["accountName"] = $this->getAccountName();
        return $results;
    }

    public function getFrequency(){
	    $model = RepeatTransaction::model()->findByAttributes(['transaction_id'=>$this->id]);
	    if($model == null ){
	        return "";
        }else{
	        return $model->frequency;
        }
    }

    public function getId(){
	    return $this->transaction_id;
    }

    public function getAccountName(){
	    return Accounts::model()->findByPk($this->account_id)->name;
    }

    public function getShortDate(){
        return  date("d, M", strtotime($this->trans_date));
    }

    public function getHTMLErrorSummary(){
	    return CHtml::errorSummary($this);
    }

    public function assignAmount($val){
	    $this->amount = str_replace( ',', '', $val);
    }

    public function getCategoryUrl(){
	    return Yii::app()->createUrl('/category/report',['name'=>$this->category]);
    }

    public function getAccountUrl(){
        return Yii::app()->createUrl('/account/view',['id'=>$this->account_id]);
    }
}
