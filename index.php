<?php
/**
 * nextsw.im front controller.
 */
header('Content-type: text/html; charset=utf-8');
$src = isset($_GET['src']) ? $_GET['src'] : null;
if ($src) {
    // for src to be valid, it must only consist of a-z or dash, and it must
    // relate to a file on the filesystem.
    $path = null;
    if (preg_match('/^[a-z-]+$/',$src)) {
        $path = __DIR__.'/src/'.$src.'.md';
    }
    if ($path && file_exists($path)) {
        require_once __DIR__.'/lib/markdown.php';
        $content = Markdown(file_get_contents($path));
        $title = 'Kayaking in '.implode(' ',array_map('ucfirst',explode('-',$src)));
    } else {
        // 404, file does not exist
        header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
        $content = file_get_contents(__DIR__.'/src/404.html');
        $title = 'Page Not Found';
    }
} else {
    $content = file_get_contents(__DIR__.'/src/seasons.html');
    $title = 'Kayaking Seasons';
}
?>
<!DOCTYPE html>
<html lang=en>
<head>
  <title><?php echo htmlentities($title,ENT_COMPAT,'UTF-8'); ?></title>
  <meta charset=utf-8>
  <link rel=stylesheet media=screen,projection href=css/screen.css>
  <link rel=stylesheet media=print href=css/print.css>
  <script src=js/jquery.js></script>
  <script src=js/jquery.floatheader.js></script>
  <!--[if IE]><script src=js/html5.js></script><![endif]-->
</head>

<body>

<nav>
<ul>
  <li class=first><a href=./>Season Chart</a></li>

  <!--<li>Alaska</li>-->
  <li><a href=altai title=Siberia data-season=7,8>Altai</a></li>
  <!--<li>Argentina</li>-->
  <!--<li>Bolivia</li>-->
  <li><span title=Canada data-season=6,7,8>British Columbia</span></li>
  <!--<li>California</li>-->
  <li><a href=cevennes title=France data-season=4,5,10,11>Cévennes</a></li>
  <li><a href=chile data-season=1,2,3,12>Chile</a></li>
  <li><span data-season=4>Corsica</span></li>
  <!--<li>Costa Rica</li>-->
  <!--<li>Cuba</li>-->
  <!--<li>Equador</li>-->
  <!--<li>Galicia</li>-->
  <!--<li>Georgia</li>-->
  <li><a href=greece data-season=4,5>Greece</a></li>
  <!--<li>Greenland</li>-->
  <li><span title=France data-season=5,6,7>Haut Alps</span></li>
  <li><span data-season=4,5,6>Iceland</span></li>
  <li><span data-season=5,6>Iran</span></li>
  <li><a href=ireland data-season=1,2,3,4,10,11,12>Ireland</a></li>
  <!--<li>Japan</li>-->
  <!--<li>Kamchatka</li>-->
  <li><a href=kyrgyzstan data-season=6,7,8,9>Kyrgyzstan</a></li>
  <!--<li>Kurdistan</li>-->
  <!--<li><span title=India>Ladakh</span></li>-->
  <!--<li>Madagascar</li>-->
  <li><span data-season=1,2,3,11,12>Mexico</span></li>
  <li><a href=morocco data-season=4,5>Morocco</a></li>
  <li><a href=nepal data-season=3,4,10,11,12>Nepal</a></li>
  <li><a href=new-zealand data-season=4,5,6,7,8,9,10>New Zealand</a></li>
  <li><a href=norway data-season=5,6,7,8>Norway</a></li>
  <!--<li>Oregon</li>-->
  <!--<li>Panama</li>-->
  <!--<li>Papua New Guinea</li>-->
  <li><a href=peru data-season=2,3,4,5,6,7,8>Peru</a></li>
  <li><a href=portugal data-season=1,2,3,4,11,12>Portugal</a></li>
  <li><a href=putorana title=Siberia data-season=7>Putorana</a></li>
  <li><a href=pyrenees title=Spain/France data-season=4,5>Pyrénées</a></li>
  <li><a href=sayan title=Siberia data-season=7,8>Sayan</a></li>
  <li><span data-season=4,5,6,7>Slovenia</span></li>
  <!--<li>Turkey</li>-->
  <li><span data-season=1,2,3,4,5,6,7,8,9,10,11,12>Uganda</span></li>
  <li><span data-season=1,2,3,4,10,11,12>UK</span></li>
  <li><a href=val-sesia title=Italy data-season=4,5>Val Sesia</a></li>
  <!--<li>Vietnam</li>-->
  <!--<li>Washington</li>-->
  <!--<li>Zambezi</li>-->
</ul>
</nav>
<script>
$(function(){ $('nav li:not(:has(a))').hide(); });
</script>

<article>
<?php echo $content; ?>
</article>

</body>
</html>
