

<style type="text/css">
    .span5{
        margin-top: 10px;
    }
    .span5:nth-child(odd){
        margin-left: 0px;
    }
</style>

<!--<div class="span5 text-center">
<?php if ($data->category == 1): ?>
    <?php echo CHtml::image($data->link, $data->gallerys->name, array('class' => 'img-polaroid thumbnail')); ?>
                <br/>
                <tt>
    <?php echo CHtml::encode($data->gallerys->name) ?>
                </tt>
<?php else: ?>
    <?php
    $this->beginWidget('ext.EjwPlayer.EjwPlayer', array(
        'width' => 600,
        'height' => 400,
        'title' => $data->gallerys->name,
        //'autostart'=> 'TRUE', // TRUE or FALSE
        //'repeat'=> 'TRUE', // TRUE or FALSE
        'controls' => 'TRUE', // TRUE or FALSE
        'stretching' => 'uniform', //(default: 'uniform') Options are: none, exactfit, uniform, fill
        'playlist' => array(
            array(
                'title' => $data->name,
                'sources' => array(
                    array('file' => $data->link),
                )
            ),
        ),
    ));
    $this->endWidget();
    ?>
<?php endif; ?>
</div>-->

<div class="container-fluid">
    <div class="row-fluid">
        <?php if ($data->category == 1): ?>
            <div class="span12">
                <?php echo CHtml::image($data->link, $data->gallerys->name, array('class' => 'img-polaroid thumbnail')); ?>
                <tt>
                    <center><?php echo CHtml::encode($data->gallerys->name) ?></center>
                </tt>
            </div>
        <?php else: ?>
            <?php
            $this->beginWidget('ext.EjwPlayer.EjwPlayer', array(
                'width' => 600,
                'height' => 400,
                'title' => $data->gallerys->name,
                //'autostart'=> 'TRUE', // TRUE or FALSE
                //'repeat'=> 'TRUE', // TRUE or FALSE
                'controls' => 'TRUE', // TRUE or FALSE
                'stretching' => 'uniform', //(default: 'uniform') Options are: none, exactfit, uniform, fill
                'playlist' => array(
                    array(
                        'title' => $data->name,
                        'sources' => array(
                            array('file' => $data->link),
                        )
                    ),
                ),
            ));
            $this->endWidget();
            ?>
        <?php endif; ?>
    </div>
</div>
<br/>