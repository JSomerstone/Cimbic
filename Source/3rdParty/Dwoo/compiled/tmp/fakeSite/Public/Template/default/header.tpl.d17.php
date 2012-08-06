<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><head>
    <title><?php echo $this->scope["siteTitle"];?></title>

    <?php 
$_loop0_data = (isset($this->scope["cssList"]) ? $this->scope["cssList"] : null);
if ($this->isArray($_loop0_data) === true)
{
	foreach ($_loop0_data as $tmp_key => $this->scope["-loop-"])
	{
		$_loop0_scope = $this->setScope(array("-loop-"));
/* -- loop start output */
?>
        <link rel="STYLESHEET" href="<?php echo $this->scope["file"];?>" media="<?php echo $this->scope["media"];?>" type="text/css" />
    <?php 
/* -- loop end output */
		$this->setScope($_loop0_scope, true);
	}
}
?>

</head><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>