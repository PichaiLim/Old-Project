<?php

/**
 * This is the model class for table "floor".
 *
 * The followings are the available columns in table 'floor':
 * @property string $id
 * @property string $branch_id
 * @property string $building_id
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
 * @property string $room_count
 * @property string $reservation_count
 */
class Floor extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'floor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('branch_id, building_id, created, created_by, name', 'required'),
			array('branch_id, building_id, created_by, updated_by, room_count, reservation_count', 'length', 'max'=>10),
			array('active, published', 'length', 'max'=>1),
			array('name', 'length', 'max'=>64),
			array('remark, seo_title, seo_description, seo_keywords', 'length', 'max'=>255),
			array('updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, branch_id, building_id, created, created_by, updated, updated_by, active, published, name, remark, seo_title, seo_description, seo_keywords, room_count, reservation_count', 'safe', 'on'=>'search'),
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
			'building_id' => 'Building',
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
		$criteria->compare('building_id',$this->building_id,true);
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
	 * @return Floor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function CountFloor($id = 0, $title = "")
    {
        $coutnFloor = Floor::model()->count();

        if($id != 0){
            switch($title){
                case 'branch':
                    return Floor::model()->countByAttributes(array('branch_id'=>$id));
                case 'building':
                    $count = Floor::model()->findAllByAttributes(array('building_id'=>$id));
                    return count($count);
                default:
                    break;
            }
        }

        return ($coutnFloor == 0)? 0:$coutnFloor;
    }
}
