<?php

/**
 * This is the model class for table "tb_gallery".
 *
 * The followings are the available columns in table 'tb_gallery':
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property string $date
 * @property string $image
 * @property string $type
 */
class Gallery extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Gallery the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tb_gallery';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, content', 'unique'),
            array('name, content, date, image', 'required'),
            array('name, image', 'length', 'max' => 255),
            array('type', 'length', 'max' => 1),
            array('image', 'file', 'types' => 'jpg, jpeg, gif, png', 'allowEmpty' => true, 'maxSize' => 1024 * 1024 * 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, content, date, image, type', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'media' => array(self::HAS_MANY, 'Media', 'id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'content' => 'Content',
            'date' => 'Date',
            'image' => 'Image',
            'type' => 'Type',
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
        $criteria->compare('content', $this->content, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('type', $this->type, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function getStatus($id = NULL) {
        if (!empty($id)) {
            $arr = array(
                '1' => '<div class="badge badge-success">Image</div>',
                '2' => '<div class="badge badge-warning">Video</div>'
            );
            return $arr[$id];
        }
        return "";
    }

    public static function getListGallery($id = NULL) {
        $criteria = new CDbCriteria();

        if ($id == 1) {
            $criteria->condition = 'type = 1';
        } else {
            $criteria->condition = 'type = 2';
        }

        $criteria->order = 'id DESC';
        $model = Gallery::model()->findAll($criteria);

        if (!empty($model)) {
            $list = CHtml::listData($model, 'id', 'name');
            return $list;
        }
        return "";
    }

    public static function getCountMedia($id = NULL) {
        if (!empty($id)) {
            $criteria = new CDbCriteria();
            $criteria->select = 'count(`id_gallery`) as Count';
            $criteria->condition = 'id_gallery = ' . $id;
            return $model_coutn = Media::model()->findAll($criteria);
        }
        return "<span class=\"badge badge-important\">NULL</span>";
    }

    public static function getTabPictuer($modelClass, $id) {
//        $modelClass = new Gallery();

        $criteria = new CDbCriteria();
        $criteria->condition = 'type = "' . $id . '"';
        $criteria->order = 'id DESC';
        $criteria->limit = 5;


        $dataprovider = new CActiveDataProvider($modelClass, array('criteria' => $criteria));
        $dataprovider->pagination = FALSE;
//        $dataprovider = new CActiveDataProvider($modelClass);
        return $dataprovider;
    }
    
    public static function getTabVideo($modelGallery){
        $criteria = new CDbCriteria();
        $criteria->condition = '`type` = 2';
        $criteria->order = '`id` DESC';
        $criteria->limit = 5;
        
        $dataprovider = new CActiveDataProvider($modelGallery, array('criteria'=>$criteria));
        $dataprovider->pagination = FALSE;
        
        return $dataprovider;
        
    }

}