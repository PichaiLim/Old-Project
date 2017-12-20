<?php

class RoomTypeController extends Controller
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
				'actions'=>array('index','view', 'ViewRoomtypeByBranchID'),
                'expression'=>"Yii::app()->user->name !== 'Guest' ",
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','SetCreate','setupdate', 'ChkName'),
                'expression'=>"Yii::app()->user->name !== 'Guest' ",
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'DeleteRoomType'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    public function actionChkName()
    {
        //read the post input (use this technique if you have no post variable name):
        $post = file_get_contents("php://input");

        //decode json post input as php array:
        $data = CJSON::decode($post, true);

        $model = RoomType::model()->findAll(array('name'=>$data['name']));

        $response = array();

        if($model != null)
        {
            $response['success'] = false;
            $response['errors'] = $model->errors;
            $response['RoomType'] = $model;

        }
        else
        {

            $response['success'] = true;
            $response['errors'] = $model->errors;
            $response['RoomType'] = $model;

        }

        header('Content-type:application/json;charset=UTF-8');
        echo CJSON::encode($response);

        Yii::app()->end();
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

	public function actionViewRoomtypeByBranchID(){
        $get = file_get_contents('php://input');
        $data = CJSON::decode($get);

        $sql = "SELECT b.id,b.name,(case when b.active = '1' then 'เปิดการใช้งาน' else 'ปิดการใช้งาน' end) as active ,b.created,(select e.username from employee e where e.id= b.created_by) as created_by,b.updated,(select e.username from employee e where e.id=b.updated_by) as updated_by, b.remark, b.price FROM room_type b where b.branch_id = {$data['id']}";

        $models = Yii::app()->db->createCommand($sql)->queryALL();
        header('Content-type: application/json');
        echo CJSON::encode($models);

        Yii::app()->end();
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{


		$model=new RoomType;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RoomType']))
		{
			$model->attributes=$_POST['RoomType'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->renderPartial('create',array(
			'model'=>$model,
		));
	}

    public function actionSetCreate(){

        //read the post input (use this technique if you have no post variable name):
        $post = file_get_contents("php://input");

        //decode json post input as php array:
        $data = CJSON::decode($post, true);

        $RoomType = new RoomType();
        $RoomType->attributes = $data;

        $RoomType->created = new CDbExpression('NOW()');
        $RoomType->created_by = Yii::app()->user->id;


        $response = array();


//        $findName = RoomType::model()->findAllByAttributes(array('name'=>$data['name']));


        //save
        /*if($findName != null)
        {
            $response['success'] = true;
            $response['errors'] = $RoomType->errors;
            $response['RoomType'] = $RoomType->name;
        }else*/
        if($RoomType->save() == true){
            $response['success'] = false;
            $response['errors'] = $RoomType->errors;
        }else{
            $response['success'] = true;

            $response['RoomType'] = $RoomType;
        }

        header('Content-type:application/json;charset=UTF-8');

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

    public function actionSetUpdate(){

        //read the post input (use this technique if you have no post variable name):
        $json = file_get_contents("php://input");

        //decode json post input as php array:
        $data = CJSON::decode($json, TRUE);

//        echo CJSON::encode($data);
        $roomType = RoomType::model()->findByPk($data['id']);


        $roomType->branch_id = $data['branch_id'];
        $roomType->created = $data['created'];
        $roomType->created_by = $data['created_by'];
        $roomType->updated = new CDbExpression('NOW()');
        $roomType->updated_by = Yii::app()->user->id;
        $roomType->active = $data['active'];
        $roomType->published = $data['published'];
        $roomType->price = $data['price'];
        $roomType->deposit = $data['deposit'];
        $roomType->name = $data['name'];
        $roomType->remark = $data['remark'];
        $roomType->seo_title = $data['seo_title'];
        $roomType->seo_description = $data['seo_description'];
        $roomType->seo_keywords = $data['seo_keywords'];


        $response = array();


        //save
        if($roomType->save() == true){
            $response['success'] = false;
            $response['errors'] = $roomType->errors;
        }else{
            $response['success'] = true;

            $response['RoomType'] = $roomType;
        }

        header('Content-type:application/json;charset=UTF-8');

        echo CJSON::encode($response);

//        Yii::app()->end();
        exit();
    }

    /**
     * @param $id
     *
     * @throws CHttpException
     */

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

	public function actionDeleteRoomType(){
		$post = file_get_contents('php://input');

        $data = CJSON::decode($post,true);

        $roomType=RoomType::model()->findByPk($data['id']); // assuming there is a post whose ID is 10
		$roomType->delete();
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('RoomType');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new RoomType('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['RoomType']))
			$model->attributes=$_GET['RoomType'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return RoomType the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=RoomType::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param RoomType $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='room-type-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
