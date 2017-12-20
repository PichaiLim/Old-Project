<?php

/**
 * This is the model class for table "employee_branch".
 *
 * The followings are the available columns in table 'employee_branch':
 * @property string $employee_id
 * @property string $branch_id
 */
class EmployeeBranch extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'employee_branch';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employee_id, branch_id', 'required'),
			array('employee_id, branch_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('employee_id, branch_id', 'safe', 'on'=>'search'),
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
            'employee'=>array(
                self::MANY_MANY,
                'Employee',
                'employeeBranch_employee_assignment(employee_id, id)'
            ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'employee_id' => 'Employee',
			'branch_id' => 'Branch',
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

		$criteria->compare('employee_id',$this->employee_id,true);
		$criteria->compare('branch_id',$this->branch_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EmployeeBranch the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function showBranch($empId, $branchId)
    {
        $model = EmployeeBranch::model()->findByAttributes(array('employee_id'=>$empId,'branch_id'=>$branchId));

        return ($model['branch_id'] === $branchId)? "": "hidden";
    }
}
