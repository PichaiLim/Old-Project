<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' - ' . $title_header;
$baseUrl = Yii::app()->baseUrl;
?>
<h1 style="margin: 0px;"><?php echo $title_header; ?></h1>
<hr style="margin: 0px;"/>
<br/>

<div class="span8 margin0">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'pages-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>
    <table class="table table-striped">
        
        <tr>
            <td><?php echo $form->labelEx($model,'name');?></td>
            <td>
                <?php echo $form->textField($model,'name');?>
                <?php echo $form->error($model,'name');?>
            </td>
        </tr>
        
        <tr>
            <td><?php echo $form->labelEx($model,'title');?></td>
            <td>
                <?php echo $form->textField($model,'title');?>
                <?php echo $form->error($model,'title');?>
            </td>
        </tr>
        
    </table>
    
    <?php echo $form->hiddenField($model, 'id');?>
    
    <div class="text-center">
        <button type="submit" name="submti" class="btn btn-warning">
            <i class="icon-check icon-white"></i> 
            <b><?php echo $title_header;?></b>
        </button>
    </div>
    <?php $this->endWidget();?>
</div>