<?php

/**
 * This is the model class for table "venta_descripcion".
 *
 * The followings are the available columns in table 'venta_descripcion':
 * @property integer $descripcion_id
 * @property integer $descripcion_venta
 * @property string $descripcion_fecha
 * @property integer $descripcion_adultos
 * @property integer $descripcion_cuartos
 * @property string $descripcion_fecha1
 * @property string $descripcion_fecha2
 * @property string $descripcion_precio
 * @property string $descripcion_producto
 * @property string $descripcion_tarifa
 * @property string $descripcion_total
 * @property string $descripcion_brief
 * @property integer $descripcion_menores
 * @property integer $descripcion_tipo_producto
 * @property string $descripcion_tarifa_id
 * @property string $descripcion_producto_id
 * @property string $descripcion_servicio_id
 * @property integer $descripcion_reservable
 * @property integer $descripcion_pagado
 * @property integer $descripcion_proveedor
 * @property string $descripcion_vuelo1
 * @property string $descripcion_vuelo2
 * @property string $descripcion_servicio_ini
 * @property integer $descripcion_infantes
 * @property string $descripcion_hotel1
 * @property string $descripcion_hotel2
 * @property integer $descripcion_destino
 * @property integer $descripcion_itinerary
 * @property string $descripcion_add_val_1
 * @property string $descripcion_add_val_2
 * @property string $descripcion_thumb
 * @property string $descripcion_serialized
 * @property string $descripcion_hora_llegada_vuelo1
 * @property string $descripcion_num_vuelo1
 * @property string $descripcion_linea_area1
 * @property string $descripcion_hora_llegada_vuelo2
 * @property string $descripcion_num_vuelo2
 * @property string $descripcion_linea_area2
 * @property string $observaciones
 * @property string $hotel_huesped
 * @property integer $descripcion_promo_id
 * @property string $valor_agregado
 * @property string $telefono
 * @property integer $tipo_translado
 * @property string $descripcion_promo_name
 * @property string $proveedor_info
 * @property string $descripcion_confirmacion
 * @property string $descripcion_pick_up
 * @property string $descripcion_notas_clientes
 * @property string $descripcion_descuento
 * @property integer $descripcion_id_cupon
 * @property string $descripcion_mkp
 * @property integer $hasIOFraud
 * @property integer $hadIOFraud
 * @property integer $clearIOFraud
 * @property string $IOFraud_filters
 */
