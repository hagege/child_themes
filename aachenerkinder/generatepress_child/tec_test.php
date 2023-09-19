<?php
/**  Eine function zur Analyse von Multiday-Events */
function tec_test_shortcode() {
	
    global $wpdb;
        
        $q = $wpdb->get_results("SELECT A.post_id AS id, A.meta_key AS KEY1, A.meta_value AS Start_Date, B.meta_key AS KEY2, B.meta_value AS End_Date FROM wpstg0_postmeta A, wpstg0_postmeta B WHERE A.post_id=B.post_id AND A.meta_key='_EventStartDate' AND B.meta_key='_EventEndDate'");
        
        foreach ( $q as $a ) {
            $start = strtotime($a->Start_Date);
            $end = strtotime($a->End_Date);
            $q_total = $end - $start;
            if ( $q_total >= 86400 ) {
                $test_for_event_post_existence = get_post( $a->id );
              if ($test_for_event_post_existence === NULL ) {
                  $exists = "no";
                  }
            else { $exists = "yes"; }
                
            echo "ID: " . $a->id . "  Total in seconds: " . $q_total . " Exists? " . $exists . "<br>";
                
                 }
            }
        
        echo $counting;
        $args = array(
            'post_type' => 'tribe_events',
            'posts_per_page' => -1
        );
    
        $search_posts = get_posts( $args );
    echo count($search_posts); ?> <br><br> <?php
    foreach( $search_posts as $search ) {
        $_ID = $search->ID;
        $multi_end = get_post_meta( $_ID, '_EventEndDate' );
        $multi_start = get_post_meta( $_ID, '_EventStartDate' );
        $multi_end = strtotime( $multi_end[0] );
        $multi_start = strtotime( $multi_start[0] );
        $total = $multi_end - $multi_start;
        if ( $total >= 86400 ) {
            
        }
    }
        //echo count($search_posts); ?>
    <br><br> <?php
    }
    add_shortcode( 'tec-test', 'tec_test_shortcode');
    ?>