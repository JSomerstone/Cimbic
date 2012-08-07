<head>
    <title>{$siteTitle}</title>
    <base href="{$baseUrl}" />
    {loop $cssList}
        <link rel="STYLESHEET" href="{$file}" media="{$media}" type="text/css" />
    {/loop}
</head>