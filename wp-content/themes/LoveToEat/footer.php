<footer class="boxes">
            <div class="pos-center">
                <div class="flyer">&nbsp;</div>
                <section class="spaghetti">
                    <h2>Przepisy i Dieta</h2>
                    <ul>
                        <?php
							$przepisy = new WP_Query(array(
								'post_type' => 'recipes',
								'posts_per_page' => 5
							));
							
							while($przepisy->have_posts()): $przepisy->the_post();						
						?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
						<?php endwhile; ?>
                    </ul>
                </section>

                <section class="bread">
                    <h2>Food Fight</h2>
                    <ul>
                        <?php
							$foodfight = new WP_Query(array(
								'post_type' => 'foodfight',
								'posts_per_page' => 5
							));
							
							while($foodfight->have_posts()): $foodfight->the_post();						
						?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
						<?php endwhile; ?>
                    </ul>
                </section>

                <section class="dinner last">
                    <h2>Restauracje</h2>
                    <ul>
                        <?php
							$restauracje = new WP_Query(array(
								'post_type' => 'restaurants',
								'posts_per_page' => 5
							));
							
							while($restauracje->have_posts()): $restauracje->the_post();						
						?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
						<?php endwhile; ?>
                    </ul>
                </section>
            </div>
        </footer>
        
    </body>
</html>