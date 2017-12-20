<?php

class GalleryController extends Controller {

    public function actionIndex() {
        $this->redirect('//site/index');
    }

    public function actionPicture() {
        $this->layout = 'column2';

        $title = 'Gallery Picture';

        $gallery = new Gallery();

        $criteria = new CDbCriteria();
        $criteria->condition = 'type = "1"';
        $criteria->order = 'id DESC';

        $model = new CActiveDataProvider($gallery, array('criteria' => $criteria));

        $this->render('//gallery/galleryPicture', array('model' => $model, 'title' => $title));
    }

    public function actionVideo() {
        $this->layout = 'column2';

        $title = 'Gallery Video';

        $gallery = new Gallery();

        $criteria = new CDbCriteria();
        $criteria->condition = 'type = "2"';
        $criteria->order = 'id DESC';

        $model = new CActiveDataProvider($gallery, array('criteria' => $criteria));

        $this->render('//gallery/galleryVideo', array('model' => $model, 'title' => $title));
    }

    public function actionVideoView($id = NULL) {
        if (empty($id) && empty($type)) {
            $this->redirect(array('//site/index'));
        }

        $this->layout = 'column2';

        $model_movie = new Movie();

        $criteria = new CDbCriteria();
        $criteria->condition = "`id_gallery` = {$id}";

        $model = new CActiveDataProvider($model_movie, array('criteria' => $criteria));

        $this->render('//gallery/galleryVideoView', array('model' => $model));
    }

    public function actionGalleryView($id = NULL, $type = NULL) {

        if (empty($id) && empty($type)) {
            $this->redirect(array('//site/index'));
        }

        $this->layout = 'column2';

        $gallery = new Media();

        $criteria = new CDbCriteria();
        $criteria->condition = "id_gallery = \"{$id}\" 
                                            AND category = \"{$type}\"";
        $criteria->order = "id ASC";

        $modelView = new CActiveDataProvider($gallery, array('criteria' => $criteria));
        $modelView->pagination = array('pagesize' => "10");

        $this->render('//gallery/galleryView', array('modelView' => $modelView));
    }

}

?>
