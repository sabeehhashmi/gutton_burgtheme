jQuery( document ).ready(function($) {

    $( ".menu-item-has-children" ).click(function() {
      $(".sub-menu").hide();
      $(this).find(".sub-menu").show();
    });
});
