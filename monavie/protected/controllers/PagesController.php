<?php

/*
 * @value $title_header
 */

class PagesController extends Controller {

    public function actionPages() {
        // Set Layout
        $this->layout = 'column2';

        // Set Themes
        Yii::app()->theme = "backend";

        // Create
        $title_header = 'Pages All';

        // Create New Model
        $pages = new Page();

        // Create DataProvider
        $model = new CActiveDataProvider($pages);
        // Setting DataProvider Page Size
        $model->pagination = array('pagesize' => 15);


        $this->render('//admin/pages/pages', array('model' => $model, 'title_header' => $title_header));
    }

    public function actionPageUpdate($id = NULL) {
        // Set Layout
        $this->layout = 'column2';

        // Set Themes
        Yii::app()->theme = "backend";

        // Create
        $title_header = 'Edit Pages';
        
        if (isset($_POST['Page'])) {
            
            $pk = $_POST["Page"]["id"];
            
            if (isset($pk)){
                $page = Page::model()->findByPk($pk);
            }
            
            $page->_attributes = $_POST['Page'];
            
            if ($page->save()){
                $this->redirect(array('Pages'));
            }
            
        }

        
        if (isset($id)){
            $model = Page::model()->findByPk($id);
        }
        

        $this->render('//admin/pages/pageUpdate', array('model' => $model, 'title_header' => $title_header));
    }

}

?>
