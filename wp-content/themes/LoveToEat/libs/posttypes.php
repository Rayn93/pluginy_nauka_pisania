<?php 

    add_action('init', 'lovetoeat_init_posttypes');
    
    function lovetoeat_init_posttypes(){
        
        
        /*
         * Register Recipes Post Type
         */
        $recipes_args = array(
            'labels' => array(
                'name' => 'Przepisy',
                'singular_name' => 'Przpisy',
                'all_items' => 'Wszystkie przepisy',
                'add_new' => 'Dodaj nowy przepis',
                'add_new_item' => 'Dodaj nowy przepis',
                'edit_item' => 'Edytuj przepis',
                'new_item' => 'Nowy przepis',
                'view_item' => 'Zobacz przepis',
                'search_items' => 'Szukaj w przepisach',
                'not_found' =>  'Nie znaleziono żadnych przepisów',
                'not_found_in_trash' => 'Nie znaleziono żadnych przepisów w koszu', 
                'parent_item_colon' => ''
            ),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true, 
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_position' => 5,
            'supports' => array(
                'title','editor','author','thumbnail','excerpt','comments','custom-fields'
            ),
            'has_archive' => true            
        );
        
        register_post_type('recipes', $recipes_args);
        
        
        
        /*
         * Register Restaurant Post Type
         */
        $restaurants_args = array(
            'labels' => array(
                'name' => 'Restauracje',
                'singular_name' => 'Restauracje',
                'all_items' => 'Wszystkie restauracje',
                'add_new' => 'Dodaj nową restaurację',
                'add_new_item' => 'Dodaj nową restaurację',
                'edit_item' => 'Edytuj restaurację',
                'new_item' => 'Nowa restauracja',
                'view_item' => 'Zobacz restaurację',
                'search_items' => 'Szukaj restauracji',
                'not_found' =>  'Nie znaleziono żadnych restauracji',
                'not_found_in_trash' => 'Nie znaleziono żadnych restauracji w koszu', 
                'parent_item_colon' => ''
            ),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true, 
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_position' => 5,
            'supports' => array(
                'title','editor','author','thumbnail','excerpt','comments','custom-fields', 'post-formats'
            ),
            'has_archive' => true
            
        );
        
        register_post_type('restaurants', $restaurants_args);
        
        
        
        /*
         * Register Food Fight Post Type
         */
        $food_fights_args = array(
            'labels' => array(
                'name' => 'Food Fight',
                'singular_name' => 'Food Fight',
                'all_items' => 'Wszystkie pojedynki',
                'add_new' => 'Dodaj nowy pojedynek',
                'add_new_item' => 'Dodaj nowy pojedynek',
                'edit_item' => 'Edytuj pojedynek',
                'new_item' => 'Nowy pojedynek',
                'view_item' => 'Zobacz pojedynek',
                'search_items' => 'Szukaj pojedynku',
                'not_found' => 'Nie znaleziono żadnych pojedynków',
                'not_found_in_trash' => 'Nie znaleziono żadnych pojedynków w koszu', 
                'parent_item_colon' => ''
            ),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true, 
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_position' => 5,
            'supports' => array(
                'title','editor','author','thumbnail','custom-fields'
            ),
            'has_archive' => true
            
        );
        
        register_post_type('foodfight', $food_fights_args);
    }
    
    
    
    add_action('init', 'lovetoeat_init_taxonomies');
    
    
    
    function lovetoeat_init_taxonomies(){
        
        // Ingredients
        register_taxonomy(
            'ingredients',
            array('recipes'),
            array(
                'hierarchical' => true,
                'labels' => array(
                    'name' => 'Składniki',
                    'singular_name' => 'Składniki',
                    'search_items' =>  'Wyszukaj składniki',
                    'popular_items' => 'Najpopularniejsze składniki',
                    'all_items' => 'Wszystkie składniki',
                    'most_used_items' => null,
                    'parent_item' => null,
                    'parent_item_colon' => null,
                    'edit_item' => 'Edytuj składnik', 
                    'update_item' => 'Aktualizuj składnik',
                    'add_new_item' => 'Dodaj nowy składnik',
                    'new_item_name' => 'Nazwa nowego skadnika',
                    'separate_items_with_commas' => 'Oddziel składniki przecinkiem',
                    'add_or_remove_items' => 'Dodaj lub usuń składniki',
                    'choose_from_most_used' => 'Wybierz spośród najczęścież używanych składników',
                    'menu_name' => 'Składniki',
                ),
                'show_ui' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array('slug' => 'ingredient' )
        ));
        
        
        // Meal Types
        register_taxonomy(
            'meal-type',
            array('recipes', 'restaurants'),
            array(
                'hierarchical' => true,
                'labels' => array(
                    'name' => 'Typ Dania', 'taxonomy general name',
                    'singular_name' => 'Typ Dania', 'taxonomy singular name',
                    'search_items' =>  'Wyszukaj typ dania',
                    'popular_items' => 'Najpopularniejsze typy dań',
                    'all_items' => 'Wszystkie typy dań',
                    'most_used_items' => null,
                    'parent_item' => null,
                    'parent_item_colon' => null,
                    'edit_item' => 'Edytuj typ dania', 
                    'update_item' => 'Aktualizuj',
                    'add_new_item' => 'Dodaj nowy typ dania',
                    'new_item_name' => 'Nazwa nowego typu dania',
                    'separate_items_with_commas' => 'Oddziel typy dań przecinkiem',
                    'add_or_remove_items' => 'Dodaj lub usuń typ dania',
                    'choose_from_most_used' => 'Wybierz spośród najczęścież używanych typów dań',
                    'menu_name' => 'Typ Dania',
                ),
                'show_ui' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array('slug' => 'meal-type' )
        ));
        
        
        
        // Cousine Types
        register_taxonomy(
            'cousine-type',
            array('recipes', 'restaurants'),
            array(
                'hierarchical' => true,
                'labels' => array(
                    'name' => 'Rodzaj kuchni',
                    'singular_name' => 'Rodzaj kuchni',
                    'search_items' =>  'Wyszukaj rodzaj kuchni',
                    'popular_items' => 'Najpopularniejsze rodzaje kuchni',
                    'all_items' => 'Wszystkie rodzaje kuchni',
                    'most_used_items' => null,
                    'parent_item' => null,
                    'parent_item_colon' => null,
                    'edit_item' => 'Edytuj rodzaj kuchni', 
                    'update_item' => 'Aktualizuj',
                    'add_new_item' => 'Dodaj nowy rodzaj kuchni',
                    'new_item_name' => 'Nazwa nowego rodzaju kuchni',
                    'separate_items_with_commas' => 'Oddziel rodzaje kuchni przecinkiem',
                    'add_or_remove_items' => 'Dodaj lub usuń rodzaj kuchni',
                    'choose_from_most_used' => 'Wybierz spośród najczęściej używanych rodzajów kuchni',
                    'menu_name' => 'Rodzaj kuchni',
                ),
                'show_ui' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array('slug' => 'cousine-type' )
        ));
        
        
        // Cities
        register_taxonomy(
            'city',
            array('restaurants'),
            array(
                'hierarchical' => FALSE,
                'labels' => array(
                    'name' => 'Miasto',
                    'singular_name' => 'Miasto',
                    'search_items' =>  'Wyszukaj miasto',
                    'popular_items' => 'Najpopularniejsze miasto',
                    'all_items' => 'Wszystkie miasta',
                    'most_used_items' => null,
                    'parent_item' => null,
                    'parent_item_colon' => null,
                    'edit_item' => 'Edytuj miasto', 
                    'update_item' => 'Aktualizuj',
                    'add_new_item' => 'Dodaj nowe miasto',
                    'new_item_name' => 'Nazwa nowego miasta',
                    'separate_items_with_commas' => 'Oddziel miasta przecinkiem',
                    'add_or_remove_items' => 'Dodaj lub usuń miasto',
                    'choose_from_most_used' => 'Wybierz spośród najczęściej używanych miast',
                    'menu_name' => 'Miasto',
                ),
                'show_ui' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array('slug' => 'city' )
        ));
        
    }
    
    
    add_action('admin_head', 'lte_admin_icons');
    function lte_admin_icons(){
        $ICON_URL = LOVETOEAT_THEME_URL.'img/admin/';
        
        ?>
<style>
    
    #menu-posts-recipes .wp-menu-image,
    #menu-posts-restaurants .wp-menu-image,
    #menu-posts-foodfight .wp-menu-image{
        background-repeat: no-repeat;
        background-position: center -17px!important;
    }
    
    #menu-posts-recipes:hover .wp-menu-image,
    #menu-posts-restaurants:hover .wp-menu-image,
    #menu-posts-foodfight:hover .wp-menu-image,
    #menu-posts-recipes.wp-has-current-submenu .wp-menu-image,
    #menu-posts-restaurants.wp-has-current-submenu .wp-menu-image,
    #menu-posts-foodfight.wp-has-current-submenu .wp-menu-image{
        background-repeat: no-repeat;
        background-position: center 6px!important;
    }
    
    #menu-posts-recipes .wp-menu-image{
        background-image: url('<?php echo $ICON_URL.'icon-recipes-menu.png' ?>');
    }
    
    #menu-posts-restaurants .wp-menu-image{
        background-image: url('<?php echo $ICON_URL.'icon-restaurants-menu.png' ?>');
    }
    
    #menu-posts-foodfight .wp-menu-image{
        background-image: url('<?php echo $ICON_URL.'icon-foodfight-menu.png' ?>');
    }
    
    
    .icon32-posts-recipes,
    .icon32-posts-restaurants,
    .icon32-posts-foodfight{
        background-position: center center!important;
    }
    
    .icon32-posts-recipes{
        background-image: url('<?php echo $ICON_URL.'icon-recipes-header.png' ?>')!important;
    }
    
    .icon32-posts-restaurants{
        background-image: url('<?php echo $ICON_URL.'icon-restaurants-header.png' ?>')!important;
    }
    
    .icon32-posts-foodfight{
        background-image: url('<?php echo $ICON_URL.'icon-foodfight-header.png' ?>')!important;
    }
    
</style>
        <?php
    }

?>
