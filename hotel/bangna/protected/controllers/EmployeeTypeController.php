<?php

class EmployeeTypeController extends Controller
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
				'actions'=>array('index','view', 'ViewEmployeeTypeAll'),
                'expression'=>"Yii::app()->user->role !== '' ",
//				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
                'expression'=>"Yii::app()->user->role !== '' ",
//				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('SetCreate','SetUpdate'),
                'expression'=>"Yii::app()->user->role !== '' ",
//				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','DeleteEmployeeType'),
				'expression'=>"Yii::app()->user->role !== '' ",
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

	public function actionViewEmployeeTypeAll(){
        $get = file_get_contents('php://input');
        $data = CJSON::decode($get);

        $sql = "SELECT t.id,t.created, (select e.username from employee e where e.id=t.created_by) as created_by, t.updated, (select e.username from employee e where e.id=t.updated_by) as updated_by, t.name,t.remark FROM employee_type t";

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

		$this->renderPartial('create');
	}
	public function actionSetCreate()
	{
        $post = file_get_contents('php://input');

        $data = CJSON::decode($post, true);

        $model = new EmployeeType;
        $model->attributes = $data;
        $model->created = new CDbExpression('NOW()');

        $response = array();

        $findName = EmployeeType::model()->findAllByAttributes(array('name'=>$data['name']));
        if($findName != null)
        {
            $response['success'] = true;
            $response['errors'] = $model->errors;
            $response['EmployeeType'] = $model;
        }
        elseif($model->save() == true)
        {
            $response['success'] = false;
            $response['errors'] = $model->errors;
        }
        else
        {
            $response['success'] = true;
            $response['errors'] = $model->errors;
            $response['EmployeeType'] = $model;
        }


        header('Content-type: application/json');

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
        $post = file_get_contents('php://input');

        $data = CJSON::decode($post, true);

        $model = EmployeeType::model()->findByPk($data['id']);
        $model->attributes = $data;
        $model->updated = new CDbExpression('NOW()');

        $response = array();

        if($model->save() == true)
        {
            $response['success'] = false;
            $response['errors'] = $model->errors;
            $response['EmployeeType'] = $model;
        }
        else
        {
            $response['success'] = true;
            $response['errors'] = $model->errors;
            $response['EmployeeType'] = $model;
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

	public function actionDeleteEmployeeType(){
		$post = file_get_contents('php://input');

        $data = CJSON::decode($post,true);

        $employeeType=EmployeeType::model()->findByPk($data['id']); // assuming there is a post whose ID is 10
		$employeeType->delete();
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('EmployeeType');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new EmployeeType('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EmployeeType']))
			$model->attributes=$_GET['EmployeeType'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return EmployeeType the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=EmployeeType::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param EmployeeType $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='employee-type-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
