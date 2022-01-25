<?php
$footer_logo = ogr_get_setting( 'footer', 'logo', 'image' );
$has_logo = ($footer_logo)?$footer_logo:'';
$copyright_text = ogr_get_setting( 'footer', 'bottom', 'copyright_text' );
$site_introduction = ogr_get_setting( 'footer', 'bottom', 'site_introduction' );
$site_address = ogr_get_setting( 'footer', 'bottom', 'site_address' );
$site_address_link = ogr_get_setting( 'footer', 'bottom', 'site_address_link' );
$phone = ogr_get_setting( 'footer', 'bottom', 'phone' );
$email = ogr_get_setting( 'footer', 'bottom', 'email' );
$face_book_url = ogr_get_setting( 'footer', 'bottom', 'face_book_url' );
$terms_link = ogr_get_setting( 'footer', 'bottom', 'terms_link' );

?>
<footer class="main-footer bg-secondary pt-5">
    <div class="container">
      <div class="footer-logo">
         <?php if( $has_logo ): ?>
            <div class="footer-logo">
               <img src="<?php echo esc_attr( $footer_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">

           </div>
       <?php endif; ?>

   </div>
   <div class="row">
    <div class="col-md-5 mb-4 mb-md-0">
      <div class="pt-3">
        <p class="text-white"><?php echo $site_introduction; ?></p>
    </div>
</div>
<div class="col-md-2 mb-4 mb-md-0">
  <div class="footer-heading">
    <h6 class="text-primary">Age Groups</h6>
</div>
<?php if( has_nav_menu( 'footer' ) ):
    wp_nav_menu( [
        'container' => false,
        'container_class' => 'navbar-nav navbar-links flex-wrap',
        'theme_location' => 'footer',
        'debth' => 3,
        'items_wrap' => '<ul class="footer-list m-0 p-0">%3$s</ul>',
            //'walker' => ( new \OneGroup\Main_Menu_Walker() )
    ] );
            //wp_nav_menu(array('theme_location' => 'primary-menu', 'menu_class' => 'light', 'container' => false, 'echo' => false))
endif;  ?>

</div>
<div class="col-md-3 mb-4 mb-md-0">
  <div class="footer-heading">
    <h6 class="text-primary">Contact Us</h6>
</div>
<ul class="footer-list m-0 p-0">
    <li>
      <a href="<?php echo $site_address_link; ?>"><?php echo $site_address; ?></a>
  </li>
  <li>

      <a href="tel:<?php  echo $phone; ?>"><?php  echo $phone; ?> </a>
  </li>
  <li>
      <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
  </li>

</ul>
</div>
</div>
<ul class="footer-social-links m-0 p-0 d-flex justify-content-end">
    <li>
      <a href="<?php echo $face_book_url; ?>">

        <img src="<?php echo ONEGROUP_URI . '/turtletot-assets/images/icon-fb.svg'; ?>" alt="Fb">
    </a>
</li>
</ul>
<div class="footer-copy-right d-flex flex-wrap justify-content-between py-3">
    <ul class="m-0 p-0 d-flex flex-wrap">

    <li class="text-white"><?php echo $copyright_text; ?></li>
    <li class="text-white">Web Developer
        <a class="text-white" href="https://rareiio.com/" target="_blank">RAREIIO</a> </li>
        <li class="text-white">Web Design by Kodaa</li>
    </ul>
    <ul class="m-0 p-0 d-flex flex-wrap">
      <?php if($terms_link): ?>
      <li class="text-white">
        <a href="<?php echo $terms_link; ?>" class="text-white">Terms & Conditions</a>
    </li>
  <?php endif; ?>

</ul>

</div>
</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
