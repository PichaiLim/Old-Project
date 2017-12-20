<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' ' . $title_header;
?>
<h1 class="text-center"><?php echo $title_header.' '.CHtml::encode(Yii::app()->name); ?></h1>
<hr/>
<?php echo CHtml::form(); ?>
<table class="table table-striped table-hover">
    <tr>
        <td><?php echo CHtml::label('ชื่อ - นามสกุล : ', ''); ?></td>
        <td><?php echo CHtml::textField('name'); ?></td>
    </tr>
    <tr>
        <td><?php echo CHtml::label('อีเมล์ : ', ''); ?></td>
        <td><?php echo CHtml::textField('email'); ?></td>
    </tr>
    <tr>
        <td><?php echo CHtml::label('หมายเลขโทรศัพท์ : ', ''); ?></td>
        <td><?php echo CHtml::textField('tel',NULL, array('maxlength'=>'13')); ?></td>
    </tr>
    <tr>
        <td><?php echo CHtml::label('ข้อมความ : ', ''); ?></td>
        <td><?php echo CHtml::textArea('textmessage'); ?></td>
    </tr>
</table>
<div class="span12 text-center">
    <button type="submit" name="submit" class="btn btn-success">
        <i class="icon-envelope icon-white"></i> 
        ส่งข้อมูล
    </button>
    &nbsp;
    <button type="reset" name="reset" class="btn btn-warning">
        <i class="icon-remove icon-white"></i> 
        ล้างข้อมูล
    </button>
</div>

<?php echo CHtml::endForm(); ?>