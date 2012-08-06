<?php
/* template head */
if (function_exists('Dwoo_Plugin_include')===false)
	$this->getLoader()->loadPlugin('include');
/* end template head */ ob_start(); /* template body */ ?><html>
    <?php echo Dwoo_Plugin_include($this, 'header.tpl', null, null, null, '_root', null);?>

    <body>
        <div class='container'>
            <?php echo Dwoo_Plugin_include($this, 'Layout/'.(isset($this->scope["layout"]) ? $this->scope["layout"] : null).'', null, null, null, '_root', null);?>

        </div>
        <?php echo Dwoo_Plugin_include($this, 'javascripts.tpl', null, null, null, '_root', null);?>

    </body>
    <?php echo Dwoo_Plugin_include($this, 'footer.tpl', null, null, null, '_root', null);?>

</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>