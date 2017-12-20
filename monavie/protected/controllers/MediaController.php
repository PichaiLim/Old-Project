<?php

ob_start();
/*
 * function 
 *  @ MediaAll
 *  @ Gallery
 *  @ Image
 *  @ Video
 *  @ Slide
 *
 *  Category Status
 * '0' => NULL
 * '1' => Image or Picture
 * '2' => Video
 */

class MediaController extends Controller {

    public $path_media = '/images/media/';
    public $layout2 = 'column2';
    public $theme = 'backend';

    public function actionIndex() {
        // Setting Layout
        $this->layout = $this->layout2;

        // Setting Theme
        Yii::app()->theme = $this->theme;

        // redirect page
        $this->redirect(array('MediaLibaryGallry'));
    }

    public function actionMediaALL() {
        // Setting Layout
        $this->layout = $this->layout2;

        // Setting Theme
        Yii::app()->theme = $this->theme;

        // Setting Title & Header
        $title_header = "Media ALL";

        // render page
        $this->render('//admin/media/mediaAll', array('title_header' => $title_header));
    }

    // Gallery Libary
    public function actionMediaLibaryGallry() {
        // Setting Layout
        $this->layout = $this->layout2;

        // Setting Theme
        Yii::app()->theme = $this->theme;

        // Setting Title & Header
        $title_header = 'Media Libary Gallry';

        // create model
        $model_gallry = new Gallery();

        // count value id
        if ($model_gallry->count('id') <= 0) {
            $this->redirect(array('MediaGallryAdd'));
        }

        // create Criteria
        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC'; // order BY `id` DESC

        $model = new CActiveDataProvider($model_gallry, array('criteria' => $criteria));
        $model->pagination = array('pagesize' => 15); // fix page size limit
        // redner page
        $this->render('//admin/media/mediaLibaryGallry', array('title_header' => $title_header, 'model' => $model));
    }

    // Add New Gallery
    public function actionMediaGallryAdd($id = NULL) {
        // Setting Layout
        $this->layout = $this->layout2;

        // Setting Theme
        Yii::app()->theme = $this->theme;

        // Setting Title & Header
        if (empty($id)) {
            $title_header = 'Media Add New Gallry';
        } else {
            $title_header = 'Media Edit Gallry';
        }


        // create model
        $model = new Gallery();

        // check value
        if (!empty($_POST['Gallery'])) {

            $id = $_POST['Gallery']['id'];

            // check value
            if (!empty($id)) {
                $model = Gallery::model()->findByPk($id);
            }

            $old_image = $model->image;

            $model->_attributes = $_POST['Gallery'];
            $model->date = new CDbExpression("NOW()");

            if (!empty($_FILES['Gallery'])) {
                $new_image = CUploadedFile::getInstances($model, 'image');

                foreach ($new_image as $value) {
                    $path = pathinfo($value);
                    $path_fileType = strtolower($path['extension']);
                    $path_fileName = substr(md5(number_format(time() * rand(), 0, '', '')), 0, 14);
                    $path_fullName = $path_fileName . '.' . $path_fileType;

                    $model->image = Yii::app()->baseUrl . $this->path_media . $path_fullName;

                    $value->saveAs(Yii::getPathOfAlias('webroot') . $this->path_media . $path_fullName);

                    if (file_exists(Yii::getPathOfAlias('webroot') . $this->path_media . $old_image)) {
                        @unlink(Yii::getPathOfAlias('webroot') . $this->path_media . $old_image);
                    }
                }
            }

            // save
            if ($model->save()) {
                // redirect page
                $this->redirect(array('MediaLibaryGallry'));
            }
        }

        // check value
        if (!empty($id)) {
            $model = Gallery::model()->findByPk($id);
        }

        // render page
        $this->render('//admin/media/mediaGallryAdd', array('title_header' => $title_header, 'model' => $model));
    }

    // Delete Gallery
    public function actionMediaGallryDelete($id = NULL) {
        // Setting Layout
        $this->layout = $this->layout2;

        // Setting Theme
        Yii::app()->theme = $this->theme;

        // check value
        if (!empty($id)) {
            // delete id[PK]
            Gallery::model()->deleteByPk($id);
        }

        // redirect page
        $this->redirect(array('MediaLibaryGallry'));
    }

