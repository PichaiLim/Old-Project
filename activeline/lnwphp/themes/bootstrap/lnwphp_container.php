<div class="lnwphp<?php echo $this->is_rtl ? ' lnwphp_rtl' : ''?>">
    <?php echo $this->render_table_name(false, 'div', true)?>
    <div class="lnwphp-container"<?php echo ($this->start_minimized) ? ' style="display:none;"' : '' ?>>
        <div class="lnwphp-ajax">
            <?php echo $this->render_view() ?>
        </div>
        <div class="lnwphp-overlay"></div>
    </div>
</div>