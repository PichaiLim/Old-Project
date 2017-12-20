<?php

/**
 * This is the model class for table "tb_social".
 *
 * The followings are the available columns in table 'tb_social':
 * @property integer $social_id
 * @property string $social_name
 * @property string $social_link
 * @property integer $tb_member
 */
class Social extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Social the static model class
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
		return 'tb_social';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('social_name, social_link, tb_member', 'required'),
			array('tb_member', 'numerical', 'integerOnly'=>true),
			array('social_name', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('social_id, social_name, social_link, tb_member', 'safe', 'on'=>'search'),
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
			'social_id' => 'Social',
			'social_name' => 'Social Name',
			'social_link' => 'Social Link',
			'tb_member' => 'Tb Member',
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

		$criteria->compare('social_id',$this->social_id);
		$criteria->compare('social_name',$this->social_name,true);
		$criteria->compare('social_link',$this->social_link,true);
		$criteria->compare('tb_member',$this->tb_member);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}