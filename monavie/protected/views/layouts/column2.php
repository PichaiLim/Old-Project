<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
&nbsp;
<div class="container-fluid">
    <div id="page-980" class="container border1" style="background-color: white; padding: 5px;">
        <div class="row-fluid">
            <div class="span8">
                <?php echo $content;?>
            </div>

            <div class="span4">
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
                &nbsp;
                <div>
                    <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2F2pm4you%2F514984698571927&amp;width=305&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:305px; height:258px;" allowTransparency="true"></iframe>
                </div>
                <div class="text-center">
          <!--                <iframe src="http://player.vimeo.com/video/34767375?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1&amp;loop=1" width="370" height="278" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                          <iframe width="370" height="278" src="//www.youtube.com/embed/wsirF3sKUNQ?&autoplay=1&rel=0" frameborder="0" allowfullscreen></iframe>-->
                    <iframe width="305" height="208" src="//www.youtube.com/embed/am_CggC80OU?&AMP;autoplay=1&AMP;rel=0" frameborder="0" allowfullscreen></iframe>
                </div><!--video-->

            </div>
        </div>

    </div>
</div>
&nbsp;
<?php $this->endContent(); ?>