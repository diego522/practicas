<?php

/**
 * This is the model class for table "postulacion_a_practica".
 *
 * The followings are the available columns in table 'postulacion_a_practica':
 * @property integer $id_inscripcion_practica
 * @property integer $id_alumno
 * @property integer $id_adjunto_fk
 * @property integer $id_periodo_practica_fk
 * @property string $fecha_creacion
 * @property integer $id_estado_fk
 * @property integer $cumple_con_requisitos_al_inscribir
 * @property string $observaciones
 * @property integer $puntaje_por_notas
 * @property integer $puntaje_por_curriculum
 * @property integer $filtro_evaluacion
 * @property integer $promedio
 *
 * The followings are the available model relations:
 * @property InscripcionCupoPractica[] $inscripcionCupoPracticas
 * @property Usuario $idAlumno
 * @property PeriodoPractica $idPeriodoPracticaFk
 * @property Estado $idEstadoFk
 */
class PostulacionAPractica extends CActiveRecord {

    public $filtro_lugar_practica;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PostulacionAPractica the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'postulacion_a_practica';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_alumno, id_periodo_practica_fk, id_estado_fk', 'required'),
            array('id_alumno, id_periodo_practica_fk, id_estado_fk, cumple_con_requisitos_al_inscribir, puntaje_por_notas, puntaje_por_curriculum', 'numerical', 'integerOnly' => true),
            array('observaciones', 'length', 'max' => 2000),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_inscripcion_practica,filtro_evaluacion,promedio,id_alumno,  id_periodo_practica_fk, fecha_creacion, id_estado_fk, cumple_con_requisitos_al_inscribir, observaciones, puntaje_por_notas, puntaje_por_curriculum', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'inscripcionCupoPracticas' => array(self::HAS_MANY, 'InscripcionCupoPractica', 'id_postulacion_practica_fk'),
            'idAlumno' => array(self::BELONGS_TO, 'Usuario', 'id_alumno'),
            'idPeriodoPracticaFk' => array(self::BELONGS_TO, 'PeriodoPractica', 'id_periodo_practica_fk'),
            'idEstadoFk' => array(self::BELONGS_TO, 'Estado', 'id_estado_fk'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_inscripcion_practica' => 'Id Inscripcion Practica',
            'id_alumno' => 'Id Alumno',
            'id_adjunto_fk' => 'Id Adjunto Fk',
            'id_periodo_practica_fk' => 'Id Periodo Practica Fk',
            'fecha_creacion' => 'Fecha Creacion',
            'id_estado_fk' => 'Id Estado Fk',
            'cumple_con_requisitos_al_inscribir' => 'Cumple Con Requisitos Al Inscribir',
            'observaciones' => 'Observaciones',
            'puntaje_por_notas' => 'Puntaje Por Notas',
            'puntaje_por_curriculum' => 'Puntaje Por Curriculum',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id_inscripcion_practica', $this->id_inscripcion_practica);
        $criteria->compare('id_alumno', $this->id_alumno);
        //$criteria->compare('filtro_evaluacion', $this->filtro_evaluacion);
        $criteria->compare('id_adjunto_fk', $this->id_adjunto_fk);
        $criteria->compare('id_periodo_practica_fk', $this->id_periodo_practica_fk);
        $criteria->compare('fecha_creacion', $this->fecha_creacion, true);
        $criteria->compare('id_estado_fk', $this->id_estado_fk);
        $criteria->compare('cumple_con_requisitos_al_inscribir', $this->cumple_con_requisitos_al_inscribir);
        $criteria->compare('observaciones', $this->observaciones, true);
        $criteria->compare('puntaje_por_notas', $this->puntaje_por_notas);
        $criteria->compare('puntaje_por_curriculum', $this->puntaje_por_curriculum);
        if($this->filtro_evaluacion!=NULL&&$this->filtro_evaluacion!=''){
            $criteria->addCondition('filtro_evaluacion='.$this->filtro_evaluacion);
        }
        $criteria->addCondition('id_alumno in (select id_usuario from usuario where campus=' . Yii::app()->user->getState('campus') . ')');
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchMisPostulaciones() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id_inscripcion_practica', $this->id_inscripcion_practica);
        //$criteria->compare('id_alumno', $this->id_alumno);
        $criteria->compare('id_adjunto_fk', $this->id_adjunto_fk);
        $criteria->compare('id_periodo_practica_fk', $this->id_periodo_practica_fk);
        $criteria->compare('fecha_creacion', $this->fecha_creacion, true);
        $criteria->compare('id_estado_fk', $this->id_estado_fk);
        $criteria->compare('cumple_con_requisitos_al_inscribir', $this->cumple_con_requisitos_al_inscribir);
        $criteria->compare('observaciones', $this->observaciones, true);
        $criteria->compare('puntaje_por_notas', $this->puntaje_por_notas);
        $criteria->compare('puntaje_por_curriculum', $this->puntaje_por_curriculum);
        $criteria->addCondition('id_alumno=' . Yii::app()->user->id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function behaviors() {
        return array(
            'ERememberFiltersBehavior' => array(
                'class' => 'application.components.ERememberFiltersBehavior',
                'defaults' => array(), /* optional line */
                'defaultStickOnClear' => false /* optional line */
            ),
        );
    }

}