    // Image Libary
    public function actionMediaLibaryImage() {
        // Setting Layout
        $this->layout = $this->layout2;

        // Setting Theme
        Yii::app()->theme = $this->theme;

        // Setting Title & Header
        $title_header = 'Media Image Libary';

        // Create Model
        $model_media = new Media();
        $gallery = new Gallery();

        // Coutn ID Gallery
        if ($gallery->count('type = 1') <= 0) {
            $this->redirect(array('MediaGallryAdd'));
        }

        // count id
        if ($model_media->count('id') <= 0) {
            $this->redirect(array('MediaImageAdd'));
        }

        // Create Criteria
        $criteria = new CDbCriteria();
        // category = "1" -> Image
        $criteria->condition = 'category = "1"'; // Where `category` = "1"
        $criteria->order = 'id DESC'; // Order BY `id` DESC

        $model = new CActiveDataProvider($model_media, array('criteria' => $criteria));
        $model->pagination = array('pagesize' => 10); // fix page size limit
        // render page
        $this->render('//admin/media/mediaLibaryImage', array('title_header' => $title_header, 'model' => $model));
    }

    public function actionMediaImageAdd() {
        // Setting Layout
        $this->layout = $this->layout2;

        // Setting Theme
        Yii::app()->theme = $this->theme;

        // Setting Title & Header
        $title_header = 'Add New Image Media';

        // Create New Model
        $model = new Media('Image');
        $gallery = new Gallery();

        // Coutn ID Gallery
        if ($gallery->count('type = 1') <= 0) {
            $this->redirect(array('MediaGallryAdd'));
        }

        // check value
        if (!empty($_FILES)) {
            $img_name = CUploadedFile::getInstances($model, 'file');

            // loop image
            foreach ($img_name as $image) {
                // rename image
                $path = pathinfo($image);
                $path_fileType = strtolower($path['extension']); // Type Name Image
                $path_fileName = substr(number_format(time() * rand(), 0, '', ''), 0, 14); // rename Name Image
                $path_fullName = $path_fileName . '.' . $path_fileType; // Full Name image
                // Save file
                $image->saveAs(Yii::getPathOfAlias('webroot') . $this->path_media . $path_fullName);

                // Create model
                $model = new Media();
                $model->_attributes = $_POST['Media'];
                $model->name = $path_fileName;
                $model->file = $path_fullName;
                $model->type = $path_fileType;
                $model->link = Yii::app()->baseUrl . $this->path_media . $path_fullName;
                $model->date = new CDbExpression('NOW()');
                $model->category = "1"; // '1'=>image
                // save
                $model->save();
            }

            // redirect page
            $this->redirect(array('MediaLibaryImage'));
        }

        // Render Page MediaAdd.php
        $this->render('//admin/media/mediaImageAdd', array('title_header' => $title_header, 'model' => $model));
    }

    public function actionMediaImageEdit($id = NULL) {
        // Setting Layout
        $this->layout = $this->layout2;

        // Setting Theme
        Yii::app()->theme = $this->theme;

        // Setting Title & Header 
        $title_header = 'Edit Image Media';

        // create value
        $model = new Media('Image');
        $gallery = new Gallery();

        // Coutn ID Gallery
        if ($gallery->count('type = 1') <= 0) {
            $this->redirect(array('MediaGallryAdd'));
        }

        // check value
        if (!empty($_POST['Media'])) {
            $id = $_POST['Media']['id'];

            // check value
            if (!empty($id)) {
                $model = Media::model()->findByPk($id);
            }

            // old file
            $old_image = $model->file;

            $model->_attributes = $_POST['Media'];
            $model->name = trim($_POST['Media']['name']);
            $model->date = new CDbExpression('NOW()');
            $model->category = "1"; // Image
            // upload file
            if (isset($_FILES['Media'])) {
                $new_image = CUploadedFile::getInstance($model, 'file');

                // rename file
                $path = pathinfo($new_image);
                if (!empty($path['filename'])) {
                    $path_fileType = strtolower($path['extension']);
                    $path_fileName = substr(number_format(time() * rand(), 0, '', ''), 0, 14);
                    $path_fullName = $path_fileName . '.' . $path_fileType;


                    $model->file = $path_fullName;
                    $model->type = $path_fileType;
                    $model->link = Yii::app()->baseUrl . $this->path_media . $path_fullName;

                    // save image
                    $new_image->saveAs(Yii::getPathOfAlias('webroot') . $this->path_media . $path_fullName);
                    // delete image
                    if (file_exists(Yii::getPathOfAlias('webroot') . $this->path_media . $old_image)) {
                        unlink(Yii::getPathOfAlias('webroot') . $this->path_media . $old_image);
                    }
                }
            }

            //save
            if ($model->save()) {
                $this->redirect(array('MediaLibaryImage'));
            }
        }

        // check value
        if (!empty($id)) {
            $model = Media::model()->findByPk($id);
        }

        // Render Page
        $this->render('//admin/media/mediaImageEdit', array('title_header' => $title_header, 'model' => $model));
    }

