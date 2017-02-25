        <footer class="boxes">
            <div class="pos-center">
                <div class="flyer">&nbsp;</div>
                <section class="spaghetti">
                    <h2>Przepisy i Dieta</h2>
                    <ul>
                        <?php
                            $restaurants = new WP_Query(array(
                                'post_type' => 'recipes',
                                'posts_per_page' => 5
                            ));
                            
                            while($restaurants->have_posts()):
                                $restaurants->the_post();
                        ?>
                        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                </section>

                <section class="bread">
                    <h2>Food Fight</h2>
                    <ul>
                        <?php
                            $restaurants = new WP_Query(array(
                                'post_type' => 'foodfight',
                                'posts_per_page' => 5
                            ));
                            
                            while($restaurants->have_posts()):
                                $restaurants->the_post();
                        ?>
                        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                </section>

                <section class="dinner">
                    <h2>Restauracje</h2>
                    <ul>
                        <?php
                            $restaurants = new WP_Query(array(
                                'post_type' => 'restaurants',
                                'posts_per_page' => 5
                            ));
                            
                            while($restaurants->have_posts()):
                                $restaurants->the_post();
                        ?>
                        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                </section>
            </div>
        </footer>

        <?php wp_footer(); ?>

    </body>
</html>