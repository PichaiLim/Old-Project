<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: _index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

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
                'actions'=>array('index', 'logout', 'branches'),
                'expression'=>"Yii::app()->user->name !== 'Guest' ",
            ),
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('login'),
                'users'=>array('*'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        Yii::app()->theme = "backend_homepage";
		// renders the view file 'protected/views/site/_index.php'
		// using the default layout 'protected/views/layouts/main.php'
        @session_destroy($_SESSION['branch']);

        $dataProvider=new CActiveDataProvider('Branch', array(
            'criteria' => array(
                'order'=> 'id ASC'
            ),
        ));

        $employee_branch = EmployeeBranch::model()->findAllByAttributes(array('employee_id'=>Yii::app()->user->id));
        $count_branch = count($employee_branch);

        if($count_branch === 1){
            $this->redirect(array('Branch/Index', 'id'=>$employee_branch[0]['branch_id']));
        }elseif($count_branch === 0 && Yii::app()->user->role === ''){
            Yii::app()->params['count_branch'] = $count_branch;
            Yii::app()->params['show_branch'] = 0;
        }

        if(empty($dataProvider) == true)
        {
            $this->redirect(array('Branch/Create'));
        }

        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

    public function actionBranches($id = 0)
    {
        $this->render('branches', array($id=>$id));
    }

	/**
	 * Displays the back_login page
	 */
	public function actionLogin()
	{
        Yii::app()->theme = "back_login";

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='back_login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the back_login form
		$this->render('login',array('model'=>$model));
	}

    public function actionChangePassword($id)
    {
        echo "Change Password";

        Yii::app()->end();
    }

	/**
	 * Logs out the current user and redirect to backend_homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
        @session_destroy($_SESSION['branch']);
		$this->redirect(Yii::app()->homeUrl);
	}
}