<!doctype html>
    <html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <?php wp_body_open();
        $logo = ogr_get_setting( 'header', 'logo', 'image' );
        $sitename = get_bloginfo( 'name' );
        $button_text = ogr_get_setting( 'header', 'button', 'text' );
        $button_url = ogr_get_setting( 'header', 'button', 'url' );
        $email = ogr_get_setting( 'header', 'top_bar', 'email' );
        $address = ogr_get_setting( 'header', 'top_bar', 'address' );
        $address_link = ogr_get_setting( 'header', 'top_bar', 'address_link' );
        $phone = ogr_get_setting( 'header', 'phone', 'phone' );
        ?>
        <header>
            <!-- Header top -->
            <div class="header-top bg-primary">
              <div class="container">
                <ul class="d-flex flex-wrap w-100 justify-content-center justify-content-md-end m-0 header-top-list">
                  <li>
                    <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                </li>
                <li>
                    <a href="<?php echo $address_link; ?>"><?php echo $address; ?></a>
                </li>
            </ul>

        </div>
    </div>

    <!-- navbar -->
    <div class="container">
      <nav class="navbar navbar-expand-lg w-100 py-1">
        <a class="navbar-brand" href="<?php echo home_url('/'); ?>">
            <img src="<?php echo ($logo) ? esc_attr( $logo ) :get_template_directory_uri() . '/turtletot-assets/images/m-logo.svg'; ?>" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <img src="<?php echo get_template_directory_uri();?>/turtletot-assets/images/mobile-menu.svg" alt="Mobile Manu">
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="flex-wrap d-flex full-w align-items-center justify-content-between">
            <?php if( has_nav_menu( 'main' ) ):
                wp_nav_menu( [
                    'container' => false,
                    'container_class' => 'navbar-nav navbar-links flex-wrap',
                    'theme_location' => 'main',
                    'debth' => 3,
                    'items_wrap' => '<ul class="nav navbar-nav navbar-links flex-wrap">%3$s</ul>',
            //'walker' => ( new \OneGroup\Main_Menu_Walker() )
                ] );
            //wp_nav_menu(array('theme_location' => 'primary-menu', 'menu_class' => 'light', 'container' => false, 'echo' => false))
            endif;  ?>

            <ul class="navbar-address m-0 p-0 d-flex align-items-center justify-content-end">
              <li class="px-3">
                <div class="d-flex">
                  <div class="item-icon px-3">
                    <img src="<?php echo get_template_directory_uri();?>/turtletot-assets/images/icon-call.svg" alt="Call">
                </div>
                <div class="item-icon">
                    <a href="tel:<?php echo $phone; ?>" class="text-primary"><span class="text-primary"><?php echo $phone; ?></span></a>

                </div>
            </div>



        </li>
        <li>
            <a class="btn btn-primary text-white btn--lagre px-3 py-1" href="<?php echo $button_url; ?>"><?php echo $button_text; ?></a>
        </li>
    </ul>
</div>

</div>
</nav>
</div>
</header>

