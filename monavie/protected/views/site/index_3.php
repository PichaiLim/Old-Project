<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
$baseUrl = Yii::app()->baseUrl;
?>
<div class="White-Gloss2">
    <div id="page-980" class="container" >
        <!-- Carousel bootstrap.widgets.TbCarousel -->
        <div id="myCarousel" class="carousel slide">
            <?php $this->beginContent('//slide/showSlide'); ?>
            <?php $this->endContent(); ?>
        </div>
    </div>
</div>

<div id="page-980" class="container">
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
                            <div class="text-right text-info">
                                <?php echo CHtml::link('View More…', array('//Posts/NewEvent')); ?>
                            </div>
                            <?php $this->beginContent('//newsevent/newsevent'); ?>
                            <?php $this->endContent(); ?>
                        </div>


                        <div class="tab-pane" id="tab2">
                            <div class="text-right text-info">
                                <?php echo CHtml::link('View More…', array('//Posts/Article')); ?>
                            </div>
                            <?php $this->beginContent('//article/articleList'); ?>
                            <?php $this->endContent(); ?>
                        </div>

                        <div class="tab-pane" id="tab3">
                            <?php
                            $this->beginContent('//picture/tabPicture');
                            $this->endContent();
                            ?>
                            <div class="text-right text-info">
                                <?php echo CHtml::link('View More…', array('//Gallery/Picture')); ?>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab4">
                            <?php
                            $this->beginContent('//picture/tabVideo');
                            $this->endContent();
                            ?>
                            <div class="text-right text-info" style="margin-top: 10px;">
                                <?php echo CHtml::link('View More…', array('//Gallery/Video')); ?>
                            </div>
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
                    'action' => Yii::app()->createUrl("//Member/MemberRegister"),
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

            &nbsp;

            <div class="text-center" style="margin-left: 0px;">
<!--                <iframe src="http://player.vimeo.com/video/34767375?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1&amp;loop=1" width="370" height="278" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                <iframe width="370" height="278" src="//www.youtube.com/embed/wsirF3sKUNQ?&autoplay=1&rel=0" frameborder="0" allowfullscreen></iframe>-->
                <iframe width="305" height="208" src="//www.youtube.com/embed/am_CggC80OU?&AMP;autoplay=1&AMP;rel=0" frameborder="0" allowfullscreen></iframe>
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

                    <div class="span7 text-left" style="word-break: break-all;">
                        <h3>ติดต่อผู้แนะนำ</h3>
                        <p><?php echo Yii::app()->request->cookies['name'] . ' ' . Yii::app()->request->cookies['lastname']; ?></p>
                        <p><?php echo Yii::app()->request->cookies['tel']; ?></p>
                        <p><?php echo Yii::app()->request->cookies['email']; ?></p>
                        <p>Username : <?php echo Yii::app()->request->cookies['username']; ?></p>
                    </div>

                </div>
            <?php endif; ?>
            <div class="span12 thumbnail" style="margin: 0px;">
                <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2F2pm4you%2F514984698571927&amp;width=305&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:305px; height:258px;" allowTransparency="true"></iframe>
            </div>
        </div>

    </div>

    &nbsp;<!--
    <div id="page-980" class="container">

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

    </div>-->

</div>