    public function actionMediaDeleteImage($id = NULL, $img = NULL) {
        // Setting Layout
        $this->layout = $this->layout2;

        // Setting Theme
        Yii::app()->theme = $this->theme;

        // check value
        if (!empty($id) && !empty($img)) {
            // check file 
            if (file_exists(Yii::getPathOfAlias('webroot') . $this->path_media . $img)) {
                unlink(Yii::getPathOfAlias('webroot') . $this->path_media . $img); // delete file
            }
            // Delete ID[PK] Model
            Media::model()->deleteByPk($id);
        }

        // redirect page
        $this->redirect(array('MediaLibaryImage'));
    }

    // Video Libary


    public function actionMediaLibaryVideo() {
        //Setting Layout
        $this->layout = $this->layout2;

        //Setting Theme
        Yii::app()->theme = $this->theme;

        //Setting Title & Header
        $title_header = 'Media Video Libary';


        $gallery = new Gallery();
        // Coutn ID Gallery
        if ($gallery->count('type = 2') <= 0) {
            $this->redirect(array('MediaGallryAdd'));
        }

        $model_Movie = new Movie();

        if ($model_Movie->count('id_movie') <= 0) {
            $this->redirect(array('MediaVideoAdd'));
        }

        $criteria = new CDbCriteria();
        $criteria->order = '`id_movie` DESC';

        $model = new CActiveDataProvider($model_Movie, array('criteria' => $criteria));
        $model->pagination = array('pagesize' => 10);

        // render page
        $this->render('//admin/media/mediaLibaryVideo', array('title_header' => $title_header, 'model' => $model));
    }

    public function actionMediaVideoAdd() {
        //<iframe width="420" height="315" src="//www.youtube.com/embed/Xq8ng0rj7Dw?rel=0" frameborder="0" allowfullscreen></iframe>
        //                                http://www.youtube.com/watch?v=Xq8ng0rj7Dw
        // Setting Layout
        $this->layout = $this->layout2;

        // Setting Theme
        Yii::app()->theme = $this->theme;

        // Setting Title & Header
        $title_header = 'Add New Video Media';

        $modle = new Movie();

        if (!empty($_POST['Movie'])) {

            $modle->_attributes = $_POST['Movie'];

            if ($modle->save()) {
                $this->redirect(array('MediaLibaryVideo'));
            } else {
                echo "error";
                exit();
            }
        }

        // render page 
        $this->render('//admin/media/mediaVideoAdd', array('title_header' => $title_header, 'model' => $modle));
    }

    public function actionMediaVideoEdit($id = NULL) {
        ////<iframe width="420" height="315" src="//www.youtube.com/embed/Xq8ng0rj7Dw?rel=0" frameborder="0" allowfullscreen></iframe>
        //                                http://www.youtube.com/watch?v=Xq8ng0rj7Dw
        // Setting Layout
        $this->layout = $this->layout2;

        // Setting Theme
        Yii::app()->theme = $this->theme;

        // Setting Title & Header
        $title_header = 'Edit Video Media';

        $modle = new Movie();

        if (!empty($_POST['Movie'])) {

            if (!empty($id)) {
                $modle = Movie::model()->findByPk($id);
            }

            $modle->_attributes = $_POST['Movie'];

            if ($modle->save()) {
                $this->redirect(array('MediaLibaryVideo'));
            } else {
                echo "Errro";
                exit();
            }
        }

        if (!empty($id)) {
            $modle = Movie::model()->findByPk($id);
        }

        // render page
        $this->render('//admin/media/mediaVideoEdit', array('title_header' => $title_header, 'model' => $modle));
    }

    public function actionMediaVideoDelete($id = NULL) {
        if (!empty($id)) {
            Movie::model()->deleteByPk($id);
        }
        // redirect page
        $this->redirect(array('MediaLibaryVideo'));
    }

