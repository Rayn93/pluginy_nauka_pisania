<?php get_header(); ?>

<section id="header">
        
    <div class="slider archive">
        <div class="pos-center">
            
        </div>
    </div>

    <section class="caption restaurant">
        <div class="pos-center">
            
            <?php $search = getQuerySingleParam('search'); ?>
            
            <form class="search" method="get" action="<?php echo getCurrentPageUrl(); ?>">
                <label for="search">Znajdź wpis:</label>
                <fieldset>
                    <input type="text" name="search" id="search" value="<?php echo $search; ?>" />
                    <input type="submit" value="" />
                </fieldset>
            </form>
        </div>
    </section>
    <div class="gradient">
        <div class="pos-center">&nbsp;</div>
    </div>
</section>

<section id="restaurants" class="content">
    <div class="pos-center">
        
        <div class="left">
            
            <?php if(isset($search)): ?>
                <h4 class="search-results">Wynik wyszukiwania:</h4>
            <?php endif; ?>

            <div class="wrapper">
                
                <?php   
                    $query_params = getQueryParams();
                    
                    if(isset($query_params['search'])){
                        $query_params['post_title_like'] = $query_params['search'];
                        unset($query_params['search']);
                    }
                    
                    $loop = new WP_Query($query_params);
                ?>
                
                <?php if($loop->have_posts()) : ?>
                
                    <?php while($loop->have_posts()): $loop->the_post(); ?>
                    <section class="entry">
                        <div class="description width">
                            <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                            <div><?php printPostCategories($post->ID); ?></div>
                            <p><?php the_excerpt_max_charlength(160); ?></p>
                            <a class="more" href="<?php the_permalink() ?>">...</a>
                        </div>
                    </section>
                    <?php endwhile; ?>
                
                <?php else: ?>
                
                    <h4 class="no-entries">Brak wpisów</h4>
                    
                <?php endif; ?>
                
            </div>

            <div class="pagination">
                <?php echo generatePagination(get_query_var('paged'), $loop); ?>
            </div>
            
        </div>

        
       <?php get_sidebar(); ?>
        
    </div>
</section>

<?php get_footer(); ?>