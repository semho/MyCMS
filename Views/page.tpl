<html>
<head>
    <title>{TITLE}</title>
    <link href="/Views/styles.css" rel="stylesheet" type="text/css">
</head>
<body>
    {DESCRIPTION}
    <table border="0" width="100%" cellpadding="4" cellspacing="0">
        <tr>
            <td colspan="2" width="100%" valign="top" align="center" class="top_menu">
                {TOP_MENU}
                <a href="index.php?p=file&f=about">О нас</a>
                <a href="index.php?p=gallery&f=gallery_show">Галерея</a>
                <a href="gb_show.php">Гостевая книга</a>
            </td>
        </tr>
        <tr>
            <td width="40%" valign="top">{MENU}</td>
            <td width="60%" valign="top">{PAGE}</td>
        </tr>
    </table>
    {INFO}<img src="/Scripts/counter.php">
</body>
</html>