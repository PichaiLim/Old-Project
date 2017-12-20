<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
$baseUrl = Yii::app()->baseUrl;
?>
&nbsp;
<div class="container-fluid" id="bg-orgen" style="border-top: 10px inset black; border-bottom: 10px inset black;">
    <div class="container" id="page-980">
        <div class="row-fluid">
            <div class="span8" style="border-right: 2px outset black;">
                <!-- Carousel bootstrap.widgets.TbCarousel -->
                <?php $this->beginContent('//slide/showSlide'); ?>
                <?php $this->endContent(); ?>
            </div><!-- Slide -->

            <div class="span4" style="background-color: rgb(191,191,191); height: 320px; border-left: 2px outset black; margin-left: 0px; width: 335px;">
                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="span12 text-center">
                            <?php
                            if (isset(Yii::app()->request->cookies['image'])) {
                                echo CHtml::image(Yii::app()->baseUrl . '/images/members/' . Yii::app()->request->cookies['image'], Yii::app()->request->cookies['name'] . " " . Yii::app()->request->cookies['lastname'], array('id' => 'myimage', 'class' => 'img-circle', 'style' => 'border:5px solid black; background-color: #FFF;'));
                            } else {
                                echo CHtml::image(Yii::app()->baseUrl . ' /images/members/team-member.png', NULL, array('class' => 'img-circle', 'class' => 'img-circle', 'style' => 'border:5px solid black; background-color: #FFF;'));
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12" style="word-break: break-all; color: black;">
                            <h4 align="center">ติดต่อผู้แนะนำ</h4>
                            <p>ชื่อ : <?php echo Yii::app()->request->cookies['name'] . ' ' . Yii::app()->request->cookies['lastname']; ?></p>
                            <p>เบอร์โทร : <?php echo Yii::app()->request->cookies['tel']; ?></p>
                            <p>อีเมล์ : <?php echo Yii::app()->request->cookies['email']; ?></p>
                            <p>Username : <?php echo Yii::app()->request->cookies['username']; ?></p>
                        </div>
                    </div>
                </div>
            </div><!-- คนแนะนำ -->
        </div>
    </div>
</div>

&nbsp;

<div id="page-980" class="container" style="background-color: white; padding: 5px;">
    <div class="row-fluid">
        <div class="span8">
            <div class="span12">
                <div class="row-fluid border1" style="background: #000000; color: #FFFFFF;"> <!--style="background-color: #000000; color: #ffffff">-->
                    <div class="span12" style="padding: 5px;">
                        <h4><i class="icon-bullhorn icon-white"></i>&nbsp;New Feed</h4>
                    </div>
                </div>

                <div class="row-fluid border1"><!-- style=" padding: 5px;"> -->
                    <div class="span12" style="border: 3px inset #f36921;"><?php $this->beginContent('//newFeed/newFeed') ?><?php $this->endContent(); ?></div>
                </div>
            </div>
            <br/>
            <div class="clearfix"></div>
            <br/>
            <div class="span12">
                <!-- Menu Basic Tabs -->
                <div class="tabbable"> <!-- Only required for left/right tabs -->

                    <ul class="nav nav-tabs">
                        <li class="navtab active"><a href="#tab1" data-toggle="tab"><b>ข่าวสารกิจกรรม</b></a></li>
                        <li class="navtab"><a href="#tab2" data-toggle="tab"><b>บทความที่หน้าสนใจ</b></a></li>
                        <li class="navtab"><a href="#tab3" data-toggle="tab"><b>tab 3</b></a></li>
                        <li class="navtab"><a href="#tab4" data-toggle="tab"><b>tab 4</b></a></li>
                        <li class="navtab"><a href="#tab5" data-toggle="tab"><b>tab 5</b></a></li>
                    </ul>

                    <div class="tab-content" style="overflow: hidden;">

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
                            <div class="text-right text-info">
                                view more 3
                            </div>
                            content 3
                        </div>


                        <div class="tab-pane" id="tab4">
                            <div class="text-right text-info">
                                view more 4
                            </div>
                            content 4
                        </div>


                        <div class="tab-pane" id="tab5">
                            <div class="text-right text-info">
                                view more 5
                            </div>
                            content 5
                        </div>

                    </div>
                </div>
            </div>
        </div><!-- News & Events -->

        <div class="span4">
            <div class="row-fluid">
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
                        <?php echo $form->textField($model, 'tel', array('class' => 'span8', 'placeholder' => 'You Phone & Number Line')); ?>
                    </p>

                    <?php echo $form->error($model, 'tel', array('class' => 'alert alert-error span12 text-center')); ?>

                    <p>
                        <label class="span4 text-right"><b>อีเมล์ :&nbsp;</b></label>
                        <?php echo $form->textField($model, 'email', array('class' => 'span8', 'placeholder' => 'Email & Email Line')); ?>
                    </p>

                    <?php echo $form->error($model, 'email', array('class' => 'alert alert-error span12 text-center')); ?>

                    <p class="text-right space-padding-right space-padding-bottom">
                        <button type="submit" name="submit" class="btn btn-success">
                            <i class="icon-pencil icon-white"></i>
                            สมัครสมาชิก
                        </button>
                    </p>
                    <?php $this->endWidget(); ?>
                </div>
            </div><!-- Register -->

            <div class="row-fluid">
                <div class="span12" style="background-color: #e4e4e4; border: 2px inset #f36921;">
                    <div class="span12" style="padding-left: 10px;">
                        <h4>ขอต้อนรับผู้ร่วมธุรกิจใหม่</h4>
                    </div>
                    <div class="clearfix"></div>
                    <div class="container-fluid">
                        <div class="row-fluid slideup">
                            <div class="span12" style="height: 300px;">
                                <marquee direction='up' scrollAmount='2' scrolldelay='80' onmouseover='this.stop();' onmouseout='this.start();' style="height: 290px;">
                                    <?php
                                    $criteria = new CDbCriteria();
                                    $criteria->condition = "status != '0'";
                                    $criteria->order = 'id DESC';

                                    $modelcount = new Member;

                                    $dataProvider = new CActiveDataProvider($modelcount, array('criteria' => $criteria));
                                    $dataProvider->pagination = array('pagesize' => 50);

                                    if ($modelcount->count() > 0) {

                                        $this->widget('zii.widgets.CListView', array(
                                            'dataProvider' => $dataProvider,
                                            'template' => "{items}\n{pager}",
                                            'itemView' => '_userListView',
                                        ));
                                    }
                                    ?>
                                </marquee>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            &nbsp;
            <div class="row-fluid">
                <div class="span12">
                    <iframe width="305" height="208" src="//www.youtube.com/embed/am_CggC80OU?&AMP;autoplay=1&AMP;rel=0" frameborder="0" allowfullscreen></iframe>
                </div>
            </div><!-- Video -->
            &nbsp;
            <div class="row-fluid White-Gloss2">
                <div class="span12 thumbnail">
                    <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2F2pm4you%2F514984698571927&amp;width=305&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:305px; height:258px;" allowTransparency="true"></iframe>
                </div>
            </div><!-- FaceBook FanPage -->

        </div>

    </div>
    &nbsp;

    <div class="row-fluid">
        <div class="span6">
            <div class="container-fluid" style="background-color: black; color: white;">
                <div class="row-fluid">
                    <div class="span12" style="margin-top: 0;">
                        <h5><i class="icon-picture icon-white"></i>&nbsp;Picture</h5>
                    </div>
                </div>
            </div>

            <div class="container-fluid" style="border: 3px solid #f36921;">
                <div class="row-fluid">
                    <div class="span12" style="margin-top: 0; border-bottom: 1px solid black;">
                        <?php
                        $this->beginContent('//picture/tabPicture');
                        $this->endContent();
                        ?>
                    </div>
                    &nbsp;
                    <div class="text-right text-info">
                        <?php echo CHtml::link('View More…', array('//Gallery/Picture')); ?>
                    </div>
                    &nbsp;
                </div>
            </div>
        </div><!-- Picture -->

        <div class="span6">
            <div class="container-fluid" style="background-color: black; color: white;">
                <div class="row-fluid">
                    <div class="span12" style="margin-top: 0;">
                        <h5><i class="icon-facetime-video icon-white"></i>&nbsp;Video</h5>
                    </div>
                </div>
            </div>

            <div class="container-fluid" style="border: 3px solid #f36921;">
                <div class="row-fluid">
                    <div class="span12" style="margin-top: 0; border-bottom: 1px solid black;">
                        <?php
                        $this->beginContent('//picture/tabVideo');
                        $this->endContent();
                        ?>
                    </div>
                    &nbsp;
                    <div class="text-right text-info">
                        <?php echo CHtml::link('View More…', array('//Gallery/Video')); ?>
                    </div>
                    &nbsp;
                </div>
            </div>
        </div><!-- Video -->
    </div>
</div><!-- News & Event | aside -->

&nbsp;

