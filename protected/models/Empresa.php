<?php

/**
 * This is the model class for table "empresa".
 *
 * The followings are the available columns in table 'empresa':
 * @property integer $id_empresa
 * @property string $nombre
 * @property string $direccion
 * @property string $web
 * @property integer $id_cuidad_fk
 * @property integer $campus
 * @property integer $id_usuario_inserta_fk
 *
 * The followings are the available model relations:
 * @property ContactoEmpresa[] $contactoEmpresas
 * @property CupoPractica[] $cupoPracticas
 * @property Usuario $idUsuarioInsertaFk
 * @property Comuna $idCuidadFk
 * @property Campus $campus0
 * @property PracticaProfesional[] $practicaProfesionals
 */
class Empresa extends CActiveRecord {
    
    public $nombre_mas_ciudad;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Empresa the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'empresa';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nombre, id_cuidad_fk, campus, id_usuario_inserta_fk', 'required'),
            array('id_cuidad_fk, campus, id_usuario_inserta_fk', 'numerical', 'integerOnly' => true),
            array('nombre, direccion, web', 'length', 'max' => 2000),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_empresa, nombre, direccion, web, id_cuidad_fk, campus, id_usuario_inserta_fk', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'contactoEmpresas' => array(self::HAS_MANY, 'ContactoEmpresa', 'id_empresa_fk'),
            'cupoPracticas' => array(self::HAS_MANY, 'CupoPractica', 'id_empresa_fk'),
            'idUsuarioInsertaFk' => array(self::BELONGS_TO, 'Usuario', 'id_usuario_inserta_fk'),
            'idCuidadFk' => array(self::BELONGS_TO, 'Comuna', 'id_cuidad_fk'),
            'campus0' => array(self::BELONGS_TO, 'Campus', 'campus'),
            'practicaProfesionals' => array(self::HAS_MANY, 'PracticaProfesional', 'id_empresa_fk'),
        );
    }

    protected function afterFind() {
        // convert to display format
        $this->nombre_mas_ciudad = $this->nombre . " - " . $this->idCuidadFk->COMUNA_NOMBRE;
        parent::afterFind();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_empresa' => 'Id Empresa',
            'nombre' => 'Nombre',
            'direccion' => 'Direccion',
            'web' => 'Web',
            'id_cuidad_fk' => 'Id Cuidad Fk',
            'campus' => 'Campus',
            'id_usuario_inserta_fk' => 'Id Usuario Inserta Fk',
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

        $criteria->compare('id_empresa', $this->id_empresa);
        $criteria->compare('nombre', $this->nombre, true);
        $criteria->compare('direccion', $this->direccion, true);
        $criteria->compare('web', $this->web, true);
        $criteria->compare('id_cuidad_fk', $this->id_cuidad_fk);
        $criteria->compare('campus', $this->campus);
        $criteria->compare('id_usuario_inserta_fk', $this->id_usuario_inserta_fk);
        $criteria->addCondition('campus=' . Yii::app()->user->getState('campus'));
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
