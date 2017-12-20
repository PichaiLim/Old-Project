<?php

/**
 * This is the model class for table "employee".
 *
 * The followings are the available columns in table 'employee':
 * @property integer $id
 * @property string $employee_type_id
 * @property string $admin
 * @property string $code
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $login_timeout
 * @property string $avatar
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
class Employee extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'employee';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, email, password, created, created_by, first_name, last_name, gender', 'required'),
			array('employee_type_id, created_by, updated_by', 'length', 'max'=>10),
			array('admin, active', 'length', 'max'=>1),
			array('code, first_name, last_name', 'length', 'max'=>64),
			array('username', 'length', 'max'=>20),
			array('email, address, remark', 'length', 'max'=>255),
			array('password', 'length', 'max'=>41),
			array('login_timeout', 'length', 'max'=>2),
			array('avatar, home_phone, work_phone, mobile_phone', 'length', 'max'=>32),
			array('initial', 'length', 'max'=>16),
			array('gender', 'length', 'max'=>6),
			array('marital_status', 'length', 'max'=>7),
			array('province_id, postal_code', 'length', 'max'=>5),
			array('district_id', 'length', 'max'=>8),
			array('area_id', 'length', 'max'=>11),
			array('updated, birthdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, employee_type_id, admin, code, username, email, password, login_timeout, avatar, created, created_by, updated, updated_by, active, initial, first_name, last_name, gender, birthdate, marital_status, address, province_id, district_id, area_id, postal_code, home_phone, work_phone, mobile_phone, remark', 'safe', 'on'=>'search'),
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
			'employee_type_id' => 'Employee Type',
			'admin' => 'Admin',
			'code' => 'Code',
			'username' => 'Username',
			'email' => 'Email',
			'password' => 'Password',
			'login_timeout' => 'Login Timeout',
			'avatar' => 'Avatar',
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
		$criteria->compare('employee_type_id',$this->employee_type_id,true);
		$criteria->compare('admin',$this->admin,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('login_timeout',$this->login_timeout,true);
		$criteria->compare('avatar',$this->avatar,true);
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
	 * @return Employee the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
