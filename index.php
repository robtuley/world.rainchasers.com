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
<html>
<head>
  <title><?php echo htmlentities($title,ENT_COMPAT,'UTF-8'); ?></title>
  <meta charset=utf-8>
  <link rel=stylesheet media=screen,projection href=css/screen.css>
  <script src=js/jquery.js></script>
  <!--[if IE]><script src=js/html5.js></script><![endif]-->
</head>

<body>

<nav>
<ul>
  <li><a href="./">Season Chart</a></li>

  <li><a href=altai title="Southern Siberia" data-season=7,8>Altai</a></li>
  <!--<li><a href=bc title="West Canada">British Columbia</a></li>-->
  <!--<li><a href=california>California</a></li>-->
  <li><a href=cevennes title="Southern France" data-season=4,5,10,11>Cévennes</a></li>
  <li><a href=chile data-season=1,2,3,12>Chile</a></li>
  <!--<li><a href=corsica>Corsica</a></li>-->
  <!--<li><a href=costa-rica>Costa Rica</a></li>-->
  <!--<li><a href=galicia>Galicia</a></li>-->
  <li><a href=greece data-season=4,5>Greece</a></li>
  <!--<li><a href=haut-alps title="Southern France">Haut Alps</a></li>-->
  <!--<li><a href=iran>Iran</a></li>-->
  <li><a href=kyrgyzstan data-season=6,7,8,9>Kyrgyzstan</a></li>
  <!--<li><a href=ladakh title="Northern India">Ladakh</a></li>-->
  <li><a href=morocco data-season=4,5>Morocco</a></li>
  <li><a href=nepal data-season=3,4,10,11,12>Nepal</a></li>
  <li><a href=norway data-season=5,6,7,8>Norway</a></li>
  <li><a href=peru data-season=2,3,4,5,6,7,8>Peru</a></li>
  <li><a href=portugal data-season=1,2,3,4,11,12>Portugal</a></li>
  <li><a href=putorana title="Northern Siberia" data-season=7>Putorana</a></li>
  <!--<li><a href=pyrenees title="Spainish/French Border">Pyrenees</a></li>-->
  <li><a href=sayan title=Siberia data-season=7,8>Sayan</a></li>
  <!--<li><a href=scotland>Scotland</a></li>-->
  <!--<li><a href=slovenia>Slovenia</a></li>-->
  <li><a href=val-sesia title="Northern Italy" data-season=4,5>Val Sesia</a></li>
</ul>
</nav>

<article>
<?php echo $content; ?>
</article>

</body>
</html>