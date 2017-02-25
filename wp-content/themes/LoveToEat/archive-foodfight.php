<?php get_header('foodfight'); ?>

    <div id="archive">

        <?php
            $query_params = getQueryParams();
            $query_params['posts_per_page'] = 8;
            
            $loop = new WP_Query($query_params);
            
            while($loop->have_posts()): 
                $loop->the_post(); 
                $title = explode('vs', get_the_title());
        ?>
            <a href="<?php the_permalink(); ?>" id="fight-<?php the_ID(); ?>" <?php post_class(); ?>>
                <section class="fight">
                    <header>
                        <h2 class="left"><?php echo trim($title[0]); ?></h2>
                        <h2 class="right"><?php echo trim($title[1]); ?></h2>
                    </header>
                    <?php the_post_thumbnail(); ?>
                </section>
            </a>

        <?php endwhile; ?>
    </div>


    <a class="nav left" href="<?php echo previous_posts(TRUE); ?>">&lAarr;</a>

    <a class="nav right" href="<?php echo next_posts($loop->max_num_pages, TRUE); ?>">&rAarr;</a>
        
<?php get_footer('foodfight'); ?>