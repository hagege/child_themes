<?php
/*
Template Name: About
*/
get_header();?>
  <?php $protHero = get_field('hero_banner');?>
  <main id="content">
   <section class="page-hero section-spacing-bottom container">
    <?php if(!empty($protHero['title'])) : ?>
    <h1 class="title-xl about-title animated-instant animate-from-top-always animate-delay-3"><?php echo nl2br($protHero['title']);?></h1>
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
    <?php $protStory = get_field('story');?>
    <div class="about-story flex-tablet">
     <div class="about-story-left flex-half left-content-max">
      <?php if(!empty($protStory['title'])) : ?>
      <h2 class="title-l title-spacer animated animate-from-top"><?php echo nl2br($protStory['title']);?></h2>
      <?php endif;?>
     </div>
     <div class="about-story-right flex-half content-text">
      <div class="right-content-max">
       <div class="animated animate-from-bottom">
        <?php echo $protStory['text'];?>
       </div>
       <?php if(!empty($protStory['text_load_more'])) : ?>
       <div class="patients-safety-more">
        <div class="more-hidden">
         <div class="hidden-text">
          <?php echo $protStory['text_load_more'];?>
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
   <section class="light-bg section-spacing-both section-spacing-bottom-large">
    <?php $protTeam = get_field('team');?>
    <div class="about-team container">
     <?php if(!empty($protTeam['title'])) : ?>
      <h2 class="title-l title-spacer-l animated animate-from-top"><?php echo nl2br($protTeam['title']);?></h2>
     <?php endif;?>
     <div class="team-wrapper">
      <?php foreach($protTeam['team_members'] as $member) : ?>
       <div class="about-team-member animated animate-from-bottom">
        <div class="member-inner">
         <div class="about-team-member-image">
          <picture>
           <source srcset="<?php echo $member['image']['image_mobile']['sizes']['image-480'];?>" media="(max-width: 1439px)">
           <source srcset="<?php echo $member['image']['image_desktop']['sizes']['image-480'];?>">
           <img src="<?php echo $member['image']['image_desktop']['sizes']['image-480'];?>" alt="<?php echo $member['image']['image_mobile']['alt'];?>">
          </picture>
          <div class="team-member-info">
           <?php echo $member['information']['about'];?>
          </div>
         </div>
         <div class="about-team-member-meta">
          <div class="about-team-member-name bigger-text-later semi-bold">
           <h3 class="team-member-name"><?php echo $member['information']['name'];?></h3>
           <h4 class="team-member-role light-blue-text"><?php echo $member['information']['role'];?></h4>
          </div>
          <?php if(!empty($member['information']['linkedin'])) : ?>
          <a class="team-member-linkedin" href="<?php echo $member['information']['linkedin'];?>" target="_blank">
           <span class="visually-hidden">Link to the LinkedIn profile of <?php echo $member['information']['name'];?></span>
          </a>
          <?php endif;?>
         </div>
         <button class="about-button text-s semi-bold light-blue-text">
          <span class="expand-close-icon" aria-hidden="true"></span>About
         </button>
        </div>
       </div>
      <?php endforeach;?>
     </div>
     <?php if(!empty($protTeam)) : ?>
     <?php endif;?>
    </div>
    <div class="about-directors container">
     <?php $protBoard = get_field('board');?>
     <?php if(!empty($protBoard)) : ?>
      <div class="about-board">
      <?php if(!empty($protBoard['title'])) : ?>
       <h2 class="text-l light-blue-text title-spacer-m animated animate-from-bottom">
        <?php echo nl2br($protBoard['title']);?>
       </h2>
      <?php endif;?>
      <div class="board-members-wrap">
       <?php if(!empty($protBoard['board_member_left'])) : ?>
        <div class="board-members-left bigger-text animated animate-from-bottom animate-delay-1">
         <?php foreach($protBoard['board_member_left'] as $bmem) : ?>
         <p class="board-member"><?php echo $bmem['name'];?><br><span class="light-blue-text"><?php echo $bmem['role'];?></span></p>
         <?php endforeach;?>
        </div>
       <?php endif;?>
       <?php if(!empty($protBoard['board_member_right'])) : ?>
        <div class="board-members-right bigger-text animated animate-from-bottom animate-delay-2">
         <?php foreach($protBoard['board_member_right'] as $bmem) : ?>
         <p class="board-member"><?php echo $bmem['name'];?><br><span class="light-blue-text"><?php echo $bmem['role'];?></span></p>
         <?php endforeach;?>
        </div>
       <?php endif;?>
      </div>
      </div>
     <?php endif;?>
    </div>
   </section>
  </main>
<?php get_footer();?>