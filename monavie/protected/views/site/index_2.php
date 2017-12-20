<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
$baseUrl = Yii::app()->baseUrl;
?>

<div class="container-fluid White-Gloss2">
    <div class="container">
        <div class="row-fluid">
            &nbsp;
            <div class="span12">
                <!-- Carousel bootstrap.widgets.TbCarousel -->
                <div id="myCarousel" class="carousel slide">
                    <!--                    <ol class="carousel-indicators">
                                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                            <li data-target="#myCarousel" data-slide-to="1"></li>
                                            <li data-target="#myCarousel" data-slide-to="2"></li>
                                            <li data-target="#myCarousel" data-slide-to="3"></li>
                                        </ol>-->
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <div class="active item" >
                            <img src="<?php echo $baseUrl; ?>/images/Cimage_1.jpg"/>
                        </div>

                        <div class="item" >
                            <img src="<?php echo $baseUrl; ?>/images/Cimage_1.jpg"/>
                        </div>

                        <!--                        <div class="item">
                                                    <img src="<?php echo $baseUrl; ?>/images/Cimage2.jpg"/>
                                                </div>
                        
                                                <div class="item">
                                                    <img src="<?php echo $baseUrl; ?>/images/Cimage3.jpg"/>
                                                </div>
                        
                                                <div class="item">
                                                    <img src="<?php echo $baseUrl; ?>/images/Cimage4.jpg"/>
                                                </div>-->
                    </div>
                    <!-- Carousel nav -->
                    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
                </div>
            </div>
        </div>
    </div>
</div><!-- myCarousel -->
&nbsp;

<div class="container">
    <div class="row-fluid">
        <div class="span8">

            <div class="span12">
                <!-- Menu Basic Tabs -->
                <div class="tabbable"> <!-- Only required for left/right tabs -->

                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1" data-toggle="tab"><b>ข่าวสารกิจกรรม</b></a></li>
                        <li><a href="#tab2" data-toggle="tab"><b>บทความที่หน้าสนใจ</b></a></li>
                        <li><a href="#tab3" data-toggle="tab"><b>รูปภาพกิจกรรม</b></a></li>
                        <li><a href="#tab4" data-toggle="tab"><b>วีดีโอกิจกรรม</b></a></li>
                    </ul>

                    <div class="tab-content">

                        <div class="tab-pane active" id="tab1">
                            <p>ข่าวการจิกรรม</p>
                        </div>


                        <div class="tab-pane" id="tab2">
                            <p>บทความที่หน้าสนใจ</p>
                        </div>

                        <div class="tab-pane" id="tab3">
                            <p>รูปภาพกิรกรรม</p>
                        </div>

                        <div class="tab-pane" id="tab4">
                            <p>วีดีโอกิรกรรม</p>
                        </div>

                    </div>

                </div>
            </div><!-- Menu Tab -->

        </div>

        <div class="span4">
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
                
                <?php echo $form->error($model,'name',array('class'=>'alert alert-error span12 text-center'));?>
                
                <p>
                    <label class="span4 text-right"><b>นามสกุล :&nbsp;</b></label>
                    <?php echo $form->textField($model, 'lastname', array('class' => 'span8', 'placeholder' => 'You Lastname')); ?>
                </p>
                
                <?php echo $form->error($model,'lastname',array('class'=>'alert alert-error span12 text-center'));?>

                <p>
                    <label class="span4 text-right"><b>เบอร์โทร :&nbsp;</b></label>
                    <?php echo $form->textField($model, 'tel', array('class' => 'span8', 'placeholder' => 'You Phone')); ?>
                </p>
                
                <?php echo $form->error($model,'tel',array('class'=>'alert alert-error span12 text-center'));?>

                <p>
                    <label class="span4 text-right"><b>อีเมล์ :&nbsp;</b></label>
                    <?php echo $form->textField($model, 'email', array('class' => 'span8', 'placeholder' => 'Example@Email.com')); ?>
                </p>
                
                <?php echo $form->error($model,'email',array('class'=>'alert alert-error span12 text-center'));?>

                <p class="text-right space-padding-right space-padding-bottom">
                    <button type="submit" name="submit" class="btn btn-success">
                        <i class="icon-pencil icon-white"></i>
                        สมัครสมาชิก
                    </button>
                </p>
                <?php $this->endWidget(); ?>
            </div><!-- Register -->

            &nbsp;

            <div class="text-center" style="margin-left: 0px;">
