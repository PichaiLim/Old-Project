<?php
/**
 * This is the model class for table "company".
 *
 * The followings are the available columns in table 'company':
 * @property string $id
 * @property string $name_th
 * @property string $name_en
 * @property string $address_th
 * @property string $address_en
 * @property string $tel
 * @property string $fax
 * @property string $updated_date
 * @property string $updated_by
 */
class Company extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('name_en', 'length', 'max'=>150),
			array('name_th', 'length', 'max'=>150),
			array('tel', 'length', 'max'=>100),
			array('fax', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name_en, name_th', 'safe', 'on'=>'search'),
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
			'name_en' => 'Name EN',
			'name_th' => 'Name TH',
			'address_th' => 'Address TH',
			'address_en' => 'Address EN',
			'tel' => 'Tel',
			'fax' => 'Fax',
			'updated_date' => 'Updated Date',
			'updated_by' => 'Updated By'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name_th',$this->name_th,true);
		$criteria->compare('name_en',$this->name_en,true);
		$criteria->compare('address_th',$this->address_th,true);
		$criteria->compare('address_en',$this->address_en,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('fax',$this->fax,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Company the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
