<?php

/**
 * This is the model class for table "precios_hoteles".
 *
 * The followings are the available columns in table 'precios_hoteles':
 * @property integer $precio_id
 * @property string $precio_destino
 * @property string $precio_destino_codigo
 * @property string $precio_actualizacion_fecha
 * @property string $precio_estrellas
 * @property string $precio_precio
 * @property string $precio_imagen
 * @property integer $precio_tipo
 */
class Destinos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PreciosHoteles the static model class
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
		return 'destino';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('precio_destino, precio_destino_codigo, precio_actualizacion_fecha, precio_estrellas, precio_precio, precio_imagen', 'required'),
			array('precio_tipo', 'numerical', 'integerOnly'=>true),
			array('precio_destino', 'length', 'max'=>100),
			array('precio_destino_codigo, precio_precio', 'length', 'max'=>10),
			array('precio_estrellas', 'length', 'max'=>2),
			array('precio_imagen', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('precio_id, precio_destino, precio_destino_codigo, precio_actualizacion_fecha, precio_estrellas, precio_precio, precio_imagen, precio_tipo', 'safe', 'on'=>'search'),
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
			'destino_id' => 'Destino',
			'destino_nombre' => 'Nombre Destino',
			/*'precio_destino_codigo' => 'Precio Destino Codigo',
			'precio_actualizacion_fecha' => 'Precio Actualizacion Fecha',
			'precio_estrellas' => 'Precio Estrellas',
			'precio_precio' => 'Precio Precio',
			'precio_imagen' => 'Precio Imagen',
			'precio_tipo' => 'Precio Tipo',*/
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

		$criteria->compare('destino_id',$this->destino_id);
		/*$criteria->compare('precio_destino',$this->precio_destino,true);
		$criteria->compare('precio_destino_codigo',$this->precio_destino_codigo,true);
		$criteria->compare('precio_actualizacion_fecha',$this->precio_actualizacion_fecha,true);
		$criteria->compare('precio_estrellas',$this->precio_estrellas,true);
		$criteria->compare('precio_precio',$this->precio_precio,true);
		$criteria->compare('precio_imagen',$this->precio_imagen,true);
		$criteria->compare('precio_tipo',$this->precio_tipo);
*/
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
