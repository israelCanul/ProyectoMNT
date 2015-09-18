<?php

/**
 * This is the model class for table "venta_data_tns".
 *
 * The followings are the available columns in table 'venta_data_tns':
 * @property integer $venta_data_id
 * @property integer $venta_id
 * @property string $venta_fecha
 * @property string $venta_data
 */
class VentaTns extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VentaTns the static model class
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
		return 'venta_data_tns';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('venta_id, venta_data', 'required'),
			array('venta_id', 'numerical', 'integerOnly'=>true),
			array('venta_fecha', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('venta_data_id, venta_id, venta_fecha, venta_data', 'safe', 'on'=>'search'),
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
			'venta_data_id' => 'Venta Data',
			'venta_id' => 'Venta',
			'venta_fecha' => 'Venta Fecha',
			'venta_data' => 'Venta Data',
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

		$criteria->compare('venta_data_id',$this->venta_data_id);
		$criteria->compare('venta_id',$this->venta_id);
		$criteria->compare('venta_fecha',$this->venta_fecha,true);
		$criteria->compare('venta_data',$this->venta_data,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
