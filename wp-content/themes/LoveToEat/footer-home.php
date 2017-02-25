        <footer>
            <div class="pos-center">
                <section class="menu">
                    <?php
                        $taxonomies_list = array('ingredients', 'cousine-type', 'meal-type');
                        foreach($taxonomies_list as $taxonomy):
                            $terms_list = get_terms($taxonomy, array(
                                'orderby' => 'count',
                                'hide_empty' => 0,
                                'number' => 5
                            ));
                    ?>
                    <ul>
                        <?php 
                            foreach($terms_list as $term): 
                                $url = get_term_link($term->slug, $term->taxonomy);
                                $name = ucfirst(mb_strtolower($term->name));
                        ?>                 
                        <li><a href="<?php echo $url; ?>"><?php echo $name; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endforeach; ?>
                </section>

                <section class="tag-cloud">
                    <?php 
                        wp_tag_cloud(array(
                            'taxonomy' => 'ingredients',
                            'smallest' => 11,
                            'largest' => 16.5,
                            'unit' => 'px'
                        )); 
                    ?>
                </section>
            </div>
        </footer>

        <?php wp_footer(); ?>

    </body>
</html>