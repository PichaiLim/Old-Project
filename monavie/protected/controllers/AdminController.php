<?php
@ob_start(); 
@session_start();
?>
<?php

class AdminController extends Controller {

    public function actionIndex() {
        Yii::app()->theme = "backend";

        $this->redirect(array('login'));
    }

    public function actionLogin() {
        Yii::app()->theme = "backend";

        if (isset(Yii::app()->session['id'])) {
            $this->redirect(array('home'));
        }

        $model = new Member('Add');

        if (isset($_POST['ajax']) && $_POST === 'login-form') {
            echo CActiveForm::validate();
            Yii::app()->end;
        }

        if (!empty($_POST['Member'])) {
            $attributes = array();
            $attributes['username'] = $_POST['Member']['username'];
            $attributes['password'] = md5($_POST['Member']['password']);

            $model = Member::model()->findByAttributes($attributes);

            if (!empty($model)) {
                
                Yii::app()->session['id'] = $model->id;
                Yii::app()->session['username'] = $model->username;
                Yii::app()->session['status'] = $model->status;

                if (Yii::app()->session['status'] == "admin") {
                    $this->redirect(array('home'));
                } else {
                    $this->redirect(array('login'));
                }
                
            } else {
                $this->redirect(array('login'));
            }
        }

        $this->render('login', array(
            'model' => $model,
        ));
    }

    public function actionLogout() {
        Yii::app()->theme = "backend";
        
        if (isset(Yii::app()->session['id'])) {
            Yii::app()->session->destroy();
        }
        
        $this->redirect(array('login'));
    }

    public function actionHome() {
        Yii::app()->theme = "backend";

        $this->layout = "column2";

        $this->render('home');
    }

}

?>
