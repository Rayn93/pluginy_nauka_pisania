<div class="right">
    <section class="overview restaurant">
        <div class="difficulty">
            Ocena:
            <ul class="difficulty big">
                <?php printRanking($post->ID); ?>
            </ul>
        </div>
        <div class="middle">Miasto: <?php echo printRestaurantCity($post->ID); ?></div>
        <div>Obiad: <?php echo get_post_meta($post->ID, 'cena obiadu', TRUE); ?></div>
    </section>
    
    <input type="hidden" id="gmap-address" value="<?php echo get_post_meta($post->ID, 'adres', TRUE); ?>" />
    
    <section class="map">
        
    </section>
    
    <?php dynamic_sidebar('restaurant-details-widgets'); ?>

</div>