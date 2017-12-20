<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/9/16
 * Time: 16:43
 */
?>

<form action="#" class="form-horizontal" role="form"  autocomplete="off">


    <div class="form-group">
        <lable for="seo_title" class="col-sm-3 control-label" >
            Title
        </lable >

        <div class="col-sm-9">
            <input class="form-control"
                   name="seo_title"
                   data-name="seo_title"
                   type="text"
                   maxlength="255"
                   value=""
                   placeholder=""
                   spellcheck="false"
                   style="display: block;">
        </div>
    </div>


    <div class="form-group">
        <lable for="seo_description" class="col-sm-3 control-label" >
            Description
        </lable >

        <div class="col-sm-9">
            <textarea class="form-control"
                  name="seo_description"
                  data-name="seo_description"
                  rows="3"
                  placeholder=""
                  spellcheck="false"
                  style="resize: none; display: block;"></textarea>
        </div>
    </div>


    <div class="form-group">
        <lable for="seo_keywords" class="col-sm-3 control-label" >
            Keywords
        </lable >

        <div class="col-sm-9">
            <input class="form-control" name="seo_keywords" id="seo_keywords" value="" type="text" />
        </div>
    </div>



</form >