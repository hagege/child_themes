<?php
/*
Template Name: Physicians
*/
get_header();?>
  <?php $protHero = get_field('hero_banner');?>
  <main id="content">
   <section class="page-hero section-spacing-bottom container">
    <?php if(!empty($protHero['title'])) : ?>
    <h1 class="title-xl animated-instant animate-from-top-always animate-delay-3"><?php echo nl2br($protHero['title']);?></h1>
    <?php endif;?>
    <div class="page-anchor-links animated-instant animate-from-bottom animate-delay-3">
     <a href="#clinical">
      <span aria-hidden="true" class="anchor-icon">
       <span class="dashicons dashicons-arrow-down-alt"></span>
      </span> Clinical need
     </a>
     <a href="#technology">        
      <span aria-hidden="true" class="anchor-icon">
       <span class="dashicons dashicons-arrow-down-alt"></span>
      </span> Technology
     </a>
    </div>
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
    <div id="clinical">
     <?php $protClin = get_field('ide_study');?>
     <div class="about-trial section-spacing-bottom-slider">
      <div class="flex-tablet">
       <div class="about-trial-left flex-half left-content-max">
        <?php if(!empty($protClin['title'])) : ?>
        <h2 class="title-l title-spacer animated animate-from-top"><?php echo nl2br($protClin['title']);?></h2>
        <?php endif;?>
        <?php if(!empty($protClin['text'])) : ?>
        <div class="animated animate-from-bottom"><?php echo $protClin['text'];?></div>
        <?php endif;?>
       </div>
       <div class="about-trial-right flex-half">
        <?php if($protClin['facts_and_numbers']) : ?>
        <div class="fact-slider phys-fact-slider animated animate-from-right">
         <?php foreach($protClin['facts_and_numbers'] as $fact) : ?>
          <div class="fact-slide">
           <p class="medium-number light-blue-text"><?php echo $fact['single_fact_and_number']['number'];?><?php if(!empty($fact['single_fact_and_number']['unit'])) : ?><?php echo $fact['single_fact_and_number']['unit'];?><?php endif;?>
           </p>
           <div class="fact-text bigger-text">
           <?php echo $fact['single_fact_and_number']['fact'];?>
           </div>
          </div>
         <?php endforeach;?>
        </div>
        <?php endif;?>
       </div>
      </div>
     </div>
    </div>
    <div class="section-spacing-bottom">
     <?php $protStud = get_field('study');?>
     <?php if(!empty($protStud['study_overview']['title'])) : ?>
     <h3 class="light-blue-text semi-bold animated animate-from-bottom"><?php echo $protStud['study_overview']['title'];?></h3>
     <?php endif;?>
     <?php if(!empty($protStud['study_overview']['accordeons'])) : ?>
      <div class="prot-accordions animated animate-from-bottom">
      <?php foreach($protStud['study_overview']['accordeons'] as $acc) : ?>
       <div class="prot-accordion">
        <div class="prot-accordion-title">
         <h4 class="acc-title title-s semi-bold"><?php echo $acc['accordion']['title'];?></h4>
         <a href="#" class="acc-title-icon-wrapper accordion-open"><span class="acc-title-icon-text light-blue-text semi-bold text-s">Show more</span><span class="acc-title-icon-image"></span></a>
        </div>
        <div class="prot-accordion-wrapper">
         <div class="prot-accordion-content">
          <?php if(!empty($acc['accordion']['image'])) : ?>
           <div class="prot-accordion-left">
            <img srcset="<?php echo $acc['accordion']['image']['sizes']['medium'];?> 480w, <?php echo $acc['accordion']['image']['sizes']['large'];?> 500w"
              sizes="(max-width: 480px) 480px,500px"
              src="<?php echo $acc['accordion']['image']['sizes']['large'];?>"
              alt="<?php echo $acc['accordion']['image']['alt'];?>">
           </div>
          <?php endif;?>
          <div class="prot-accordion-right">
           <?php echo $acc['accordion']['content'];?>
          </div>
         </div>
        </div>
       </div>
      <?php endforeach;?>
      </div> 
     <?php endif;?>
    </div>
    <?php $protGen = get_field('first_gen');?>
    <div class="about-story flex-tablet">
     <div class="about-story-left flex-half left-content-max">
      <?php if(!empty($protGen['title'])) : ?>
      <h2 class="title-l title-spacer animated animate-from-top"><?php echo nl2br($protGen['title']);?></h2>
      <?php endif;?>
     </div>
     <div class="about-story-right flex-half content-text">
      <div class="right-content-max">
       <div class="animated animate-from-bottom">
        <?php echo $protGen['text'];?>
       </div>
       <?php if(!empty($protGen['text_load_more'])) : ?>
       <div class="patients-safety-more">
        <div class="more-hidden">
         <div class="hidden-text">
          <?php echo $protGen['text_load_more'];?>
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
       <?php endif;?>
      </div>
     </div>
    </div>    
   </section>
   <section class="light-bg section-spacing-top">
    <div class="container">
     <?php $protProtect = get_field('protect_entire');?>
     <?php if(!empty($protProtect)) : ?>
     <div id="technology" class="section-spacing-bottom-large">
      <?php if(!empty($protProtect['title'])) : ?>
      <h2 class="title-xl title-spacer-xl animated animate-from-bottom"><?php echo nl2br($protProtect['title']);?></h2>
      <?php endif;?>
      <div class="about-story flex-tablet">
       <div class="about-story-left flex-half left-content-max">
        <?php if(!empty($protProtect['left_side']['mobile_image'])) : ?>
        <div class="prot-brain-mobile-image animated animate-from-bottom">
         <img src="<?php echo $protProtect['left_side']['mobile_image']['sizes']['large'];?>" alt="<?php echo $protProtect['left_side']['mobile_image']['alt'];?>">  
        </div>
        <?php endif;?>
        <?php if(!empty($protProtect['left_side']['left_text'])) : ?>
        <div class="text-l light-blue-text animated animate-from-top"><?php echo nl2br($protProtect['left_side']['left_text']);?></div>
        <?php endif;?>
        <?php if(!empty($protProtect['left_side']['image'])) : ?>
        <div class="prot-brain-desktop-image animated animate-from-bottom">
         <img src="<?php echo $protProtect['left_side']['image']['sizes']['large'];?>" alt="<?php echo $protProtect['left_side']['image']['alt'];?>">         
        </div>       
        <?php endif;?>
       </div>
       <div class="about-story-right flex-half content-text">
        <div class="right-content-max">
         <div class="animated animate-from-bottom">
          <?php echo $protProtect['text'];?>
         </div>
         <?php if(!empty($protProtect['text_load_more'])) : ?>
         <div class="patients-safety-more">
          <div class="more-hidden">
           <div class="hidden-text">
            <?php echo $protProtect['text_load_more'];?>
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
         <?php endif;?>
        </div>
       </div>      
      </div>
     </div>
     <?php endif;?>
     <?php $protHowWorks = get_field('how_it_works');?>
     <?php if(!empty($protHowWorks)) : ?>
     <div class="section-spacing-bottom-large mobile-border-top">
      <?php if(!empty($protHowWorks['title'])) : ?>
      <h2 class="title-l title-spacer-l animated animate-from-bottom"><?php echo $protHowWorks['title'];?></h2>
      <?php endif;?>
      <?php if(!empty($protHowWorks['video'])) : ?>
       <div class="phys-video-wrap">
        <video class="animated animate-from-bottom" controls playsinline="1" preload="metadata" <?php if(!empty($protHowWorks['poster'])) : ?>
         poster="<?php echo $protHowWorks['poster']['sizes']['image-1920'];?><?php endif;?>">
         <source src="<?php echo $protHowWorks['video']['url'];?>" type="video/mp4">
        </video>
       </div>
      <?php endif;?>
     </div>
     <?php endif;?>
     <?php $protRes = get_field('clinical_results');?>
     <?php if(!empty($protRes)) : ?>
     <div class="clin-res section-spacing-bottom-medium"> 
      <div class="flex-tablet">
       <div class="home-technology-left flex-half left-content-max">
        <?php if(!empty($protRes['title'])) : ?>
        <h2 class="title-l animated animate-from-top"><?php echo nl2br($protRes['title']);?></h2>
        <?php endif;?>
       </div>
       <div class="home-technology-right flex-half content-text">
        <div class="bigger-text right-content-max animated animate-from-bottom">
         <?php echo $protRes['text'];?>
        </div>
       </div>
      </div>
     </div> 
     <?php endif;?>
     <div class="section-spacing-bottom">
      <?php $protStud = get_field('clin_results');?>
      <?php if(!empty($protStud['results_overview']['title'])) : ?>
      <h3 class="light-blue-text semi-bold animated animate-from-bottom"><?php echo $protStud['results_overview']['title'];?></h3>
      <?php endif;?>
      <?php if(!empty($protStud['results_overview']['accordeons'])) : ?>
       <div class="prot-accordions animated animate-from-bottom">
       <?php foreach($protStud['results_overview']['accordeons'] as $acc) : ?>
        <div class="prot-accordion">
         <div class="prot-accordion-title">
          <h4 class="acc-title title-s semi-bold"><?php echo $acc['accordion']['title'];?></h4>
          <a href="#" class="acc-title-icon-wrapper accordion-open"><span class="acc-title-icon-text light-blue-text semi-bold text-s">Show more</span><span class="acc-title-icon-image"></span></a>
         </div>
         <div class="prot-accordion-wrapper">
          <div class="prot-accordion-content">
           <?php if(!empty($acc['accordion']['image'])) : ?>
            <div class="prot-accordion-left">
             <img srcset="<?php echo $acc['accordion']['image']['sizes']['medium'];?> 480w, <?php echo $acc['accordion']['image']['sizes']['large'];?> 500w"
               sizes="(max-width: 480px) 480px,500px"
               src="<?php echo $acc['accordion']['image']['sizes']['large'];?>"
               alt="<?php echo $acc['accordion']['image']['alt'];?>">
            </div>
           <?php endif;?>
           <div class="prot-accordion-right">
            <?php echo $acc['accordion']['content'];?>
           </div>
          </div>
         </div>
        </div>
       <?php endforeach;?>
       </div> 
      <?php endif;?>
     </div>
     <div class="info-box-wrapper section-spacing-bottom-small">
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
     <?php $protCaut = get_field('caution');?>
     <?php if(!empty($protCaut)) : ?>
     <div class="section-spacing-bottom-large">
      <div class="caution-big animated animate-from-bottom">
       <div class="caution-big-left">
        <p class="text-l"><?php echo $protCaut['title'];?></p>
       </div>
       <div class="caution-big-right">
        <?php echo $protCaut['text'];?>
       </div>
      </div>
     </div>
     <?php endif;?>
     <?php $protStor = get_field('publications');?>
     <div class="news-and-events section-spacing-bottom">
      <?php if(!empty($protStor)) : ?>
      <div class="latest-news">
       <div class="latest-news-head">
        <?php if(!empty($protStor['title'])) : ?>
        <h2 class="text-xl light-blue-text animated animate-from-bottom"><?php echo $protStor['title'];?></h2>
        <?php endif;?>
       </div>
       <div class="latest-news-slider publications-slider animated animate-from-right">
        <?php foreach($protStor['publications'] as $pub) : ?>
        <div class="latest-news-entry">
         <p class="latest-news-meta light-blue-text text-s"><?php echo $pub['publication']['date'];?></p>
         <h3 class="text-l latest-news-title"><a target="_blank" href="<?php echo $pub['publication']['file']['link'];?>"><?php echo $pub['publication']['title'];?></a></h3>
         <div class="latest-news-excerpt"><?php echo $pub['publication']['text'];?></div>
         <a class="link-cta light-blue-text text-s study-pdf-link" target="_blank" href="<?php echo $pub['publication']['file']['link'];?>">
          <span class="study-pdf-link-icon"></span><span class="study-pdf-link-text"><?php echo $pub['publication']['file']['title'];?></span>
         </a>        
        </div>
        <?php endforeach;?>
       </div>
      </div>
      <?php endif;?>
     </div>
     <?php $protRefe = get_field('references');?>
     <?php if(!empty($protRefe)) : ?>
     <div id="references" class="section-spacing-bottom-small">
      <div class="references animated animate-from-bottom">
       <button class="references-button text-s semi-bold light-blue-text">
        <span class="expand-close-icon" aria-hidden="true"></span>View References
       </button>
       <div class="references-wrapper">
        <div class="references-content light-blue-text">
         <?php echo $protRefe;?>
        </div>
       </div>
      </div>
     </div>
     <?php endif;?>
    </div>
   </section>
  </main>
<?php get_footer();?>