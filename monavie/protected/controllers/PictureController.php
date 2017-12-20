<?php

class PictureTabController extends Controller {

    public static function Picturetab($id = NULL) {
        /*
          SELECT *
          FROM  `tb_gallery`
          LEFT JOIN  `tb_media` ON  `tb_gallery`.id =  `tb_media`.id_gallery
          WHERE (
          `tb_gallery`.type =  `tb_media`.category
          AND  `tb_gallery`.id =  `tb_media`.id_gallery
          )
          AND  `tb_media`.id_gallery IS NOT NULL
          ORDER BY  `tb_gallery`.id DESC
          LIMIT 0 , 5
         */
        $model = new Gallery();

        $criteria = new CDbCriteria();
        $criteria->select = "t1.id, t1.name, t1.content, t1.image, t1.type";
        $criteria->alias = "t1";
        $criteria->condition = 't1.type = ' . $id;
        $criteria->order = 't1.id DESC';

        $tabpicture = new CActiveDataProvider($model, array('criteria' => $criteria));
        $tabpicture->pagination = array('pagesize' => 5);
        
        return $tabpicture;
    }

}

?>