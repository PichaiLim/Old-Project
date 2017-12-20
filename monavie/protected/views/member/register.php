<div class="span12 White-Gloss2">

    <h2 class="span12 text-center ">สมัครสมาชิก</h2>

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'register-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>
    <p>
        <label class="span4 text-right"><b>ชื่อ :&nbsp;</b></label>
        <?php echo $form->textField($model, 'name', array('class' => 'span8', 'placeholder' => 'You Name')); ?>
    </p>

    <?php echo $form->error($model, 'name', array('class' => 'alert alert-error span12 text-center')); ?>

    <p>
        <label class="span4 text-right"><b>นามสกุล :&nbsp;</b></label>
        <?php echo $form->textField($model, 'lastname', array('class' => 'span8', 'placeholder' => 'You Lastname')); ?>
    </p>

    <?php echo $form->error($model, 'lastname', array('class' => 'alert alert-error span12 text-center')); ?>

    <p>
        <label class="span4 text-right"><b>เบอร์โทร :&nbsp;</b></label>
        <?php echo $form->textField($model, 'tel', array('class' => 'span8', 'placeholder' => 'You Phone')); ?>
    </p>

    <?php echo $form->error($model, 'tel', array('class' => 'alert alert-error span12 text-center')); ?>

    <p>
        <label class="span4 text-right"><b>อีเมล์ :&nbsp;</b></label>
        <?php echo $form->textField($model, 'email', array('class' => 'span8', 'placeholder' => 'Example@Email.com')); ?>
    </p>

    <?php echo $form->error($model, 'email', array('class' => 'alert alert-error span12 text-center')); ?>

    <p class="text-right space-padding-right space-padding-bottom">
        <button type="submit" name="submit" class="btn btn-success">
            <i class="icon-pencil icon-white"></i>
            สมัครสมาชิก
        </button>
    </p>
    <?php $this->endWidget(); ?>
</div><!-- Register -->