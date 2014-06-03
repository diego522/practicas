<?php

/**
 * This is the model class for table "visita_practica_profesional".
 *
 * The followings are the available columns in table 'visita_practica_profesional':
 * @property integer $id_visita_practica_profesional
 * @property integer $id_practica_profesional_fk
 * @property integer $id_usuario_visitador_fk
 * @property string $fecha_creacion
 * @property string $fecha_visita
 * @property integer $observaciones
 *
 * The followings are the available model relations:
 * @property PracticaProfesional $idPracticaProfesionalFk
 * @property Usuario $idUsuarioVisitadorFk
 */
class VisitaPracticaProfesional extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VisitaPracticaProfesional the static model class
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
		return 'visita_practica_profesional';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_practica_profesional_fk, id_usuario_visitador_fk, fecha_creacion, fecha_visita', 'required'),
			array('id_practica_profesional_fk, id_usuario_visitador_fk, observaciones', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_visita_practica_profesional, id_practica_profesional_fk, id_usuario_visitador_fk, fecha_creacion, fecha_visita, observaciones', 'safe', 'on'=>'search'),
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
			'idPracticaProfesionalFk' => array(self::BELONGS_TO, 'PracticaProfesional', 'id_practica_profesional_fk'),
			'idUsuarioVisitadorFk' => array(self::BELONGS_TO, 'Usuario', 'id_usuario_visitador_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_visita_practica_profesional' => 'Id Visita Practica Profesional',
			'id_practica_profesional_fk' => 'Id Practica Profesional Fk',
			'id_usuario_visitador_fk' => 'Id Usuario Visitador Fk',
			'fecha_creacion' => 'Fecha Creacion',
			'fecha_visita' => 'Fecha Visita',
			'observaciones' => 'Observaciones',
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

		$criteria->compare('id_visita_practica_profesional',$this->id_visita_practica_profesional);
		$criteria->compare('id_practica_profesional_fk',$this->id_practica_profesional_fk);
		$criteria->compare('id_usuario_visitador_fk',$this->id_usuario_visitador_fk);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('fecha_visita',$this->fecha_visita,true);
		$criteria->compare('observaciones',$this->observaciones);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}