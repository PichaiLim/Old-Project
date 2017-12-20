<?php

@ob_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * @Attribute Status
 * #status = 0; (Not Post);
 * #status = 1; (Post);
 * 
 * @ Page & Post
 * @Attribute Post.id_page = Page.id
 *  # 1 => Product ---------------> (ผลิตภัณฑ์);
 *  # 2 => Why MonaVie -----------> (ทำไมต้องโมนาวี);
 *  # 3 => Why Team --------------> (ทำไมต้องทีม [2PM4You]);
 *  # 4 => Business Opportunities   (โอกาสทางธุรกิจ);
 *  # 5 => News and Event --------> (ข่าวสารกิจกรรม);
 *  # 6 => About Me --------------> (ติดต่อเรา);
 */

class PostsController extends Controller {

    public function actionIndex() {
        // Ste Layout
        $this->layout = 'column2';

        // Set Themes
        Yii::app()->theme = "backend";

        $this->redirect(array('//Posts/PostAll'));
    }

    // View All Post
    public function actionPostAll() {
        // Set Layout
        $this->layout = 'column2';

        // Set Themes
        Yii::app()->theme = "backend";

        // Set Title & Header
        $title_header = 'Post All';

        // Create New Model
        $model_post = new Post();
        
        $criteria = new CDbCriteria();
        $criteria->order = "`id` DESC";

        // Create DataProvider
        $model = new CActiveDataProvider($model_post, array('criteria'=>$criteria));
        $model->pagination = array('pagesize' => 15);

        $this->render('//admin/post/postAll', array('title_header' => $title_header, 'model' => $model));
    }

    // Add New Post
    public function actionPostAdd($id = NULL) {
        // Set Layout
        $this->layout = 'column2';

        // Set Themes
        Yii::app()->theme = 'backend';

        // Set Title & Header
        if (empty($id)) {
            $title_header = 'Add New Post';
        } else {
            $title_header = 'Edit Post';
        }


        // Create Model
        $model = new Post();

        if (!empty($_POST['Post'])) {
            /*
              $id = $_POST['Post']['id'];

              if (!empty($id)) {
              $model = Post::model()->findByPk($id);
              }

              $model->_attributes = $_POST['Post'];
              $model->date = new CDbExpression('NOW()');    //ปกติชื่อตารางจะไม่ซ้ำกับ attribute
              // Save
              if ($model->save()) {
              $this->redirect(array('//Posts/index'));
              }
             */
            $id = $_POST['Post']['id'];

            if (!empty($id)) {
                $model = Post::model()->findByPk($id);
            }
            $oldImage = $model->imageHeader;


            $model->_attributes = $_POST['Post'];
            $model->date = new CDbExpression('NOW()');

            if (!empty($_FILES['Post'])) {

                $newImage = CUploadedFile::getInstances($model, 'imageHeader');

                foreach ($newImage as $key => $value) {
                    $pathinfo = pathinfo($value);
                    $path_fileType = strtolower($pathinfo['extension']);
                    $path_fileName = substr(md5(number_format(time() * rand(), 0)), 0, 14) . '.' . $path_fileType;

                    $model->imageHeader = $path_fileName;

                    $value->saveAs(Yii::getPathOfAlias('webroot') . '/images/media/' . $path_fileName);
                    
                    if (file_exists(Yii::getPathOfAlias('webroot') . '/images/media/' . $oldImage)) {
                        @unlink(Yii::getPathOfAlias('webroot') . '/images/media/' . $oldImage);
                    }
                }
            }


            if ($model->save()) {
                $this->redirect(array('//Posts/index'));
            }
        }

        // Select Model PK = ID
        if (!empty($id)) {
            $model = Post::model()->findByPk($id);
        }

        $this->render('//admin/post/postAdd', array('title_header' => $title_header, 'model' => $model));
    }

    // Delete Post
    public function actionPostDelete($id = NULL) {
        if (!empty($id)) {
            Post::model()->deleteByPk($id);
        }
        $this->redirect(array('//Posts/PostAll'));
    }

    // View Page Product.php
    public function actionProduct() {
        // Setting Layout
        $this->layout = 'column2';

        // Create New Model
        $model = new Post();
        $model_page = Page::model()->findByPk("1");

        // Setting Title
        $title = $model_page->name;

        // Create Critria
        $criteria = new CDbCriteria();
        $criteria->condition = 'id_page = ' . $model_page->id;
        $criteria->params = array($model->status => '1');
        $criteria->order = '`id` DESC';

        // Create DataProvider
        // Select Attributes @Status = 1 and @id_page = 2
        $posts = new CActiveDataProvider($model, array('criteria' => $criteria));
        $posts->pagination = array('pagesize' => 10);

        // Render Product
        $this->render('//posts/product', array('title' => $title, 'posts' => $posts));
    }

