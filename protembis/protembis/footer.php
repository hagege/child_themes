  <footer class="text-s">
   <?php $footerContent = get_field('footer_content','option');?>
   <div class="footer-content container">
    <?php if(is_page_template('page-homepage.php') || is_page_template('page-about.php')) : ?>
    <div class="footer-partners">
      <?php if($footerContent['partner_section']['title']) : ?>
      <h2 class="animated animate-from-bottom"><?php echo $footerContent['partner_section']['title'];?></h2>
      <?php endif;?>
      <?php if($footerContent['partner_section']['logos']) : ?>
      <div class="marquee-wrapper animated animate-from-bottom ">
       <div class="marquee">
        <?php for($i = 1;$i <= 3;$i++) : ?>
        <div class="footer-partners-logos"<?php if($i > 1) :?> aria-hidden="true"<?php endif;?>>
         <?php foreach($footerContent['partner_section']['logos'] as $logo) : ?>
         <img class="footer-partners-logo" src="<?php echo $logo['logo']['sizes']['medium_large'];?>" width="<?php echo $logo['logo']['sizes']['medium_large-width'];?>" 
          height="<?php echo $logo['logo']['sizes']['medium_large-height'];?>" alt="<?php echo $logo['logo']['alt'];?>">
         <?php endforeach;?>
        </div>
        <?php endfor;?>
       </div>
      </div>
      <?php endif;?>
    </div>
    <?php endif;?>
    <div id="contact" class="footer-information<?php if(!is_page_template('page-homepage.php') && !is_page_template('page-about.php')) : ?> footer-spacing<?php endif;?>">
     <div class="footer-information-left text-l light-blue-text animated animate-from-top">
      <div class="footer-information-left-inner">
       <?php if($footerContent['information_section']['information_left_side']){
        echo $footerContent['information_section']['information_left_side'];}
       ?>
      </div>
     </div>
     <div class="footer-information-right animated animate-from-bottom">
      <div>
       <?php if($footerContent['information_section']['information_right_side']['left_column']){
        echo $footerContent['information_section']['information_right_side']['left_column'];}
       ?>
      </div>
      <div>
       <?php if($footerContent['information_section']['information_right_side']['center_column']){
        echo $footerContent['information_section']['information_right_side']['center_column'];}
       ?>
      </div>
      <div id="connect" class="footer-connect">
       <?php if($footerContent['information_section']['information_right_side']['right_column']){
        echo $footerContent['information_section']['information_right_side']['right_column'];}
       ?>
       <a id="back-to-top" class="prot-button prot-button-blue back-to-top" href="/">
        <span aria-hidden="true" class="icon-move icon-move-blue">
         <span class="dashicons dashicons-arrow-up-alt"></span>
        </span>       
        <span class="visually-hidden">Back to top</span>
       </a>
      </div>
     </div>
     <p class="footer-copyright">© <?php echo date('Y');?> Protembis GmbH – all rights reserved</p>
    </div>
   </div>
   <div class="footer-hint">
    <div class="container">
     <div class="footer-hint-text">
      <?php echo $footerContent['caution_hint'];?>
     </div>
    </div> 
   </div>
  </footer>
  <?php wp_footer();?>
 </body>
</html>