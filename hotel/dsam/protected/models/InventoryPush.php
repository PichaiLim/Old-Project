<?php

/**
 * This is the model class for table "inventory_push".
 *
 * The followings are the available columns in table 'inventory_push':
 * @property string $id
 * @property string $branch_id
 * @property string $product_id
 * @property string $created
 * @property string $created_by
 * @property string $price
 * @property string $quantity
 * @property string $price_total
 */
class InventoryPush extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'inventory_push';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('branch_id, product_id, created, created_by, price, quantity, price_total', 'required'),
			array('branch_id, product_id, created_by, price, quantity', 'length', 'max'=>10),
			array('price_total', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, branch_id, product_id, created, created_by, price, quantity, price_total', 'safe', 'on'=>'search'),
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
			'branch_id' => 'Branch',
			'product_id' => 'Product',
			'created' => 'Created',
			'created_by' => 'Created By',
			'price' => 'Price',
			'quantity' => 'Quantity',
			'price_total' => 'Price Total',
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
		$criteria->compare('branch_id',$this->branch_id,true);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('quantity',$this->quantity,true);
		$criteria->compare('price_total',$this->price_total,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InventoryPush the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}