<!--                <iframe src="http://player.vimeo.com/video/34767375?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1&amp;loop=1" width="370" height="278" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                <iframe width="370" height="278" src="//www.youtube.com/embed/wsirF3sKUNQ?&autoplay=1&rel=0" frameborder="0" allowfullscreen></iframe>
                <iframe width="370" height="278" src="//www.youtube.com/embed/am_CggC80OU?&AMP;autoplay=1&AMP;rel=0" frameborder="0" allowfullscreen></iframe>-->
            </div><!--video-->

            &nbsp;

            <?php if (isset(Yii::app()->request->cookies['id'])): ?>
                <div class="span12 thumbnail White-Gloss2" style="margin: 0px;">
                    <div class="span5 text-center">
                        <?php
                        if (isset(Yii::app()->request->cookies['image'])) {
                            echo CHtml::image(Yii::app()->baseUrl . '/images/members/' . Yii::app()->request->cookies['image'], Yii::app()->request->cookies['name'] . " " . Yii::app()->request->cookies['lastname'], array('id' => 'myimage'));
                        } else {
                            echo CHtml::image(Yii::app()->baseUrl . ' /images/members/team-member.png', " ");
                        }
                        ?>
                    </div>

                    <div class="span7 text-left">
                        <h3>ติดต่อผู้แนะนำ</h3>
                        <p><?php echo Yii::app()->request->cookies['name'] . ' ' . Yii::app()->request->cookies['lastname']; ?></p>
                        <p><?php echo Yii::app()->request->cookies['tel']; ?></p>
                        <p><?php echo Yii::app()->request->cookies['email']; ?></p>
                        <p>Username : <?php echo Yii::app()->request->cookies['username']; ?></p>
                    </div>

                </div>
            <?php endif; ?>

        </div>

    </div>
</div>

&nbsp;

<div class="container">

    <div class="row-fluid">

        <div class="span3">
            <div class="thumbnail">
                <img data-src="holder.js/300x200" src="<?php echo $baseUrl; ?>/images/Business-Registration-550x366.jpg" alt="">
                <div class="caption">
                    <h4>Register <?php echo CHtml::encode(Yii::app()->name); ?></h4>
                    <p>รับเว็บธุรกิจส่วนตัว และสิทธิพิเศษอื่นๆมากมายจากทาง <?php echo CHtml::encode(Yii::app()->name); ?> โดยสมัครผ่านเว็ปไซด์ของสมาชิก <?php echo CHtml::encode(Yii::app()->name); ?> เท่านั้น</p>
                    <p class="text-right"><a href="#" class="btn btn-primary">Read me</a></p>
                </div>
            </div>
        </div>

        <div class="span3">
            <div class="thumbnail">
                <img data-src="holder.js/300x200" src="<?php echo $baseUrl; ?>/images/faq.jpg" alt="">
                <div class="caption">
                    <h4>Frequently asked questions <?php echo CHtml::encode(Yii::app()->name); ?></h4>
                    <p>Frequently asked questions are listed questions and answers</p>
                    <p class="text-right"><a href="#" class="btn btn-primary">View Gallery</a></p>
                </div>
            </div>
        </div>

        <div class="span3">
            <div class="thumbnail">
                <img data-src="holder.js/300x200" src="<?php echo $baseUrl; ?>/images/team-building.jpg" alt=""/>
                <div class="caption">
                    <h4>ทำไมต้อง <?php echo CHtml::encode(Yii::app()->name); ?></h4>
                    <p>มาเป็นส่วนหนึ่งกับเรา <?php echo CHtml::encode(Yii::app()->name); ?></p>
                    <p class="text-right"><a href="#" class="btn btn-primary">Read Me</a></p>
                </div>
            </div>
        </div>

        <div class="span3">
            <div class="thumbnail">
                <img data-src="holder.js/300x200" src="<?php echo $baseUrl; ?>/images/Monavie_Lifestyle_5.jpg" alt=""/>
                <div class="caption">
                    <h4>Monavie มีอะไรดีกว่าที่คิด</h4>
                    <p>Monavie………</p>
                    <p class="text-right"><a href="#" class="btn btn-primary">Read Me</a></p>
                </div>
            </div>
        </div>

    </div>

</div>



<script type="text/javascript">
    $('.carousel').carousel({
        interval: 3500
    });
</script>