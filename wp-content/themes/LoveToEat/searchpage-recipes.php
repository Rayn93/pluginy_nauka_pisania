<?php
    /*
        Template Name: Wyszukiwanie po składnikach
    */
?>

<?php
    $search_ingr = TRUE;

    if(isset($_GET['ingredients'])){
        $ingedients = array_keys($_GET['ingredients']);
    }else{
        $ingedients = array();
    }

    $loop = new WP_Query(array(
        'post_type' => 'recipes',
        'tax_query' => array(
            array(
                'taxonomy' => 'ingredients',
                'field' => 'slug',
                'terms' => $ingedients
            )
        )
    ));
    
    get_template_part('content', 'recipes');
?>