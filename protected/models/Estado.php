<?php

/**
 * This is the model class for table "estado".
 *
 * The followings are the available columns in table 'estado':
 * @property integer $id_estado
 * @property integer $id_tipo_estado_fk
 * @property string $nombre
 *
 * The followings are the available model relations:
 * @property TipoEstado $idTipoEstadoFk
 * @property InscripcionCupoPractica[] $inscripcionCupoPracticas
 * @property PeriodoPractica[] $periodoPracticas
 * @property PostulacionAPractica[] $postulacionAPracticas
 * @property PracticaProfesional[] $practicaProfesionals
 */
class Estado extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Estado the static model class
     */
    public static $PERIODO_PRACTICA_PENDIENTE_DE_APERTURA = 1;
    public static $PERIODO_PRACTICA_ABIERTO = 2;
    public static $PERIODO_PRACTICA_CERRADO = 3;
    
    public static $POSTULACION_PRACTICA_BORRADOR= 4;
    public static $POSTULACION_PRACTICA_ENVIADA = 5;
    public static $POSTULACION_PRACTICA_ESPERANDO_CONFIRMACION = 10;
    public static $POSTULACION_PRACTICA_RECHAZADO = 11;
    public static $POSTULACION_PRACTICA_RENUNCIADA = 12;
    public static $POSTULACION_PRACTICA_RECHAZADA_POR_FALTA_DE_CUPOS = 12;
    
    public static $POSTULACION_CUPO_INSCRITO = 6;
    public static $POSTULACION_CUPO_PENDIENTE_DE_CONFIRMACION = 7;
    public static $POSTULACION_CUPO_ASIGNADO = 8;
    public static $POSTULACION_CUPO_RECHAZADO = 9;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'estado';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_tipo_estado_fk, nombre', 'required'),
            array('id_tipo_estado_fk', 'numerical', 'integerOnly' => true),
            array('nombre', 'length', 'max' => 2000),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_estado, id_tipo_estado_fk, nombre', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'idTipoEstadoFk' => array(self::BELONGS_TO, 'TipoEstado', 'id_tipo_estado_fk'),
            'inscripcionCupoPracticas' => array(self::HAS_MANY, 'InscripcionCupoPractica', 'id_estado_fk'),
            'periodoPracticas' => array(self::HAS_MANY, 'PeriodoPractica', 'id_estado_fk'),
            'postulacionAPracticas' => array(self::HAS_MANY, 'PostulacionAPractica', 'id_estado_fk'),
            'practicaProfesionals' => array(self::HAS_MANY, 'PracticaProfesional', 'id_estado_fk'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_estado' => 'Id Estado',
            'id_tipo_estado_fk' => 'Id Tipo Estado Fk',
            'nombre' => 'Nombre',
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

        $criteria->compare('id_estado', $this->id_estado);
        $criteria->compare('id_tipo_estado_fk', $this->id_tipo_estado_fk);
        $criteria->compare('nombre', $this->nombre, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
