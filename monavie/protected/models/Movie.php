<?php

/**
 * This is the model class for table "tb_movie".
 *
 * The followings are the available columns in table 'tb_movie':
 * @property integer $id_movie
 * @property string $movie_name
 * @property string $movie_link
 * @property integer $id_gallery
 */
class Movie extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Movie the static model class
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
		return 'tb_movie';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('movie_name, movie_link, id_gallery', 'required'),
			array('id_gallery', 'numerical', 'integerOnly'=>true),
			array('movie_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_movie, movie_name, movie_link, id_gallery', 'safe', 'on'=>'search'),
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
			'id_movie' => 'Id Movie',
			'movie_name' => 'Movie Name',
			'movie_link' => 'Movie Link',
			'id_gallery' => 'Id Gallery',
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

		$criteria->compare('id_movie',$this->id_movie);
		$criteria->compare('movie_name',$this->movie_name,true);
		$criteria->compare('movie_link',$this->movie_link,true);
		$criteria->compare('id_gallery',$this->id_gallery);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}