    // View Page WhyMonavie.php
    public function actionWhyMoanvie() {
        // Setting Layout
        $this->layout = 'column2';

        // Create New Model
        $model = new Post();
        $model_page = Page::model()->findByPk("2");

        // Setting Title
        $title = $model_page->name;

        // Create Critria
        $criteria = new CDbCriteria();
        $criteria->condition = 'id_page = ' . $model_page->id;
        $criteria->params = array($model->status => '1');
        $criteria->order = '`id` DESC';

        // Create DataProvider
        // Select Attributes @Status = 1 and @id_page = 2
        $posts = new CActiveDataProvider($model, array('criteria' => $criteria));
        $posts->pagination = array('pagesize' => 10);

        // Render Product
        $this->render('//posts/whymonavie', array('title' => $title, 'posts' => $posts));
    }

    // View Page WhyTeam.php
    public function actionWhyTeam() {
        // Setting Layout
        $this->layout = 'column2';

        // Create new Model
        $model = new Post();
        $model_page = Page::model()->findByPk("3");

        // Setting Title
        $title = $model_page->name;

        // Create Critria
        $criteria = new CDbCriteria();
        $criteria->condition = 'id_page = ' . $model_page->id;
        $criteria->params = array($model->status => '1');
        $criteria->order = '`id` DESC';

        // Create DataProvider
        $posts = new CActiveDataProvider($model, array('criteria' => $criteria));
        $posts->pagination = array('pagesize' => 10);

        // Render Page whyTeam
        $this->render('//posts/whyteam', array('title' => $title, 'posts' => $posts));
    }

    // View Page Bussiness.php
    public function actionBusiness() {
        // Setting Layout
        $this->layout = 'column2';

        // Create new Model
        $model = new Post();
        $model_page = Page::model()->findByPk("4");

        // Setting Title
        $title = $model_page->name;

        // Create Critria
        $criteria = new CDbCriteria();
        $criteria->condition = 'id_page = ' . $model_page->id;
        $criteria->params = array($model->status => '1');
        $criteria->order = '`id` DESC';

        // Create DataProvider
        $posts = new CActiveDataProvider($model, array('criteria' => $criteria));
        $posts->pagination = array('pagesize' => 10);

        // Render Page whyTeam
        $this->render('//posts/business', array('title' => $title, 'posts' => $posts));
    }

    public function actionNewEvent() {
        // Setting Layout
        $this->layout = 'column2';

        // Create new Model
        $model = new Post();
        $model_page = Page::model()->findByPk("5");

        // Setting Title
        $title = $model_page->name;

        // Create Critria
        $criteria = new CDbCriteria();
        $criteria->condition = 'id_page = ' . $model_page->id;
        $criteria->params = array($model->status => '1');
        $criteria->order = '`id` DESC';

        // Create DataProvider
        $posts = new CActiveDataProvider($model, array('criteria' => $criteria));
        $posts->pagination = array('pagesize' => 10);

        $this->render('//posts/newevent', array('title' => $title, 'posts' => $posts));
    }

    public function actionViewNewsEvent($id = NULL) {

        if (!empty($id)) {
            $this->layout = 'column2';

            $modelPost = Post::model()->findByPk($id);

            $this->render('//newsevent/viewNewseEvent', array('modelPost' => $modelPost));
        } else {
            $this->redirect(array('//site/index'));
        }
    }

    public function actionArticle() {
        // Setting Layout
        $this->layout = 'column2';

        // Create new Model
        $model = new Post();
        $model_page = Page::model()->findByPk("6");

        // Setting Title
        $title = $model_page->name;

        // Create Critria
        $criteria = new CDbCriteria();
        $criteria->condition = 'id_page = ' . $model_page->id;
        $criteria->params = array($model->status => '1');
        $criteria->order = '`id` DESC';

        // Create DataProvider
        $posts = new CActiveDataProvider($model, array('criteria' => $criteria));
        $posts->pagination = array('pagesize' => 10);

        $this->render('//article/article', array('title' => $title, 'posts' => $posts));
    }

    public function actionViewArticle($id = NULL) {
        if (!empty($id)) {
            $this->layout = 'column2';

            $modelPost = Post::model()->findByPk($id);

            $title = $modelPost->header;

            $this->render('//article/viewArticle', array('title' => $title, 'modelPost' => $modelPost));
        } else {
            $this->redirect(array('//site/index'));
        }
    }

}

?>
