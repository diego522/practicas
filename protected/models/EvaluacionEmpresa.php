<?php

/**
 * This is the model class for table "evaluacion_empresa".
 *
 * The followings are the available columns in table 'evaluacion_empresa':
 * @property integer $id_evaluacion_empresa
 * @property integer $id_practica_profesional_fk
 * @property string $fecha_creacion
 * @property integer $id_evaluacion_empresa_padre
 * @property integer $id_usuario_creador_fk
 *
 * The followings are the available model relations:
 * @property PracticaProfesional $idPracticaProfesionalFk
 * @property EvaluacionEmpresa $idEvaluacionEmpresaPadre
 * @property EvaluacionEmpresa[] $evaluacionEmpresas
 * @property Usuario $idUsuarioCreadorFk
 */
class EvaluacionEmpresa extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EvaluacionEmpresa the static model class
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
		return 'evaluacion_empresa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_practica_profesional_fk, fecha_creacion, id_evaluacion_empresa_padre, id_usuario_creador_fk', 'required'),
			array('id_practica_profesional_fk, id_evaluacion_empresa_padre, id_usuario_creador_fk', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_evaluacion_empresa, id_practica_profesional_fk, fecha_creacion, id_evaluacion_empresa_padre, id_usuario_creador_fk', 'safe', 'on'=>'search'),
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
			'idEvaluacionEmpresaPadre' => array(self::BELONGS_TO, 'EvaluacionEmpresa', 'id_evaluacion_empresa_padre'),
			'evaluacionEmpresas' => array(self::HAS_MANY, 'EvaluacionEmpresa', 'id_evaluacion_empresa_padre'),
			'idUsuarioCreadorFk' => array(self::BELONGS_TO, 'Usuario', 'id_usuario_creador_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_evaluacion_empresa' => 'Id Evaluacion Empresa',
			'id_practica_profesional_fk' => 'Id Practica Profesional Fk',
			'fecha_creacion' => 'Fecha Creacion',
			'id_evaluacion_empresa_padre' => 'Id Evaluacion Empresa Padre',
			'id_usuario_creador_fk' => 'Id Usuario Creador Fk',
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

		$criteria->compare('id_evaluacion_empresa',$this->id_evaluacion_empresa);
		$criteria->compare('id_practica_profesional_fk',$this->id_practica_profesional_fk);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('id_evaluacion_empresa_padre',$this->id_evaluacion_empresa_padre);
		$criteria->compare('id_usuario_creador_fk',$this->id_usuario_creador_fk);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}