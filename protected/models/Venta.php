<?php

/**
 * This is the model class for table "venta".
 *
 * The followings are the available columns in table 'venta':
 * @property integer $venta_id
 * @property string $venta_session_id
 * @property string $venta_moneda
 * @property integer $venta_site_id
 * @property integer $venta_user_id
 * @property integer $venta_estt
 * @property string $venta_total
 * @property string $venta_fecha
 * @property string $venta_authcode
 * @property string $venta_autorizador
 * @property string $venta_hotel
 * @property string $venta_observacion
 * @property integer $tipo_pago
 * @property integer $venta_agente_id
 * @property string $venta_ip
 */
class Venta extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Venta the static model class
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
		return 'venta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('venta_session_id, venta_estt, venta_fecha', 'required'),
			array('venta_site_id, venta_user_id, venta_estt, tipo_pago, venta_agente_id', 'numerical', 'integerOnly'=>true),
			array('venta_session_id', 'length', 'max'=>160),
			array('venta_moneda', 'length', 'max'=>3),
			array('venta_total', 'length', 'max'=>10),
			array('venta_authcode', 'length', 'max'=>150),
			array('venta_autorizador, venta_hotel', 'length', 'max'=>100),
			array('venta_ip', 'length', 'max'=>30),
			array('venta_observacion', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('venta_id, venta_session_id, venta_moneda, venta_site_id, venta_user_id, venta_estt, venta_total, venta_fecha, venta_authcode, venta_autorizador, venta_hotel, venta_observacion, tipo_pago, venta_agente_id, venta_ip', 'safe', 'on'=>'search'),
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
			'venta_id' => 'Venta',
			'venta_session_id' => 'Venta Session',
			'venta_moneda' => 'Venta Moneda',
			'venta_site_id' => 'Venta Site',
			'venta_user_id' => 'Venta User',
			'venta_estt' => 'Venta Estt',
			'venta_total' => 'Venta Total',
			'venta_fecha' => 'Venta Fecha',
			'venta_authcode' => 'Venta Authcode',
			'venta_autorizador' => 'Venta Autorizador',
			'venta_hotel' => 'Venta Hotel',
			'venta_observacion' => 'Venta Observacion',
			'tipo_pago' => 'Tipo Pago',
			'venta_agente_id' => 'Venta Agente',
			'venta_ip' => 'Venta Ip',
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

		$criteria->compare('venta_id',$this->venta_id);
		$criteria->compare('venta_session_id',$this->venta_session_id,true);
		$criteria->compare('venta_moneda',$this->venta_moneda,true);
		$criteria->compare('venta_site_id',$this->venta_site_id);
		$criteria->compare('venta_user_id',$this->venta_user_id);
		$criteria->compare('venta_estt',$this->venta_estt);
		$criteria->compare('venta_total',$this->venta_total,true);
		$criteria->compare('venta_fecha',$this->venta_fecha,true);
		$criteria->compare('venta_authcode',$this->venta_authcode,true);
		$criteria->compare('venta_autorizador',$this->venta_autorizador,true);
		$criteria->compare('venta_hotel',$this->venta_hotel,true);
		$criteria->compare('venta_observacion',$this->venta_observacion,true);
		$criteria->compare('tipo_pago',$this->tipo_pago);
		$criteria->compare('venta_agente_id',$this->venta_agente_id);
		$criteria->compare('venta_ip',$this->venta_ip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
