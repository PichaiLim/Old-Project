<?php

class InventoryPushController extends Controller
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
                'actions'=>array('index','view'),
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


    public function actionIndex()
    {
        $this->render('index');
    }


    public function actionCreate()
    {

        $this->renderPartial('create');
    }

    /**
     *
     */
    public function actionSetCreate()
    {
        $post = file_get_contents('php://input');

        $data = CJSON::decode($post, true);

        $thisTime = new CDbExpression('NOW()');

        $model = new InventoryPush;
        $model->attributes = $data;
        $model->created = $thisTime;


        $response = array();

        if($model->save() == true){

            $response['success'] = false;

            $response['errors']['inventory_push'] = $model->errors;

            $response['model']['inventory_push'] = $model;

        }
        else{
            $response['success'] = true;

            $response['errors']['inventory_push'] = $model->errors;

            $response['model']['inventory_push'] = $model;
        }


        $sql    = "SELECT * ";
        $sql    .= "FROM inventory AS i ";
        $sql    .= "WHERE product_id = {$data['product_id']} ";
        $sql    .= "AND branch_id = {$data['branch_id']}";

        $InventoryFindPK = Yii::app()->db->createCommand($sql)->queryALL();

        if($InventoryFindPK != null){

            $modelInventory = Inventory::model()->findByPk($InventoryFindPK[0]['id']);
            $modelInventory->pushed_by = $data['created_by'];
            $modelInventory->pushed = $thisTime;
            $modelInventory->quantity += $data['quantity'];

            if($modelInventory->save() == true){

                $response['success'] = false;

                $response['errors']['inventory'] = $modelInventory->errors;

                $response['model']['inventory'] = $modelInventory;

            }else{
                $response['success'] = true;

                $response['errors']['inventory'] = $modelInventory->errors;

                $response['model']['inventory'] = $modelInventory;
            }

        }else{

            $newInventory = new Inventory;
            $newInventory->branch_id = $data['branch_id'];
            $newInventory->product_id = $data['product_id'];
            $newInventory->pushed = $thisTime;
            $newInventory->pushed_by = $data['created_by'];
            $newInventory->quantity = $data['quantity'];

            if($newInventory->save() == true){

                $response['success'] = false;

                $response['errors']['inventory'] = $newInventory->errors;

                $response['model']['inventory'] = $newInventory;

            }else{
                $response['success'] = true;

                $response['errors']['inventory'] = $newInventory->errors;

                $response['model']['inventory'] = $newInventory;
            }

        }

        header('Content-type: application/json');
        echo CJSON::encode($response);

        Yii::app()->end();

    }

}