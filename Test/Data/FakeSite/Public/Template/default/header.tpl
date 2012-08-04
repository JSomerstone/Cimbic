<head>
    <title>{$siteTitle}</title>

    {loop $cssList}
        <link rel="STYLESHEET" href="{$file}" media="{$media}" type="text/css" />
    {/loop}
</head>