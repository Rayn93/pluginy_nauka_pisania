<?php
    $query_params = getQueryParams();
    if(isset($query_params['search'])){
        $query_params['post_title_like'] = $query_params['search'];
        unset($query_params['search']);
    }

    $loop = new WP_Query($query_params);
    
    get_template_part('content', 'recipes');
?>