<?php

/**
 * This is the model class for table "inventory_pull_detail".
 *
 * The followings are the available columns in table 'inventory_pull_detail':
 * @property string $id
 * @property string $inventory_pull_id
 * @property string $product_id
 * @property string $quantity
 */
class InventoryPullDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'inventory_pull_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('inventory_pull_id, product_id, quantity', 'required'),
			array('inventory_pull_id, product_id, quantity', 'length', 'max'=>100),
			array('id, inventory_pull_id, product_id, quantity', 'safe', 'on'=>'search'),
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
			'inventory_pull_id' => 'Reciept no',
			'product_id' => 'Product',
			'quantity' => 'Quantity',
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
		$criteria->compare('inventory_pull_id',$this->inventory_pull_id,true);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('quantity',$this->quantity,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InventoryPull the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
