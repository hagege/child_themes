<?php
/*
Template Name: Patients
*/
get_header();?>
  <?php $protHero = get_field('hero_banner');?>
  <main id="content">
   <section class="page-hero section-spacing-bottom container">
    <?php if(!empty($protHero['title'])) : ?>
    <h1 class="title-xl animated-instant animate-from-top-always animate-delay-3"><?php echo nl2br($protHero['title']);?></h1>
    <?php endif;?>
    <?php if(!empty($protHero['image']['url'])) : ?>
    <div class="page-hero-image animated-instant animate-from-bottom animate-delay-3">
     <picture>
      <source srcset="<?php echo $protHero['mobile_image']['sizes']['medium_large'];?>" media="(max-width: 480px)">
      <source srcset="<?php echo $protHero['image']['sizes']['image-1600'];?>">
      <img src="<?php echo $protHero['image']['sizes']['image-1600'];?>" alt="<?php echo $protHero['image']['alt'];?>">
     </picture>
    </div>
    <?php endif;?>
   </section>
   <section class="container section-spacing-bottom">
    <?php $protProt = get_field('protecting');?>
    <div class="patients-protecting flex-tablet order-switch">
     <div class="patients-protecting-left flex-half right-content-max-plus">
      <?php if(!empty($protProt['title'])) : ?>
      <h2 class="title-l title-spacer animated animate-from-bottom"><?php echo nl2br($protProt['title']);?></h2>
      <?php endif;?>
      <div class="animated animate-from-bottom">
       <?php echo $protProt['text'];?>
      </div>
     </div>
     <div class="patients-protecting-right flex-half flex-mobile-spacer">
      <div class="animated animate-from-top">
       <?php if(!empty($protProt['image']['url'])) : ?>
       <img srcset="<?php echo $protProt['image']['sizes']['medium_large'];?> 768w, <?php echo $protProt['image']['sizes']['large'];?> 800w"
         sizes="(max-width: 768px) 768px,800px"
         src="<?php echo $protProt['image']['sizes']['large'];?>"
         alt="<?php echo $protProt['image']['alt'];?>">
       <?php endif;?>
      </div>
     </div>
    </div>
    <?php if(!empty($protProt['explanation'])) : ?>
    <div class="protecting-explanation text-l light-blue-text animated animate-from-bottom">
     <?php echo $protProt['explanation'];?>
    </div>
    <?php endif;?>
   </section>
   <section class="light-bg section-spacing-both section-spacing-bottom-large">
    <div class="container">
     <?php $protWhat = get_field('what_is');?>
     <div class="patients-what-is flex-tablet section-spacing-bottom-large">
      <div class="patients-what-is-left flex-half left-content-max">
       <?php if(!empty($protWhat['title'])) : ?>
       <h2 class="title-l title-spacer animated animate-from-bottom"><?php echo $protWhat['title'];?></h2>
       <?php endif;?>
       <div class="animated animate-from-bottom">
        <?php echo $protWhat['text'];?>
       </div>
      </div>
      <div class="patients-what-is-right flex-half flex-mobile-spacer right-content-max">
       <div class="animated animate-from-top">
        <?php if(!empty($protWhat['image']['url'])) : ?>
        <picture>
         <source srcset="<?php echo $protWhat['image_mobile']['sizes']['medium_large'];?>" media="(max-width: 480px)">
         <source srcset="<?php echo $protWhat['image']['sizes']['image-1600'];?>">
         <img src="<?php echo $protWhat['image']['sizes']['image-1600'];?>" alt="<?php echo $protWhat['image']['alt'];?>">
        </picture>
        <?php endif;?>
       </div>
      </div>
     </div>
     <?php $protSafety = get_field('safety');?>
     <div class="patients-safety flex-tablet order-switch section-spacing-bottom">
      <div class="patients-safety-left flex-half right-content-max">
       <?php if(!empty($protSafety['title'])) : ?>
       <h2 class="title-l title-spacer animated animate-from-bottom"><?php echo nl2br($protSafety['title']);?></h2>
       <?php endif;?>
       <div class="animated animate-from-bottom">
        <?php echo $protSafety['text'];?>
       </div>
       <div class="patients-safety-more">
        <div class="more-hidden">
         <div class="hidden-text">
          <?php echo $protSafety['text_load_more'];?>
         </div>
        </div>
        <div class="more-button animated animate-from-bottom">
         <a class="text-cta" href="/">
          <span aria-hidden="true" class="icon-circle icon-circle-blue">
           <span class="dashicons dashicons-plus-alt2"></span>
          </span>Load more
         </a>
        </div>
       </div>
      </div>
      <div class="patients-safety-right flex-mobile-spacer flex-half left-content-max">
       <div class="animated animate-from-top">
        <?php if(!empty($protSafety['image']['url'])) : ?>
        <picture>
         <source srcset="<?php echo $protSafety['image_mobile']['sizes']['medium_large'];?>" media="(max-width: 480px)">
         <source srcset="<?php echo $protSafety['image']['sizes']['image-1600'];?>">
         <img src="<?php echo $protSafety['image']['sizes']['image-1600'];?>" alt="<?php echo $protSafety['image']['alt'];?>">
        </picture>
        <?php endif;?>
       </div>
      </div>
     </div>
     <?php $protInfo = get_field('info_box');?>
     <?php if(!empty($protInfo['title'])) : ?>
     <div class="info-box animated animate-from-bottom">
      <div class="info-box-mobile">
       <a class="info-box-link" target="_blank" href="<?php echo $protInfo['button']['link']['url'];?>"><span class="visually-hidden"><?php echo $protInfo['button']['link']['title'];?></span></a>
       <div class="info-box-left">
        <p class="text-l light-blue-text"><?php echo $protInfo['title'];?></p>
        <span aria-hidden="true" class="prot-button prot-button-blue hide-on-mobile">
         <span aria-hidden="true" class="icon-move icon-move-blue">
          <span class="dashicons dashicons-arrow-<?php echo $protInfo['button']['arrow'];?>-alt"></span>
         </span><?php echo $protInfo['button']['link']['title'];?>
        </span>
       </div>
        <div class="info-box-right">
         <?php if(!empty($protInfo['logo_image']['url'])) : ?>
          <img src="<?php echo $protInfo['logo_image']['sizes']['medium'];?>" alt="<?php echo $protInfo['logo_image']['alt'];?>">
         <?php elseif(!empty($protInfo['text_right'])) : ?>
         <p class="info-box-right-text"><?php echo $protInfo['text_right'];?></p>
         <?php endif;?>
        </div>
      </div>
     </div>
     <?php endif;?>
    </div>
   </section>
  </main>
<?php get_footer();?>