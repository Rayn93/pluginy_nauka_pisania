<?php
    /*
     * Template Name: Home Page
     */
?>

<?php get_header(); ?>

<section id="header" class="home-slider">
    <div class="wooden">
        <div class="pos-center">
            <div class="slides">
                
                <?php if(function_exists('edu_home_slider_print_slides')): ?>
                    <?php edu_home_slider_print_slides(); ?>
                <?php else: ?>
                
                    <div class="item pepers">
                        <div class="caption">
                            <h3>Czerwone papryczki!</h3>
                            <p>
                                Papryka ostra – ogólna nazwa, jaką określa się owoce niektórych odmian, kultywarów i mieszańców papryki (Capsicum) o bardzo ostrym smaku
                                <a href="#">Czytaj artykuł</a>
                            </p>
                        </div>
                        <img src="<?php echo LOVETOEAT_THEME_URL; ?>home-slider/header-big-peppers1.png" alt="" />
                    </div>
                
                <?php endif; ?>
            </div>

            <div class="pagination">
                <ul>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li class="active"><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                </ul>
            </div>
        </div>
    </div>

    <section class="caption quote">
        <div class="pos-center">
            <blockquote>
                <?php 
                    if(function_exists('edu_cytaty_random_qoute')){
                        edu_cytaty_random_qoute(); 
                    }else{
                        echo '<p>“W gospodarcze opartej na wiedzy możemy mieć ciastko, zjeść ciastko i upiec jeszcze trzecie”</p>';
                    } 
                ?>
            </blockquote>
        </div>
    </section>

    <div class="gradient">
        <div class="pos-center">&nbsp;</div>
    </div>
</section>

