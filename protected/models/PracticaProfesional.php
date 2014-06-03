<?php

/**
 * This is the model class for table "practica_profesional".
 *
 * The followings are the available columns in table 'practica_profesional':
 * @property integer $id_practica_profesional
 * @property integer $id_padre_practica_profesional
 * @property integer $id_alumno_fk
 * @property integer $id_empresa_fk
 * @property integer $id_profesor_revisor_fk
 * @property integer $id_profesor_visitante_fk
 * @property string $fecha_creacion
 * @property string $fecha_inicio_practica
 * @property string $fecha_termino_practica
 * @property integer $id_supervisor_empresa_fk
 * @property integer $id_estado_fk
 * @property string $fecha_notifica_finalizacion
 * @property integer $id_campus_fk
 *
 * The followings are the available model relations:
 * @property EvaluacionEmpresa[] $evaluacionEmpresas
 * @property Campus $idCampusFk
 * @property PracticaProfesional $idPadrePracticaProfesional
 * @property PracticaProfesional[] $practicaProfesionals
 * @property Usuario $idAlumnoFk
 * @property Empresa $idEmpresaFk
 * @property Usuario $idProfesorRevisorFk
 * @property Usuario $idProfesorVisitanteFk
 * @property Usuario $idSupervisorEmpresaFk
 * @property Estado $idEstadoFk
 * @property VisitaPracticaProfesional[] $visitaPracticaProfesionals
 */
class PracticaProfesional extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PracticaProfesional the static model class
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
		return 'practica_profesional';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_padre_practica_profesional, id_alumno_fk, id_empresa_fk, id_profesor_revisor_fk, id_profesor_visitante_fk, fecha_creacion, id_supervisor_empresa_fk, id_estado_fk, id_campus_fk', 'required'),
			array('id_padre_practica_profesional, id_alumno_fk, id_empresa_fk, id_profesor_revisor_fk, id_profesor_visitante_fk, id_supervisor_empresa_fk, id_estado_fk, id_campus_fk', 'numerical', 'integerOnly'=>true),
			array('fecha_inicio_practica, fecha_termino_practica, fecha_notifica_finalizacion', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_practica_profesional, id_padre_practica_profesional, id_alumno_fk, id_empresa_fk, id_profesor_revisor_fk, id_profesor_visitante_fk, fecha_creacion, fecha_inicio_practica, fecha_termino_practica, id_supervisor_empresa_fk, id_estado_fk, fecha_notifica_finalizacion, id_campus_fk', 'safe', 'on'=>'search'),
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
			'evaluacionEmpresas' => array(self::HAS_MANY, 'EvaluacionEmpresa', 'id_practica_profesional_fk'),
			'idCampusFk' => array(self::BELONGS_TO, 'Campus', 'id_campus_fk'),
			'idPadrePracticaProfesional' => array(self::BELONGS_TO, 'PracticaProfesional', 'id_padre_practica_profesional'),
			'practicaProfesionals' => array(self::HAS_MANY, 'PracticaProfesional', 'id_padre_practica_profesional'),
			'idAlumnoFk' => array(self::BELONGS_TO, 'Usuario', 'id_alumno_fk'),
			'idEmpresaFk' => array(self::BELONGS_TO, 'Empresa', 'id_empresa_fk'),
			'idProfesorRevisorFk' => array(self::BELONGS_TO, 'Usuario', 'id_profesor_revisor_fk'),
			'idProfesorVisitanteFk' => array(self::BELONGS_TO, 'Usuario', 'id_profesor_visitante_fk'),
			'idSupervisorEmpresaFk' => array(self::BELONGS_TO, 'Usuario', 'id_supervisor_empresa_fk'),
			'idEstadoFk' => array(self::BELONGS_TO, 'Estado', 'id_estado_fk'),
			'visitaPracticaProfesionals' => array(self::HAS_MANY, 'VisitaPracticaProfesional', 'id_practica_profesional_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_practica_profesional' => 'Id Practica Profesional',
			'id_padre_practica_profesional' => 'Id Padre Practica Profesional',
			'id_alumno_fk' => 'Id Alumno Fk',
			'id_empresa_fk' => 'Id Empresa Fk',
			'id_profesor_revisor_fk' => 'Id Profesor Revisor Fk',
			'id_profesor_visitante_fk' => 'Id Profesor Visitante Fk',
			'fecha_creacion' => 'Fecha Creacion',
			'fecha_inicio_practica' => 'Fecha Inicio Practica',
			'fecha_termino_practica' => 'Fecha Termino Practica',
			'id_supervisor_empresa_fk' => 'Id Supervisor Empresa Fk',
			'id_estado_fk' => 'Id Estado Fk',
			'fecha_notifica_finalizacion' => 'Fecha Notifica Finalizacion',
			'id_campus_fk' => 'Id Campus Fk',
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

		$criteria->compare('id_practica_profesional',$this->id_practica_profesional);
		$criteria->compare('id_padre_practica_profesional',$this->id_padre_practica_profesional);
		$criteria->compare('id_alumno_fk',$this->id_alumno_fk);
		$criteria->compare('id_empresa_fk',$this->id_empresa_fk);
		$criteria->compare('id_profesor_revisor_fk',$this->id_profesor_revisor_fk);
		$criteria->compare('id_profesor_visitante_fk',$this->id_profesor_visitante_fk);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('fecha_inicio_practica',$this->fecha_inicio_practica,true);
		$criteria->compare('fecha_termino_practica',$this->fecha_termino_practica,true);
		$criteria->compare('id_supervisor_empresa_fk',$this->id_supervisor_empresa_fk);
		$criteria->compare('id_estado_fk',$this->id_estado_fk);
		$criteria->compare('fecha_notifica_finalizacion',$this->fecha_notifica_finalizacion,true);
		$criteria->compare('id_campus_fk',$this->id_campus_fk);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}