<?php
/**
 * nextsw.im front controller.
 *  FB-APP-ID 159877897376773
 *  FB-APP-SECRET f5f89f1471b8aa64bdb3392a67f31cb9
 */
header('Content-type: text/html; charset=utf-8');
header('X-Frame-Options: DENY');
$escape = function($val) {
    return htmlentities($val,ENT_COMPAT,'UTF-8');
};

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
        $fb_title = implode(' ',array_map('ucfirst',explode('-',$src)));
        $title = 'Kayaking in '.$fb_title;
        $fb_type = 'country';
    } else {
        // 404, file does not exist
        header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
        $content = file_get_contents(__DIR__.'/src/404.html');
        $title = $fb_title = 'Page Not Found';
        $fb_type = 'website';
    }
} else {
    $content = file_get_contents(__DIR__.'/src/seasons.html');
    $title = $fb_title = 'Kayaking Seasons';
    $fb_type = 'website';
}
$fb_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$fb_img = strlen($_SERVER['REQUEST_URI'])<=1 ? '/website' : $_SERVER['REQUEST_URI'];
  $fb_img = '/website'; // temporary until populate fb images
$fb_img = 'http://'.$_SERVER['HTTP_HOST'].'/fb'.$fb_img.'.png';
?>
<!DOCTYPE html>
<html lang=en xmlns=http://www.w3.org/1999/xhtml
      xmlns:og=http://opengraphprotocol.org/schema/
      xmlns:fb=http://www.facebook.com/2008/fbml>
<head>
  <title><?php echo $escape($title); ?></title>
  <meta charset=utf-8>
  <meta property=og:title content="<?php echo $escape($fb_title); ?>"> 
  <meta property=og:type content="<?php echo $escape($fb_type); ?>"> 
  <meta property=og:url content=<?php echo $escape($fb_url); ?>> 
  <meta property=og:image content=<?php echo $escape($fb_img); ?>> 
  <meta property=fb:app_id content=159877897376773> 
  <meta property=og:site_name content=nextsw.im> 
  <link rel=stylesheet media=screen,projection href=css/screen.css>
  <link rel=stylesheet media=print href=css/print.css>
  <script src=js/jquery.js></script>
  <script src=js/jquery.floatheader.js></script>
  <!--[if IE]><script src=js/html5.js></script><![endif]-->
</head>

<body>

<article>
<?php echo $content; ?>
</article>

<aside>
<fb:comments width=750></fb:comments>
</aside>

<nav>
<fb:like layout=button_count width=160></fb:like>
<ul>
  <li class=first><a href=./>Season Chart</a></li>

  <li><span data-season=6,7>Alaska</span></li>
  <li><a href=altai title=Siberia data-season=7,8>Altai</a></li>
  <li><span data-season=8>Argentina</span></li>
  <li><span data-season=5,6,7,8>Austria</span></li>
  <!--<li>Bolivia</li>-->
  <!--<li>Brazil</li>-->
  <li><span title=Canada data-season=6,7,8>British Columbia</span></li>
  <!--<li>California</li>-->
  <li><a href=cevennes title=France data-season=4,5,10,11>Cévennes</a></li>
  <li><a href=chile data-season=1,2,3,12>Chile</a></li>
  <!--<li>Columbia</li>-->
  <li><span data-season=4>Corsica</span></li>
  <li><span title=Turkey data-season=5,6,7,8>Coruh</span></li>
  <li><a href=costa-rica data-season=6,7,8,9,10,11,12>Costa Rica</a></li>
  <li><span data-season=8,9>Cuba</span></li>
  <!--<li>Ecuador</li>-->
  <!--<li>Galicia</li>-->
  <!--<li>Georgia</li>-->
  <li><a href=greece data-season=4,5>Greece</a></li>
  <!--<li>Greenland</li>-->
  <li><span title=France data-season=5,6,7>Haut Alps</span></li>
  <li><span data-season=4,5,6>Iceland</span></li>
  <li><span data-season=5,6>Iran</span></li>
  <li><a href=ireland data-season=1,2,3,4,10,11,12>Ireland</a></li>
  <li><a href=japan data-season=7,8>Japan</a></li>
  <!--<li>Kamchatka</li>-->
  <!--<li>Korea</li>-->
  <li><a href=kyrgyzstan data-season=6,7,8,9>Kyrgyzstan</a></li>
  <!--<li>Kurdistan</li>-->
  <li><span title=India data-season=8>Ladakh</span></li>
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
  <!--<li>South Africa</li>-->
  <!--<li>Sweden</li>-->
  <!--<li>Taiwan</li>-->
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

<div id=fb-root></div>
<script>
window.fbAsyncInit = function() {
  FB.init({appId: '159877897376773', status: true, cookie: true,
           xfbml: true});
};
(function() {
  var e = document.createElement('script');
  e.type = 'text/javascript';
  e.src = document.location.protocol +
       '//connect.facebook.net/en_GB/all.js';
  e.async = true;
  document.getElementById('fb-root').appendChild(e);
}());
</script>

</body>
</html>