<section id="home" class="content">
    <section class="boxes">
        <div class="pos-center">
            
            <section class="box first">
                <div class="step1">
                    <h2>Witaj w lovetoeat!</h2>
                    <p>
                        <?php
                            $box1_text = get_option('edu_sapi_box1_text', '');
                        
                            if(empty($box1_text)){
                                echo 'Witaj w świecie prawdziwych kulinarnych inspiracji! Jesteśmy pasjonatami dobrego jedzenia i chcemy w pięknej formie podzielić się z Tobą naszymi zainteresowaniami.';
                            }else{
                                echo $box1_text;
                            }
                        ?>
                    </p>
                </div>
            </section>

            <section class="box second">
                <div class="step1">
                    <h2>Przepisy i Dieta</h2>
                    
                    <p>
                        <?php
                            $box2_text = get_option('edu_sapi_box2_text', '');
                        
                            if(empty($box2_text)){
                                echo 'Na lovetoeat.pl znajdziesz między innymi dziesiątki zdrowych przepisów, które przygotowali dla Ciebie nasi dietetycy. Najlepsze przepisy wyślij znajomym!';
                            }else{
                                echo $box2_text;
                            }
                        ?>
                    </p>
                </div>
                
                <?php 
                
                    $show_recent_recipies = get_option('edu_sapi_show_recent_recipies', 1);
                
                    if($show_recent_recipies):
                ?>
                
                <div class="step2 hidden">
                    <h2>Ostatnio dodane:</h2>
                    
                    <?php
                        $recipes_query = new WP_Query(array(
                            'numberposts'     => 7,
                            'orderby'         => 'post_date',
                            'order'           => 'DESC',
                            'post_type'       => 'recipes',
                            'post_status'     => 'publish'
                        ));
                        
                        if($recipes_query->have_posts()):
                    ?>
                    <ul class="icons-list">
                        <?php while ($recipes_query->have_posts()): $recipes_query->the_post(); ?>
                        <li class="chicken"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                    <a href="#">Wszystkie przepisy</a>
                    <?php endif;?>
                </div>
                <?php endif;?>
                
            </section>

            <section class="box third">
                <div class="step1">
                    <h2>Dobre Restauracje</h2>
                    <p>
                        <?php
                            $box3_text = get_option('edu_sapi_box3_text', '');
                        
                            if(empty($box3_text)){
                                echo 'Odkryj ciekawe miejsca i dowiedz się, które potrawy warto zjeść w restauracjach, które dla Ciebie recenzujemy. Sprawdź restauracje w których bywają Twoi znajomi.';
                            }else{
                                echo $box3_text;
                            }
                        ?>
                    </p>
                </div>
                
                <?php 
                
                    $show_recent_restaurants = get_option('edu_sapi_show_recent_restaurants', 1);
                
                    if($show_recent_restaurants):
                ?>
                <div class="step2 hidden">
                    <h2>Ostatnio dodane:</h2>
                    
                    <?php
                        $restaurants_query = new WP_Query(array(
                            'numberposts'     => 7,
                            'orderby'         => 'post_date',
                            'order'           => 'DESC',
                            'post_type'       => 'restaurants',
                            'post_status'     => 'publish'
                        ));
                        
                        if($restaurants_query->have_posts()):
                    ?>
                    <ul class="icons-list">
                        <?php while ($restaurants_query->have_posts()): $restaurants_query->the_post(); ?>
                        <li class="waiter"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                    <a href="#">Wszystkie</a>
                    <?php endif;?>
                </div>
                <?php endif;?>
            </section>

        </div>
    </section>

    <section class="food-fight">
        <div class="pos-center">
            <header>
                <h2>Food Fight</h2>
                <h4>Wszystkie pojedynki</h4>
            </header>
            
            <?php $FoodFight = getRandomFoodFight(); ?>
            
            <div class="opponent good">
                <div class="header">
                    <small>Jedz</small>
                    to!
                </div>
                <div class="details">
                    <?php echo $FoodFight->getDobry()->getWyroznione(); ?>
                    <small><?php echo $FoodFight->getWyroznij(); ?></small>
                </div>
                <div class="image">
                    <img src="<?php echo $FoodFight->getDobry()->getGrafika(); ?>" alt="" />
                </div>
                <p><?php echo $FoodFight->getDobry()->getNazwa(); ?></p>
            </div>

            <div class="opponent bad">
                <div class="header">
                    <small>nie</small>
                    to!
                </div>
                <div class="details">
                    <?php echo $FoodFight->getZly()->getWyroznione(); ?>
                    <small><?php echo $FoodFight->getWyroznij(); ?></small>
                </div>
                <div class="image">
                    <img src="<?php echo $FoodFight->getZly()->getGrafika(); ?>" alt="" />
                </div>
                <p><?php echo $FoodFight->getZly()->getNazwa(); ?></p>
            </div>
        </div>
    </section>

    <section class="inspirations">
        <div class="pos-center">
            <header>
                <h2>Kulinarne inspiracje</h2>
                <h4>Zobacz wszystkie artykuły</h4>
            </header>

            <div class="slider">
                <a class="prev" href="#">&LeftArrow;</a>
                <div class="slides-container">
                    <div class="items">
                        
                        <?php 
                            $recent_recipes_loop = new WP_Query(array(
                                        'post_type' => 'recipes',
                                        'posts_per_page' => 6
                                    ));
                            
                            while($recent_recipes_loop->have_posts()): 
                                $recent_recipes_loop->the_post();
                        ?>
                        
                        <div>
                            <?php the_post_thumbnail(); ?>
                            <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                            <p><?php the_excerpt_max_charlength(94); ?></p>
                            <a class="more" href="<?php the_permalink() ?>">...</a>
                        </div>
                        
                        <?php endwhile; ?>
    
                    </div>
                </div>
                <a class="next" href="#">&RightArrow;</a>
            </div>

        </div>
    </section>

    <section class="comments">
        <div class="pos-center">
            <header>
                <h2>Poznaj opinie innych</h2>
                <h4><a href="#">Zobacz wszystkie komentarze</a></h4>
            </header>
            
            <section class="container">
                <span class="flyer">&uArr;</span>
                <?php 
                    $recent_comms = fetchRecentComments(3);
                
                    foreach($recent_comms as $comment): 
                        $date = new \DateTime($comment->comment_date_gmt);
                ?>
                
                    <section>
                        <header>
                            <small><?php echo $comment->comment_author; ?> w dniu <?php echo $date->format('d.m.Y'); ?></small>
                            <?php echo cutText($comment->post_title, 27); ?>
                        </header>
                        <?php echo get_avatar($comment->user_id, 69); ?>
                        <blockquote>
                            <?php echo $comment->comment_content; ?>
                        </blockquote>
                    </section>
                            
                <?php endforeach; ?>
                        
                <div class="clear"></div>
            </section>
        </div>
    </section>
</section>

<?php get_footer('home'); ?>