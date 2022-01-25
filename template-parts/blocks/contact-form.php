<?php

$title = trim( $data['title'] );
$phone = trim( $data['phone'] );
$email = trim( $data['email'] );
$adress = trim( $data['adress'] );
$adress_link = trim( $data['adress_link'] );
$shortcode = trim( $data['shortcode'] );
$facebook = trim( $data['facebook'] );
$sub_title = $data['sub_title'];
$map_image = ogr_get_image( $data['map_image_id'] );





if( ! empty( $map_image ) ) {
    $map_image_url = ogr_get_image_url( $data['map_image_id'] );
}
?>
<section class="main-contact ">
 <div class="container ">
   <div class="row mx-md-5">
     <div class="col-12">
        <h1 class="text-primary"><?php echo $title; ?></h1>
    </div>
</div>
<div class="row my-4 mx-md-5">
 <div class="col-md-6 mb-3">
   <div class="card card-shadow border-primary">
     <div class="card-body">
       <?php echo do_shortcode( $shortcode ); ?>
</div>
</div>
</div>
<div class="col-md-6 mb-3">
   <div class="contact-info card bg-light p-4 border-primary">
     <div class="d-flex justify-content-start mb-4">
       <div class="icon-box ">
         <img src="<?php echo ONEGROUP_URI . 'turtletot-assets/images/contact-icon/phone.png'; ?>">
     </div>
     <?php if($phone): ?>
         <div class="content-box">
             <h5 class="text-primary">Phone</h5>
             <p><?php echo $phone; ?></p>
         </div>
     <?php endif; ?>
 </div>

 <div class="d-flex justify-content-start mb-4">
   <div class="icon-box ">
     <img src="<?php echo ONEGROUP_URI . 'turtletot-assets/images/contact-icon/mail.png';?>">
 </div>
 <div class="content-box">
   <?php if($email): ?>
     <h5 class="text-primary">Email</h5>
     <a href="mailto:<?php echo $email; ?>"><p><?php echo $email; ?></p></a>
 <?php endif; ?>

</div>
</div>

<div class="d-flex justify-content-start mb-4">
   <div class="icon-box ">
     <img src="<?php echo ONEGROUP_URI . 'turtletot-assets/images/contact-icon/map.png';?>">
 </div>
 <div class="content-box">
   <?php if($adress): ?>
     <h5 class="text-primary">Address</h5>
     <a href="<?php echo $adress_link; ?>"><p><?php echo $adress; ?></p></a>
 <?php endif; ?>
</div>
</div>
<?php if($facebook): ?>
    <div class="d-flex justify-content-start">
       <div class="icon-box ">
        <img src="<?php echo ONEGROUP_URI . 'turtletot-assets/images/contact-icon/facebook.png'; ?>">
     </div>
     <div class="content-box">
         <h5 class="text-primary">Facebook</h5>
          <a href="<?php echo $facebook; ?>"><p><?php echo $facebook; ?></p></a>

     </div>
 </div>
</div>
<?php endif; ?>
<div class="map-container card border-primary mt-4">
 <!-- <img src="<?php echo $map_image_url; ?>" class="img-fluid w-100"> -->
 <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3309.5336992187117!2d151.11608111521238!3d-33.9531194806331!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b12b9f35efba6a5%3A0x30fb33f00035312c!2s14%20Preddys%20Rd%2C%20Bexley%20NSW%202207%2C%20Australia!5e0!3m2!1sen!2s!4v1628869344741!5m2!1sen!2s" height="215" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div>
</div>
</div>
</div>
</section>
<?php
