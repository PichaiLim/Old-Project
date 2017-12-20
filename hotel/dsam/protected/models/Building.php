<?php

/**
 * This is the model class for table "building".
 *
 * The followings are the available columns in table 'building':
 * @property string $id
 * @property string $branch_id
 * @property string $created
 * @property string $created_by
 * @property string $updated
 * @property string $updated_by
 * @property string $active
 * @property string $published
 * @property string $name
 * @property string $remark
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keywords
 * @property string $floor_count
 * @property string $room_count
 * @property string $reservation_count
 */
class Building extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'building';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('branch_id, created, created_by, name', 'required'),
			array('branch_id, created_by, updated_by, floor_count, room_count, reservation_count', 'length', 'max'=>10),
			array('active, published', 'length', 'max'=>1),
			array('name', 'length', 'max'=>64),
			array('remark, seo_title, seo_description, seo_keywords', 'length', 'max'=>255),
			array('updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, branch_id, created, created_by, updated, updated_by, active, published, name, remark, seo_title, seo_description, seo_keywords, floor_count, room_count, reservation_count', 'safe', 'on'=>'search'),
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
            'branch' => array(self::BELONGS_TO, 'Brach', 'branch_id'),
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
			'created' => 'Created',
			'created_by' => 'Created By',
			'updated' => 'Updated',
			'updated_by' => 'Updated By',
			'active' => 'Active',
			'published' => 'Published',
			'name' => 'Name',
			'remark' => 'Remark',
			'seo_title' => 'Seo Title',
			'seo_description' => 'Seo Description',
			'seo_keywords' => 'Seo Keywords',
			'floor_count' => 'Floor Count',
			'room_count' => 'Room Count',
			'reservation_count' => 'Reservation Count',
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
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('updated_by',$this->updated_by,true);
		$criteria->compare('active',$this->active,true);
		$criteria->compare('published',$this->published,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('seo_title',$this->seo_title,true);
		$criteria->compare('seo_description',$this->seo_description,true);
		$criteria->compare('seo_keywords',$this->seo_keywords,true);
		$criteria->compare('floor_count',$this->floor_count,true);
		$criteria->compare('room_count',$this->room_count,true);
		$criteria->compare('reservation_count',$this->reservation_count,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Building the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function CountBuilding($id = 0, $title=""){
        $countBuilding = Building::model()->count();

        if($id !== 0){
            switch($title){
                case "branch":
                    return Building::model()->countByAttributes(array('branch_id'=>$id));
                default:
                    return $countBuilding;
            }
        }

        return ($countBuilding == 0)? 0 : $countBuilding;
    }

    public function setName($id){

        $buildingName = Building::model()->findByPk($id);

        return $buildingName->name;
    }
}
