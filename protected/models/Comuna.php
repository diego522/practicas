<?php

/**
 * This is the model class for table "comuna".
 *
 * The followings are the available columns in table 'comuna':
 * @property integer $COMUNA_ID
 * @property string $COMUNA_NOMBRE
 * @property integer $COMUNA_PROVINCIA_ID
 *
 * The followings are the available model relations:
 * @property Provincia $cOMUNAPROVINCIA
 * @property Empresa[] $empresas
 */
class Comuna extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comuna the static model class
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
		return 'comuna';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('COMUNA_ID, COMUNA_PROVINCIA_ID', 'numerical', 'integerOnly'=>true),
			array('COMUNA_NOMBRE', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('COMUNA_ID, COMUNA_NOMBRE, COMUNA_PROVINCIA_ID', 'safe', 'on'=>'search'),
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
			'cOMUNAPROVINCIA' => array(self::BELONGS_TO, 'Provincia', 'COMUNA_PROVINCIA_ID'),
			'empresas' => array(self::HAS_MANY, 'Empresa', 'id_cuidad_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'COMUNA_ID' => 'Comuna',
			'COMUNA_NOMBRE' => 'Comuna Nombre',
			'COMUNA_PROVINCIA_ID' => 'Comuna Provincia',
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

		$criteria->compare('COMUNA_ID',$this->COMUNA_ID);
		$criteria->compare('COMUNA_NOMBRE',$this->COMUNA_NOMBRE,true);
		$criteria->compare('COMUNA_PROVINCIA_ID',$this->COMUNA_PROVINCIA_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}