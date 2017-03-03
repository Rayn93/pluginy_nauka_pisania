<div class="wrap">
    <h2>
        <a href="<?php echo $this->get_admin_url(array('view' => 'index')); ?>" > LTE Home Slider </a>
        <a class="add-new-h2" href="<?php echo $this->get_admin_url(array('view' => 'form')); ?>">Dodaj nowy slajd</a>
    </h2>


    <?php if($this->has_flash_msg()): ?>
        <div id="message" class="<?php echo $this->get_flash_status(); ?>">
            <p><?php echo $this->get_flash_msg(); ?></p>
        </div>
    <?php endif; ?>


    <?php require_once $view; ?>

    <br style="clear: both">


</div>