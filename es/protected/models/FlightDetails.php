<?php

/**
 * This is the model class for table "flight_details".
 *
 * The followings are the available columns in table 'flight_details':
 * @property integer $flightID
 * @property integer $itineraryID
 * @property string $fl_airline
 * @property string $fl_from
 * @property string $fl_to
 * @property string $fl_departure
 * @property string $fl_arrival
 * @property string $fl_number
 * @property integer $adults
 * @property integer $childs
 */
class FlightDetails extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return FlightDetails the static model class
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
		return 'flight_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('itineraryID, adults, childs', 'numerical', 'integerOnly'=>true),
			array('fl_airline, fl_number', 'length', 'max'=>10),
			array('fl_from, fl_to', 'length', 'max'=>4),
			array('fl_departure, fl_arrival', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('flightID, itineraryID, fl_airline, fl_from, fl_to, fl_departure, fl_arrival, fl_number, adults, childs', 'safe', 'on'=>'search'),
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
			'flightID' => 'Flight',
			'itineraryID' => 'Itinerary',
			'fl_airline' => 'Fl Airline',
			'fl_from' => 'Fl From',
			'fl_to' => 'Fl To',
			'fl_departure' => 'Fl Departure',
			'fl_arrival' => 'Fl Arrival',
			'fl_number' => 'Fl Number',
			'adults' => 'Adults',
			'childs' => 'Childs',
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

		$criteria->compare('flightID',$this->flightID);
		$criteria->compare('itineraryID',$this->itineraryID);
		$criteria->compare('fl_airline',$this->fl_airline,true);
		$criteria->compare('fl_from',$this->fl_from,true);
		$criteria->compare('fl_to',$this->fl_to,true);
		$criteria->compare('fl_departure',$this->fl_departure,true);
		$criteria->compare('fl_arrival',$this->fl_arrival,true);
		$criteria->compare('fl_number',$this->fl_number,true);
		$criteria->compare('adults',$this->adults);
		$criteria->compare('childs',$this->childs);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
