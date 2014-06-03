<?php

/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property integer $id_usuario
 * @property string $nombre
 * @property string $username
 * @property string $dv
 * @property string $password
 * @property string $apellido
 * @property integer $id_rol
 * @property string $email
 * @property integer $carrera
 * @property integer $plan
 * @property integer $campus
 * @property string $telefono
 * @property string $direccion
 * @property integer $habilitado_adt
 * @property integer $habilitado_practica
 * @property integer $habilitado_ici
 *
 * The followings are the available model relations:
 * @property Adjunto[] $adjuntos
 * @property CupoPractica[] $cupoPracticas
 * @property EvaluacionEmpresa[] $evaluacionEmpresas
 * @property PostulacionAPractica[] $postulacionAPracticas
 * @property PracticaProfesional[] $practicaProfesionals
 * @property PracticaProfesional[] $practicaProfesionals1
 * @property PracticaProfesional[] $practicaProfesionals2
 * @property PracticaProfesional[] $practicaProfesionals3
 * @property Rol $idRol
 * @property VisitaPracticaProfesional[] $visitaPracticaProfesionals
 */
class Usuario extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usuario the static model class
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
		return 'usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_usuario, nombre, username, dv, password, id_rol', 'required'),
			array('id_usuario, id_rol, carrera, plan, campus, habilitado_adt, habilitado_practica, habilitado_ici', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>300),
			array('username, password, apellido, email, telefono', 'length', 'max'=>200),
			array('dv', 'length', 'max'=>1),
			array('direccion', 'length', 'max'=>2000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_usuario, nombre, username, dv, password, apellido, id_rol, email, carrera, plan, campus, telefono, direccion, habilitado_adt, habilitado_practica, habilitado_ici', 'safe', 'on'=>'search'),
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
			'adjuntos' => array(self::HAS_MANY, 'Adjunto', 'creador'),
			'cupoPracticas' => array(self::HAS_MANY, 'CupoPractica', 'id_usuario_creador_fk'),
			'evaluacionEmpresas' => array(self::HAS_MANY, 'EvaluacionEmpresa', 'id_usuario_creador_fk'),
			'postulacionAPracticas' => array(self::HAS_MANY, 'PostulacionAPractica', 'id_alumno'),
			'practicaProfesionals' => array(self::HAS_MANY, 'PracticaProfesional', 'id_alumno_fk'),
			'practicaProfesionals1' => array(self::HAS_MANY, 'PracticaProfesional', 'id_profesor_revisor_fk'),
			'practicaProfesionals2' => array(self::HAS_MANY, 'PracticaProfesional', 'id_profesor_visitante_fk'),
			'practicaProfesionals3' => array(self::HAS_MANY, 'PracticaProfesional', 'id_supervisor_empresa_fk'),
			'idRol' => array(self::BELONGS_TO, 'Rol', 'id_rol'),
			'visitaPracticaProfesionals' => array(self::HAS_MANY, 'VisitaPracticaProfesional', 'id_usuario_visitador_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_usuario' => 'Id Usuario',
			'nombre' => 'Nombre',
			'username' => 'Username',
			'dv' => 'Dv',
			'password' => 'Password',
			'apellido' => 'Apellido',
			'id_rol' => 'Id Rol',
			'email' => 'Email',
			'carrera' => 'Carrera',
			'plan' => 'Plan',
			'campus' => 'Campus',
			'telefono' => 'Telefono',
			'direccion' => 'Direccion',
			'habilitado_adt' => 'Habilitado Adt',
			'habilitado_practica' => 'Habilitado Practica',
			'habilitado_ici' => 'Habilitado Ici',
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

		$criteria->compare('id_usuario',$this->id_usuario);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('dv',$this->dv,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('id_rol',$this->id_rol);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('carrera',$this->carrera);
		$criteria->compare('plan',$this->plan);
		$criteria->compare('campus',$this->campus);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('habilitado_adt',$this->habilitado_adt);
		$criteria->compare('habilitado_practica',$this->habilitado_practica);
		$criteria->compare('habilitado_ici',$this->habilitado_ici);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}