<?php

class EmployeeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: _index.php?r=site/page&view=FileName
            'page'=>array(
                'class'=>'CViewAction',
            ),
        );
    }


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
                'expression'=>"Yii::app()->user->role !== '' ",
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'SetCreate'),
//				'users'=>array('*'),
                'expression'=>"Yii::app()->user->role !== '' ",
			),

			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('ChangePassword', 'CPassword', 'SetChnagePassword',
                                'UpdateProfile', 'UpProfile', 'SetUpdateProfile'),
                'expression'=>"Yii::app()->user->role !== '' ",
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
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        $error = Yii::app()->errorHandler->error;

        if( $error )
        {
            $this -> render( 'error', array( 'error' => $error ) );
        }
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


        $model = new Employee;

        $model->attributes = $data;

        if(isset($data['password'])){
            $model->password = md5($data['password']);
        }

        $model->created = new CDbExpression('NOW()');


        $response = array();

        $findByAttribuesId = Employee::model()->findByAttributes(array('username'=>$model->username));
        if($findByAttribuesId != null){
            $response['Employee'] = $findByAttribuesId;

            $response['success'] = true;

            $response['errors'] = $model->errors;
        }
        elseif($model->save() == true)
        {

            $response['success'] = false;

            $response['errors'] = $model->errors;

            $response['Employee'] = $model->id;



        }else{
            $response['success'] = true;

            $response['errors'] = $model->errors;

            $response['Employee'] = $model;
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


        $model = Employee::model()->findByPk($data['id']);
        $model->attributes = $data;

        /*$model->username          = $data['username'];
        $model->email             = $data['email'];
        $model->initial           = $data['initial'];
        $model->first_name        = $data['first_name'];
        $model->last_name         = $data['last_name'];
        $model->gender            = $data['gender'];
        $model->marital_status    = $data['marital_status'];
        $model->address           = $data['address'];
        $model->province_id       = $data['province_id'];
        $model->home_phone        = $data['home_phone'];
        $model->work_phone        = $data['work_phone'];
        $model->mobile_phone      = $data['mobile_phone'];*/
        $model->updated = new CDbExpression('NOW()');

        $response = array();

        if($model->save() == true){


            $response['success'] = false;

            $response['error'] = $model->errors;
        }
        else{
            $response['success'] = true;

            $response['error'] = $model->errors;

            $response['Employee'] = $model;
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

		$this->render('index');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Employee('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Employee']))
			$model->attributes=$_GET['Employee'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


    /**
     * Chnage Password
    */
    public function actionChangePassword()
    {
        Yii::app()->theme = "backend_homepage";

        $this->renderPartial('changepassword');
    }

    public function actionCPassword()
    {

        $this->renderPartial('changepassword');
    }

    public function actionSetChnagePassword()
    {
        $post = file_get_contents('php://input');

        $data = CJSON::decode($post, true);

        /**
         * Decode "MD5"
        */
        $password = md5($data['password']);

        /**
         * Select PK by id
        */
        $model = Employee::model()->findByPk($data['id']);


        // Array
        $response = array();

            $model->password = $password;

            if($model->save() == true){
                $response['success'] = false;

                $response['errors'] = $model->errors;
            }
            else{
                $response['success'] = true;

                $response['Employee'] = $model;
            }

        header('Content-type: application/json');

        echo CJSON::encode($response);

        Yii::app()->end();
    }

    /**
     * Update Profile
    */
    public function actionUpdateProfile()
    {
        Yii::app()->theme = "backend_homepage";

        $this->renderPartial('updateprofile');
    }

    public function actionUpProfile()
    {

        $this->renderPartial('updateprofile');
    }

    public function actionSetUpdateProfile()
    {
        $put = file_get_contents('php://input');

        $data = CJSON::decode($put, true);


        $model = Employee::model()->findByPk($data['id']);
        $model->attributes = $data;

        /*$model->username          = $data['username'];
        $model->email             = $data['email'];
        $model->initial           = $data['initial'];
        $model->first_name        = $data['first_name'];
        $model->last_name         = $data['last_name'];
        $model->gender            = $data['gender'];
        $model->marital_status    = $data['marital_status'];
        $model->address           = $data['address'];
        $model->province_id       = $data['province_id'];
        $model->home_phone        = $data['home_phone'];
        $model->work_phone        = $data['work_phone'];
        $model->mobile_phone      = $data['mobile_phone'];*/
        $model->updated = new CDbExpression('NOW()');

        $response = array();

        if($model->save() == true){
            Yii::app()->user->name = $model->username;

            $response['success'] = false;

            $response['error'] = $model->errors;
        }
        else{
            $response['success'] = true;

            $response['error'] = $model->errors;

            $response['Employee'] = $model;
        }

        header('Content-type: application/json');

        echo CJSON::encode($response);

        Yii::app()->end();
    }



	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Employee the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Employee::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Employee $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='employee-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
