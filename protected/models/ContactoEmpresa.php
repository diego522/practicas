<?php

/**
 * This is the model class for table "contacto_empresa".
 *
 * The followings are the available columns in table 'contacto_empresa':
 * @property integer $id_contacto_empresa
 * @property string $nombre
 * @property string $email
 * @property string $telefono
 * @property string $celular
 * @property string $unidad
 * @property string $cargo
 * @property integer $contacto_principal
 * @property integer $id_empresa_fk
 * @property integer $id_usuario_inserta_fk
 *
 * The followings are the available model relations:
 * @property Usuario $idUsuarioInsertaFk
 * @property Empresa $idEmpresaFk
 */
class ContactoEmpresa extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ContactoEmpresa the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'contacto_empresa';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nombre, email, id_empresa_fk, id_usuario_inserta_fk', 'required'),
            array('contacto_principal, id_empresa_fk, id_usuario_inserta_fk', 'numerical', 'integerOnly' => true),
            array('nombre, email, telefono, celular, unidad, cargo', 'length', 'max' => 2000),
            array('email','email'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_contacto_empresa, nombre, email, telefono, celular, unidad, cargo, contacto_principal, id_empresa_fk, id_usuario_inserta_fk', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'idUsuarioInsertaFk' => array(self::BELONGS_TO, 'Usuario', 'id_usuario_inserta_fk'),
            'idEmpresaFk' => array(self::BELONGS_TO, 'Empresa', 'id_empresa_fk'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_contacto_empresa' => 'Id Contacto Empresa',
            'nombre' => 'Nombre Contacto',
            'email' => 'Email',
            'telefono' => 'Teléfono',
            'celular' => 'Celular',
            'unidad' => 'Unidad',
            'cargo' => 'Cargo',
            'contacto_principal' => 'Contacto Principal',
            'id_empresa_fk' => 'Centro de práctica',
            'id_usuario_inserta_fk' => 'Id Usuario Inserta Fk',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search($ide) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id_contacto_empresa', $this->id_contacto_empresa);
        $criteria->compare('nombre', $this->nombre, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('telefono', $this->telefono, true);
        $criteria->compare('celular', $this->celular, true);
        $criteria->compare('unidad', $this->unidad, true);
        $criteria->compare('cargo', $this->cargo, true);
        $criteria->compare('contacto_principal', $this->contacto_principal);
        //$criteria->compare('id_empresa_fk', $this->id_empresa_fk);
        $criteria->compare('id_usuario_inserta_fk', $this->id_usuario_inserta_fk);
        $criteria->addCondition('id_empresa_fk='.$ide );
        $criteria->order="nombre DESC";
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
