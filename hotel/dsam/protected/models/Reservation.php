<?php

/**
 * This is the model class for table "reservation".
 *
 * The followings are the available columns in table 'reservation':
 * @property string $id
 * @property string $reciept_no
 * @property string $branch_id
 * @property string $building_id
 * @property string $floor_id
 * @property string $room_id
 * @property string $customer_id
 * @property string $created
 * @property string $created_by
 * @property string $updated
 * @property string $updated_by
 * @property string $status
 * @property string $paid_status
 * @property string $paid
 * @property string $payee
 * @property string $start
 * @property string $end
 * @property string $num_days
 * @property string $price
 * @property string $deposit
 * @property string $amount
 */
class Reservation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reservation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('branch_id, building_id, floor_id, room_id, customer_id, created, created_by, status, start, end, num_days, price, amount', 'required'),
			array('reciept_no', 'length', 'max'=>16),
			array('branch_id, building_id, floor_id, room_id, customer_id, created_by, updated_by, payee, num_days, price, deposit, amount', 'length', 'max'=>10),
			array('status', 'length', 'max'=>9),
			array('paid_status', 'length', 'max'=>3),
			array('updated, paid', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, reciept_no, branch_id, building_id, floor_id, room_id, customer_id, created, created_by, updated, updated_by, status, paid_status, paid, payee, start, end, num_days, price, deposit, amount', 'safe', 'on'=>'search'),
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
			'reciept_no' => 'Reciept No',
			'branch_id' => 'Branch',
			'building_id' => 'Building',
			'floor_id' => 'Floor',
			'room_id' => 'Room',
			'customer_id' => 'Customer',
			'created' => 'Created',
			'created_by' => 'Created By',
			'updated' => 'Updated',
			'updated_by' => 'Updated By',
			'status' => 'Status',
			'paid_status' => 'Paid Status',
			'paid' => 'Paid',
			'payee' => 'Payee',
			'start' => 'Start',
			'end' => 'End',
			'num_days' => 'Num Days',
			'price' => 'Price',
			'deposit' => 'Deposit',
			'amount' => 'Amount',
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
		$criteria->compare('reciept_no',$this->reciept_no,true);
		$criteria->compare('branch_id',$this->branch_id,true);
		$criteria->compare('building_id',$this->building_id,true);
		$criteria->compare('floor_id',$this->floor_id,true);
		$criteria->compare('room_id',$this->room_id,true);
		$criteria->compare('customer_id',$this->customer_id,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('updated_by',$this->updated_by,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('paid_status',$this->paid_status,true);
		$criteria->compare('paid',$this->paid,true);
		$criteria->compare('payee',$this->payee,true);
		$criteria->compare('start',$this->start,true);
		$criteria->compare('end',$this->end,true);
		$criteria->compare('num_days',$this->num_days,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('deposit',$this->deposit,true);
		$criteria->compare('amount',$this->amount,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Reservation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function genRecieptNo($padiStatus = 'no')
    {
        return (strtolower($padiStatus) == 'yes')? "DRC".date('y').'-000001' : "";
    }
}
