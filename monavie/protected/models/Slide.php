<?php

/**
 * This is the model class for table "tb_slide".
 *
 * The followings are the available columns in table 'tb_slide':
 * @property integer $id
 * @property string $name
 * @property string $file
 * @property string $type
 * @property string $date
 * @property string $link
 * @property string $title
 * @property string $content
 */
class Slide extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Slide the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_slide';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, file, type, date', 'required'),
			array('name, file, title', 'length', 'max'=>100),
			array('type', 'length', 'max'=>50),
			array('link, content', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, file, type, date, link, title, content', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'file' => 'File',
			'type' => 'Type',
			'date' => 'Date',
			'link' => 'Link',
			'title' => 'Title',
			'content' => 'Contetn',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function getDataProvider($modelClass){
            return new CActiveDataProvider($modelClass);
        }
        
        public static function getSlide($modelClass){
//            $modelClass = new Slide();
            $listDataProdiver = new CActiveDataProvider($modelClass);
            return $listDataProdiver;
        }
}