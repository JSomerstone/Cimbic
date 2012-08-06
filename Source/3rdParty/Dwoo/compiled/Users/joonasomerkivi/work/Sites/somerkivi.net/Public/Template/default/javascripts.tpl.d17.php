<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><script>
    //alert('hello world!');
</script><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>