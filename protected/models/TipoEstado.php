<?php

/**
 * This is the model class for table "tipo_estado".
 *
 * The followings are the available columns in table 'tipo_estado':
 * @property integer $id_tipo_estado
 * @property string $nombre
 *
 * The followings are the available model relations:
 * @property Estado[] $estados
 */
class TipoEstado extends CActiveRecord {
    
    public static $PPERIODO_PRACTICA=1;
    public static $POSTULACION_A_PRACTICA=2;
    public static $POSTULACION_A_CUPO=3;
    public static $PRACTICA_PROFESIONAL=4;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TipoEstado the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tipo_estado';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nombre', 'required'),
            array('nombre', 'length', 'max' => 2000),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_tipo_estado, nombre', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'estados' => array(self::HAS_MANY, 'Estado', 'id_tipo_estado_fk'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_tipo_estado' => 'Id Tipo Estado',
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

        $criteria->compare('id_tipo_estado', $this->id_tipo_estado);
        $criteria->compare('nombre', $this->nombre, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
