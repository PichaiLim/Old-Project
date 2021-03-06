<?php

/**
 * This is the model class for table "inventory".
 *
 * The followings are the available columns in table 'inventory':
 * @property string $id
 * @property string $branch_id
 * @property string $product_id
 * @property string $pushed
 * @property string $pushed_by
 * @property string $pulled
 * @property string $pulled_by
 * @property string $quantity
 */
class Inventory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'inventory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('branch_id, product_id', 'required'),
			array('branch_id, product_id, pushed_by, pulled_by, quantity', 'length', 'max'=>10),
			array('pulled', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, branch_id, product_id, pushed, pushed_by, pulled, pulled_by, quantity', 'safe', 'on'=>'search'),
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
            'branch'=>array(self::BELONGS_TO, 'Branch', 'branch_id'),
            'product'=>array(self::BELONGS_TO, 'Product', 'product_id')
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
			'pushed' => 'Pushed',
			'pushed_by' => 'Pushed By',
			'pulled' => 'Pulled',
			'pulled_by' => 'Pulled By',
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
		$criteria->compare('branch_id',$this->branch_id,true);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('pushed',$this->pushed,true);
		$criteria->compare('pushed_by',$this->pushed_by,true);
		$criteria->compare('pulled',$this->pulled,true);
		$criteria->compare('pulled_by',$this->pulled_by,true);
		$criteria->compare('quantity',$this->quantity,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Inventory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
