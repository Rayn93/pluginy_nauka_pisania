<?php


function LTE_home_slider_print_slides(){

    $model = new LTE_Homes_Slider_Model();
    $slide_list = $model->get_slides();

    if(!empty($slide_list)){

        foreach ($slide_list as $entry){

            ?>

            <div class="item pepers">
                <div class="caption">
                    <h3><?php echo $entry->title; ?></h3>
                    <p>
                        <?php echo $entry->caption; ?>
                        <?php if(!empty($entry->read_more_url)): ?>
                            <a href="<?php echo $entry->read_more_url; ?>">Czytaj artykuł</a>
                        <?php endif; ?>
                    </p>
                </div>
                <img src="<?php echo $entry->slide_url; ?>" alt="" />
            </div>

            <?php
        };
    }
}