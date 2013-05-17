#!/usr/bin/php -q
<?php
define('DOMAIN','world.rainchasers.com');
$escape = function($val) {
    return htmlentities($val,ENT_COMPAT,'UTF-8');
};
$src = trim(isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1] : '');
if (!$src) { // home page
    $content = file_get_contents(__DIR__.'/src/seasons.html');
    $title = $fb_title = 'Kayaking Seasons';
    $desc = 'Concise summaries of world kayaking destinations and seasons.';
    $fb_type = 'website';
} elseif (!preg_match('/^[a-z-]+$/',$src)) {
    fwrite(STDERR,"Export src must be A-Z-; provided $src\n");
    exit(1);
} else {
    $path = __DIR__.'/src/'.$src.'.md';
    if (!file_exists($path)) {
        fwrite(STDERR,"File $path does not exist\n");
        exit(2);
    }
    require_once __DIR__.'/lib/markdown.php';
    $content = Markdown(file_get_contents($path));
    $fb_title = implode(' ',array_map('ucfirst',explode('-',$src)));
    if (strlen($fb_title)<3) $fb_title = strtoupper($fb_title);
    $title = 'Kayaking in '.$fb_title;
    $desc = 'Summary of '.$fb_title.' kayaking and rafting season, potential and further resources.';
    $fb_type = 'state_province';
}
$fb_url = 'http://'.DOMAIN.'/'.$src;
$fb_img = '/website'; // default to standard image
if ($src) {
  $path = __DIR__.'/fb/'.$src.'.png';
  if (file_exists($path)) $fb_img = '/'.$src; // custom image 
}
$fb_img = 'http://'.DOMAIN.'/img/fb'.$fb_img.'.png';
?>
<!DOCTYPE html>
<html lang=en>
<head>
  <meta charset=utf-8>
  <title><?php echo $escape($title); ?></title>
  <meta name=viewport content="width=device-width,initial-scale=1.0">
  
  <meta property=og:title content="<?php echo $escape($fb_title); ?>"> 
  <meta property=og:type content="<?php echo $escape($fb_type); ?>"> 
  <meta property=og:url content=<?php echo $escape($fb_url); ?>> 
  <meta property=og:image content=<?php echo $escape($fb_img); ?>> 
  <meta property=fb:app_id content=214254015300505>
  <meta property=og:site_name content="World Rainchasers">
  <meta property=og:description
        content="<?php echo $escape($desc); ?>">
  <meta property=description
        content="<?php echo $escape($desc); ?>">
  <link rel=stylesheet media=screen,projection href=asset/css/screen.css>
  <link rel=stylesheet media=print href=asset/css/print.css>
  <script src=asset/js/jquery.js></script>
  <script src=asset/js/jquery.floatheader.js></script>
  <!--[if IE]><script src=asset/js/html5.js></script><![endif]-->
</head>

<body>

<article class=clearfix>
<?php echo $content; ?>
</article>

