<?php

/**
 * This is the model class for table "tarjeta".
 *
 * The followings are the available columns in table 'tarjeta':
 * @property integer $tarjeta_id
 * @property integer $tarjeta_cliente
 * @property integer $tarjeta_venta
 * @property string $Ecom_Payment_Name
 * @property string $Ecom_Payment_Card_Number
 * @property string $Ecom_Payment_Card_Month
 * @property string $Ecom_Payment_Card_Year
 */
class Tarjeta extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Tarjeta the static model class
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
		return 'tarjeta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tarjeta_cliente, tarjeta_venta, Ecom_Payment_Card_Number, Ecom_Payment_Card_Month, Ecom_Payment_Card_Year', 'required'),
			array('tarjeta_cliente, tarjeta_venta', 'numerical', 'integerOnly'=>true),
			array('Ecom_Payment_Name, Ecom_Payment_Card_Number', 'length', 'max'=>250),
			array('Ecom_Payment_Card_Month', 'length', 'max'=>3),
			array('Ecom_Payment_Card_Year', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('tarjeta_id, tarjeta_cliente, tarjeta_venta, Ecom_Payment_Name, Ecom_Payment_Card_Number, Ecom_Payment_Card_Month, Ecom_Payment_Card_Year', 'safe', 'on'=>'search'),
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
			'tarjeta_id' => 'Tarjeta',
			'tarjeta_cliente' => 'Tarjeta Cliente',
			'tarjeta_venta' => 'Tarjeta Venta',
			'Ecom_Payment_Name' => 'Ecom Payment Name',
			'Ecom_Payment_Card_Number' => 'Ecom Payment Card Number',
			'Ecom_Payment_Card_Month' => 'Ecom Payment Card Month',
			'Ecom_Payment_Card_Year' => 'Ecom Payment Card Year',
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

		$criteria->compare('tarjeta_id',$this->tarjeta_id);
		$criteria->compare('tarjeta_cliente',$this->tarjeta_cliente);
		$criteria->compare('tarjeta_venta',$this->tarjeta_venta);
		$criteria->compare('Ecom_Payment_Name',$this->Ecom_Payment_Name,true);
		$criteria->compare('Ecom_Payment_Card_Number',$this->Ecom_Payment_Card_Number,true);
		$criteria->compare('Ecom_Payment_Card_Month',$this->Ecom_Payment_Card_Month,true);
		$criteria->compare('Ecom_Payment_Card_Year',$this->Ecom_Payment_Card_Year,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
