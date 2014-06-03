<?php

/**
 * This is the model class for table "periodo_practica".
 *
 * The followings are the available columns in table 'periodo_practica':
 * @property integer $id_periodo_practica
 * @property string $nombre
 * @property string $fecha_creacion
 * @property string $fecha_apertura
 * @property string $fecha_cierre
 * @property integer $id_campus_fk
 * @property integer $id_estado_fk
 * @property integer $id_tipo_practica_fk
 * @property string $fecha_entrega_formulario_prac
 *
 * The followings are the available model relations:
 * @property BitacoraPractica[] $bitacoraPracticas
 * @property CupoPractica[] $cupoPracticas
 * @property Campus $idCampusFk
 * @property Estado $idEstadoFk
 * @property TipoPractica $idTipoPracticaFk
 * @property PostulacionAPractica[] $postulacionAPracticas
 */
class PeriodoPractica extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PeriodoPractica the static model class
     */
    public $nombre_mas_estado;
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'periodo_practica';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nombre, fecha_apertura,fecha_cierre,fecha_entrega_formulario_prac, id_tipo_practica_fk', 'required'),
            array('id_campus_fk, id_estado_fk, id_tipo_practica_fk', 'numerical', 'integerOnly' => true),
            array('nombre', 'length', 'max' => 2000),
            array('fecha_apertura, fecha_cierre, fecha_entrega_formulario_prac', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_periodo_practica, nombre, fecha_creacion, fecha_apertura, fecha_cierre, id_campus_fk, id_estado_fk, id_tipo_practica_fk, fecha_entrega_formulario_prac', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'bitacoraPracticas' => array(self::HAS_MANY, 'BitacoraPractica', 'id_practica_profesional_fk'),
            'cupoPracticas' => array(self::HAS_MANY, 'CupoPractica', 'id_periodo_practica_fk'),
            'idCampusFk' => array(self::BELONGS_TO, 'Campus', 'id_campus_fk'),
            'idEstadoFk' => array(self::BELONGS_TO, 'Estado', 'id_estado_fk'),
            'idTipoPracticaFk' => array(self::BELONGS_TO, 'TipoPractica', 'id_tipo_practica_fk'),
            'postulacionAPracticas' => array(self::HAS_MANY, 'PostulacionAPractica', 'id_periodo_practica_fk'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_periodo_practica' => 'Id Periodo Practica',
            'nombre' => 'Nombre',
            'fecha_creacion' => 'Fecha Creacion',
            'fecha_apertura' => 'Fecha Apertura',
            'fecha_cierre' => 'Fecha Cierre',
            'id_campus_fk' => 'Id Campus Fk',
            'id_estado_fk' => 'Id Estado Fk',
            'id_tipo_practica_fk' => 'Id Tipo Practica Fk',
            'fecha_entrega_formulario_prac' => 'Fecha Entrega Formulario Prac',
        );
    }

    protected function afterFind() {
        // convert to display format
        $this->fecha_creacion = Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($this->fecha_creacion));
        $this->fecha_apertura = Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($this->fecha_apertura));
        $this->fecha_cierre = Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($this->fecha_cierre));
        $this->fecha_entrega_formulario_prac = Yii::app()->dateFormatter->format("dd/MM/y HH:mm", strtotime($this->fecha_entrega_formulario_prac));
        $this->nombre_mas_estado=  $this->nombre." - ".$this->idTipoPracticaFk->nombre ." - (".$this->idEstadoFk->nombre.")";
        parent::afterFind();
    }

    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->fecha_creacion = new CDbExpression('NOW()');
            $this->id_campus_fk = Yii::app()->user->getState('campus');
            $this->id_estado_fk = Estado::$PERIODO_PRACTICA_PENDIENTE_DE_APERTURA;
        } else {
            $newDate = DateTime::createFromFormat('d/m/Y H:i', $this->fecha_creacion);
            if ($newDate != null)
                $this->fecha_creacion = $newDate->format('Y-m-d H:i:s');
        }
        $newDate2 = DateTime::createFromFormat('d/m/Y H:i', $this->fecha_apertura);
        if ($newDate2 != null)
            $this->fecha_apertura = $newDate2->format('Y-m-d H:i:s');

        $newDate3 = DateTime::createFromFormat('d/m/Y H:i', $this->fecha_cierre);
        if ($newDate3 != null) {
            $this->fecha_cierre = $newDate3->format('Y-m-d H:i:s');
        }

        $newDate4 = DateTime::createFromFormat('d/m/Y H:i', $this->fecha_entrega_formulario_prac);
        if ($newDate4 != null)
            $this->fecha_entrega_formulario_prac = $newDate4->format('Y-m-d H:i:s');
        return parent::beforeSave();
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
        $criteria = new CDbCriteria;
        $criteria->compare('id_periodo_practica', $this->id_periodo_practica);
        $criteria->compare('nombre', $this->nombre, true);
        $criteria->compare('fecha_creacion', $this->fecha_creacion, true);
        $criteria->compare('fecha_apertura', $this->fecha_apertura, true);
        $criteria->compare('fecha_cierre', $this->fecha_cierre, true);
        //$criteria->compare('id_campus_fk', $this->id_campus_fk);
        $criteria->compare('id_estado_fk', $this->id_estado_fk);
        $criteria->compare('id_tipo_practica_fk', $this->id_tipo_practica_fk);
        $criteria->compare('fecha_entrega_formulario_prac', $this->fecha_entrega_formulario_prac, true);
        $criteria->addCondition('id_campus_fk=' . Yii::app()->user->getState('campus'));
        $criteria->order="fecha_apertura DESC";
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    public function searchPeriodosDisponibles() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
        $criteria = new CDbCriteria;
        $criteria->compare('id_periodo_practica', $this->id_periodo_practica);
        $criteria->compare('nombre', $this->nombre, true);
        $criteria->compare('fecha_creacion', $this->fecha_creacion, true);
        $criteria->compare('fecha_apertura', $this->fecha_apertura, true);
        $criteria->compare('fecha_cierre', $this->fecha_cierre, true);
        //$criteria->compare('id_campus_fk', $this->id_campus_fk);
        $criteria->compare('id_estado_fk', $this->id_estado_fk);
        $criteria->compare('id_tipo_practica_fk', $this->id_tipo_practica_fk);
        $criteria->compare('fecha_entrega_formulario_prac', $this->fecha_entrega_formulario_prac, true);
        $criteria->addCondition('NOW() between fecha_apertura and fecha_cierre and id_campus_fk=' . Yii::app()->user->getState('campus') . ' and id_estado_fk=' . Estado::$PERIODO_PRACTICA_ABIERTO);
        $criteria->order="fecha_apertura DESC";
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
     public static function obtienePeriodoActual() {
        return PeriodoPractica::model()->findAll('NOW() between fecha_apertura and fecha_cierre and id_campus_fk=' . Yii::app()->user->getState('campus') . ' and id_estado_fk=' . Estado::$PERIODO_PRACTICA_ABIERTO);
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
