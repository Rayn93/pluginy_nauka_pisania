	<?php get_header(); ?>
        
        <section id="header">

            <div class="map"></div>
			
			<script>var restaurantsList = JSON.parse('<?php echo json_encode(getRestaurantsCountByCities()); ?>')</script>
			

            <section class="caption restaurant">
                <div class="pos-center">
				
				<?php $search = getQuerySingleParam('search'); ?>
				
                    <form class="search" method="get" action="<?php getCurrentPageUrl(); ?>">
                        <label for="search">Znajdź restaurację:</label>
                        <fieldset>
                            <input type="text" name="search" id="search" value="<?php echo $search ?>" />
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
					
					<?php
						$query_params = getQueryParams();
							if(isset($query_params['search'])) {
								$query_params['post_title_like'] = $query_params['search'];
								unset($query_params['search']);
							}

						$loop = new WP_Query($query_params);
					?>
					
                    
                    <div class="wrapper">
					
					<?php if($loop->have_posts()) :?>
					
					<?php while ($loop->have_posts()) : $loop->the_post(); ?>
					
					<section id="restaurants-<?php the_ID();?>" <?php post_class('entry'); ?>>
					
					<?php if(get_post_format($post->ID) == 'gallery'): ?>
					
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                            <div class="description">
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <div>
                                    <?php printRestaurantCategories($post->ID) ?>
                                    <ul class="difficulty dark">
 
										<?php printRanking($post->ID); ?>
                                    </ul>
                                </div>
                                <p><?php the_excerpt_max_charlength(173); ?></p>
                                <a class="more" href="<?php the_permalink(); ?>">...</a>
                            </div>
							
                    <?php else: ?> 
					
							<div class="description width">
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <div>
                                    <?php printRestaurantCategories($post->ID) ?>
                                    <ul class="difficulty dark">
 
										<?php printRanking($post->ID); ?>
                                    </ul>
                                </div>
                                <p><?php the_excerpt_max_charlength(173); ?></p>
                                <a class="more" href="#">...</a>
                            </div>

					<?php endif; ?>
					</section>

					<?php endwhile; ?>
					
					<?php else: ?>
						<h4>Nie ma żadnych postów</h4>
						
					<?php endif; ?>
                        
                    </div>

                    <div class="pagination">
                        <?php generatePagination(get_query_var('paged'), $loop); ?>
                    </div>
                </div>

                <?php get_sidebar('restaurants-archive'); ?>   
				
            </div>
        </section>

        <?php get_footer(); ?>