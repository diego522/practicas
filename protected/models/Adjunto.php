<?php

/**
 * This is the model class for table "adjunto".
 *
 * The followings are the available columns in table 'adjunto':
 * @property integer $id_adjunto
 * @property string $filename
 * @property string $filecontenttype
 * @property integer $creador
 * @property string $ruta
 *
 * The followings are the available model relations:
 * @property Usuario $creador0
 * @property BitacoraPractica[] $bitacoraPracticas
 */
class Adjunto extends CActiveRecord {

    public static $formatos_acepotados = array('pdf',);
   // public static $formatos_acepotados = array('pdf', 'doc', 'odt', 'docx', 'txt', 'jpg', 'jpeg', 'png', 'gif', 'bmp', 'zip', 'rar', 'tar.gz', 'gz', '7z');

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Adjunto the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'adjunto';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('filename, filecontenttype, creador', 'required'),
            array('creador', 'numerical', 'integerOnly' => true),
            array('filename, filecontenttype', 'length', 'max' => 200),
            array('ruta', 'length', 'max' => 2000),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_adjunto, filename, filecontenttype, creador, ruta', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'creador0' => array(self::BELONGS_TO, 'Usuario', 'creador'),
            'bitacoraPracticas' => array(self::HAS_MANY, 'BitacoraPractica', 'id_adjunto_fk'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_adjunto' => 'Id Adjunto',
            'filename' => 'Filename',
            'filecontenttype' => 'Filecontenttype',
            'creador' => 'Creador',
            'ruta' => 'Ruta',
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

        $criteria->compare('id_adjunto', $this->id_adjunto);
        $criteria->compare('filename', $this->filename, true);
        $criteria->compare('filecontenttype', $this->filecontenttype, true);
        $criteria->compare('creador', $this->creador);
        $criteria->compare('ruta', $this->ruta, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    protected function beforeDelete() {
        if (file_exists($this->ruta))
            unlink($this->ruta);
        parent::beforeDelete();
    }

}
