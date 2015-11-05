<?php

/**
 * This is the model class for table "test_card".
 *
 * The followings are the available columns in table 'test_card':
 * @property integer $card_id
 * @property string $card_mail
 * @property string $card_name
 * @property string $card_valid
 * @property string $card_number
 * @property string $card_month
 * @property string $card_year
 * @property string $card_cvv
 */
class TestCard extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TestCard the static model class
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
		return 'test_card';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('card_mail, card_name, card_valid, card_number, card_month, card_year, card_cvv', 'required'),
			array('card_mail, card_name', 'length', 'max'=>150),
			array('card_number', 'length', 'max'=>16),
			array('card_month, card_year', 'length', 'max'=>2),
			array('card_cvv', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('card_id, card_mail, card_name, card_valid, card_number, card_month, card_year, card_cvv', 'safe', 'on'=>'search'),
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
			'card_id' => 'Card',
			'card_mail' => 'Card Mail',
			'card_name' => 'Card Name',
			'card_valid' => 'Card Valid',
			'card_number' => 'Card Number',
			'card_month' => 'Card Month',
			'card_year' => 'Card Year',
			'card_cvv' => 'Card Cvv',
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

		$criteria->compare('card_id',$this->card_id);
		$criteria->compare('card_mail',$this->card_mail,true);
		$criteria->compare('card_name',$this->card_name,true);
		$criteria->compare('card_valid',$this->card_valid,true);
		$criteria->compare('card_number',$this->card_number,true);
		$criteria->compare('card_month',$this->card_month,true);
		$criteria->compare('card_year',$this->card_year,true);
		$criteria->compare('card_cvv',$this->card_cvv,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
