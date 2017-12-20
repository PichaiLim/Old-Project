<?php

class RoomController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','ViewOnPageReservation', 'ViewRoomByRoomIdAndBranchId', 'ViewRoomNotReservation', 'ViewRoomAll'),
                'expression'=>"Yii::app()->user->name !== 'Guest' "
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'setcreate', 'setupdate', 'UpdateStatusActive'),
                'expression'=>"Yii::app()->user->name !== 'Guest' "
//                'expression'=>"Yii::app()->user->name !== 'Guest' "
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'DeleteRoom'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	public function actionViewRoomByRoomIdAndBranchId(){
		$get = file_get_contents('php://input');
        $data = CJSON::decode($get);

        $sql = "select r.name,r.id as 'room_id', r.building_id as 'building_id', r.branch_id as 'branch_id' ,r.floor_id as 'floor_id' , b.name AS 'branch_name' ,f.name AS 'floor_name',rt.name AS 'roomTypeName', rt.price AS 'roomTypePrice', rt.deposit AS 'roomTypeDeposit' from room r, branch b , floor f, room_type rt where r.branch_id = b.id and r.floor_id = f.id and r.room_type_id = rt.id and r.id = {$data['id']} and r.branch_id = {$data['branch_id']}  GROUP by r.id";

        $models = Yii::app()->db->createCommand($sql)->queryRow();
        header('Content-type: application/json');
        echo CJSON::encode($models);

        Yii::app()->end();
	}

	public function actionViewRoomNotReservation()
	{
        $get = file_get_contents('php://input');
        $data = CJSON::decode($get);

        $sql = "SELECT r.id, r.name, r.active, rt.name as 'roomTypeName', rt.price, rt.deposit FROM room AS r INNER JOIN branch AS b ON b.id = r.branch_id INNER JOIN building AS buil ON buil.id = r.building_id INNER JOIN floor AS f ON f.id = r.floor_id INNER JOIN room_type as rt ON r.room_type_id = rt.id WHERE r.branch_id = {$data['branch_id']} AND r.building_id = {$data['building_id']} AND r.floor_id = {$data['floor_id']} and r.active != '' and r.id not in (SELECT rn.room_id FROM `reservation` rn where (str_to_date('{$data['start']}', '%Y-%m-%d') BETWEEN rn.start and rn.end or str_to_date('{$data['end']}', '%Y-%m-%d') BETWEEN rn.start and rn.end) and rn.floor_id ={$data['floor_id']} and rn.branch_id ={$data['branch_id']} and rn.building_id ={$data['building_id']} GROUP by rn.room_id) order by r.name";

        $models = Yii::app()->db->createCommand($sql)->queryALL();

        $response = array();
        if(is_null($models)){
            $response['success'] = false;
            $response['error'] = 404;
            $response['models'] = $models;
        }else{
            $response['success'] = true;
            $response['error'] = 200;
            $response['models'] = $models;
        }

        header('Content-type: application/json');
        echo CJSON::encode($response);

        Yii::app()->end();
	}

	public function actionViewRoomAll(){
        $get = file_get_contents('php://input');
        $data = CJSON::decode($get);

        $sql = "SELECT b.id,b.name,(case when b.active = '1' then 'เปิดการใช้งาน' else 'ปิดการใช้งาน' end) as active ,b.created,(select e.username from employee e where e.id= b.created_by) as created_by,b.updated,(select e.username from employee e where e.id=b.updated_by) as updated_by, b.remark,b.building_id, b.floor_id,bd.name as 'building_name', f.name as 'floor_name' FROM room b, building bd, floor f where b.building_id = bd.id and b.floor_id = f.id";

        $models = Yii::app()->db->createCommand($sql)->queryALL();
        header('Content-type: application/json');
        echo CJSON::encode($models);

        Yii::app()->end();
    }

	public function actionViewOnPageReservation()
	{
        $get = file_get_contents('php://input');
        $data = CJSON::decode($get);

        $sql = "SELECT r.id, r.name, r.active ";
        $sql .= "FROM room AS r ";
        $sql .= "INNER JOIN branch AS b ON b.id = r.branch_id ";
        $sql .= "INNER JOIN building AS buil ON buil.id = r.building_id ";
        $sql .= "INNER JOIN floor AS f ON f.id = r.floor_id ";
        $sql .= "WHERE r.branch_id = {$data['branch_id']} ";
        $sql .= "AND r.building_id = {$data['building_id']} ";
        $sql .= "AND r.floor_id = {$data['floor_id']}";

        $models = Yii::app()->db->createCommand($sql)->queryALL();

        $response = array();
        if(is_null($models)){
            $response['success'] = false;
            $response['error'] = 404;
            $response['models'] = $models;
        }else{
            $response['success'] = true;
            $response['error'] = 200;
            $response['models'] = $models;
        }

        header('Content-type: application/json');
        echo CJSON::encode($response);

        Yii::app()->end();
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        /*
		$model=new Room;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Room']))
		{
			$model->attributes=$_POST['Room'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
        */
        $this->renderPartial('create');
	}

    public function actionSetCreate()
    {
        //read the post input (use this technique if you have no post variable name):
        $post = file_get_contents("php://input");

        //decode json post input as php array:
        $data = CJSON::decode($post, true);

        // New object name 'Room'
        $model = new Room;

        // Set all value in 'Attrubutes'
        $model->attributes = $data;

        // Set datetime now
        $model->created = new CDbExpression('NOW()');


        $response= array();

        if($model->save()== true){
            $response['success'] = false;

            $response['errors'] = $model->errors;
        }else{
            $response['success'] = true;

            $response['Room'] = $model;
        }

        // Set content json
        header('Content-type: application/json');
        // Return response value json
        echo CJSON::encode($response);

        Yii::app()->end();
    }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
        $this->renderPartial('update');
	}

    public function actionSetUpdate()
    {
        //read the post input (use this technique if you have no post variable name):
        $put = file_get_contents("php://input");

        //decode json post input as php array:
        $data = CJSON::decode($put, true);

        // Get id by pk & Set attributes
        $model = Room::model()->findByPk($data['id']);

		$model->branch_id           =   $data['branch_id'];
		$model->building_id         =   $data['building_id'];
		$model->floor_id            =   $data['floor_id'];
		$model->room_type_id        =   $data['room_type_id'];
		/*$model->created             =   $data['created'];
		$model->created_by          =   $data['created_by'];*/
        $model->updated             =   new CDbExpression('NOW()');
        $model->updated_by          =   $data['updated_by'];
		$model->active              =   $data['active'];
		$model->published           =   $data['published'];
		$model->name                =   $data['name'];
		$model->remark              =   $data['remark'];
		$model->seo_title           =   $data['seo_title'];
		$model->seo_description     =   $data['seo_description'];
		$model->seo_keywords        =   $data['seo_keywords'];
//		$model->reservation_count   =   $data['reservation_count'];


        $response = array();

        // Save for updated
        if($model->save() == true){
            $response['success'] = false;

            $response['errors'] = $model->errors;
        }
        else{
            $response['success'] = true;

            $response['Room'] = $model;
        }


        header('Content-type: application/json');
        echo CJSON::encode($response);

        Yii::app()->end();
    }

    public function actionUpdateStatusActive()
    {
        $post = file_get_contents('php://input');
        $data = CJSON::decode($post, true);

        $model = Room::model()->findByPk($data['id']);
        $model->active = $data['active'];
        $model->updated = new CDbExpression('NOW()');
        $model->updated_by = Yii::app()->user->id;


        $response = array();

        if($model->save() == true){
            $response['success'] = false;

            $response['errors'] = $model->errors;

            $response['models'] = $model;
        }else{
            $response['success'] = true;
            $response['errors'] = $model->errors;
            $response['models'] = $model;
        }


        header('Content-type: application/json');
        echo CJSON::encode($response);


        Yii::app()->end();
    }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionDeleteRoom(){
		$post = file_get_contents('php://input');

        $data = CJSON::decode($post,true);

        $room=Room::model()->findByPk($data['id']); // assuming there is a post whose ID is 10
		$room->delete();
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($id = 0)
	{
        $dataProvider=new CActiveDataProvider('Room');

        if($id == null || $id <= 0)
        {
            $id = "";
        }

        $this->render('index',array(
            'dataProvider'=>$dataProvider,
            'id'=>$id
        ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Room('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Room']))
			$model->attributes=$_GET['Room'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Room the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Room::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Room $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='room-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
