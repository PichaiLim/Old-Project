<?php

class CustomerController extends Controller
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
				'actions'=>array('index','view'),
//				'users'=>array('*'),
                'expression'=>"Yii::app()->user->name !== 'Guest' ",
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
                'expression'=>"Yii::app()->user->name !== 'Guest' ",
			),
            array(
                'allow',
                'actions'=>array('SetCreate', 'SetUpdate', 'CustomerFilterName'),
                'expression'=>"Yii::app()->user->name !== 'Guest' ",
            ),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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

    public function actionCustomerFilterName()
    {
        $post = file_get_contents('php://input');

        $data = CJSON::decode($post,true);

        $sql = "SELECT c.id, c.first_name, c.last_name, c.deposit ";
        $sql .= "FROM customer AS c ";
        $sql .= "WHERE c.first_name LIKE '%{$data}%' ";
        $sql .= "LIMIT 5";

        $model = Yii::app()->db->createCommand($sql)->queryALL();

        echo  CJSON::encode($model);

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

        $model = new Customer;
        $model->attributes = $data;
        $model->created = new CDbExpression('NOW()');

        $response = array();

        if($model->save() == true)
        {
            $response['success'] = false;

            $response['errors'] = $model->errors;
        }
        else{
            $response['success'] = true;

            $response['errors'] = $model->errors;

            $response['Customer'] = $model;
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
        $put = file_get_contents('php://input');

        $data = CJSON::decode($put, true);

        $model = Customer::model()->findByPk($data['id']);
        $model->attributes = $data;
        $model->updated = new CDbExpression('NOW()');

        $response = array();

        if($model->save() == true)
        {
            $response['success'] = false;

            $response['errors'] = $model->errors;
        }
        else{
            $response['success'] = true;

            $response['errors'] = $model->errors;

            $response['Customer'] = $model;
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

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Customer');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Customer('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Customer']))
			$model->attributes=$_GET['Customer'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Customer the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Customer::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Customer $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='customer-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
