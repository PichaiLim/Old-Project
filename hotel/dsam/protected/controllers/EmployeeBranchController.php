<?php

class EmployeeBranchController extends Controller
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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('SetCreate', ' SetUpdate'),
//				'users'=>array('*'),
                'expression'=>"Yii::app()->user->name !== 'Guest' ",
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    /*
    public function actions()
    {
        // return external action classes, e.g.:
        return array(
            'action1'=>'path.to.ActionClass',
            'action2'=>array(
                'class'=>'path.to.AnotherActionClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }
    */

	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionGetFindAll()
    {

        Yii::app()->end();
    }

    public function actionSetCreate()
    {
        $post = file_get_contents('php://input');

        $data = CJSON::decode($post,true);

        $model = new EmployeeBranch;

        $model->attributes = $data;


        $response = array();

        if($model->save() === true)
        {
            $response['success'] = false;

            $response['errors'] = $model->errors;
        }
        else{
            $response['success'] = false;

            $response['errors'] = $model->errors;

            $response['employee_branch'] = $model;
        }

        header('Content-type: application/json');

        echo CJSON::encode($response);

        Yii::app()->end();
    }

    public function actionSetUpdate(){


        Yii::app()->end();
    }
}