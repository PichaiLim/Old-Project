<?php

/**
 * This is the model class for table "branch".
 *
 * The followings are the available columns in table 'branch':
 * @property string $id
 * @property string $created
 * @property string $created_by
 * @property string $updated
 * @property string $updated_by
 * @property string $active
 * @property string $published
 * @property string $name
 * @property string $remark
 * @property string $address
 * @property string $province_id
 * @property string $district_id
 * @property string $area_id
 * @property string $postal_code
 * @property string $map_data
 * @property string $phone
 * @property string $fax
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keywords
 * @property string $building_count
 * @property string $floor_count
 * @property string $room_count
 * @property string $room_type_count
 */
class Branch extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'branch';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('created, created_by, name', 'required'),
			array('created_by, updated_by, building_count, floor_count, room_count, room_type_count', 'length', 'max'=>10),
			array('active, published', 'length', 'max'=>1),
			array('name, map_data', 'length', 'max'=>64),
			array('remark, address, seo_title, seo_description, seo_keywords', 'length', 'max'=>255),
			array('province_id, postal_code', 'length', 'max'=>5),
			array('district_id', 'length', 'max'=>8),
			array('area_id', 'length', 'max'=>11),
			array('phone, fax', 'length', 'max'=>32),
			array('updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, created, created_by, updated, updated_by, active, published, name, remark, address, province_id, district_id, area_id, postal_code, map_data, phone, fax, seo_title, seo_description, seo_keywords, building_count, floor_count, room_count, room_type_count', 'safe', 'on'=>'search'),
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
            'building'=>array(self::HAS_MANY, 'Building', 'branch_id'),
            'room'=>array(self::HAS_MANY, 'Room', 'branch_id'),
            'roomTypes' => array(self::HAS_MANY, 'RoomType', 'branch_id'),
            'inventory'=>array(self::HAS_MANY, 'Inventory' ,'branch_id')
        );
	}


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'created' => 'Created',
			'created_by' => 'Created By',
			'updated' => 'Updated',
			'updated_by' => 'Updated By',
			'active' => 'Active',
			'published' => 'Published',
			'name' => 'Name',
			'remark' => 'Remark',
			'address' => 'Address',
			'province_id' => 'Province',
			'district_id' => 'District',
			'area_id' => 'Area',
			'postal_code' => 'Postal Code',
			'map_data' => 'Map Data',
			'phone' => 'Phone',
			'fax' => 'Fax',
			'seo_title' => 'Seo Title',
			'seo_description' => 'Seo Description',
			'seo_keywords' => 'Seo Keywords',
			'building_count' => 'Building Count',
			'floor_count' => 'Floor Count',
			'room_count' => 'Room Count',
			'room_type_count' => 'Room Type Count',
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
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('updated_by',$this->updated_by,true);
		$criteria->compare('active',$this->active,true);
		$criteria->compare('published',$this->published,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('province_id',$this->province_id,true);
		$criteria->compare('district_id',$this->district_id,true);
		$criteria->compare('area_id',$this->area_id,true);
		$criteria->compare('postal_code',$this->postal_code,true);
		$criteria->compare('map_data',$this->map_data,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('seo_title',$this->seo_title,true);
		$criteria->compare('seo_description',$this->seo_description,true);
		$criteria->compare('seo_keywords',$this->seo_keywords,true);
		$criteria->compare('building_count',$this->building_count,true);
		$criteria->compare('floor_count',$this->floor_count,true);
		$criteria->compare('room_count',$this->room_count,true);
		$criteria->compare('room_type_count',$this->room_type_count,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Branch the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function TilesClassColor($id){
        switch ($id){
            case 1:
                return "shortcut-tiles tiles-green";
            case 2:
                return "shortcut-tiles tiles-indigo";
            case 3:
                return "shortcut-tiles tiles-primary";
            case 4:
                return "shortcut-tiles tiles-magenta";
            case 5:
                return "shortcut-tiles tiles-info";
            case 6:
                return "shortcut-tiles tiles-alizarin";
            case 7:
                return "shortcut-tiles tiles-danger";
            case 8:
                return "shortcut-tiles tiles-orange";
            case 9:
                return "shortcut-tiles tiles-indigo";
            case 10:
                return "shortcut-tiles tiles-brown";
            case 11:
                return "shortcut-tiles tiles-sky";
            default:
                return "shortcut-tiles tiles-grape";
        }
    }

}