class VentaDescripcion_latin extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VentaDescripcion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getDbConnection()
	{
			return Yii::app()->dbCharset;
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'venta_descripcion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('descripcion_venta, descripcion_fecha, descripcion_adultos, descripcion_cuartos, descripcion_fecha1, descripcion_fecha2, descripcion_precio, descripcion_producto, descripcion_total, descripcion_menores, descripcion_tipo_producto, descripcion_destino', 'required'),
			array('descripcion_venta, descripcion_adultos, descripcion_cuartos, descripcion_menores, descripcion_tipo_producto, descripcion_reservable, descripcion_pagado, descripcion_proveedor, descripcion_infantes, descripcion_destino, descripcion_itinerary, descripcion_promo_id, tipo_translado, descripcion_id_cupon, hasIOFraud, hadIOFraud, clearIOFraud', 'numerical', 'integerOnly'=>true),
			array('descripcion_precio, descripcion_total, descripcion_descuento', 'length', 'max'=>10),
			array('descripcion_producto', 'length', 'max'=>150),
			array('descripcion_tarifa', 'length', 'max'=>200),
			array('descripcion_tarifa_id, descripcion_producto_id, descripcion_servicio_id, descripcion_servicio_ini, descripcion_thumb, descripcion_promo_name, proveedor_info, IOFraud_filters', 'length', 'max'=>250),
			array('descripcion_vuelo1, descripcion_vuelo2, telefono, descripcion_confirmacion, descripcion_pick_up', 'length', 'max'=>100),
			array('descripcion_hotel1, descripcion_hotel2, descripcion_hora_llegada_vuelo1, descripcion_num_vuelo1, descripcion_linea_area1, descripcion_hora_llegada_vuelo2, descripcion_num_vuelo2, descripcion_linea_area2, hotel_huesped', 'length', 'max'=>150),
			array('descripcion_mkp', 'length', 'max'=>30),
			array('descripcion_brief, descripcion_add_val_1, descripcion_add_val_2, descripcion_serialized, observaciones, valor_agregado, descripcion_notas_clientes', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('descripcion_id, descripcion_venta, descripcion_fecha, descripcion_adultos, descripcion_cuartos, descripcion_fecha1, descripcion_fecha2, descripcion_precio, descripcion_producto, descripcion_tarifa, descripcion_total, descripcion_brief, descripcion_menores, descripcion_tipo_producto, descripcion_tarifa_id, descripcion_producto_id, descripcion_servicio_id, descripcion_reservable, descripcion_pagado, descripcion_proveedor, descripcion_vuelo1, descripcion_vuelo2, descripcion_servicio_ini, descripcion_infantes, descripcion_hotel1, descripcion_hotel2, descripcion_destino, descripcion_itinerary, descripcion_add_val_1, descripcion_add_val_2, descripcion_thumb, descripcion_serialized, descripcion_hora_llegada_vuelo1, descripcion_num_vuelo1, descripcion_linea_area1, descripcion_hora_llegada_vuelo2, descripcion_num_vuelo2, descripcion_linea_area2, observaciones, hotel_huesped, descripcion_promo_id, valor_agregado, telefono, tipo_translado, descripcion_promo_name, proveedor_info, descripcion_confirmacion, descripcion_pick_up, descripcion_notas_clientes, descripcion_descuento, descripcion_id_cupon, descripcion_mkp, hasIOFraud, hadIOFraud, clearIOFraud, IOFraud_filters', 'safe', 'on'=>'search'),
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
			'descripcion_id' => 'Descripcion',
			'descripcion_venta' => 'Descripcion Venta',
			'descripcion_fecha' => 'Descripcion Fecha',
			'descripcion_adultos' => 'Descripcion Adultos',
			'descripcion_cuartos' => 'Descripcion Cuartos',
			'descripcion_fecha1' => 'Descripcion Fecha1',
			'descripcion_fecha2' => 'Descripcion Fecha2',
			'descripcion_precio' => 'Descripcion Precio',
			'descripcion_producto' => 'Descripcion Producto',
			'descripcion_tarifa' => 'Descripcion Tarifa',
			'descripcion_total' => 'Descripcion Total',
			'descripcion_brief' => 'Descripcion Brief',
			'descripcion_menores' => 'Descripcion Menores',
			'descripcion_tipo_producto' => 'Descripcion Tipo Producto',
			'descripcion_tarifa_id' => 'Descripcion Tarifa',
			'descripcion_producto_id' => 'Descripcion Producto',
			'descripcion_servicio_id' => 'Descripcion Servicio',
			'descripcion_reservable' => 'Descripcion Reservable',
			'descripcion_pagado' => 'Descripcion Pagado',
			'descripcion_proveedor' => 'Descripcion Proveedor',
			'descripcion_vuelo1' => 'Descripcion Vuelo1',
			'descripcion_vuelo2' => 'Descripcion Vuelo2',
			'descripcion_servicio_ini' => 'Descripcion Servicio Ini',
			'descripcion_infantes' => 'Descripcion Infantes',
			'descripcion_hotel1' => 'Descripcion Hotel1',
			'descripcion_hotel2' => 'Descripcion Hotel2',
			'descripcion_destino' => 'Descripcion Destino',
			'descripcion_itinerary' => 'Descripcion Itinerary',
			'descripcion_add_val_1' => 'Descripcion Add Val 1',
			'descripcion_add_val_2' => 'Descripcion Add Val 2',
			'descripcion_thumb' => 'Descripcion Thumb',
			'descripcion_serialized' => 'Descripcion Serialized',
			'descripcion_hora_llegada_vuelo1' => 'Descripcion Hora Llegada Vuelo1',
			'descripcion_num_vuelo1' => 'Descripcion Num Vuelo1',
			'descripcion_linea_area1' => 'Descripcion Linea Area1',
			'descripcion_hora_llegada_vuelo2' => 'Descripcion Hora Llegada Vuelo2',
			'descripcion_num_vuelo2' => 'Descripcion Num Vuelo2',
			'descripcion_linea_area2' => 'Descripcion Linea Area2',
			'observaciones' => 'Observaciones',
			'hotel_huesped' => 'Hotel Huesped',
			'descripcion_promo_id' => 'Descripcion Promo',
			'valor_agregado' => 'Valor Agregado',
			'telefono' => 'Telefono',
			'tipo_translado' => 'Tipo Translado',
			'descripcion_promo_name' => 'Descripcion Promo Name',
			'proveedor_info' => 'Proveedor Info',
			'descripcion_confirmacion' => 'Descripcion Confirmacion',
			'descripcion_pick_up' => 'Descripcion Pick Up',
			'descripcion_notas_clientes' => 'Descripcion Notas Clientes',
			'descripcion_descuento' => 'Descripcion Descuento',
			'descripcion_id_cupon' => 'Descripcion Id Cupon',
			'descripcion_mkp' => 'Descripcion Mkp',
			'hasIOFraud' => 'Has Iofraud',
			'hadIOFraud' => 'Had Iofraud',
			'clearIOFraud' => 'Clear Iofraud',
			'IOFraud_filters' => 'Iofraud Filters',
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

		$criteria->compare('descripcion_id',$this->descripcion_id);
		$criteria->compare('descripcion_venta',$this->descripcion_venta);
		$criteria->compare('descripcion_fecha',$this->descripcion_fecha,true);
		$criteria->compare('descripcion_adultos',$this->descripcion_adultos);
		$criteria->compare('descripcion_cuartos',$this->descripcion_cuartos);
		$criteria->compare('descripcion_fecha1',$this->descripcion_fecha1,true);
		$criteria->compare('descripcion_fecha2',$this->descripcion_fecha2,true);
		$criteria->compare('descripcion_precio',$this->descripcion_precio,true);
		$criteria->compare('descripcion_producto',$this->descripcion_producto,true);
		$criteria->compare('descripcion_tarifa',$this->descripcion_tarifa,true);
		$criteria->compare('descripcion_total',$this->descripcion_total,true);
		$criteria->compare('descripcion_brief',$this->descripcion_brief,true);
		$criteria->compare('descripcion_menores',$this->descripcion_menores);
		$criteria->compare('descripcion_tipo_producto',$this->descripcion_tipo_producto);
		$criteria->compare('descripcion_tarifa_id',$this->descripcion_tarifa_id,true);
		$criteria->compare('descripcion_producto_id',$this->descripcion_producto_id,true);
		$criteria->compare('descripcion_servicio_id',$this->descripcion_servicio_id,true);
		$criteria->compare('descripcion_reservable',$this->descripcion_reservable);
		$criteria->compare('descripcion_pagado',$this->descripcion_pagado);
		$criteria->compare('descripcion_proveedor',$this->descripcion_proveedor);
		$criteria->compare('descripcion_vuelo1',$this->descripcion_vuelo1,true);
		$criteria->compare('descripcion_vuelo2',$this->descripcion_vuelo2,true);
		$criteria->compare('descripcion_servicio_ini',$this->descripcion_servicio_ini,true);
		$criteria->compare('descripcion_infantes',$this->descripcion_infantes);
		$criteria->compare('descripcion_hotel1',$this->descripcion_hotel1,true);
		$criteria->compare('descripcion_hotel2',$this->descripcion_hotel2,true);
		$criteria->compare('descripcion_destino',$this->descripcion_destino);
		$criteria->compare('descripcion_itinerary',$this->descripcion_itinerary);
		$criteria->compare('descripcion_add_val_1',$this->descripcion_add_val_1,true);
		$criteria->compare('descripcion_add_val_2',$this->descripcion_add_val_2,true);
		$criteria->compare('descripcion_thumb',$this->descripcion_thumb,true);
		$criteria->compare('descripcion_serialized',$this->descripcion_serialized,true);
		$criteria->compare('descripcion_hora_llegada_vuelo1',$this->descripcion_hora_llegada_vuelo1,true);
		$criteria->compare('descripcion_num_vuelo1',$this->descripcion_num_vuelo1,true);
		$criteria->compare('descripcion_linea_area1',$this->descripcion_linea_area1,true);
		$criteria->compare('descripcion_hora_llegada_vuelo2',$this->descripcion_hora_llegada_vuelo2,true);
		$criteria->compare('descripcion_num_vuelo2',$this->descripcion_num_vuelo2,true);
		$criteria->compare('descripcion_linea_area2',$this->descripcion_linea_area2,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('hotel_huesped',$this->hotel_huesped,true);
		$criteria->compare('descripcion_promo_id',$this->descripcion_promo_id);
		$criteria->compare('valor_agregado',$this->valor_agregado,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('tipo_translado',$this->tipo_translado);
		$criteria->compare('descripcion_promo_name',$this->descripcion_promo_name,true);
		$criteria->compare('proveedor_info',$this->proveedor_info,true);
		$criteria->compare('descripcion_confirmacion',$this->descripcion_confirmacion,true);
		$criteria->compare('descripcion_pick_up',$this->descripcion_pick_up,true);
		$criteria->compare('descripcion_notas_clientes',$this->descripcion_notas_clientes,true);
		$criteria->compare('descripcion_descuento',$this->descripcion_descuento,true);
		$criteria->compare('descripcion_id_cupon',$this->descripcion_id_cupon);
		$criteria->compare('descripcion_mkp',$this->descripcion_mkp,true);
		$criteria->compare('hasIOFraud',$this->hasIOFraud);
		$criteria->compare('hadIOFraud',$this->hadIOFraud);
		$criteria->compare('clearIOFraud',$this->clearIOFraud);
		$criteria->compare('IOFraud_filters',$this->IOFraud_filters,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
