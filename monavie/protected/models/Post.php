<?php

/**
 * This is the model class for table "tb_post".
 *
 * The followings are the available columns in table 'tb_post':
 * @property integer $id
 * @property string $header
 * @property string $content
 * @property string $date
 * @property string $status
 * @property integer $id_page
 *
 * The followings are the available model relations:
 * @property TbPage $idPage
 */
class Post extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Post the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tb_post';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('header', 'unique'),
            array('header, imageHeader, detailHeader, content, date, id_page', 'required'),
            array('id_page', 'numerical', 'integerOnly' => true),
            array('header', 'length', 'max' => 255),
            array('imageHeader', 'length', 'max' => 100),
            array('detailHeader', 'length', 'max' => 200),
            array('status', 'length', 'max' => 1),
            array('imageHeader', 'file', 'types' => 'jpg, gif, png', 'allowEmpty' => true, 'maxSize' => 10 * 1024 * 1024),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, header, content, date, status, id_page', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'Pages' => array(self::BELONGS_TO, 'Page', 'id_page'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'header' => 'Header',
            'content' => 'Content',
            'date' => 'Date',
            'status' => 'Status',
            'id_page' => 'Id Page',
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
        $criteria->compare('header', $this->header, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('id_page', $this->id_page);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function getStatus($status = NULL) {

        if (!empty($status)) {
            $arr = array(
                '0' => 'No Post',
                '1' => 'Post'
            );
            return $arr[$status];
        }
        return 'No Post';
    }

    public static function getPages() {
        $rec = Page::model()->findAll();
        $list = CHtml::listData($rec, 'id', 'name');
        return $list;
    }

    public static function getPageName($id = NULL) {
        if (!empty($id)) {
            $m = Page::model()->findByPk($id);
            return $m->name;
        }
        return '';
    }

    public static function getTabNewsEvent($model, $id) {

        $criteria = new CDbCriteria();
        $criteria->condition = 'id_page = "' . $id . '" AND status = "1"';
        $criteria->order = 'id DESC';
        $criteria->offset = 0;
        $criteria->limit = 5;

        return new CActiveDataProvider($model, array('criteria' => $criteria, 'pagination' => FALSE));
    }

    public static function getNewFeed($modelClass) {
        $criteria = new CDbCriteria();
        $criteria->addCondition(array('t.`id_page` = "5"'));
        $criteria->addCondition(array('t.`id_page` = "6"'), "OR");
        $criteria->addCondition(array('t.`status` = "1"'), "AND");
        $criteria->order = '`id` DESC';
        $criteria->offset = 0;
        $criteria->limit = 5;

        $dataProvider = new CActiveDataProvider($modelClass, array('criteria' => $criteria));
        $dataProvider->pagination = FALSE;
        return $dataProvider;
    }

}