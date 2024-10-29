<?php
/*
Template Name: Homepage
*/
get_header();?>
  <?php $protHero = get_field('hero_banner');?>
  <div class="home-hero">
   <div class="container hero-text-wrap">
    <div class="hero-text">
     <?php if(!empty($protHero['title'])) : ?>
     <h1 class="animated-instant animate-from-top-always animate-delay-3"><?php echo $protHero['title'];?></h1>
     <?php endif;?>
     <?php if(!empty($protHero['button']['link'])) : ?>
     <a id="hero-more" class="prot-button prot-button-light animated-instant animate-from-bottom animate-delay-3" href="<?php echo $protHero['button']['link']['url'];?>">
      <span aria-hidden="true" class="icon-move icon-move-light">
       <span class="dashicons dashicons-arrow-<?php echo $protHero['button']['arrow'];?>-alt"></span>
      </span><?php echo $protHero['button']['link']['title'];?>
     </a>
     <?php endif;?>
    </div>
    <?php if(!empty($protHero['featured_news'])) : ?>
    <div class="hero-news-wrapper animated-instant animate-from-right-always animate-delay-3">
     <div class="hero-news">
      <a class="hero-button-link" href="<?php echo get_the_permalink($protHero['featured_news']->ID);?>"><span class="visually-hidden"><?php echo $protHero['featured_news']->post_title;?></span></a>
      <div class="hero-news-inner">
       <h3 class="text-s light-blue-text">Latest News</h3>
       <h2><?php echo $protHero['featured_news']->post_title;?></h2>
       <span aria-hidden="true" class="prot-button prot-button-blue">
        <span aria-hidden="true" class="icon-move icon-move-blue">
         <span class="dashicons dashicons-arrow-right-alt"></span>
        </span>Learn more
       </span>
      </div>
     </div>
    </div>
    <?php endif;?>
   </div>
  </div>
  <main id="content">
   <section class="container">
    <?php $protProt = get_field('protection');?>
    <div class="home-protection section-spacing-bottom-large">
     <div class="home-protection-left flex-half left-content-max">
      <div class="image-button-link-wrapper animated animate-from-top">
       <?php if(!empty($protProt['patients']['link'])) : ?>
       <a class="image-button-link" href="<?php echo $protProt['patients']['link']['url'];?>"><span class="visually-hidden"><?php echo $protProt['patients']['link']['title'];?></span></a>
       <?php endif;?>
       <?php if(!empty($protProt['patients']['image']['url'])) : ?>
       <img srcset="<?php echo $protProt['patients']['image']['sizes']['medium_large'];?> 768w, <?php echo $protProt['patients']['image']['sizes']['large'];?> 800w"
         sizes="(max-width: 768px) 768px,800px"
         src="<?php echo $protProt['patients']['image']['sizes']['large'];?>"
         alt="<?php echo $protProt['patients']['image']['alt'];?>">
       <?php endif;?>
       <div class="image-button-link-gradient"></div>
       <?php if(!empty($protProt['patients']['link'])) : ?>
        <span aria-hidden="true" class="prot-button prot-button-light">
         <span class="icon-move icon-move-light">
          <span class="dashicons dashicons-arrow-<?php echo $protProt['patients']['arrow'];?>-alt"></span>
         </span><?php echo $protProt['patients']['link']['title'];?>
        </span>
       <?php endif;?>
      </div>
     </div>
     <div class="home-protection-right flex-half">
      <?php if(!empty($protProt['text']['title'])) : ?>
      <h2 class="title-l title-spacer right-content-max-alt animated animate-from-bottom"><?php echo $protProt['text']['title'];?></h2>
      <?php endif;?>
      <div class="home-protection-right-body right-content-max-alt animated animate-from-bottom">
       <?php echo $protProt['text']['copy'];?>
      </div>
      <div class="home-protection-slider animated animate-from-right">
        <div class="home-protection-slide">
         <?php if(!empty($protProt['patients']['link'])) : ?>
         <div class="image-button-link-wrapper">
          <a class="image-button-link" href="<?php echo $protProt['patients']['link']['url'];?>"><span class="visually-hidden"><?php echo $protProt['patients']['link']['title'];?></span></a>
          <?php endif;?>
          <?php if(!empty($protProt['patients']['image']['url'])) : ?>
          <img src="<?php echo $protProt['patients']['image']['sizes']['medium_large'];?>" alt="<?php echo $protProt['patients']['image']['alt'];?>">
          <?php endif;?>
          <div class="image-button-link-gradient"></div>
          <?php if(!empty($protProt['patients']['link'])) : ?>
           <span aria-hidden="true" class="prot-button prot-button-light">
            <span class="icon-move icon-move-light">
             <span class="dashicons dashicons-arrow-<?php echo $protProt['patients']['arrow'];?>-alt"></span>
            </span><?php echo $protProt['patients']['link']['title'];?>
           </span>
          </div>
         <?php endif;?>
        </div>
        <div class="home-protection-slide">
         <?php if(!empty($protProt['physicians']['link'])) : ?>
         <div class="image-button-link-wrapper">
          <a class="image-button-link" href="<?php echo $protProt['physicians']['link']['url'];?>"><span class="visually-hidden"><?php echo $protProt['physicians']['link']['title'];?></span></a>
          <?php endif;?>
          <?php if(!empty($protProt['physicians']['image_mobile']['url'])) : ?>
          <img src="<?php echo $protProt['physicians']['image_mobile']['sizes']['medium_large'];?>" alt="<?php echo $protProt['physicians']['image_mobile']['alt'];?>">
          <?php endif;?>
          <div class="image-button-link-gradient"></div>
          <?php if(!empty($protProt['physicians']['link'])) : ?>
           <span aria-hidden="true" class="prot-button prot-button-light">
            <span aria-hidden="true" class="icon-move icon-move-light">
             <span class="dashicons dashicons-arrow-<?php echo $protProt['physicians']['arrow'];?>-alt"></span>
            </span><?php echo $protProt['physicians']['link']['title'];?>
           </span>
          </div>
         <?php endif;?>
        </div>
      </div>
      <div class="image-button-link-wrapper animated animate-from-bottom home-physicians-desktop">
       <?php if(!empty($protProt['physicians']['link'])) : ?>
       <a class="image-button-link" href="<?php echo $protProt['physicians']['link']['url'];?>"><span class="visually-hidden"><?php echo $protProt['physicians']['link']['title'];?></span></a>
       <?php endif;?>
       <?php if(!empty($protProt['physicians']['image']['url'])) : ?>
       <img srcset="<?php echo $protProt['physicians']['image']['sizes']['medium_large'];?> 768w, <?php echo $protProt['physicians']['image']['sizes']['large'];?> 800w"
         sizes="(max-width: 768px) 768px,800px"
         src="<?php echo $protProt['physicians']['image']['sizes']['large'];?>"
         alt="<?php echo $protProt['physicians']['image']['alt'];?>">
       <?php endif;?>
       <div class="image-button-link-gradient"></div>
       <?php if(!empty($protProt['physicians']['link'])) : ?>
        <span aria-hidden="true" class="prot-button prot-button-light">
         <span aria-hidden="true" class="icon-move icon-move-light">
          <span class="dashicons dashicons-arrow-<?php echo $protProt['physicians']['arrow'];?>-alt"></span>
         </span><?php echo $protProt['physicians']['link']['title'];?>
        </span>
       <?php endif;?>
      </div>
     </div>
    </div>
   </section>
   <section class="container">
    <?php $protTech = get_field('technology');?>
    <div class="home-technology section-spacing-bottom">
     <div class="flex-tablet">
      <div class="home-technology-left flex-half">
       <?php if(!empty($protTech['text']['title'])) : ?>
       <h2 class="title-l animated animate-from-top"><?php echo nl2br($protTech['text']['title']);?></h2>
       <?php endif;?>
      </div>
      <div class="home-technology-right flex-half content-text">
       <div class="bigger-text right-content-max animated animate-from-bottom">
        <?php echo $protTech['text']['content'];?>
       </div>
       <?php if(!empty($protTech['text']['button']['link'])) : ?>
       <div class="animated animate-from-bottom technology-button">
        <a class="prot-button prot-button-blue" href="<?php echo $protTech['text']['button']['link']['url'];?>">
         <span aria-hidden="true" class="icon-move icon-move-blue">
          <span class="dashicons dashicons-arrow-<?php echo $protTech['text']['button']['arrow'];?>-alt"></span>
         </span><?php echo $protTech['text']['button']['link']['title'];?>
        </a>
       </div>
       <?php endif;?>
      </div>
     </div>
     <div class="home-media flex-tablet">
      <div class="home-media-left flex-half">
       <?php if(!empty($protTech['text']['media']['medium_one']['image_one']) || !empty($protTech['text']['media']['medium_one']['video'])) : ?>
        <?php if(!empty($protTech['text']['media']['medium_one']['video'])) : ?>
        <video class="play-video animated animate-from-top" muted playsinline="1" loop poster="">
         <source src="<?php echo $protTech['text']['media']['medium_one']['video']['url'];?>" type="video/mp4">
        </video>
        <?php else : ?>
        <picture>
         <source srcset="<?php echo $protTech['text']['media']['medium_one']['image_mobile']['sizes']['medium_large'];?>" media="(max-width: 480px)">
         <source srcset="<?php echo $protTech['text']['media']['medium_one']['image_one']['sizes']['large'];?>">
         <img class="animated animate-from-top" src="<?php echo $protTech['text']['media']['medium_one']['image_one']['sizes']['large'];?>" alt="<?php echo $protTech['text']['media']['medium_one']['image_one']['alt'];?>">
        </picture>
        <?php endif;?>
       <?php endif;?>
      </div>
      <div class="home-media-right flex-half">
       <?php if(!empty($protTech['text']['media']['medium_two']['image']) || !empty($protTech['text']['media']['medium_two']['video'])) : ?>
        <?php if(!empty($protTech['text']['media']['medium_two']['video'])) : ?>
        <video class="play-video animated animate-from-bottom" muted playsinline="1" loop poster="">
         <source src="<?php echo $protTech['text']['media']['medium_two']['video']['url'];?>" type="video/mp4">
        </video>
        <?php else : ?>
        <picture>
         <source srcset="<?php echo $protTech['text']['media']['medium_two']['image_mobile']['sizes']['medium_large'];?>" media="(max-width: 480px)">
         <source srcset="<?php echo $protTech['text']['media']['medium_two']['image_one']['sizes']['large'];?>">
         <img class="animated animate-from-bottom" src="<?php echo $protTech['text']['media']['medium_two']['image_one']['sizes']['large'];?>" alt="<?php echo $protTech['text']['media']['medium_two']['image_one']['alt'];?>">
        </picture>
        <?php endif;?>
       <?php endif;?>
      </div>
     </div>
    </div>
   </section>
   <section class="light-blue-bg">
    <div class="container">
     <?php $protClin = get_field('clinical');?>
     <div class="home-clinical section-spacing-both">
      <div class="flex-tablet">
       <div class="home-clinical-left flex-half">
        <?php if(!empty($protClin['title'])) : ?>
        <h2 class="title-l animated animate-from-top"><?php echo nl2br($protClin['title']);?></h2>
        <?php endif;?>
       </div>
       <div class="home-clinical-right flex-half">
        <?php if($protClin['facts_and_numbers']) : ?>
        <div class="home-clinical-fact-slider right-content-max-alt animated animate-from-right">
         <?php foreach($protClin['facts_and_numbers'] as $fact) : ?>
          <div class="home-clinical-fact">
           <p class="big-number light-blue-text"><?php echo $fact['single_fact_and_number']['number'];?><?php if(!empty($fact['single_fact_and_number']['unit'])) : ?><?php echo $fact['single_fact_and_number']['unit'];?><?php endif;?>
           </p>
           <div class="home-clinical-fact-text bigger-text">
           <?php echo $fact['single_fact_and_number']['fact'];?>
           </div>
          </div>
         <?php endforeach;?>
        </div>
        <?php endif;?>
       </div>
      </div>
     </div>
     <div class="home-studies section-spacing-bottom">
      <?php if(!empty($protClin['studies']['title'])) : ?>
       <h2 class="semi-bold animated animate-from-bottom"><?php echo nl2br($protClin['studies']['title']);?></h2>
      <?php endif;?>
      <?php if($protClin['studies']['study']) : ?>
       <?php foreach($protClin['studies']['study'] as $study) : ?>
       <div class="home-clinical-study animated animate-from-bottom">
        <p class="home-clinical-study-status light-blue-text text-s"><?php echo $study['status_or_date'];?></p>
        <div class="home-clinical-study-body">
         <h3><a href="<?php echo $study['link'];?>" target="_blank"><?php echo $study['title'];?></a></h3>
         <div class="study-copy">
          <?php echo $study['text'];?>
         </div>
         <div class="animated animate-from-bottom">
         <a class="link-cta light-blue-text text-s" href="<?php echo $study['link'];?>" target="_blank">Learn more 
          <span aria-hidden="true" class="link-arrow-right">
           <span class="dashicons dashicons-arrow-right-alt"></span>
          </span>
         </a>
         </div>
        </div>
       </div>
      <?php endforeach;endif;?>
      <?php if(!empty($protClin['studies']['button']['link'])) : ?>
      <div class="animated animate-from-bottom studies-button">
       <a class="prot-button prot-button-blue" href="<?php echo $protClin['studies']['button']['link']['url'];?>">
        <span aria-hidden="true" class="icon-move icon-move-blue">
         <span class="dashicons dashicons-arrow-<?php echo $protClin['studies']['button']['arrow'];?>-alt"></span>
        </span><?php echo $protClin['studies']['button']['link']['title'];?>
       </a>
      </div>
      <?php endif;?>
     </div>
    </div>
   </section>
   <section class="container">
    <?php $protStor = get_field('story');?>
    <div class="home-story section-spacing-both flex-tablet order-switch">
     <div class="home-story-left flex-half right-content-max">
      <?php if(!empty($protStor['title'])) : ?>
      <h2 class="title-l title-spacer animated animate-from-bottom"><?php echo nl2br($protStor['title']);?></h2>
      <?php endif;?>
      <div class="home-story-content animated animate-from-bottom">
       <?php echo $protStor['content'];?>
      </div>
      <?php if(!empty($protStor['button']['link'])) : ?>
      <div class="animated animate-from-bottom">
       <a class="prot-button prot-button-blue" href="<?php echo $protStor['button']['link']['url'];?>">
        <span aria-hidden="true" class="icon-move icon-move-blue">
         <span class="dashicons dashicons-arrow-<?php echo $protStor['button']['arrow'];?>-alt"></span>
        </span><?php echo $protStor['button']['link']['title'];?>
       </a>
      </div>
      <?php endif;?>
     </div>
     <div class="home-story-right flex-half">
      <div class="animated animate-from-top">
       <?php if(!empty($protStor['image']['url'])) : ?>
       <img srcset="<?php echo $protStor['image']['sizes']['medium_large'];?> 768w, <?php echo $protStor['image']['sizes']['large'];?> 800w"
         sizes="(max-width: 768px) 768px,800px"
         src="<?php echo $protStor['image']['sizes']['large'];?>"
         alt="<?php echo $protStor['image']['alt'];?>">
       <?php endif;?>
      </div>
     </div>
    </div>
   </section>
   <section class="container">
    <div class="news-and-events section-spacing-bottom-large">
    <?php $catOne = get_category_by_slug('events');?>
    <?php $catIdOne = $catOne->term_id;?>
    <?php $catTwo = get_category_by_slug('news');?>
    <?php $catIdTwo = $catTwo->term_id;?>
    <?php $args = array('numberposts' => 6,'post_type' => 'post','category' => array($catIdOne,$catIdTwo));
     $latest_news = get_posts($args);
     if(!empty($latest_news)) : ?>
     <div class="latest-news">
      <div class="latest-news-head">
       <h2 class="title-l animated animate-from-bottom">Latest news and events</h2>
       <a class="prot-button prot-button-icon-right prot-button-blue animated animate-from-bottom hide-on-landscape" href="/news">
        View all<span aria-hidden="true" class="icon-move icon-move-blue">
         <span class="dashicons dashicons-arrow-right-alt"></span>
        </span>
       </a>
      </div>
      <div class="latest-news-slider animated animate-from-bottom">
       <?php foreach($latest_news as $news) : ?>
       <div class="latest-news-entry">
        <?php $categories = get_the_category($news->ID);?>
        <p class="latest-news-meta light-blue-text text-s">
         <?php if(!empty($categories)) : ?><?php echo esc_html($categories[0]->name);?><?php endif;?> 
         <?php if($categories[0]->name == "Events") : ?><?php $eventMeta = get_field('event_information',$news->ID);echo $eventMeta['event_date_small'];?><?php else : ?> <?php echo get_the_date('m-d-Y',$news->ID );?><?php endif;?>
        </p>
        <h3 class="text-l latest-news-title"><a href="<?php echo get_the_permalink($news->ID);?>"><?php echo $news->post_title;?></a></h3>
        <div class="latest-news-excerpt"><?php echo $news->post_excerpt;?></div>
        <a class="link-cta light-blue-text text-s" href="<?php echo get_the_permalink($news->ID);?>">Learn more
         <span aria-hidden="true" class="link-arrow-right">
          <span class="dashicons dashicons-arrow-right-alt"></span>
         </span>
        </a>        
       </div>
       <?php endforeach;?>
      </div>
      <div class="animated animate-from-bottom hide-on-bigger-than-landscape">
       <a class="prot-button prot-button-blue" href="/news">
        <span aria-hidden="true" class="icon-move icon-move-blue">
         <span class="dashicons dashicons-arrow-right-alt"></span>
        </span>All News
       </a>
      </div>
     </div>
     <?php endif;?>
    </div>
   </section>
  </main>
<?php get_footer();?>