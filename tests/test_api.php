<?PHP

require_once('../Ranktracker.php');
require_once('../KeywordResearch.php');

//$rt = new Ranktracker('QK1SsrVurJ5gUEBgLX9VOerNGyF8pIVETe1mYoo26WxM1nPXqMP6q', '9A5ntv7SdPFOQgW');
$kwd = new KeywordResearch('nlWgru0aZP2btxSz7zZ77uZuxBH/sOMa2A4sU0BsIaFdSbmcSHtQG', '9A5ntv7SdPFOQgW');

echo '<h1>Keywords</h1>';
echo var_dump($kwd->fetch("oranciata"));
echo '<br />';
