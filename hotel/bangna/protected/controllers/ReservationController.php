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
				'actions'=>array('index','view', 'ViewReservationByStartDate', 'payment', 'CountStatusRoom', 'RoomCheckout', 'ValidateDateRoomReservedOrCheckin'),
//				'users'=>array('*'),
                'expression'=>"Yii::app()->user->name !== 'Guest' ",
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'CheckIn', 'CheckOut', 'SetBooking', "SetCheckOut", "UpdateReservation"),
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

    public function actionCountStatusRoom(){
        $get = file_get_contents('php://input');
        $data = CJSON::decode($get);

        $sql = "select sum(status_1) as closeRoom, sum(status_2) as emptyRoom,sum(status_3) as checkinRoom,sum(status_4) as reservationRoom from (
                SELECT
                (case when tb2.status = 'restore' then 1 else 0 end) as status_1
                , (case when tb2.status = 'cancelled' or tb2.status = 'checkout' or tb2.status='empty' then 1 else 0 end) as status_2
                , (case when tb2.status = 'reserved' then 1 else 0 end) as status_3
                , (case when tb2.status = 'checkin' then 1 else 0 end) as status_4
                , tb2.room_id
                , tb2.name
                from(
                select * from (select rs.status, rs.room_id, r.name FROM room r left join reservation rs on r.id=rs.room_id
                WHERE r.branch_id={$data['branch_id']} and r.building_id = {$data['building_id']}  and r.floor_id={$data['floor_id']} and str_to_date('{$data['startDate']}', '%Y-%m-%d') BETWEEN rs.start and rs.end and r.active <> ''
                order by rs.room_id asc, rs.created desc) tb1
                union all
                select 'restore' as status, r.id as room_id, r.name FROM room r left join reservation rs on r.id=rs.room_id
                WHERE r.branch_id={$data['branch_id']} and r.building_id = {$data['building_id']} and r.floor_id={$data['floor_id']}  and r.active = ''
                union all
                select 'empty' as status, r.id as room_id, r.name FROM room r where r.branch_id={$data['branch_id']} and r.building_id = {$data['building_id']} and r.active <> '' and r.floor_id={$data['floor_id']} and r.id not in (select rs.room_id from reservation rs where str_to_date('{$data['startDate']}', '%Y-%m-%d') BETWEEN rs.start and rs.end)) tb2
                group by tb2.room_id
                ) as tb3";

        $models = Yii::app()->db->createCommand($sql)->queryRow();
        header('Content-type: application/json');
        echo CJSON::encode($models);

        Yii::app()->end();
    }

    public function actionRoomCheckout(){
        $get = file_get_contents('php://input');
        $data = CJSON::decode($get);

        $sql  = "SELECT r.id,r.room_id,r.status,r.start,r.end,r.payee,r.created,r.updated,
                        (select e.username from employee e where e.id=r.created_by) as created_by,
                        (select e.username from employee e where e.id=r.updated_by) as updated_by,
                        b.name AS 'branch_name',
                        bu.name AS 'building_name',
                        f.name AS 'floor_name',
                        room.name AS 'room_name',
                        c.initial, c.first_name, c.last_name ";
                $sql .= "FROM reservation AS r ";
                $sql .= "INNER JOIN branch AS b ON b.id = r.branch_id ";
                $sql .= "INNER JOIN building AS bu ON bu.id = r.building_id ";
                $sql .= "INNER JOIN floor AS f ON f.id = r.floor_id ";
                $sql .= "INNER JOIN room AS room ON room.id = r.room_id ";
                $sql .= "INNER JOIN customer AS c ON c.id = r.customer_id ";
                $sql .= "WHERE r.branch_id = {$data['branch_id']} and r.status = 'checkin' order by r.end asc";

        $models = Yii::app()->db->createCommand($sql)->queryALL();
        header('Content-type: application/json');
        echo CJSON::encode($models);

        Yii::app()->end();
    }


    public function actionViewReservationByStartDate(){
        $get = file_get_contents('php://input');
        $data = CJSON::decode($get);

        $sql = "SELECT id,room_id,customer_id,status,paid_status,start,end FROM `reservation` where str_to_date('{$data['startDate']}', '%Y-%m-%d') BETWEEN start and end and status not in ('checkout', 'cancelled') order by end desc";

        $models = Yii::app()->db->createCommand($sql)->queryALL();
        header('Content-type: application/json');
        echo CJSON::encode($models);

        Yii::app()->end();
    }

    public function actionValidateDateRoomReservedOrCheckin(){
        $get = file_get_contents('php://input');
        $data = CJSON::decode($get);

        $sql = "SELECT id,room_id,customer_id,status,paid_status,start,end FROM `reservation` where room_id ={$data['roomId']} and (start between str_to_date('{$data['startDate']}', '%Y-%m-%d') and str_to_date('{$data['endDate']}', '%Y-%m-%d') and end between str_to_date('{$data['startDate']}', '%Y-%m-%d') and str_to_date('{$data['endDate']}', '%Y-%m-%d')) and status not in ('checkout', 'cancelled') group by status order by end desc";

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

    public function actionUpdateReservation(){
        $put = file_get_contents('php://input');

        $data = CJSON::decode($put, true);

        $model = Reservation::model()->findByPk($data['id']);

        $model->reciept_no   = $this->loadLastRecieptNo($data['paid_status']);
        $model->updated      = (strtolower($data['paid_status']) === "yes")? new CDbExpression("NOW()") : null;
        $model->updated_by   = $data['updated_by'];
        $model->status       = $data['status'];
        $model->payee        = $data['payee'];
        $model->paid_status  = $data['paid_status'];
        $model->paid         = (strtolower($data['paid_status']) === "yes")? new CDbExpression("NOW()") : null;
        $model->deposit_with_me  = $data['deposit_with_me'];

        if($data['type'] == 5){
            $model->building_id      = $data['building_id'];
            $model->floor_id         = $data['floor_id'];
            $model->room_id          = $data['room_id'];
            $model->price            = $data['price'];
            $model->deposit          = $data['deposit'];
            $model->used_deposit_old = $data['used_deposit_old'];
            $model->amount           = $data['amount'];
        }

        $response = array();

        if($model->save() == true){
            $response['success'] = true;
            $response['models'] = $model;
        }else{
            $response['success'] = false;
            $response['error'] = $model->errors;
        }

        header('Content-Type: application/json');

        echo CJSON::encode($response);

        Yii::app()->end();
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
            $model->description = $data['description'];
        }

        $model->reciept_no = $this->loadLastRecieptNo($data['paid_status']);
        $model->paid = (strtolower($data['paid_status']) === "yes")? new CDbExpression("NOW()") : null;
        if($model->save() == true){
            $response['status'] = true;

            $response['errors'] = $model->errors;

            $response['models'] = $model;
        } else{
            $response['status'] = false;

            $response['errors'] = $model->errors;

            $response['models'] = $model;
        }

        echo CJSON::encode($response);
        Yii::app()->end();
    }

    public function actionCheckOut()
    {
        $this->renderPartial('checkout');
    }

    public function actionSetCheckOut()
    {
        $post = file_get_contents('php://input');

        $data = CJSON::decode($post, true);

        $id = $data['id'];
        $status =  $data['status'];
        $reservation = Reservation::model()->findByPk($id);

        $response = array();

        if($status == "reserved")
        {
            $status = "cancel";
        }
        else if($status == "checkin")
        {
            $status = "checkout";
        }

        if($reservation != null){
            $reservationHistory = new ReservationHistory();
            $reservationHistory->attributes = $reservation->attributes;
            $reservationHistory->id = null;
            $reservationHistory->status = $status;
            $reservationHistory->updated = new CDbExpression('NOW()');
            $reservationHistory->updated_by = Yii::app()->user->id;

            if($reservationHistory->save() == true){
                $response['status'] = false;
                $response['error'] = $reservationHistory->errors;

            }
            else{
                $response['status'] = false;
                $response['error'] = $reservationHistory->errors;
                $response['model'] = $reservationHistory;
            }

            $reservation->deleteByPk($reservation->id);

        }

        echo CJSON::encode($response);

        Yii::app()->end();
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

    public function actionPayment()
    {
        $dataProvider=new CActiveDataProvider('Reservation');
        $this->render('payment',array(
            'dataProvider'=>$dataProvider,
        ));
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

        $sql    = "SELECT max(r.reciept_no) as reciept_no ";
        $sql    .= " FROM reservation AS r ";
        $sql    .= " WHERE r.reciept_no LIKE '%DRC{$yearNow2DigiTh}%' ";

        $query = Yii::app()->db->createCommand($sql)->queryRow();

        $newNo = null;

        if(strtolower($paid_status)=="yes"){
            if($query['reciept_no'] != ""){

                $defaultCodeRunning= "00000";

                $arr = explode('-', $query['reciept_no']);
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

}
