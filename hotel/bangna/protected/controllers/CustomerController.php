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
				'actions'=>array('index','view', 'ViewCustomerList', 'ValidateName'),
//				'users'=>array('*'),
                'expression'=>"Yii::app()->user->name !== 'Guest' ",
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'UpdateDeposit'),
                'expression'=>"Yii::app()->user->name !== 'Guest' ",
			),
            array(
                'allow',
                'actions'=>array('SetCreate', 'SetUpdate', 'CustomerFilterName'),
                'expression'=>"Yii::app()->user->name !== 'Guest' ",
            ),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'DeleteCustomer'),
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


	public function actionValidateName(){
        $put = file_get_contents('php://input');
        $data = CJSON::decode($put, true);

        //echo $data['firstName'];
        $sql = "SELECT id FROM customer WHERE first_name = '{$data['first_name']}' and last_name ='{$data['last_name']}' ";

        $models = Yii::app()->db->createCommand($sql)->queryRow();
        header('Content-type: application/json');
        echo CJSON::encode($models);

        Yii::app()->end();
    }

	 public function actionViewCustomerList(){
        $get = file_get_contents('php://input');
        $data = CJSON::decode($get);

        $sql = "select c.id, c.initial, c.first_name, c.last_name, c.address,p.province, d.district, a.area, c.postal_code, c.home_phone, c.mobile_phone, c.remark,c.deposit, c.created,(select e.username from employee e where e.id=c.created_by) as created_by,c.updated, (select e.username from employee e where e.id=c.updated_by) as updated_by from customer c left join province p on c.province_id = p.id left join district d on c.district_id = d.id left join area a on c.area_id = a.id";

        $models = Yii::app()->db->createCommand($sql)->queryALL();
        header('Content-type: application/json');
        echo CJSON::encode($models);

        Yii::app()->end();
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
	public function actionCreate(){
		$this->renderPartial('create');
	}

	public function actionUpdateDeposit(){
        $put = file_get_contents('php://input');
        $data = CJSON::decode($put, true);

        $model = Customer::model()->findByPk($data['id']);
        $model->updated      = new CDbExpression("NOW()");
        $model->updated_by   = $data['updated_by'];
        $model->deposit      = $this->calDeposit($data['id'], $data['deposit'], $data['type']);

        $response = array();

        if($model->save() == true){
            $response['success'] = true;
            $response['Customer'] = $model;
        }else{
            $response['success'] = false;
            $response['error'] = $model->errors;
        }

        header('Content-Type: application/json');
        echo CJSON::encode($response);
        Yii::app()->end();
    }

    /**
     * @return null|string
     */
    private function calDeposit($id, $depositUpdate, $type){
    	if($type == 3 || $type ==6 || $type == 7){
    		$sql  = "SELECT deposit FROM customer WHERE id = $id";
	        $query = Yii::app()->db->createCommand($sql)->queryRow();
	        $result = $depositUpdate;

	        if($query['deposit'] != ""){
	            $result =  $query['deposit'] + $depositUpdate;
	        }
	        return $result;
    	}else{
    		return $depositUpdate;
    	}
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

	public function actionDeleteCustomer(){
		$post = file_get_contents('php://input');

        $data = CJSON::decode($post,true);

        $customer=Customer::model()->findByPk($data['id']); // assuming there is a post whose ID is 10
		$customer->delete();
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
