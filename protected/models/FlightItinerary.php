<?php

/**
 * This is the model class for table "flight_itinerary".
 *
 * The followings are the available columns in table 'flight_itinerary':
 * @property integer $itineraryID
 * @property string $date_transaction
 * @property string $fl_from
 * @property string $fl_to
 * @property integer $saleID
 * @property string $total
 * @property string $res_code
 * @property string $sabre_token
 */
class FlightItinerary extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return FlightItinerary the static model class
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
		return 'flight_itinerary';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_transaction', 'required'),
			array('saleID', 'numerical', 'integerOnly'=>true),
			array('fl_from, fl_to, total', 'length', 'max'=>10),
			array('res_code', 'length', 'max'=>25),
			array('sabre_token', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('itineraryID, date_transaction, fl_from, fl_to, saleID, total, res_code, sabre_token', 'safe', 'on'=>'search'),
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
			'itineraryID' => 'Itinerary',
			'date_transaction' => 'Date Transaction',
			'fl_from' => 'Fl From',
			'fl_to' => 'Fl To',
			'saleID' => 'Sale',
			'total' => 'Total',
			'res_code' => 'Res Code',
			'sabre_token' => 'Sabre Token',
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

		$criteria->compare('itineraryID',$this->itineraryID);
		$criteria->compare('date_transaction',$this->date_transaction,true);
		$criteria->compare('fl_from',$this->fl_from,true);
		$criteria->compare('fl_to',$this->fl_to,true);
		$criteria->compare('saleID',$this->saleID);
		$criteria->compare('total',$this->total,true);
		$criteria->compare('res_code',$this->res_code,true);
		$criteria->compare('sabre_token',$this->sabre_token,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
