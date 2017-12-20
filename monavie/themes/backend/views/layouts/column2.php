<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span3 marginL0"  style="background-color: white;">
    <div id="sidebar" class="box-shadow">
        <?php
        $this->beginContent('//admin/menu');
        $this->endContent();
        ?>
        
    </div><!-- sidebar -->
</div>
<div class="span9">
    <div id="content">
        <?php echo $content; ?>
    </div><!-- content -->
</div>
<?php $this->endContent(); ?>