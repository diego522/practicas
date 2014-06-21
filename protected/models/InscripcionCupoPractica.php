<?php

/**
 * This is the model class for table "inscripcion_cupo_practica".
 *
 * The followings are the available columns in table 'inscripcion_cupo_practica':
 * @property integer $id_inscripcion_practica
 * @property integer $id_cupo_practica_fk
 * @property integer $id_postulacion_practica_fk
 * @property integer $prioridad
 * @property string $fecha_inscripcion
 * @property integer $id_estado_fk
 * @property integer $confirmacion
 * @property string $motivo_rechazo
 * @property string $observaciones
 * @property integer $notificado
 *
 * The followings are the available model relations:
 * @property CupoPractica $idCupoPracticaFk
 * @property PostulacionAPractica $idPostulacionPracticaFk
 * @property Estado $idEstadoFk
 */
class InscripcionCupoPractica extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return InscripcionCupoPractica the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'inscripcion_cupo_practica';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_cupo_practica_fk, id_postulacion_practica_fk, prioridad, id_estado_fk', 'required'),
            array('id_cupo_practica_fk, id_postulacion_practica_fk, prioridad, id_estado_fk, confirmacion, notificado', 'numerical', 'integerOnly' => true),
            array('motivo_rechazo, observaciones', 'length', 'max' => 2000),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_inscripcion_practica, id_cupo_practica_fk, id_postulacion_practica_fk, prioridad, fecha_inscripcion, id_estado_fk, confirmacion, motivo_rechazo, observaciones, notificado', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'idCupoPracticaFk' => array(self::BELONGS_TO, 'CupoPractica', 'id_cupo_practica_fk'),
            'idPostulacionPracticaFk' => array(self::BELONGS_TO, 'PostulacionAPractica', 'id_postulacion_practica_fk'),
            'idEstadoFk' => array(self::BELONGS_TO, 'Estado', 'id_estado_fk'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_inscripcion_practica' => 'Id Inscripcion Practica',
            'id_cupo_practica_fk' => 'Centro de práctica',
            'id_postulacion_practica_fk' => 'Id Postulacion Practica Fk',
            'prioridad' => 'Prioridad',
            'fecha_inscripcion' => 'Fecha de inscripción',
            'id_estado_fk' => 'Estado',
            'confirmacion' => 'Confirmación',
            'motivo_rechazo' => 'Motivo de Rechazo',
            'observaciones' => 'Observaciones',
            'notificado' => 'Notificado',
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
        $criteria->compare('id_cupo_practica_fk', $this->id_cupo_practica_fk);
        $criteria->compare('id_postulacion_practica_fk', $this->id_postulacion_practica_fk);
        $criteria->compare('prioridad', $this->prioridad);
        $criteria->compare('fecha_inscripcion', $this->fecha_inscripcion, true);
        $criteria->compare('id_estado_fk', $this->id_estado_fk);
        $criteria->compare('confirmacion', $this->confirmacion);
        $criteria->compare('motivo_rechazo', $this->motivo_rechazo, true);
        $criteria->compare('observaciones', $this->observaciones, true);
        $criteria->compare('notificado', $this->notificado);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    public function searchInscrpcionesCupoPorPostulacion($idpp) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id_inscripcion_practica', $this->id_inscripcion_practica);
        $criteria->compare('id_cupo_practica_fk', $this->id_cupo_practica_fk);
        //$criteria->compare('id_postulacion_practica_fk', $this->id_postulacion_practica_fk);
        $criteria->compare('prioridad', $this->prioridad);
        $criteria->compare('fecha_inscripcion', $this->fecha_inscripcion, true);
        $criteria->compare('id_estado_fk', $this->id_estado_fk);
        $criteria->compare('confirmacion', $this->confirmacion);
        $criteria->compare('motivo_rechazo', $this->motivo_rechazo, true);
        $criteria->compare('observaciones', $this->observaciones, true);
        $criteria->compare('notificado', $this->notificado);
        $criteria->addCondition('id_postulacion_practica_fk='.$idpp);
        $criteria->order='prioridad ASC';
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination'=>false, 
        ));
    }

}
