<script type="text/javascript">
$(function(){
    $('.aaa').click(function(){
        var a =$('.cc').val();
        alert(a);
//        window. showModalDialog();
    });
});
</script>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $modelView,
    'enableSorting' => TRUE,
    'template' => "{items}\n{pager}", //"{summary}\n{sorter}\n{items}\n{pager}",
    'itemView' => '//gallery/_processGalleryView',
));
?>
