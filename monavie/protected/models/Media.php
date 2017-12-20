<?php

/**
 * This is the model class for table "tb_media".
 *
 * The followings are the available columns in table 'tb_media':
 * @property integer $id
 * @property string $name
 * @property string $file
 * @property string $type
 * @property string $link
 * @property string $date
 * @property string $category
 * @property integer $id_gallery
 */
class Media extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Media the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tb_media';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('file', 'unique'),
            // Image no Add
            array('file', 'file', 'types' => 'jpg, jpeg, gif, png', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * 10, 'on' => 'Image'),
            array('files', 'file', 'types' => 'avi, mpg, flv, mov, mpeg, mp4, m4v, 3gp, wmv', 'maxSize' => 150 * 1024 * 1024, 'on' => 'Video'),
            array('name, file, type, link, date', 'required'),
            array('id_gallery', 'numerical', 'integerOnly' => true),
            array('name, file, type, link', 'length', 'max' => 255),
            array('category', 'length', 'max' => 1),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, file, type, link, date, category, id_gallery', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'gallerys' => array(self::BELONGS_TO, 'Gallery', 'id_gallery')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'file' => 'File',
            'type' => 'Type',
            'link' => 'Link',
            'date' => 'Date',
            'category' => 'Category',
            'id_gallery' => 'Id Gallery',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('file', $this->file, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('link', $this->link, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('category', $this->category, true);
        $criteria->compare('id_gallery', $this->id_gallery);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function getTabPicAndVideo($modelClass, $category, $idGallery) {
        $config = new CDbCriteria();
        $config->condition = '`category` = "' . $category . '"';
        $config->params = array('id_gallery' => $idGallery);

        $dataprovider = new CActiveDataProvider($modelClass, array('config' => $config));
        $dataprovider->pagination = array('pagesize' => '10');

        return $dataprovider;
    }
    
    public static function getSlide($model){
        $dataprovider = new CActiveDataProvider($modelClass);
        $dataprovider->pagination = FALSE;
        return $dataprovider;
    }

}