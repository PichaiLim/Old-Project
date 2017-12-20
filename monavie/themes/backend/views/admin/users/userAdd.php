<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' - ' . $title_header;
$baseUrl = Yii::app()->baseUrl;
?>
<h1 style="margin: 0px;"><?php echo $title_header; ?></h1>
<hr style="margin: 0px;"/>
<br/>
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'profile-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    ),
    'focus' => array($model, 'username'),
        ));
?>
<div class="row-fluid">
    <div class="span12">
        <div class="span4">
            <img data-src="holder.js/260x180" src="<?php echo $baseUrl; ?>/images/members/team-member.png" alt="" class="thumbnail"/>
            &nbsp;
            <?php echo $form->fileField($model, 'image_profile'); ?>
            <br/>
            <?php echo $form->error($model, 'image_profile'); ?>
        </div><!-- Image -->
        <div class="span8">

            <table class="table table-striped">

                <?php if (Yii::app()->session['status'] === '0'): ?>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'status'); ?></td>
                        <td>
                            <?php
                            $sex = array('0' => "admin", '1' => 'user');
                            echo $form->dropDownList($model, 'status', $sex);
                            ?>
                        </td>
                    </tr>
                <?php endif; ?>

                <tr>
                    <td><?php echo $form->labelEx($model, 'username' . " :"); ?></td>
                    <td>
                        <?php echo $form->textField($model, 'username'); ?>
                        <?php echo $form->error($model, 'username'); ?>
                    </td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'password' . " :"); ?></td>
                    <td>
                        <?php echo $form->passwordField($model, 'password'); ?>
                        <?php echo $form->error($model, 'password'); ?>
                    </td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'email' . ' :'); ?></td>
                    <td>
                        <?php echo $form->textField($model, 'email'); ?>
                        <?php echo $form->error($model, 'email'); ?>
                    </td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'name' . ' :'); ?></td>
                    <td>
                        <?php echo $form->textField($model, 'name'); ?>
                        <?php echo $form->error($model, 'name'); ?>
                    </td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'lastname' . ' :'); ?></td>
                    <td>
                        <?php echo $form->textField($model, 'lastname'); ?>
                        <?php echo $form->error($model, 'lastname'); ?>
                    </td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'address' . ' :'); ?></td>
                    <td>
                        <?php echo $form->textArea($model, 'address'); ?>
                        <?php echo $form->error($model, 'address'); ?>
                    </td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'tel' . ' :'); ?></td>
                    <td>
                        <?php echo $form->textField($model, 'tel'); ?>
                        <?php echo $form->error($model, 'tel'); ?>
                    </td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'mobile' . ' :'); ?></td>
                    <td>
                        <?php echo $form->textField($model, 'mobile'); ?>
                        <?php echo $form->error($model, 'mobile'); ?>
                    </td>
                </tr>

            </table>

        </div><!-- Content -->

        <div class="text-center">
            <button type="submit" name="submti" class="btn btn-primary">
                <i class="icon-check icon-white"></i> 
                <b>Submit</b>
            </button>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>