<?php

/**
 * This is the model class for table "cupo_practica".
 *
 * The followings are the available columns in table 'cupo_practica':
 * @property integer $id_cupo_practica
 * @property integer $cantidad
 * @property integer $remunerado
 * @property string $detalle_remuneracion
 * @property string $funcion_a_cumplir
 * @property string $habilidades_requeridas
 * @property string $duracion
 * @property string $otros_beneficios
 * @property integer $id_empresa_fk
 * @property integer $id_periodo_practica_fk
 * @property integer $id_usuario_creador_fk
 *
 * The followings are the available model relations:
 * @property Empresa $idEmpresaFk
 * @property PeriodoPractica $idPeriodoPracticaFk
 * @property Usuario $idUsuarioCreadorFk
 * @property InscripcionCupoPractica[] $inscripcionCupoPracticas
 */
class CupoPractica extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return CupoPractica the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'cupo_practica';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('cantidad, funcion_a_cumplir, habilidades_requeridas, duracion, id_empresa_fk, id_periodo_practica_fk', 'required'),
            array('cantidad, remunerado, id_empresa_fk, id_periodo_practica_fk, id_usuario_creador_fk', 'numerical', 'integerOnly' => true),
            array('detalle_remuneracion, funcion_a_cumplir, habilidades_requeridas, duracion, otros_beneficios', 'length', 'max' => 2000),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_cupo_practica, cantidad, remunerado, detalle_remuneracion, funcion_a_cumplir, habilidades_requeridas, duracion, otros_beneficios, id_empresa_fk, id_periodo_practica_fk, id_usuario_creador_fk', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'idEmpresaFk' => array(self::BELONGS_TO, 'Empresa', 'id_empresa_fk'),
            'idPeriodoPracticaFk' => array(self::BELONGS_TO, 'PeriodoPractica', 'id_periodo_practica_fk'),
            'idUsuarioCreadorFk' => array(self::BELONGS_TO, 'Usuario', 'id_usuario_creador_fk'),
            'inscripcionCupoPracticas' => array(self::HAS_MANY, 'InscripcionCupoPractica', 'id_cupo_practica_fk'),
        );
    }

    public function beforeSave() {
        if ($this->isNewRecord) {
            // $this->fecha_creacion = new CDbExpression('NOW()');
            //$this->id_campus_fk = Yii::app()->user->getState('campus');
            // $this->id_estado_fk = Estado::$PERIODO_PRACTICA_PENDIENTE_DE_APERTURA;
            $this->id_usuario_creador_fk = Yii::app()->user->id;
        }
        return parent::beforeSave();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_cupo_practica' => 'Id Cupo Practica',
            'cantidad' => 'Cupos',
            'remunerado' => 'Remunerado',
            'detalle_remuneracion' => 'Detalle remuneración',
            'funcion_a_cumplir' => 'Funcion a cumplir',
            'habilidades_requeridas' => 'Habilidades requeridas',
            'duracion' => 'Duración',
            'otros_beneficios' => 'Otros beneficios',
            'id_empresa_fk' => 'Centro de práctica',
            'id_periodo_practica_fk' => 'Práctica',
            'id_usuario_creador_fk' => 'Id Usuario Creador Fk',
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

        $criteria->compare('id_cupo_practica', $this->id_cupo_practica);
        $criteria->compare('cantidad', $this->cantidad);
        $criteria->compare('remunerado', $this->remunerado);
        $criteria->compare('detalle_remuneracion', $this->detalle_remuneracion, true);
        $criteria->compare('funcion_a_cumplir', $this->funcion_a_cumplir, true);
        $criteria->compare('habilidades_requeridas', $this->habilidades_requeridas, true);
        $criteria->compare('duracion', $this->duracion, true);
        $criteria->compare('otros_beneficios', $this->otros_beneficios, true);
        $criteria->compare('id_empresa_fk', $this->id_empresa_fk);
        $criteria->compare('id_periodo_practica_fk', $this->id_periodo_practica_fk);
        $criteria->compare('id_usuario_creador_fk', $this->id_usuario_creador_fk);
        $criteria->addCondition('id_periodo_practica_fk in (select id_periodo_practica from periodo_practica where id_campus_fk=' . Yii::app()->user->getState('campus') . ')');
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    public function searchCupoPracticaDisponible($idp) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id_cupo_practica', $this->id_cupo_practica);
        $criteria->compare('cantidad', $this->cantidad);
        $criteria->compare('remunerado', $this->remunerado);
        $criteria->compare('detalle_remuneracion', $this->detalle_remuneracion, true);
        $criteria->compare('funcion_a_cumplir', $this->funcion_a_cumplir, true);
        $criteria->compare('habilidades_requeridas', $this->habilidades_requeridas, true);
        $criteria->compare('duracion', $this->duracion, true);
        $criteria->compare('otros_beneficios', $this->otros_beneficios, true);
        $criteria->compare('id_empresa_fk', $this->id_empresa_fk);
        //$criteria->compare('id_periodo_practica_fk', $this->id_periodo_practica_fk);
        $criteria->compare('id_usuario_creador_fk', $this->id_usuario_creador_fk);
        $criteria->addCondition('id_periodo_practica_fk ='.$idp);
        $criteria->addCondition('id_cupo_practica not in (select id_cupo_practica_fk from inscripcion_cupo_practica where id_postulacion_practica_fk in '
                . '(select id_inscripcion_practica from postulacion_a_practica where id_alumno='.Yii::app()->user->id.'))');
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination'=>false,  
        ));
    }
}