    /*
      // Video Libary [Old]
      public function actionMediaLibaryVideo() {
      //Setting Layout
      $this->layout = $this->layout2;

      //Setting Theme
      Yii::app()->theme = $this->theme;

      //Setting Title & Header
      $title_header = 'Media Video Libary';

      // Create Model
      $media = new Media();
      $gallery = new Gallery();

      // Coutn ID Gallery
      if ($gallery->count('type = 2') <= 0) {
      $this->redirect(array('MediaGallryAdd'));
      }

      // Coutn Category
      // '2' => Video
      if ($media->count('category = 2') <= 0) {
      $this->redirect(array('MediaVideoAdd'));
      }

      $criteria = new CDbCriteria();
      //category = "2"
      // "2" => Video
      $criteria->condition = 'category = "2"'; // Where `category`= "2";
      $criteria->order = 'id DESC'; // ORDER BY `id` DESC

      $model = new CActiveDataProvider($media, array('criteria' => $criteria));
      $model->pagination = array('pagesize' => 10); // fix page size limit
      // render page
      $this->render('//admin/media/mediaLibaryVideo', array('title_header' => $title_header, 'model' => $model));
      }
     */
    /*
      public function actionMediaVideoAdd() {
      // Setting Layout
      $this->layout = $this->layout2;

      // Setting Theme
      Yii::app()->theme = $this->theme;

      // Setting Title & Header
      $title_header = 'Add New Video Media';

      // Create New Model
      $model = new Media();
      $gallery = new Gallery();

      // Coutn ID Gallery
      if ($gallery->count('type = 2') <= 0) {
      $this->redirect(array('MediaGallryAdd'));
      }

      // upload
      if (!empty($_FILES['Media']['name']['file'])) {
      $video = CUploadedFile::getInstances($model, 'file');

      foreach ($video as $value) {
      // rename
      $path = pathinfo($value);
      $path_fileType = strtolower($path['extension']);
      $path_fileName = substr(md5(number_format(time() * rand(), 0, '', '')), 0, 14);
      $path_fullName = $path_fileName . '.' . $path_fileType;

      // save file
      $value->saveAs(Yii::getPathOfAlias('webroot') . $this->path_media . $path_fullName);

      $model = new Media();
      $model->_attributes = $_POST['Media'];
      $model->name = $path_fileName;
      $model->file = $path_fullName;
      $model->type = $path_fileType;
      $model->link = Yii::app()->baseUrl . $this->path_media . $path_fullName;
      $model->date = new CDbExpression('NOW()');
      $model->category = "2"; // Video
      // save
      $model->save();
      }

      // redirect page
      $this->redirect(array('MediaLibaryVideo'));
      }

      // render page
      $this->render('//admin/media/mediaVideoAdd', array('title_header' => $title_header, 'model' => $model));
      }
     */
    /*
      public function actionMediaVideoEdit($id = NULL) {
      // Setting Layout
      $this->layout = $this->layout2;

      // Setting Theme
      Yii::app()->theme = $this->theme;

      // Setting Title & Header
      $title_header = 'Edit Video Media';

      // Create New Model
      $model = new Media();
      $gallery = new Gallery();

      // Coutn ID Gallery
      if ($gallery->count('type = 2') <= 0) {
      $this->redirect(array('MediaGallryAdd'));
      }

      // check value
      if (!empty($_POST['Media'])) {

      $id = $_POST['Media']['id'];

      // select model
      if (!empty($id)) {
      $model = Media::model()->findByPk($id);
      }

      // old file
      $old_video = $model->file;

      $model->_attributes = $_POST['Media'];
      $model->name = trim($_POST['Media']['name']);
      $model->category = "2";

      // upload
      if (!empty($_FILES['Media'])) {

      $new_video = CUploadedFile::getInstances($model, 'file');

      foreach ($new_video as $value) {
      // rename
      $path = pathinfo($value);
      $path_fileType = strtolower($path['extension']);
      $path_fileName = substr(md5(number_format(time() * rand(), 0, '', '')), 0, 14);
      $path_fullName = $path_fileName . '.' . $path_fileType;

      // save image
      $value->saveAs(Yii::getPathOfAlias('webroot') . $this->path_media . $path_fullName);

      $model->file = $path_fullName;
      $model->type = $path_fileType;
      $model->link = Yii::app()->baseUrl . $this->path_media . $path_fullName;
      $model->date = new CDbExpression('NOW()');
      }


      // check older image file in folder
      if (file_exists(Yii::getPathOfAlias('webroot') . $this->path_media . $old_video)) {
      unlink(Yii::getPathOfAlias('webroot') . $this->path_media . $old_video); // delete file
      }

      //save
      if ($model->save()) {
      // redirect page
      $this->redirect(array('MediaLibaryVideo'));
      }
      }
      }

      // select model
      if (!empty($id)) {
      $model = Media::model()->findByPk($id);
      }

      // render page
      $this->render('//admin/media/mediaVideoEdit', array('title_header' => $title_header, 'model' => $model));
      }

      public function actionMediaVideoDelete($id = NULL, $video = NULL) {

      if (!empty($id) && !empty($video)) {
      // check older image file in folder
      if (file_exists(Yii::getPathOfAlias('webroot') . $this->path_media . $video)) {
      unlink(Yii::getPathOfAlias('webroot') . $this->path_media . $video);
      }
      // Delete
      Media::model()->deleteByPk($id);
      }
      // redirect page
      $this->redirect(array('MediaLibaryVideo'));
      }
     */

