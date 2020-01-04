<?php

/**
 * This is the model class for table "repeat_transactions".
 *
 * The followings are the available columns in table 'repeat_transactions':
 * @property integer $id
 * @property string $created_date
 * @property string $upcoming_date
 * @property integer $transaction_id
 * @property string $frequency
 */
class RepeatTransaction extends Model
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'repeat_transactions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('transaction_id', 'numerical', 'integerOnly'=>true),
			array('frequency', 'length', 'max'=>45),
			array('created_date, upcoming_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, created_date, upcoming_date, transaction_id, frequency', 'safe', 'on'=>'search'),
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
			'created_date' => 'Created Date',
			'upcoming_date' => 'Upcoming Date',
			'transaction_id' => 'Transaction',
			'frequency' => 'Frequency',
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
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('upcoming_date',$this->upcoming_date,true);
		$criteria->compare('transaction_id',$this->transaction_id);
		$criteria->compare('frequency',$this->frequency,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RepeatTransaction the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function setUpComingDateFromFrequency(){
	    $freq = $this->frequency;
	    $currentDate = $this->created_date;
        $this->setUpcomingByFreq($freq, $currentDate);
    }

    private function setUpcomingByFreq($freq, $currentDate){
        if($freq == "month"){
            $this->upcoming_date = $this->addOneMonth($currentDate);
        }else if($freq == 'year'){
            $this->upcoming_date = date('Y-m-d', strtotime("+1 years", strtotime($currentDate)));
        }else if($freq == "week"){
            $this->upcoming_date = date('Y-m-d', strtotime("+1 weeks", strtotime($currentDate)));
        }else if($freq == "day"){
            $this->upcoming_date = date('Y-m-d', strtotime("+1 days", strtotime($currentDate)));
        }
    }

    public function setCurrentUpComingDate(){
        $freq = $this->frequency;
        $currentDate = $this->upcoming_date;
        $this->setUpcomingByFreq($freq, $currentDate);
    }

    public function getShortDate(){
        return  date("d, M y", strtotime($this->upcoming_date));
    }

    private function addOneMonth($m){
        $monthToAdd = 1;
        $d1 = DateTime::createFromFormat('Y-m-d', $m);

        $year = $d1->format('Y');
        $month = $d1->format('n');
        $day = $d1->format('d');

        $year += floor($monthToAdd/12);
        $monthToAdd = $monthToAdd%12;
        $month += $monthToAdd;
        if($month > 12) {
            $year ++;
            $month = $month % 12;
            if($month === 0)
                $month = 12;
        }

        if(!checkdate($month, $day, $year)) {
            $d2 = DateTime::createFromFormat('Y-n-j', $year.'-'.$month.'-1');
            $d2->modify('last day of');
        }else {
            $d2 = DateTime::createFromFormat('Y-n-d', $year.'-'.$month.'-'.$day);
        }
        $d2->setTime($d1->format('H'), $d1->format('i'), $d1->format('s'));
        return $d2->format('Y-m-d');
    }
}
