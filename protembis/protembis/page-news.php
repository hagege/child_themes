<?php
/*
Template Name: News and Events
*/
get_header();?>
  <?php $protHero = get_field('hero_banner');?>
  <main id="content">
   <div class="page-hero container section-spacing-bottom-xs">
    <h1 class="title-xl animated-instant animate-from-top-always animate-delay-3">News</h1>
   </div>   
   <section class="container">
    <?php $catN = get_category_by_slug('news');?>
    <?php $catIdN = $catN->term_id;?>
    <?php $args = array('numberposts' => 1,'post_type' => 'post','category' => $catIdN);?>
    <?php $featured_news = get_posts($args);?>
    <?php if(!empty($featured_news)) : ?>
    <div class="news-featured animated-instant animate-from-bottom animate-delay-3">
     <div class="news-featured-image">
      <?php echo get_the_post_thumbnail($featured_news[0]->ID, 'medium_large');?>
     </div>
     <div class="news-featured-content">
      <p class="featured-news-meta semi-bold light-blue-text text-s">News <?php echo get_the_date('m-d-Y',$featured_news[0]->ID );?></p>
      <h2 class="title-l latest-news-title">
       <a href="<?php echo get_the_permalink($featured_news[0]->ID);?>">
       <?php $featuredShortTitle = get_field('short_title',$featured_news[0]->ID);?>
       <?php if(!empty($featuredShortTitle)) : ?>
        <?php echo $featuredShortTitle;?>
       <?php else : ?>
        <?php echo $featured_news[0]->post_title;?>
       <?php endif;?>
       </a>
      </h2>
      <div class="featured-news-excerpt"><?php echo $featured_news[0]->post_excerpt;?></div>
      <a class="prot-button light-blue-text text-s" href="<?php echo get_the_permalink($featured_news[0]->ID);?>">
      <span aria-hidden="true" class="icon-move icon-move-blue">
        <span class="dashicons dashicons-arrow-right-alt"></span>
       </span>Learn more
      </a>
     </div>
    </div>
    <?php endif;?>
    <div class="section-spacing-top-m section-spacing-bottom-sm">
    <?php $args = array('numberposts' => 12,'offset' => 1,'post_type' => 'post','category' => $catIdN);?>
    <?php $latest_news = get_posts($args);?>
    <?php if(!empty($latest_news)) : ?>
     <div class="news-press-wrapper">
      <div class="latest-news-head">
       <h2 class="title-l animated animate-from-bottom">Discover News & Press</h2>
      </div>
      <div class="news-inner">
       <?php $newsCount = 0;?>
       <?php foreach($latest_news as $news) : ?>
       <div class="news-entry animated animate-from-bottom<?php if($newsCount > 5) : ?> more-news-entry<?php endif;?>">
        <?php $categories = get_the_category($news->ID);?>
        <p class="latest-news-meta light-blue-text text-s"><?php if(!empty($categories)) : ?><?php echo esc_html($categories[0]->name);?><?php endif;?> <?php echo get_the_date('m-d-Y',$news->ID );?></p>
        <h3 class="text-l latest-news-title"><a href="<?php echo get_the_permalink($news->ID);?>"><?php echo $news->post_title;?></a></h3>
        <div class="latest-news-excerpt"><?php echo $news->post_excerpt;?></div>
        <a class="link-cta light-blue-text text-s" href="<?php echo get_the_permalink($news->ID);?>">Learn more
         <span aria-hidden="true" class="link-arrow-right">
          <span class="dashicons dashicons-arrow-right-alt"></span>
         </span>
        </a>        
       </div>
       <?php $newsCount++;?>
       <?php endforeach;?>
      </div>
      <div id="show-more-news-button" class="news-button-spacing animated animate-from-bottom">
       <a class="text-cta" href="/news">
        <span aria-hidden="true" class="icon-circle icon-circle-blue">
         <span class="dashicons dashicons-plus-alt2"></span>
        </span>Load more
       </a>
      </div>
     </div>
     <?php endif;?>
    </div>
   </section>
   <section class="light-bg section-spacing-top">
    <?php $cat = get_category_by_slug('events');?>
    <?php $catID = $cat->term_id;?>
    <?php $argsEvents = array('numberposts' => 6,'post_type' => 'post','category' => $catID);?>
    <?php $latest_events = get_posts($argsEvents);?>
    <?php if(!empty($latest_events)) : ?>
    <div class="news-events section-spacing-bottom container">
     <h2 class="title-l title-spacer-s animated animate-from-bottom">Events</h2>
      <?php foreach($latest_events as $event) : ?>
      <?php $eventMeta = get_field('event_information',$event->ID);?>
      <div class="news-event animated animate-from-bottom">
       <p class="news-event-meta light-blue-text semi-bold text-s">
        <?php if(!empty($eventMeta['event_date'])) : ?>
         <span class="event-format-br"><?php echo $eventMeta['event_date'];?>, <br></span>
        <?php endif;?>
        <?php if(!empty($eventMeta['event_time'])) : ?>
         <?php echo $eventMeta['event_time'];?><br>
        <?php endif;?>
        <?php if(!empty($eventMeta['event_location'])) : ?>
        <span class="event-format-br"><?php echo nl2br($eventMeta['event_location']);?></span>
        <?php endif;?>
       </p>
       <div class="news-event-body">
        <div class="news-event-copy">
         <h3 class="event-title semi-bold"><a href="<?php echo get_the_permalink($event->ID);?>"><?php echo $event->post_title;?></a></h3>
         <div class="event-excerpt"><?php echo $event->post_excerpt;?></div>
        </div>
        <div class="news-event-links">
         <a class="link-cta light-blue-text text-s" href="<?php echo get_the_permalink($event->ID);?>" target="_blank">Read more 
          <span aria-hidden="true" class="link-arrow-right">
           <span class="dashicons dashicons-arrow-right-alt"></span>
          </span>
         </a>
         <?php if(!empty($eventMeta['event_link'])) : ?>
         <a class="link-cta light-blue-text text-s" href="<?php echo $eventMeta['event_link']['url'];?>" target="_blank"><?php echo $eventMeta['event_link']['title'];?> 
          <span aria-hidden="true" class="link-arrow-right">
           <span class="dashicons dashicons-arrow-right-alt"></span>
          </span>
         </a>
         <?php endif;?>
        </div>
       </div>
       <?php if(has_post_thumbnail($event->ID)) : ?>
       <div class="news-event-image">
        <?php echo get_the_post_thumbnail($event->ID, 'medium_large');?>
       </div>
       <?php endif;?>
      </div>
     <?php endforeach;?>
    </div>
    <?php endif;?>
    <?php $protInst = get_field('instagram');?>
    <?php if(!empty($protInst)) : ?>
    <div class="instagram section-spacing-bottom-large container">
     <div class="instagram">
      <div class="instagram-head">
       <?php if(!empty($protInst['title'])) : ?>
       <h2 class="text-l light-blue-text animated animate-from-bottom"><?php echo $protInst['title'];?></h2>
       <?php endif;?>
       <?php if(!empty($protInst['profile_link'])) : ?>
       <a class="prot-button prot-button-blue animated animate-from-bottom hide-on-tablet" target="_blank" href="<?php echo $protInst['profile_link'];?>">
        <span aria-hidden="true" class="icon-move icon-move-blue">
         <span class="dashicons dashicons-arrow-right-alt"></span>
        </span>LinkedIn Profile
       </a>
       <?php endif;?>
      </div>
      <div class="instagram-slider animated animate-from-bottom">
       <?php foreach($protInst['instagram_link'] as $insta) : ?>
       <div class="instagram-entry">
        <?php if(!empty($insta['link'])) : ?>
        <a class="insta-image-link" href="<?php echo $insta['link'];?>" target="_blank"></a>
        <?php endif;?>
        <?php if(!empty($insta['image'])) : ?>
        <img src="<?php echo $insta['image']['sizes']['medium_large'];?>" alt="<?php echo $insta['image']['alt'];?>">
        <?php endif;?>
       </div>
       <?php endforeach;?>
      </div>
      <div class="animated animate-from-bottom hide-on-desktop">
       <?php if(!empty($protInst['profile_link'])) : ?>
       <a class="prot-button prot-button-blue" target="_blank" href="<?php echo $protInst['profile_link'];?>">
        <span aria-hidden="true" class="icon-move icon-move-blue">
         <span class="dashicons dashicons-arrow-right-alt"></span>
        </span>LinkedIn Profile
       </a>
       <?php endif;?>
      </div>
     </div>
    </div>
    <?php endif;?>
   </section>
  </main>
<?php get_footer();?>