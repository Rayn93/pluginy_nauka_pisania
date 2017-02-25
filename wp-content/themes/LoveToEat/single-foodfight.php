<?php get_header('foodfight'); ?>

<?php 
    the_post();
    $FoodFight = getFoodFight($post->ID);
?>

<script>var IMG_URL = '<?php echo LOVETOEAT_THEME_URL.'img/'; ?>';</script>

<a class="nav left" href="<?php echo get_permalink(get_adjacent_post(false,'',true)); ?>">&lAarr;</a>
<a class="nav right" href="<?php echo get_permalink(get_adjacent_post(false,'',false)); ?>">&lAarr;</a>


<div id="details">
    <header>
        <h2 class="left"><span><?php echo $FoodFight->getTytul(1); ?></span></h2>
        <h2 class="right"><span><?php echo $FoodFight->getTytul(2); ?></span></h2>
    </header>

    <div class="timer">
        <div class="left">
            <img src="<?php echo LOVETOEAT_THEME_URL.'img/'; ?>/counter_0.png" />
        </div>
        <div class="right">
            <img src="<?php echo LOVETOEAT_THEME_URL.'img/'; ?>/counter_3.png" />
        </div>
    </div>

    <div class="tags">
        <?php
            wp_tag_cloud(array(
                'taxonomy' => 'ingredients',
                'smallest' => 11,
                'largest' => 16.5,
                'unit' => 'px'
            ));
        ?>
    </div>

    <div class="info">
        <div class="wrapper">
            <div class="content">
                <?php echo $FoodFight->getTresc(); ?>
            </div>
        </div>
    </div>


    <section class="opponent good">
        <div class="header">
            <small>Jedz</small>
            to!
        </div>
        <div class="details">
            <?php echo $FoodFight->getDobry()->getWyroznione(); ?>
            <small><?php echo $FoodFight->getWyroznij(); ?></small>
        </div>
        <div class="image">
            <div>?</div>
            <img src="<?php echo $FoodFight->getDobry()->getGrafika(); ?>" alt="" />
        </div>
        <p><?php echo $FoodFight->getDobry()->getNazwa(); ?></p>
        <ul>
            <?php foreach($FoodFight->getDobry()->getDane() as $label=>$value): ?>
            <li><?php echo $label; ?> <span><?php echo $value; ?></span></li>
            <?php endforeach; ?>
        </ul>
    </section>

    <section class="opponent bad">
        <div class="header">
            <small>nie</small>
            to!
        </div>
        <div class="details">
            <?php echo $FoodFight->getZly()->getWyroznione(); ?>
            <small><?php echo $FoodFight->getWyroznij(); ?></small>
        </div>
        <div class="image">
            <div>?</div>
            <img src="<?php echo $FoodFight->getZly()->getGrafika(); ?>" alt="" />
        </div>
        <p><?php echo $FoodFight->getZly()->getNazwa(); ?></p>
        <ul>
            <?php foreach($FoodFight->getZly()->getDane() as $label=>$value): ?>
            <li><?php echo $label; ?> <span><?php echo $value; ?></span></li>
            <?php endforeach; ?>
        </ul>
    </section>  
</div>


<?php get_footer('foodfight'); ?>