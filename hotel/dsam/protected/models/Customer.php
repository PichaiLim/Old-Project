<?php

/**
 * This is the model class for table "customer".
 *
 * The followings are the available columns in table 'customer':
 * @property integer $id
 * @property string $email
 * @property string $created
 * @property string $created_by
 * @property string $updated
 * @property string $updated_by
 * @property string $active
 * @property string $initial
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $birthdate
 * @property string $nationality
 * @property string $personal_no
 * @property string $passport_no
 * @property string $marital_status
 * @property string $address
 * @property string $province_id
 * @property string $district_id
 * @property string $area_id
 * @property string $postal_code
 * @property string $home_phone
 * @property string $work_phone
 * @property string $mobile_phone
 * @property string $remark
 */
class Customer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('created, created_by, first_name, last_name, gender', 'required'),
			array('email, address, remark', 'length', 'max'=>255),
			array('created_by, updated_by', 'length', 'max'=>10),
			array('active', 'length', 'max'=>1),
			array('initial', 'length', 'max'=>16),
			array('first_name, last_name, nationality', 'length', 'max'=>64),
			array('gender', 'length', 'max'=>6),
			array('personal_no', 'length', 'max'=>13),
			array('passport_no', 'length', 'max'=>9),
			array('marital_status', 'length', 'max'=>7),
			array('province_id, postal_code', 'length', 'max'=>5),
			array('district_id', 'length', 'max'=>8),
			array('area_id', 'length', 'max'=>11),
			array('home_phone, work_phone, mobile_phone', 'length', 'max'=>32),
			array('updated, birthdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, email, created, created_by, updated, updated_by, active, initial, first_name, last_name, gender, birthdate, nationality, personal_no, passport_no, marital_status, address, province_id, district_id, area_id, postal_code, home_phone, work_phone, mobile_phone, remark', 'safe', 'on'=>'search'),
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
			'email' => 'Email',
			'created' => 'Created',
			'created_by' => 'Created By',
			'updated' => 'Updated',
			'updated_by' => 'Updated By',
			'active' => 'Active',
			'initial' => 'Initial',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'gender' => 'Gender',
			'birthdate' => 'Birthdate',
			'nationality' => 'Nationality',
			'personal_no' => 'Personal No',
			'passport_no' => 'Passport No',
			'marital_status' => 'Marital Status',
			'address' => 'Address',
			'province_id' => 'Province',
			'district_id' => 'District',
			'area_id' => 'Area',
			'postal_code' => 'Postal Code',
			'home_phone' => 'Home Phone',
			'work_phone' => 'Work Phone',
			'mobile_phone' => 'Mobile Phone',
			'remark' => 'Remark',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('updated_by',$this->updated_by,true);
		$criteria->compare('active',$this->active,true);
		$criteria->compare('initial',$this->initial,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('birthdate',$this->birthdate,true);
		$criteria->compare('nationality',$this->nationality,true);
		$criteria->compare('personal_no',$this->personal_no,true);
		$criteria->compare('passport_no',$this->passport_no,true);
		$criteria->compare('marital_status',$this->marital_status,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('province_id',$this->province_id,true);
		$criteria->compare('district_id',$this->district_id,true);
		$criteria->compare('area_id',$this->area_id,true);
		$criteria->compare('postal_code',$this->postal_code,true);
		$criteria->compare('home_phone',$this->home_phone,true);
		$criteria->compare('work_phone',$this->work_phone,true);
		$criteria->compare('mobile_phone',$this->mobile_phone,true);
		$criteria->compare('remark',$this->remark,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Customer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
