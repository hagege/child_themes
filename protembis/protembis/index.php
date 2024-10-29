<?php get_header();?>
  <main class="content">
   <div class="container">  
    <div class="text-page-wrap section-spacing-bottom-large">
     <div class="text-page-left animated animated animate-from-top animate-delay-3">
       <?php if(have_posts() ) : while(have_posts()) : the_post();?>
       <h1 class="title-m"><?php the_title();?></h1>
       <?php endwhile;endif;?>
     </div>
     <div class="text-page-right animated animate-from-bottom animate-delay-3">
      <?php if(have_posts() ) : while(have_posts()) : the_post();?>
      <?php the_content();?>
      <?php endwhile;endif;?>
     </div>
    </div>
   </div>
  </main>
<?php get_footer();?>