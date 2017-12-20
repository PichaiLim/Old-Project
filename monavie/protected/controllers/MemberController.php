<?php

ob_start();
session_start();

/*
 * Setting Layout & Theme
 *      # theme = 'backend'
 *      # layout = 'column2'
 * 
 * Function Class
 *      @Index, @Users, @UserAdd, @UserEdit, @UserDelete, @UserProfile
 * 
 * @public value $title_header
 */

class MemberController extends Controller {

    public function actionIndex() {
        // Ste Layout
        $this->layout = 'column2';

        // Set Themes
        Yii::app()->theme = "backend";

        $this->redirect(array('//admin/index'));
    }

    public function actionMemberRegister() {
        $model = new Member('Register');

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

        // Register
        if (isset($_POST['Member'])) {
            $model->_attributes = $_POST['Member'];
            $model->username = substr(md5(uniqid(rand(), true)), 16, 16);
            $model->password = md5(rand());
            $model->joindate = new CDbExpression('NOW()');


            if ($model->save()) {
                // Setting Message
                $message = "<h1><center> Register " . Yii::app()->name . "</center></h1>";
                $message .= "<h2>New Member</h2>";
                $message .= "Name : " . $model->name . '<br/>';
                $message .= "Lastname : " . $model->lastname . '<br/>';
                $message .= "Tel : " . $model->tel . '<br/>';
                $message .= "Email : " . $model->email . '<br/>';
                $message .= "<hr/>";
                $message .= "Username : " . $model->username . '<br/>';
                $message .= "Password : " . $model->password . '<br/>';

                // Send Email
                $email = Yii::app()->email;
                $email->from = $model->email;
                $email->to = $to;
                $email->subject = 'New Register Member You';
                $email->message = $message;
                $email->send();

                // Redirect home page index.php 
            }
            $this->redirect(array('//site/index'));
        }

        $this->render('//site/index', array('model' => $model));
    }

    public function actionUsers() {
        // Ste Layout
        $this->layout = 'column2';

        // Set Themes
        Yii::app()->theme = "backend";

        // Set Title & Header
        $title_header = "Usres All";

        // Create New Model Member
        $model = new Member();

        $criteria = new CDbCriteria();

        $allusers = new CActiveDataProvider($model, array('criteria' => $criteria));
        $allusers->pagination = array('pagesize' => 15);

        $this->render('//admin/users/allusers', array('title_header' => $title_header, 'alluser' => $allusers));
    }

    public function actionUserAdd() {
        // Ste Layout
        $this->layout = 'column2';

        // Set Themes
        Yii::app()->theme = "backend";

        // Set Title & Header
        $title_header = 'Add New User';

        // Create New Model Member
        $model = new Member("Add");

        // Check Value $_POST['Member']
        if (isset($_POST['Member'])) {

            $model->_attributes = $_POST['Member'];
            $model->password = md5($_POST['Member']['password']);
            $model->joindate = new CDbExpression('NOW()');
            $member_image = CUploadedFile::getInstance($model, 'image_profile');

            /*  Rename Image */
            $path_part = pathinfo($member_image);
            $path_fileType = '.' . strtolower($path_part['extension']);
            $path_fullName = substr(number_format(time() * rand(), 0, '', ''), 0, 14) . $path_fileType;

            $model->image_profile = $path_fullName;

            
            // Save
            if ($model->save()) {

                if (!$member_image->saveAs(Yii::getPathOfAlias('webroot') . '/images/members/' . $path_fullName)) {
                    echo 'Upload Error';
                    exit();
                }

                $this->redirect(array('Users'));
            }// End Save
        }// End Check Value $_POST['Member'];
        // Render userAdd.php
        $this->render('//admin/users/userAdd', array('model' => $model, 'title_header' => $title_header));
    }

    public function actionUserEdit($id = NULL) {
        // Seting Layout
        $this->layout = 'column2';

        // Setting Themes
        Yii::app()->theme = 'backend';

        // Setting Title & Header
        $title_header = 'Edit User';

        // Create Model
        $model = new Member('Update');

        if (!empty($_POST['Member'])) {

            $id = $_POST['Member']['id'];
            // check value $id
            if (!empty($id)) {
                // create model by PK
                $model = Member::model()->findByPk($id);
            }

            // image old
            $old_image = $model->image_profile;

            $model->_attributes = $_POST['Member'];
            $model->password = md5($_POST['Member']['password']);

            // upload file
            $new_image = CUploadedFile::getInstance($model, 'image_profile');

            // check value $new_image
            if (!empty($new_image)) {
                $path_part = pathinfo($new_image);
                $path_fullName = substr(number_format(time() * rand(), 0, '', ''), 0, 14) . '.' . strtolower($path_part['extension']);
                $model->image_profile = $path_fullName;
            }

            // Save value
            if ($model->save()) {

                // check value $new_iamge
                if (!empty($new_image)) {

                    // save and Upload image
                    if ($new_image->saveAs(Yii::getPathOfAlias('webroot') . '/images/members/' . $path_fullName)) {

                        // check file image
                        if (file_exists(Yii::getPathOfAlias('webroot') . '/images/members/' . $old_image)) {
                            // delete old image
                            unlink(Yii::getPathOfAlias('webroot') . '/images/members/' . $old_image);
                        }
                    } else {
                        echo "Upload Error";
                        exit();
                    }
                }
                // redirect users.php
                $this->redirect(array('Users'));
            }
        }

        // check value $id
        if (isset($id)) {
            // create model by pk
            $model = Member::model()->findByPk($id);
        }

        // render page userEdit.php
        $this->render('//admin/users/userEdit', array('title_header' => $title_header, 'model' => $model));
    }

    public function actionUserDelete($id = NULL) {
        $this->layout = 'column2';

        Yii::app()->theme = 'backend';

        if (isset($id)) {
            $model = Member::model()->findByPk($id);
            if (file_exists(Yii::getPathOfAlias('webroot') . '/images/members/' . $model->image_profile)) {
                unlink(Yii::getPathOfAlias('webroot') . '/images/members/' . $model->image_profile);
            }
            Member::model()->deleteByPk($model->id);
        }

        $this->redirect(array('Users'));
    }

    public function actionUserProfile() {
        // Ste Layout
        $this->layout = 'column2';

        // Set Themes
        Yii::app()->theme = "backend";

        // Set Title & Header
        $title_header = 'User Profile';

        // PK ID
        $pk = Yii::app()->session['id'];

        // Create Model Member Select PK
        $member = new Member("Add");
        $model = $member->model()->findByPk($pk);


        // Render Page User Profile
        // @value $model
        // @value $title_header
        $this->render('//admin/users/userProfile', array(
            'model' => $model,
            'title_header' => $title_header
        ));
    }

}

?>