<nav>
<ul>
  <li><a href=./>Season Chart</a></li>
  <li class=first><a href="//rainchasers.com">&lsaquo; Rainchasers UK</a></li>

  <li><span data-season=6,7>Alaska</span></li>
  <li><a href=altai.html title=Siberia data-season=6:high,7,8 data-state=rain>Altai</a></li>
  <!--<li><span data-season=8>Argentina</span></li>-->
  <li><span data-season=5,6,7,8 data-state=snow>Austria</span></li>
  <!--<li>Bolivia</li>-->
  <!--<li>Brazil</li>-->
  <li><a href=bc.html title=Canada data-season=5:maybe,6,7,8,9:low data-state=snow>British Columbia</a></li>
  <li><a href=california.html title=USA data-season=3,4,5,6,7>California</a></li>
  <li><a href=cevennes.html title=France data-season=4,5,10,11 data-state=rain>Cévennes</a></li>
  <li><a href=chile.html data-season=1,2,3,10:high,11:high,12>Chile</a></li>
  <!--<li>Columbia</li>-->
  <li><a href=corsica.html data-season=4 data-state=snow>Corsica</a></li>
  <li><span title=Turkey data-season=5,6,7,8 data-state=snow>Coruh</span></li>
  <li><a href=costa-rica.html data-season=6,7,8,9,10,11,12 data-state=rain>Costa Rica</a></li>
  <li><span data-season=8,9>Cuba</span></li>
  <li><span data-season=1,2,3,11,12 data-state=rain>Ecuador</span></li>
  <!--<li>Galicia</li>-->
  <li><span data-season=5,6,7,8,9,10>Georgia</span></li>
  <li><a href=greece.html data-season=4,5 data-state=rain>Greece</a></li>
  <li><span data-season=7,8>Greenland</span></li>
  <li><span title=France data-season=5,6,7:low,8:low data-state=snow>Haut Alps</span></li>
  <li><a href=iceland.html data-season=5,6,7,8,9>Iceland</a></li>
  <li><span data-season=4,5,6>Idaho</span></li>
  <li><span data-season=5,6>Iran</span></li>
  <li><a href=ireland.html data-season=1:low,2,3,4,10,11,12:low data-state=rain>Ireland</a></li>
  <li><a href=japan.html data-season=7,8>Japan</a></li>
  <!--<li>Kamchatka</li>-->
  <!--<li>Korea</li>-->
  <li><a href=kyrgyzstan.html data-season=6,7,8,9:low data-state=snow>Kyrgyzstan</a></li>
  <!--<li>Kurdistan</li>-->
  <li><span title=India data-season=8:snow,9:low>Ladakh</span></li>
  <li><a href=madagascar.html data-season=1:maybe,2:maybe,3:maybe,4,5 data-state=rain>Madagascar</a></li>
  <li><a href=mexico.html data-season=1,2,3,11,12>Mexico</a></li>
  <li><span data-season=6,7>Mongolia</span></li>
  <li><a href=montenegro.html data-season=5,6 data-state=snow>Montenegro</a></li>
  <li><a href=morocco.html data-season=4,5 data-state=snow>Morocco</a></li>
  <li><a href=nepal.html data-season=3,4,5,9:high,10,11,12:low>Nepal</a></li>
  <li><a href=new-zealand.html data-season=1,2,3,4,11,12>New Zealand</a></li>
  <li><a href=norway.html data-season=5,6,7,8,9:low data-state=snow>Norway</a></li>
  <li><span data-season=4,5,6>Oregon</span></li>
  <li><span data-season=10,11>Panama</span></li>
  <!--<li>Papua New Guinea</li>-->
  <li><a href=peru.html data-season=2:high,3,4,5,6,7,8,9:low data-state=snow>Peru</a></li>
  <li><a href=portugal.html data-season=1:low,2,3,4:low,11:low,12:low data-state=rain>Portugal</a></li>
  <li><a href=putorana.html title=Siberia data-season=7:snow>Putorana</a></li>
  <li><a href=pyrenees.html title=Spain/France data-season=4,5 data-state=snow>Pyrénées</a></li>
  <li><span data-season=5,6,7,8,9>Quebec</span></li>
  <li><span title=Australia data-season=1:maybe,2,3,4:low>Queensland</span></li>
  <li><a href=sayan.html title=Siberia data-season=7,8 data-state=rain>Sayan</a></li>
  <li><a href=soca.html title=Slovenia data-season=4:low,5,6,7:low data-state=snow>Soča</a></li>
  <!--<li>South Africa</li>-->
  <!--<li>Sweden</li>-->
  <li><span data-season=5,6 data-state=rain>Taiwan</span></li>
  <li><span data-season=9,10,11>Tajikistan</span></li>
  <li><span data-season=1,2,3,4,5,6,7,8,9,10,11,12 data-state=dam>Uganda</span></li>
  <li><a href=uk.html data-season=1:low,2,3,4,10,11,12:low data-state=rain>UK</a></li>
  <li><a href=val-sesia.html title=Italy data-season=4,5 data-state=snow>Val Sesia</a></li>
  <!--<li>Vietnam</li>-->
  <li><span data-season=4,5,6>Washington</span></li>
  <li><span data-season=9,10,11>Zambezi</span></li>
</ul>
</nav>
<script>
$(function(){ $('nav li:not(:has(a))').hide(); });
</script>

</body>
</html>
