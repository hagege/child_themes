<?php get_header();?>
  <main class="content">
   <div class="container">  
    <div class="text-page-wrap section-spacing-bottom-large">
     <div class="text-page-left animated animate-from-top animate-delay-3">
      <aside class="post-meta">
       <?php if(have_posts() ) : while(have_posts()) : the_post();?>
        <?php $eventMeta = get_field('event_information');?>
        <?php $categories = get_the_category();?>
        <?php if(!empty($categories)) : ?>
        <p class="post-category semi-bold">
         <?php echo esc_html($categories[0]->name);?> 
         <span class="post-mobile-date">
          <?php if($categories[0]->name == "Events") : ?><?php echo $eventMeta['event_date_small'];?><?php else : ?> <?php echo get_the_date('m-d-Y');?><?php endif;?>
         </span>
        </p>
        <?php endif;?>
       <?php endwhile;endif;?>
       <?php if($categories[0]->name == "Events") : ?>
       <?php $protBlog = $eventMeta['event_location'];?>
       <?php else : ?>
       <?php $protBlog = get_field('locations');?>
       <?php endif;?>
       <p class="meta-information light-blue-text text-s semi-bold">
        <span class="post-desktop-date"><?php if($categories[0]->name == "Events") : ?><?php echo $eventMeta['event_date'];?><?php else : ?><?php echo get_the_date('F d, Y');?><?php endif;?><br></span>
        <?php if(!empty($eventMeta['event_time'])) : ?>
        <?php echo $eventMeta['event_time'];?><br>
        <?php endif;?>
        <?php if(!empty($protBlog)) : ?><?php echo nl2br($protBlog);?><?php endif;?>
       </p>
      </aside>
     </div>
     <div class="text-page-right article-content animated animate-from-bottom animate-delay-3">
      <?php if(have_posts() ) : while(have_posts()) : the_post();?>
      <h1 class="title-l title-spacer"><?php the_title();?></h1>
      <div class="article-excerpt"><?php the_excerpt();?></div>
      <?php if(!empty($protBlog)) : ?>
      <div class="mobile-meta light-blue-text">
       <?php echo nl2br($protBlog);?>
      </div>
      <?php endif;?>
      <?php if(has_post_thumbnail()) : ?>
      <div class="event-inner-image">
       <?php the_post_thumbnail('medium_large');?>
      </div>
      <?php endif;?>
      <div class="article-inner"><?php the_content();?></div>
      <?php endwhile;endif;?>
     </div>
    </div>
   </div>
  </main>
<?php get_footer();?>