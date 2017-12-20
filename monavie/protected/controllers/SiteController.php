<?php

@ob_start();
@session_start();
?>
<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {

//        return array(
//            // captcha action renders the CAPTCHA image displayed on the contact page
//            'captcha' => array(
//                'class' => 'CCaptchaAction',
//                'backColor' => 0xFFFFFF,
//            ),
//            // page action renders "static" pages stored under 'protected/views/site/pages'
//            // They can be accessed via: index.php?r=site/page&view=FileName
//            'page' => array(
//                'class' => 'CViewAction',
//            ),
//        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex($user = NULL) {
        if (isset($_GET['user'])) {
            $user = $_GET['user'];

            $criteria = new CDbCriteria();
            $criteria->condition = "username = '{$user}'";
            $modelUser = Member::model()->find($criteria);

            if ($modelUser !== NULL) {
                $cookieDay = time() + 60 * 60 * 24;
                Yii::app()->request->cookies['id'] = new CHttpCookie('id', $modelUser->id, array('expire' => $cookieDay));
                Yii::app()->request->cookies['username'] = new CHttpCookie('username', $modelUser->username, array('expire' => $cookieDay));
                Yii::app()->request->cookies['name'] = new CHttpCookie('name', $modelUser->name, array('expire' => $cookieDay));
                Yii::app()->request->cookies['lastname'] = new CHttpCookie('lastname', $modelUser->lastname, array('expire' => $cookieDay));
                Yii::app()->request->cookies['tel'] = new CHttpCookie('tel', $modelUser->tel, array('expire' => $cookieDay));
                Yii::app()->request->cookies['email'] = new CHttpCookie('email', $modelUser->email, array('expire' => $cookieDay));
                Yii::app()->request->cookies['image'] = new CHttpCookie('image', $modelUser->image_profile, array('expire' => $cookieDay));
            }
        }
        // Create Model Member
        $model = new Member("Register");
        if (!isset(Yii::app()->request->cookies['id'])) {
            $criteria = new CDbCriteria();
            $criteria->select = '`id`,`username`,`email`,`name`,`lastname`,`tel`,`mobile`,`image_profile`';
            $criteria->order = 'RAND()';
            $criteria->limit = "1";
            $modelRandom = Member::model()->find($criteria);
            // Setting Time Cookie
            $cookieDay = time() + 60 * 60 * 24;

//            Yii::app()->request->cookies['id'] = new CHttpCookie('id', md5($modelRandom->id), array('expire' => $cookieDay));
            Yii::app()->request->cookies['username'] = new CHttpCookie('username', $modelRandom->username, array('expire' => $cookieDay));
            Yii::app()->request->cookies['name'] = new CHttpCookie('name', $modelRandom->name, array('expire' => $cookieDay));
            Yii::app()->request->cookies['lastname'] = new CHttpCookie('lastname', $modelRandom->lastname, array('expire' => $cookieDay));
            Yii::app()->request->cookies['tel'] = new CHttpCookie('tel', $modelRandom->tel, array('expire' => $cookieDay));
            Yii::app()->request->cookies['email'] = new CHttpCookie('email', $modelRandom->email, array('expire' => $cookieDay));
            Yii::app()->request->cookies['image'] = new CHttpCookie('image', $modelRandom->image_profile, array('expire' => $cookieDay));
        }

        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionContactUs() {
        // Setting Layout
        $this->layout = 'column3';

        // Setting Title & Header
        $title_header = 'ติดต่อเรา';

        $to = NULL;

        if (empty(Yii::app()->request->cookies['email'])) {
            $criteria = new CDbCriteria();
            $criteria->select = '`email`';
            $criteria->order = 'RAND()';
            $criteria->limit = "1";
            $modelRandom = Member::model()->find($criteria);
            $to = $modelRandom->email;
        } else {
            $to = Yii::app()->request->cookies['email'];
        }

        // Check Value $_POST Not NULL
        if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['tel']) && !empty($_POST['textmessage'])
        ) {
            // Setting Message Send Email
            $message = '<div style="border: 1px inset #000; padding: 10px;">';
            $message .= "<h1><center>{$title_header}</center></h1>";
            $message .= "<hr/>";
            $message .="<p>";
            $message .= "ผู้ติดต่อ : คุณ";
            $message .= $_POST['name'];
            $message .="</p>";
            $message .="<p>";
            $message .= "E-mail : ";
            $message .= $_POST['email'];
            $message .="</p>";
            $message .="<p>";
            $message .= "เบอร์โทรศัพท์ : ";
            $message .= $_POST['tel'];
            $message .="</p>";
            $message .="<p>";
            $message .="ข้อมความ : ";
            $message .=$_POST['textmessage'];
            $message .="</p>";
            $message .= "</div>";

            // Send Email
            $email = Yii::app()->email;
            $email->from = $_POST['email'];
            $email->to = $to;
            $email->subject = $title_header;
            $email->message = $_POST['textmessage'];
            $email->send();

            // Redirect Page
            $this->redirect(array('//site/ContactUs'));
        }

        // Render Page
        $this->render('//site/pages/about', array('title_header' => $title_header));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        // Create Model
        $model = new Member();

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate();
            Yii::app()->end;
        }

        // collect user input data
        if (isset($_POST['Member'])) {

            $attributes = array();
            $attributes['username'] = $_POST['Member']['username'];
            $attributes['password'] = md5($_POST['Member']['password']);

            $model = Member::model()->findByAttributes($attributes);

            // check value $model
            if (!empty($model)) {
                // Setting Time Cookie
                $cookieNULL = NULL;
                $cookieMinute = time() + 60;
                $cookieHour = time() + 60 * 60;
                $cookieDay = time() + 60 * 60 * 24;
                $cookieWeek = time() + 60 * 60 * 180;
                $cookieMonth = time() + 60 * 60 * 24 * 30;
                $cookieYear = time() + 60 * 60 * 24 * 180 * 12;

                /*
                 * How To Use Cookie
                 * Yii::app()->request->cookies['name'] = new CHttpCookie($name, $value, $attributes => array());
                 * expire => Time
                 * ------------------------------------------------
                 * Cookid Value Member
                 * cookies['id']    =>  id;
                 * cookies['username']  => username;
                 * cookies['status']    => status;
                 */
                Yii::app()->request->cookies['log'] = new CHttpCookie('log', 'log');
                Yii::app()->request->cookies['id'] = new CHttpCookie('id', md5($model->id), array('expire' => $cookieYear));
                Yii::app()->request->cookies['username'] = new CHttpCookie('username', $model->username, array('expire' => $cookieYear));
                Yii::app()->request->cookies['status'] = new CHttpCookie('status', $model->status, array('expire' => $cookieYear));

                /*
                 * Cookie Value Member
                 * cookies['name']  =>  Name;
                 * cookies['lastname']  =>  Lastname;
                 * cookies['tel']   => Tel;
                 * cookies['email'] =>  Email;
                 * cookies['image'] => Image;
                 */
                Yii::app()->request->cookies['name'] = new CHttpCookie('name', $model->name, array('expire' => $cookieYear));
                Yii::app()->request->cookies['lastname'] = new CHttpCookie('lastname', $model->lastname, array('expire' => $cookieYear));
                Yii::app()->request->cookies['tel'] = new CHttpCookie('tel', $model->tel, array('expire' => $cookieYear));
                Yii::app()->request->cookies['email'] = new CHttpCookie('email', $model->email, array('expire' => $cookieYear));
                Yii::app()->request->cookies['image'] = new CHttpCookie('image', $model->image_profile, array('expire' => $cookieYear));


                // redirect page index.php
                $this->redirect(array('//site/index'));
            } else {
                // redirect page index.php
                $this->redirect(array('//site/login'));
            }
        }

        if (!empty(Yii::app()->request->cookies['id'])) {
            $this->redirect(array('//site/index'));
        }

        // render login.php
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->request->cookies->clear();

        $this->redirect(array('index'));
    }

    public function actionProduct() {
        $this->layout = 'column2';
        $this->render('../product/product');
    }

}

?>