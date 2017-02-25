<?php get_header(); ?>
        
        <section id="header">

            <section class="caption">
                <div class="pos-center">
                    <h2>Przeglądasz kategorię: <?php echo ucfirst(single_cat_title('', false)); ?></h2>
                </div>
            </section>
            
            <div class="gradient">
                <div class="pos-center">&nbsp;</div>
            </div>
        </section>

        <section id="restaurants" class="content">
            <div class="pos-center">
                <div class="left">
                    
                    <div class="wrapper">
					
						<?php 
							$category_desc = category_description();
							if(!empty($category_desc)) :
						?>
                        
                        <div class="taxonomy-desc">
                            <h2><?php echo ucfirst(single_cat_title('', false)); ?></h2>
                            <p><?php echo $category_desc; ?></p>
                        </div>
						
						<?php endif; ?>
						
						<?php if(have_posts()) : ?>
						
						<?php while(have_posts()) : the_post(); ?>
                        
                        <section class="entry">
                            <div class="description width">
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <div>
                                    <ul class="difficulty dark">
                                        <?php printRanking($post->ID); ?>
                                    </ul>
                                </div>
                                <p><?php the_excerpt_max_charlength(336); ?></p>
                                <a class="more" href="<?php the_permalink(); ?>">...</a>
                            </div>
                        </section>
					<?php endwhile; ?>
					
					<?php else : ?>
					
						<h4 class="no-entries">Brak postów</h4>
						
					<?php endif; ?>
                        
                    </div>

                    <div class="pagination">
                        <ul>
                            <?php
								global $wp_query;
								echo generatePagination(get_query_var('paged'), $wp_query);
							?>
                        </ul>
                    </div>
                </div>

                <?php get_sidebar(); ?>
            </div>
        </section>

        <? get_footer(); ?>