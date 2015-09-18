<?php

/**
 * This is the model class for table "flight_traveler".
 *
 * The followings are the available columns in table 'flight_traveler':
 * @property integer $travelerID
 * @property integer $itineraryID
 * @property integer $saleID
 * @property string $last_name
 * @property string $first_name
 * @property string $email
 * @property string $phone
 * @property string $phone_area_code
 */
class FlightTraveler extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return FlightTraveler the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'flight_traveler';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('itineraryID, saleID', 'numerical', 'integerOnly'=>true),
			array('last_name, first_name, email', 'length', 'max'=>250),
			array('phone', 'length', 'max'=>11),
			array('phone_area_code', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('travelerID, itineraryID, saleID, last_name, first_name, email, phone, phone_area_code', 'safe', 'on'=>'search'),
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
			'travelerID' => 'Traveler',
			'itineraryID' => 'Itinerary',
			'saleID' => 'Sale',
			'last_name' => 'Last Name',
			'first_name' => 'First Name',
			'email' => 'Email',
			'phone' => 'Phone',
			'phone_area_code' => 'Phone Area Code',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('travelerID',$this->travelerID);
		$criteria->compare('itineraryID',$this->itineraryID);
		$criteria->compare('saleID',$this->saleID);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('phone_area_code',$this->phone_area_code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
