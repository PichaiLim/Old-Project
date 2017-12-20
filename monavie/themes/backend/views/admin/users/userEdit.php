<?php
$this->pageTitle = Yii::app()->name . ' - ' . $title_header;
$baseUrl = Yii::app()->baseUrl;
?>

<div class="row-fluid">
    <div class="span12">
        <h1><?php echo $title_header; ?></h1>
        <hr/>
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
        ));
        ?>

        <div class="span4">
            <div class="span12">
                <?php if (!empty($model->image_profile)): ?>
                    <img data-src="holder.js/260x180" src="<?php echo $baseUrl ?>/images/members/<?php echo $model->image_profile; ?>"/>
                <?php else: ?>
                    <img data-src="holder.js/260x180" src="<?php echo $baseUrl ?>/images/members/team-member.png"/>
                <?php endif; ?>
            </div>
            &nbsp;
            <div class="span12">
                <?php echo $form->fileField($model, 'image_profile'); ?><?php echo $form->hiddenField($model, 'id'); ?>
            </div>
        </div>

        <div class="span8">
            <table class="table table-striped table-hover">
                <tr>
                    <td><?php echo $form->labelEx($model, 'status' . ' :'); ?></td>
                    <td>
                        <?php
                        $sex = array('0' => "admin", '1' => 'user');
                        echo $form->dropDownList($model, 'status', $sex);
                        ?>
                    </td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'usernam' . ' :'); ?></td>
                    <td>
                        <?php echo $form->textField($model, 'username'); ?>
                        <?php echo $form->error($model, 'username'); ?>
                    </td>
                </tr>

                <tr>
                    <td><?php echo $form->labelEx($model, 'password' . ' :'); ?></td>
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
                        <?php echo $form->textField($model, 'address'); ?>
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
        </div>

        <div class="span12 text-center">
            <button type="submit" name="submit" class="btn btn-warning">
                <i class="icon-check icon-white"></i> 
                <b>Submit</b>
            </button>
        </div>
        <?php $this->endWidget($model->id); ?>
    </div>

</div>