<?php

class CompanyController extends Controller
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
				'actions'=>array('index','view', 'ViewCompany'),
//				'users'=>array('*'),
                'expression'=>"Yii::app()->user->name !== 'Guest' ",
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'UpdateCompany'),
                'expression'=>"Yii::app()->user->name !== 'Guest' ",
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'expression'=>"Yii::app()->user->name !== 'Guest' ",
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

	 public function actionViewCompany(){
        $get = file_get_contents('php://input');
        $data = CJSON::decode($get);

        $sql = "select * from company limit 1";

        $models = Yii::app()->db->createCommand($sql)->queryRow();
        header('Content-type: application/json');
        echo CJSON::encode($models);

        Yii::app()->end();
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate(){
		$this->renderPartial('create');
	}

	public function actionUpdateCompany(){
        $put = file_get_contents('php://input');
        $data = CJSON::decode($put, true);

        $model = Company::model()->findByPk(1);
        $model->name_th         = $data['name_th'];
        $model->name_en         = $data['name_en'];
        $model->address_th      = $data['address_th'];
        $model->address_en      = $data['address_en'];
        $model->tel             = $data['tel'];
        $model->fax             = $data['fax'];
        $model->updated_date    = new CDbExpression("NOW()");
        $model->updated_by      = $data['updated_by'];

        $response = array();

        if($model->save() == true){
            $response['success'] = true;
            $response['Company'] = $model;
        }else{
            $response['success'] = false;
            $response['error'] = $model->errors;
        }

        header('Content-Type: application/json');
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
		$dataProvider=new CActiveDataProvider('Company');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Company('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Company']))
			$model->attributes=$_GET['Company'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Company the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Company::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Company $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='company-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
