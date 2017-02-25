<?php get_header(); ?>

<?php the_post(); ?>

<section id="header" class="entry">

    <div class="wooden">
        <div class="pos-center">
            <header>
                <h3><?php the_title(); ?></h3>
            </header>
        </div>
    </div>

    <section class="caption"></section>
    
    <div class="gradient">
        <div class="pos-center">&nbsp;</div>
    </div>
</section>

<section id="entry" class="content">
    <div class="pos-center">
        <article class="left">
            
            <?php the_content(); ?>
            
            <?php the_tags(); ?>

            <?php comments_template(); ?>

        </article>

        <?php get_sidebar(); ?>
    </div>
</section>


<?php get_footer(); ?>