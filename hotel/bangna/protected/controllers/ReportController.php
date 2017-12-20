<?php

class ReportController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('daily', 'summaryDaily', 'reportDaily', 'reportSummaryDaily'),
//				'users'=>array('*'),
                'expression'=>"Yii::app()->user->name !== 'Guest' ",
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionReportDaily(){
        $get = file_get_contents('php://input');
        $data = CJSON::decode($get);

        $sql  = "SELECT r.id,r.room_id,r.reciept_no ,r.status,r.start,r.end,r.payee,r.created,r.updated, r.deposit,r.amount, r.price , room.name AS 'room_name', c.initial, c.first_name, c.last_name FROM reservation AS r left JOIN room AS room ON room.id = r.room_id left JOIN customer AS c ON c.id = r.customer_id WHERE r.branch_id = {$data['branch_id']} and r.status = 'checkout' and r.reciept_no != '' ";
		if($data['startDate'] != "" && $data['endDate']){
			$sql .= " and (r.start BETWEEN str_to_date('{$data['startDate']}', '%Y-%m-%d') and str_to_date('{$data['endDate']}', '%Y-%m-%d'))  ";
		}
		$sql .= " order by r.end asc ";
        $models = Yii::app()->db->createCommand($sql)->queryALL();
        header('Content-type: application/json');
        echo CJSON::encode($models);

        Yii::app()->end();
    }

	public function actionReportSummaryDaily(){
        $get = file_get_contents('php://input');
        $data = CJSON::decode($get);

        $sql  = "SELECT r.start, count(r.room_id) as total_room, sum(r.deposit) as total_deposit, sum(r.amount) as total_amount, sum(r.price) as total_price 
				FROM reservation AS r WHERE r.branch_id = {$data['branch_id']} and r.status = 'checkout' and r.reciept_no != '' ";
		if($data['startDate'] != "" && $data['endDate']){
			$sql .= " and (r.start BETWEEN str_to_date('{$data['startDate']}', '%Y-%m-%d') and str_to_date('{$data['endDate']}', '%Y-%m-%d'))  ";
		}
		$sql .= " group by r.start order by r.start asc ";
        $models = Yii::app()->db->createCommand($sql)->queryALL();
        header('Content-type: application/json');
        echo CJSON::encode($models);

        Yii::app()->end();
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionDaily(){
        $this->render('daily');
	}

    public function actionSummaryDaily(){
        $this->render('summaryDaily');
	}

}
