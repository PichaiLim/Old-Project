<?php

class ReservationController extends Controller
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
				'actions'=>array('create','update', 'CheckIn', 'CheckOut', 'SetBooking'),
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
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
        $this->render('view');
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Reservation;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Reservation']))
		{
			$model->attributes=$_POST['Reservation'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Reservation']))
		{
			$model->attributes=$_POST['Reservation'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

    public function actionCheckIn()
    {
        $this->renderPartial('checkin');
    }

    public function actionSetBooking()
    {
        $post = file_get_contents('php://input');
        $data = CJSON::decode($post, true);

        $status = strtolower($data['status']);

        $response = array();


        if(!empty($data['id']) == true)
        {
            $model = Reservation::model()->findByPk($data['id']);
        }else{
            $model  = new Reservation();
            $model->attributes = $data;
            $model->created = new CDbExpression('NOW()');
        }

        if($status === "checkin"){

            /*$model->attributes = $data;
            $model->created = new CDbExpression('NOW()');*/
            $model->reciept_no = $this->loadLastRecieptNo($data['paid_status']);
            $model->payee = $this->payeeIdStatus($data['status'], $data['payee']);
            $model->paid = (strtolower($data['paid_status']) === "yes")? new CDbExpression("NOW()") : null;
            if($model->save() == true)
            {
                $response['status'] = false;

                $response['errors'] = $model->errors;

                $response['models'] = $model;
            }
            else
            {
                $response['status'] = true;

                $response['errors'] = $model->errors;

                $response['models'] = $model;
            }

        }

        echo CJSON::encode($response);
        Yii::app()->end();
    }

    public function actionCheckOut()
    {
        $this->renderPartial('checkout');
    }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        Yii::app()->theme = "reservation";

        if(empty($_REQUEST['id']) == true){
            Yii::app()->request->redirect(Yii::app()->user->returnUrl);
        }

		$this->render('index');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Reservation('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Reservation']))
			$model->attributes=$_GET['Reservation'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Reservation the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Reservation::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Reservation $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='reservation-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


    /**
     * @return null|string
     */
    private function loadLastRecieptNo($paid_status = "no")
    {
        $yearNow2DigiTh = substr(date('Y')+543, 2, 2);

        $sql    = "SELECT r.id , r.reciept_no ";
        $sql    .= "FROM reservation AS r ";
        $sql    .= "WHERE r.reciept_no LIKE '%DRC{$yearNow2DigiTh}%' ";
        $sql    .= "ORDER BY r.reciept_no ";
        $sql    .= "LIMIT 1";

        $query = Yii::app()->db->createCommand($sql)->queryALL();

        $newNo = null;


        if(strtolower($paid_status)=="yes"){
            if($query != null){

                $defaultCodeRunning= "00000";

                $arr = explode('-', $query[0]['reciept_no']);
                $defaultCode = $arr[0].'-';
                $newRunningNumber = intval($arr[1])+1;
                $lenghRunningNumber = strlen($newRunningNumber);


                switch ($lenghRunningNumber)
                {
                    case 1:
                        $newNo = $defaultCode.$defaultCodeRunning.$newRunningNumber;
                        break;
                    case 2:
                        $newNo = $defaultCode.substr($defaultCodeRunning,0,4).$newRunningNumber;
                        break;
                    case 3:
                        $newNo = $defaultCode.substr($defaultCodeRunning,0,3).$newRunningNumber;
                        break;
                    case 4:
                        $newNo = $defaultCode.substr($defaultCodeRunning,0,2).$newRunningNumber;
                        break;
                    case 5:
                        $newNo = $defaultCode.substr($defaultCodeRunning,0,1).$newRunningNumber;
                        break;
                    default:
                        $newNo = $defaultCode.substr($defaultCodeRunning,0,0).$newRunningNumber;
                        break;
                }

            }else{
                $newNo = "DRC".$yearNow2DigiTh.'-000001';
            }
        }

        return $newNo;
    }

    private function payeeIdStatus($status= "checkin", $payee)
    {

        return (strtolower($status) != "checkin")? null:$payee;
    }
}
