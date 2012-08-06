<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="span-24 loud top">
    Header
</div>
<div class="span-4 first border">
    Menu
</div>
<div class="span-19">
    Content area
    <?php echo $this->scope["content"];?>

</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>