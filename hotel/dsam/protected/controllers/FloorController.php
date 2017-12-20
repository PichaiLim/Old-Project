<?php

class FloorController extends Controller
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
                'expression'=>"Yii::app()->user->name !== 'Guest' "
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'setcreate', 'setupdate'),
                'expression'=>"Yii::app()->user->name !== 'Guest' "
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        /*$model=new Floor;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Floor']))
        {
            $model->attributes=$_POST['Floor'];
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
        $post = file_get_contents("php://input");

        $data = CJSON::decode($post, true);

        $model = new Floor;

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

            $response['Floor'] = $model;
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
	public function actionUpdate($id)
	{
		/*$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Floor']))
		{
			$model->attributes=$_POST['Floor'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));*/
        $this->renderPartial('update');
	}

    public function actionSetUpdate()
    {
        $put = file_get_contents('php://input');

        $data = CJSON::decode($put, true);

        $model = Floor::model()->findByPk($data['id']);
        $model->branch_id   = $data['branch_id'];
        $model->building_id = $data['building_id'];
        $model->name        = $data['name'];
        $model->active      = $data['active'];
        $model->published   = $data['published'];
        $model->remark      = $data['remark'];
        $model->updated_by  = $data['updated_by'];
        $model->updated     = new CDbExpression('NOW()');
        $model->seo_title   = $data['seo_title'];
        $model->seo_description     = $data['seo_description'];
        $model->seo_keywords        = $data['seo_keywords'];

        $response = array();

        if($model->save() == true){
            $response['success'] = false;

            $response['errors'] = $model->errors;
        }
        else{
            $response['success'] = true;

            $response['Floor'] = $model;
        }

        header('Content-Type: application/json');

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
//		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		/*if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));*/
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Floor');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Floor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Floor']))
			$model->attributes=$_GET['Floor'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Floor the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Floor::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Floor $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='floor-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
