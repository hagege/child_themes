<?php
/*
Template Name: Studies
*/
get_header();?>
  <?php $protHero = get_field('hero_banner');?>
  <main id="content">
   <section class="page-hero section-spacing-bottom container">
    <?php if(!empty($protHero['title'])) : ?>
    <h1 class="title-xl animated-instant animate-from-top-always animate-delay-3"><?php echo nl2br($protHero['title']);?></h1>
    <?php endif;?>
    <div class="page-anchor-links animated-instant animate-from-bottom animate-delay-3">
     <a href="#trial">
      <span aria-hidden="true" class="anchor-icon">
       <span class="dashicons dashicons-arrow-down-alt"></span>
      </span> Protembo Trial
     </a>
     <a href="#studies">        
      <span aria-hidden="true" class="anchor-icon">
       <span class="dashicons dashicons-arrow-down-alt"></span>
      </span><span class="hide-on-mobile"> Recent studies</span> <span class="hide-on-mobile-up"> Studies</span>
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
    <div id="trial">
     <?php $protClin = get_field('ide_study');?>
     <div class="about-trial section-spacing-bottom-large">
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
        <div class="fact-slider animated animate-from-right">
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
    <div class="info-box-wrapper">
     <?php $protInfo = get_field('info_box');?>
     <?php if(!empty($protInfo['title'])) : ?>
     <div class="info-box info-box-light animated animate-from-bottom">
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
   <section id="studies" class="light-bg section-spacing-both">
    <div class="container">
     <?php $protClin = get_field('studies');?>
     <div class="home-studies section-spacing-bottom">
      <?php if(!empty($protClin['title'])) : ?>
       <h2 class="title-l animated animate-from-bottom"><?php echo nl2br($protClin['title']);?></h2>
      <?php endif;?>
      <?php if($protClin['study']) : ?>
       <?php foreach($protClin['study'] as $study) : ?>
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
     <?php $protStor = get_field('publications');?>
     <div class="news-and-events">
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
    </div>
   </section>
  </main>
<?php get_footer();?>