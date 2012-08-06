<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><footer>
    &copy; Joona Somerkivi 2012
</footer><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>