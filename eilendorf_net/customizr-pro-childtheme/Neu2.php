    //Inhalte sammeln
    /* $content = '<div class="aktuelle_posts_titel">'.$post->post_title.'</div>'; */
    $content .= '<div class="aktuelle_posts">';
    /* $content .= '<div class="aktuelle_posts_titel">Aktuelle Informationen</div>'; */
    $content .= '<hr>';     
    
    foreach ($posts as $post) {
        $content .= '<div class="aktuelle_posts_beitrag">';
        $content .= '<a href="'.get_permalink($post->ID).'"><img src="'.get_the_post_thumbnail_url($post->ID, 'full').'" class="aktuelle_posts_image"></a></div>';
        /* $content .= '<img src="'.get_the_post_thumbnail_url($post->ID, 'full').'" class="thumb">'; */
        $content .= '<div class="aktuelle_posts_beitrag">' . $post->post_excerpt . '</div>';
        $content .= '</div>';
        $content .= '<a href="'.get_permalink($post->ID).'">Weiterlesen</a>';
        
        
        $content .= '<div class="post">';
        $content .= '<a href="'.get_permalink($post->ID).'"><div class="title">'.$post->post_title.'</div></a>';
        $content .= '<a href="'.get_permalink($post->ID).'"><img src="'.get_the_post_thumbnail_url($post->ID, 'full').'" class="thumb"></a>';
        $content .= '<div class="aktuelle_posts_beitrag">' . $post->post_excerpt . '</div>';
        $content .= '</div>';

    }
    $content .= '</div>';
    //Inhalte übergeben




        //Inhalte sammeln
    $content = '<div class="posts">';
    foreach ($posts as $post) {
        $content .= '<div class="post">';
        $content .= '<a href="'.get_permalink($post->ID).'"><div class="title">'.$post->post_title.'</div></a>';
        $content .= '<a href="'.get_permalink($post->ID).'"><img src="'.get_the_post_thumbnail_url($post->ID, 'full').'" class="thumb"></a>';
        $content .= $post->post_excerpt;
        $content .= '<a href="'.get_permalink($post->ID).'">Weiterlesen</a>';
        $content .= '</div>';
    }
    $content .= '</div>';
    //Inhalte übergeben


        //Inhalte sammeln
    $content = '<div class="flex-container">';
    $content .= '<h2>Aktuelle Informationen</h2>';
    // $content .= '<div>';
    // $content .= '</div>';
    $content .= '<hr>';     
    foreach ($posts as $post) {
        // $content .= '<div class="aktuelle_posts_titel">' . $post->post_title .'</div>'; 
        // $content .= '<div class="grid_container_1">';
        $content .= '<div><div class="fc_title">'.$post->post_title.'</a></div>';
        $content .= '<div><a href="'.get_permalink($post->ID).'"><img class="fc_kleines_bild" src="'.get_the_post_thumbnail_url($post->ID, 'full').'"></a></div>';
        $content .= '<div>' . $post->post_excerpt . '</div>';
        $content .= '<div><a href="'.get_permalink($post->ID).'">Weiterlesen</a></div>';
        // $content .= '</div>';
    }
    $content .= '</div></div>';
    //Inhalte übergeben
