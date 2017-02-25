<div class="right">
    <section class="overview">
        <div class="difficulty">
            Ocena:
            <ul class="difficulty big">
                <?php printRanking($post->ID); ?>
            </ul>
        </div>
        <div class="time middle">Czas: <?php echo printPreparationTime($post->ID); ?></div>
        <div class="diet">Dieta: <?php echo get_post_meta($post->ID, 'kalorie', TRUE); ?> kcal</div>
    </section>

    <section class="ingredients">
        <h2>Składniki</h2>
        <a class="print" href="#">Wydrukuj</a>
        <?php printRecipeIngredients($post->ID); ?>
    </section>
    
    <?php dynamic_sidebar('recipe-details-widgets'); ?>

</div>