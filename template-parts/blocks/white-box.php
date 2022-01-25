<?php

if( empty( $child_blocks ) ) {
    return;
}

?>
<div class="white-box">
    <div class="white-box-inner">
        <?php foreach( $child_blocks as $child_block ):
            echo $child_block['innerHTML'];
        endforeach; ?>
    </div>
</div><!-- / White Box -->