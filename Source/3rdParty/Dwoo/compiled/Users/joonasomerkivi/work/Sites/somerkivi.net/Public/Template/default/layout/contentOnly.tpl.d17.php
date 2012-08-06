<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="span-24">
    <?php echo $this->scope["content"];?>

</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>