    // Slide
    public function actionMediaLibarySlide() {
        // Setting Layout
        $this->layout = $this->layout2;

        // Setting Theme
        Yii::app()->theme = $this->theme;

        // Setting Title & Header
        $title_header = 'Media Libary Slide';

        $slide = new Slide();

        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';

        $model = new CActiveDataProvider($slide, array('criteria' => $criteria));
        $model->pagination = array('pagesize' => 10);

        $this->render('//admin/media/mediaLibarySlide', array(
            'title_header' => $title_header,
            'model' => $model
        ));
    }

    public function actionMediaSlideAdd() {
        // Setting Layout
        $this->layout = $this->layout2;

        // Setting Theme
        Yii::app()->theme = $this->theme;

        // Setting Title & Header
        $title_header = 'Add New Media Slide';

        $model = new Slide();

        if (!empty($_POST['Slide'])) {

            if (!empty($_FILES['Slide'])) {
                $new_image = CUploadedFile::getInstances($model, 'file');

                foreach ($new_image as $value) {
                    $path = pathinfo($value);
                    $path_fileType = strtolower($path['extension']);
                    $path_fileName = substr(md5(number_format(time() * rand(), 0, '', '')), 0, 14);
                    $path_fullName = $path_fileName . '.' . $path_fileType;
                    // Save file
                    $value->saveAs(Yii::getPathOfAlias('webroot') . $this->path_media . $path_fullName);

                    $model = new Slide();
                    $model->attributes = $_POST['Slide'];
                    $model->name = $path_fileName;
                    $model->file = $path_fullName;
                    $model->type = $path_fileType;
                    $model->link = Yii::app()->baseUrl . $this->path_media . $path_fullName;
                    $model->date = new CDbExpression('NOW()');

                    $model->save();
                }
                $this->redirect(array('MediaLibarySlide'));
            }
        }


        $this->render('//admin/media/mediaSlideAdd', array(
            'title_header' => $title_header,
            'model' => $model
        ));
    }

    public function actionMediaSlideEdit($id = NULL) {
        // Setting Layout
        $this->layout = $this->layout2;

        // Setting Theme
        Yii::app()->theme = $this->theme;

        // Setting Title & Header
        $title_header = 'Media Libary Slide';

        $model = new Slide();

        if (!empty($_POST['Slide'])) {

            $id = $_POST['Slide']['id'];

            if (!empty($id)) {
                $model = Slide::model()->findByPk($id);
            }
            $old_image = $model->file;

            if (file_exists(Yii::getPathOfAlias('webroot') . $this->path_media . $old_image)) {
                @unlink(Yii::getPathOfAlias('webroot') . $this->path_media . $old_image);
            }

            if (!empty($_FILES['Slide'])) {
                $new_image = CUploadedFile::getInstances($model, 'file');

                foreach ($new_image as $value) {
                    $path = pathinfo($value);
                    $path_fileType = strtolower($path['extension']);
                    $path_fileName = substr(md5(number_format(time() * rand(), 0, '', '')), 0, 14);
                    $path_fullName = $path_fileName . '.' . $path_fileType;
                    // Save file
                    $value->saveAs(Yii::getPathOfAlias('webroot') . $this->path_media . $path_fullName);

                    $model->attributes = $_POST['Slide'];
                    $model->file = $path_fullName;
                    $model->type = $path_fileType;
                    $model->link = Yii::app()->baseUrl . $this->path_media . $path_fullName;
                    $model->date = new CDbExpression('NOW()');

                    $model->save();
                }

                $this->redirect(array('MediaLibarySlide'));
            }
        }

        if (!empty($id)) {
            $model = Slide::model()->findByPk($id);
        }


        $this->render('//admin/media/mediaSlideEdit', array(
            'title_header' => $title_header,
            'model' => $model
        ));
    }

    public function actionMediaSlideDelete($id = NULL, $img = NULL) {
        // Setting Layout
        $this->layout = $this->layout2;

        // Setting Theme
        Yii::app()->theme = $this->theme;

        // check value
        if (!empty($id) && !empty($img)) {
            // check file 
            if (file_exists(Yii::getPathOfAlias('webroot') . $this->path_media . $img)) {
                unlink(Yii::getPathOfAlias('webroot') . $this->path_media . $img); // delete file
            }
            // Delete ID[PK] Model
            Slide::model()->deleteByPk($id);
        }

        // redirect page
        $this->redirect(array('MediaLibarySlide'));
    }

}

?>