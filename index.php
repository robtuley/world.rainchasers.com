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
        if (strlen($fb_title)<3) $fb_title = strtoupper($fb_title);
        $title = 'Kayaking in '.$fb_title;
        $fb_type = 'state_province';
    } else {
        // 404, file does not exist
        header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
        echo file_get_contents(__DIR__.'/src/404.html');
        exit;
    }
} else {
    $content = file_get_contents(__DIR__.'/src/seasons.html');
    $title = $fb_title = 'Kayaking Seasons';
    $fb_type = 'website';
}
$fb_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$fb_img = '/website'; // default to standard image
if ($src) {
  $path = __DIR__.'/fb/'.$src.'.png';
  if (file_exists($path)) $fb_img = '/'.$src; // custom image 
}
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
<?php if ($fb_type=='website') : ?>
  <meta property="og:description"
        content="Concise summaries of world kayaking destinations and seasons."/>
<?php endif; ?>
  <link rel=stylesheet media=screen,projection href=css/screen.css>
  <link rel=stylesheet media=print href=css/print.css>
  <script src=js/jquery.js></script>
  <script src=js/jquery.floatheader.js></script>
  <!--[if IE]><script src=js/html5.js></script><![endif]-->
</head>

<body>

<article class=clearfix>
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
  <li><a href=altai title=Siberia data-season=6:high,7,8 data-state=rain>Altai</a></li>
  <!--<li><span data-season=8>Argentina</span></li>-->
  <li><span data-season=5,6,7,8 data-state=snow>Austria</span></li>
  <!--<li>Bolivia</li>-->
  <!--<li>Brazil</li>-->
  <li><a href=bc title=Canada data-season=5:maybe,6,7,8,9:low data-state=snow>British Columbia</a></li>
  <li><a href=california title=USA data-season=3,4,5,6,7>California</a></li>
  <li><a href=cevennes title=France data-season=4,5,10,11 data-state=rain>Cévennes</a></li>
  <li><a href=chile data-season=1,2,3,10:high,11:high,12>Chile</a></li>
  <!--<li>Columbia</li>-->
  <li><a href=corsica data-season=4 data-state=snow>Corsica</a></li>
  <li><span title=Turkey data-season=5,6,7,8 data-state=snow>Coruh</span></li>
  <li><a href=costa-rica data-season=6,7,8,9,10,11,12 data-state=rain>Costa Rica</a></li>
  <li><span data-season=8,9>Cuba</span></li>
  <li><span data-season=1,2,3,11,12 data-state=rain>Ecuador</span></li>
  <!--<li>Galicia</li>-->
  <li><span data-season=5,6,7,8,9,10>Georgia</span></li>
  <li><a href=greece data-season=4,5 data-state=rain>Greece</a></li>
  <li><span data-season=7,8>Greenland</span></li>
  <li><span title=France data-season=5,6,7:low,8:low data-state=snow>Haut Alps</span></li>
  <li><span data-season=4,5,6>Iceland</span></li>
  <li><span data-season=4,5,6>Idaho</span></li>
  <li><span data-season=5,6>Iran</span></li>
  <li><a href=ireland data-season=1:low,2,3,4,10,11,12:low data-state=rain>Ireland</a></li>
  <li><a href=japan data-season=7,8>Japan</a></li>
  <!--<li>Kamchatka</li>-->
  <!--<li>Korea</li>-->
  <li><a href=kyrgyzstan data-season=6,7,8,9:low data-state=snow>Kyrgyzstan</a></li>
  <!--<li>Kurdistan</li>-->
  <li><span title=India data-season=8:snow,9:low>Ladakh</span></li>
  <!--<li>Madagascar</li>-->
  <li><span data-season=1,2,3,11,12>Mexico</span></li>
  <li><span data-season=6,7>Mongolia</span></li>
  <li><a href=montenegro data-season=5,6 data-state=snow>Montenegro</a></li>
  <li><a href=morocco data-season=4,5 data-state=snow>Morocco</a></li>
  <li><a href=nepal data-season=3,4,5,9:high,10,11,12:low>Nepal</a></li>
  <li><a href=new-zealand data-season=1,2,3,4,11,12>New Zealand</a></li>
  <li><a href=norway data-season=5,6,7,8,9:low data-state=snow>Norway</a></li>
  <li><span data-season=4,5,6>Oregon</span></li>
  <li><span data-season=10,11>Panama</span></li>
  <!--<li>Papua New Guinea</li>-->
  <li><a href=peru data-season=2:high,3,4,5,6,7,8,9:low data-state=snow>Peru</a></li>
  <li><a href=portugal data-season=1:low,2,3,4:low,11:low,12:low data-state=rain>Portugal</a></li>
  <li><a href=putorana title=Siberia data-season=7:snow>Putorana</a></li>
  <li><a href=pyrenees title=Spain/France data-season=4,5 data-state=snow>Pyrénées</a></li>
  <li><span data-season=5,6,7,8,9>Quebec</span></li>
  <li><a href=sayan title=Siberia data-season=7,8 data-state=rain>Sayan</a></li>
  <li><a href=soca title=Slovenia data-season=4:low,5,6,7:low data-state=snow>Soča</a></li>
  <!--<li>South Africa</li>-->
  <!--<li>Sweden</li>-->
  <li><span data-season=5,6 data-state=rain>Taiwan</span></li>
  <li><span data-season=9,10,11>Tajikistan</span></li>
  <li><span data-season=1,2,3,4,5,6,7,8,9,10,11,12 data-state=dam>Uganda</span></li>
  <li><a href=uk data-season=1:low,2,3,4,10,11,12:low data-state=rain>UK</a></li>
  <li><a href=val-sesia title=Italy data-season=4,5 data-state=snow>Val Sesia</a></li>
  <!--<li>Vietnam</li>-->
  <li><span data-season=4,5,6>Washington</span></li>
  <li><span data-season=9,10,11>Zambezi</span></li>
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
