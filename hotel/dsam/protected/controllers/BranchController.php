<?php

class BranchController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
//	public $layout='//layouts/column2';

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
				'actions'=>array('index','view', 'list'),
//				'users'=>array('?'),
                'expression'=>"Yii::app()->user->name !== 'Guest' ",
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','SetCreate'),
//				'users'=>array('@'),
                'expression'=>"Yii::app()->user->name !== 'Guest' ",
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update', 'SetUpdate'),
//				'users'=>array('@'),
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
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('/site/error', $error);
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
		/*$model=new Branch;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Branch']))
		{
			$model->attributes=$_POST['Branch'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));*/
        $this->renderPartial('create');
	}

        public function actionSetCreate()
        {
            $post = file_get_contents('php://input');

            $data = CJSON::decode($post, true);

            $model = new Branch;
            $model->attributes = $data;
            $model->created = new CDbExpression('NOW()');



            $criteria = new CDbCriteria;
            $criteria->condition = 'name = :name';
            $criteria->params = array(':name'=>$data['name']);

            $names = Branch::model()->findAll($criteria);

            $response = array();
            if($names != null){

                $response['success'] = true;
                $response['errors'] = 'มีชื่อาคารซ้ำ';
                $response['Branch'] = $names;

            }else{
                if($model->save() == true){
                    $response['success'] = false;

                    $response['errors'] = $model->errors;
                }
                else
                {
                    $response['success'] = true;

                    $response['errors'] = $model->errors;

                    $response['Branch'] = $model;
                }
            }


            header('Control-type: application/json');

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

            $model = Branch::model()->findByPk($data['id']);
            $model->attributes = $data;
            $model->updated = new CDbExpression('Now()');


            $response = array();


            if($model->save() == true)
            {
                $response['success'] = false;

                $response['error'] = $model->errors;

            }
            else{

                $response['success'] = true;

                $response['error'] = $model->errors;

                $response['Branch'] = $model;

            }

            header('Control-type: application/json');

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
	public function actionIndex($id=0)
	{
        if(empty($id) || $id == 0)
        {
            $this->redirect(array('/Site/Index'));
        }

        $modelBranch = Branch::model()->findByAttributes(array('id'=>$id));

        if($modelBranch == null)
        {
            throw new CHttpException(404,'The specified post cannot be found.');
        }

        @$_SESSION['branch'] = $modelBranch['name'];


		$this->render('index', array('id'=>$modelBranch['id']));
	}


        public function actionList()
        {
            $this->render('list');
        }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Branch('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Branch']))
			$model->attributes=$_GET['Branch'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Branch the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Branch::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Branch $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='branch-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
