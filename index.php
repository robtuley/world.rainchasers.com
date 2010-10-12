<?php
/**
 * nextsw.im front controller.
 */
error_reporting(E_ALL);
ini_set('display_errors',1);
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
  <link rel=stylesheet type=text/css href=css/screen.css>
</head>

<body>

<nav>
<ul>
  <li><a href="./">Season Chart</a></li>

  <li><a href=altai title="Southern Siberia">Altai</a></li>
  <li><a href=bc title="West Canada">British Columbia</a></li>
  <li><a href=california>California</a></li>
  <li><a href=cevennes title="Southern France">Cévennes</a></li>
  <li><a href=chile>Chile</a></li>
  <li><a href=corsica>Corsica</a></li>
  <li><a href=galicia>Galicia</a></li>
  <li><a href=greece>Greece</a></li>
  <li><a href=haut-alps title="Southern France">Haut Alps</a></li>
  <li><a href=iran>Iran</a></li>
  <li><a href=kyrgyzstan>Kyrgyzstan</a></li>
  <li><a href=ladakh title="Northern India">Ladakh</a></li>
  <li><a href=morocco>Morocco</a></li>
  <li><a href=nepal>Nepal</a></li>
  <li><a href=norway>Norway</a></li>
  <li><a href=peru>Peru</a></li>
  <li><a href=portugal>Portugal</a></li>
  <li><a href=putorana title="Northern Siberia">Putorana</a></li>
  <li><a href=pyrenees title="Spainish/French Border">Pyrenees</a></li>
  <li><a href=sayan title=Siberia>Sayan</a></li>
  <li><a href=scotland>Scotland</a></li>
  <li><a href=slovenia>Slovenia</a></li>
  <li><a href=val-sesia title="Northern Italy">Val Sesia</a></li>
</ul>
</nav>

<article>
<?php echo $content; ?>
</article>

</body>
</html>