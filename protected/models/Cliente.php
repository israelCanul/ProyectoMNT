<?php

/**
 * This is the model class for table "cliente".
 *
 * The followings are the available columns in table 'cliente':
 * @property integer $cliente_id
 * @property string $cliente_nombre
 * @property string $cliente_apellido
 * @property string $cliente_genero
 * @property string $cliente_email
 * @property integer $cliente_pais
 * @property string $cliente_username
 * @property string $cliente_password
 * @property integer $cliente_activo
 * @property integer $cliente_mailing
 * @property string $cliente_domicilio
 * @property string $cliente_nacimiento
 * @property string $cliente_telefono
 * @property string $cliente_foto
 * @property string $cliente_pais_n
 * @property string $cliente_ciudad
 * @property string $cliente_estado
 * @property string $cliente_postal_code
 */
class Cliente extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cliente the static model class
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
		return 'cliente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cliente_pais, cliente_activo, cliente_mailing', 'numerical', 'integerOnly'=>true),
			array('cliente_nombre, cliente_apellido, cliente_email, cliente_domicilio, cliente_foto', 'length', 'max'=>250),
			array('cliente_genero, cliente_postal_code', 'length', 'max'=>10),
			array('cliente_username', 'length', 'max'=>50),
			array('cliente_password', 'length', 'max'=>150),
			array('cliente_nacimiento', 'length', 'max'=>20),
			array('cliente_telefono', 'length', 'max'=>25),
			array('cliente_pais_n, cliente_ciudad, cliente_estado', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cliente_id, cliente_nombre, cliente_apellido, cliente_genero, cliente_email, cliente_pais, cliente_username, cliente_password, cliente_activo, cliente_mailing, cliente_domicilio, cliente_nacimiento, cliente_telefono, cliente_foto, cliente_pais_n, cliente_ciudad, cliente_estado, cliente_postal_code', 'safe', 'on'=>'search'),
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
			'cliente_id' => 'Cliente',
			'cliente_nombre' => 'Cliente Nombre',
			'cliente_apellido' => 'Cliente Apellido',
			'cliente_genero' => 'Cliente Genero',
			'cliente_email' => 'Cliente Email',
			'cliente_pais' => 'Cliente Pais',
			'cliente_username' => 'Cliente Username',
			'cliente_password' => 'Cliente Password',
			'cliente_activo' => 'Cliente Activo',
			'cliente_mailing' => 'Cliente Mailing',
			'cliente_domicilio' => 'Cliente Domicilio',
			'cliente_nacimiento' => 'Cliente Nacimiento',
			'cliente_telefono' => 'Cliente Telefono',
			'cliente_foto' => 'Cliente Foto',
			'cliente_pais_n' => 'Cliente Pais N',
			'cliente_ciudad' => 'Cliente Ciudad',
			'cliente_estado' => 'Cliente Estado',
			'cliente_postal_code' => 'Cliente Postal Code',
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

		$criteria->compare('cliente_id',$this->cliente_id);
		$criteria->compare('cliente_nombre',$this->cliente_nombre,true);
		$criteria->compare('cliente_apellido',$this->cliente_apellido,true);
		$criteria->compare('cliente_genero',$this->cliente_genero,true);
		$criteria->compare('cliente_email',$this->cliente_email,true);
		$criteria->compare('cliente_pais',$this->cliente_pais);
		$criteria->compare('cliente_username',$this->cliente_username,true);
		$criteria->compare('cliente_password',$this->cliente_password,true);
		$criteria->compare('cliente_activo',$this->cliente_activo);
		$criteria->compare('cliente_mailing',$this->cliente_mailing);
		$criteria->compare('cliente_domicilio',$this->cliente_domicilio,true);
		$criteria->compare('cliente_nacimiento',$this->cliente_nacimiento,true);
		$criteria->compare('cliente_telefono',$this->cliente_telefono,true);
		$criteria->compare('cliente_foto',$this->cliente_foto,true);
		$criteria->compare('cliente_pais_n',$this->cliente_pais_n,true);
		$criteria->compare('cliente_ciudad',$this->cliente_ciudad,true);
		$criteria->compare('cliente_estado',$this->cliente_estado,true);
		$criteria->compare('cliente_postal_code',$this->cliente_postal_code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
