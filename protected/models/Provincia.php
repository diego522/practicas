<?php

/**
 * This is the model class for table "provincia".
 *
 * The followings are the available columns in table 'provincia':
 * @property integer $PROVINCIA_ID
 * @property string $PROVINCIA_NOMBRE
 * @property integer $PROVINCIA_REGION_ID
 *
 * The followings are the available model relations:
 * @property Comuna[] $comunas
 * @property Region $pROVINCIAREGION
 */
class Provincia extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Provincia the static model class
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
		return 'provincia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PROVINCIA_ID, PROVINCIA_REGION_ID', 'numerical', 'integerOnly'=>true),
			array('PROVINCIA_NOMBRE', 'length', 'max'=>23),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PROVINCIA_ID, PROVINCIA_NOMBRE, PROVINCIA_REGION_ID', 'safe', 'on'=>'search'),
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
			'comunas' => array(self::HAS_MANY, 'Comuna', 'COMUNA_PROVINCIA_ID'),
			'pROVINCIAREGION' => array(self::BELONGS_TO, 'Region', 'PROVINCIA_REGION_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PROVINCIA_ID' => 'Provincia',
			'PROVINCIA_NOMBRE' => 'Provincia Nombre',
			'PROVINCIA_REGION_ID' => 'Provincia Region',
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

		$criteria->compare('PROVINCIA_ID',$this->PROVINCIA_ID);
		$criteria->compare('PROVINCIA_NOMBRE',$this->PROVINCIA_NOMBRE,true);
		$criteria->compare('PROVINCIA_REGION_ID',$this->PROVINCIA_REGION_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}