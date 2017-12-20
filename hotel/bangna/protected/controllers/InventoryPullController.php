<?php

class InventoryPullController extends Controller
{

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
                'actions'=>array('index','view', 'ViewLastInventoryPullRecieptNo'),
//				'users'=>array('*'),
                'expression'=>"Yii::app()->user->name !== 'Guest' ",
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update'),
//				'users'=>array('@'),
                'expression'=>"Yii::app()->user->name !== 'Guest' ",
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('SetCreate','SetUpdate'),
//				'users'=>array('@'),
                'expression'=>"Yii::app()->user->name !== 'Guest' ",
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete'),
//				'users'=>array('admin'),
                'expression'=>"Yii::app()->user->name !== 'Guest' ",
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionViewLastInventoryPullRecieptNo(){
        $get = file_get_contents('php://input');
        $data = CJSON::decode($get);
        $models = $this->getLastRecieptNo();
        header('Content-type: application/json');
        echo CJSON::encode($models);

        Yii::app()->end();
    }

    private function getLastRecieptNo(){
        $yearNow2DigiTh = substr(date('Y')+543, 2, 2);

        $sql    = "SELECT max(i.reciept_no) as reciept_no ";
        $sql    .= "FROM inventory_pull AS i ";
        $sql    .= " WHERE i.reciept_no LIKE '%PKG{$yearNow2DigiTh}%' ";

        $query = Yii::app()->db->createCommand($sql)->queryRow();

        $newNo = null;

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
            $newNo = "PKG".$yearNow2DigiTh.'-000001';
        }


        return $newNo;
    }


	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionCreate()
    {
        $this->renderPartial('create');
    }

    public function actionSetCreate()
    {
        $post = file_get_contents('php://input');

        $data = CJSON::decode($post, true);

        $model = new InventoryPull;
        $model->attributes = $data;
        // $model->reciept_no = $this->getLastRecieptNo();

        $response = array();

        if($model->save() == true){
            $response['success'] = true;
            $response['model'] = $model->reciept_no;

            for($i=0; $i < count($data['detail']); $i++){
                $modelDetail = new InventoryPullDetail;
                $modelDetail->inventory_pull_id = $model->reciept_no;
                $modelDetail->product_id= $data['detail'][$i]['product_id'];
                $modelDetail->quantity = $data['detail'][$i]['quantity'];
                if($modelDetail->save() == true){
                    $response['success-detail'] = true;
                    $response['model-detail'] = $modelDetail;
                }else{
                    $response['success-detail'] = true;
                    $response['errors-detail'] = $modelDetail->errors;
                    $response['model-detail'] = $modelDetail;
                }
            }

        }else{
            $response['success'] = false;
            $response['errors'] = $model->errors;
            $response['model'] = $model;
        }

        for($a=0; $a < count($data['detail']); $a++){
            $sql    = "SELECT * ";
            $sql    .= "FROM inventory AS i ";
            $sql    .= "WHERE product_id = {$data['detail'][$a]['product_id']} ";
            $sql    .= "AND branch_id = {$data['branch_id']}";

            $InventoryFindPK = Yii::app()->db->createCommand($sql)->queryALL();

            if($InventoryFindPK != null){
                $modelInventory = Inventory::model()->findByPk($InventoryFindPK[0]['id']);
                $modelInventory->pulled = new CDbExpression('NOW()');
                $modelInventory->pulled_by = $data['created_by'];
                $modelInventory->quantity -= $data['detail'][$a]['quantity'];

                if($modelInventory->save() == true){
                    $response['success-inventory-update'] = true;
                    $response['model-inventory-update']= $modelInventory;

                }else{
                    $response['success-inventory-update'] = false;
                    $response['errors-inventory-update'] = $modelInventory->errors;
                    $response['model-inventory-update'] = $modelInventory;
                }

            }
        }

        header('Content-type: application/json');
        echo CJSON::encode($response);


        Yii::app()->end();
    }
}