<?php

/**
 * This is the model class for table "bitacora_practica".
 *
 * The followings are the available columns in table 'bitacora_practica':
 * @property integer $id_bitacora
 * @property integer $id_practica_profesional_fk
 * @property string $fecha_creacion
 * @property string $fecha_registro
 * @property string $titulo
 * @property string $objetivos
 * @property string $tareas_realizadas
 * @property integer $id_adjunto_fk
 *
 * The followings are the available model relations:
 * @property PeriodoPractica $idPracticaProfesionalFk
 * @property Adjunto $idAdjuntoFk
 */
class BitacoraPractica extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BitacoraPractica the static model class
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
		return 'bitacora_practica';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_practica_profesional_fk, fecha_creacion, fecha_registro, titulo, objetivos, tareas_realizadas', 'required'),
			array('id_practica_profesional_fk, id_adjunto_fk', 'numerical', 'integerOnly'=>true),
			array('titulo', 'length', 'max'=>2000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_bitacora, id_practica_profesional_fk, fecha_creacion, fecha_registro, titulo, objetivos, tareas_realizadas, id_adjunto_fk', 'safe', 'on'=>'search'),
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
			'idPracticaProfesionalFk' => array(self::BELONGS_TO, 'PeriodoPractica', 'id_practica_profesional_fk'),
			'idAdjuntoFk' => array(self::BELONGS_TO, 'Adjunto', 'id_adjunto_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_bitacora' => 'Id Bitacora',
			'id_practica_profesional_fk' => 'Id Practica Profesional Fk',
			'fecha_creacion' => 'Fecha Creacion',
			'fecha_registro' => 'Fecha Registro',
			'titulo' => 'Titulo',
			'objetivos' => 'Objetivos',
			'tareas_realizadas' => 'Tareas Realizadas',
			'id_adjunto_fk' => 'Id Adjunto Fk',
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

		$criteria->compare('id_bitacora',$this->id_bitacora);
		$criteria->compare('id_practica_profesional_fk',$this->id_practica_profesional_fk);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('objetivos',$this->objetivos,true);
		$criteria->compare('tareas_realizadas',$this->tareas_realizadas,true);
		$criteria->compare('id_adjunto_fk',$this->id_adjunto_fk);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}