<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
  <meta name="viewport" content="user-scalable=no,width=device-width, initial-scale=1">

<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Favicons -->
<link href="catalog/assets/images/favicon.ico" rel="icon" />
<link rel="shortcut icon" href="catalog/assets/images/favicon.ico">
<link rel="apple-touch-icon" href="ccatalog/assets/images/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="catalog/assets/images/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="catalog/assets/images/apple-touch-icon-114x114.png">
 
 <?php if($img_for_social){ ?>

<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:description" content="<?php echo $description; ?>" />
<meta property="og:type" content="website" />
<meta property="og:image" content="<?php echo $img_for_social;?>" />

<meta name="mrc__share_title" content="<?php echo $title; ?>" />
<meta name="mrc__share_description" content="<?php echo $description; ?>" />
<link rel="image_src" href="<?php echo $img_for_social;?>" />
 <?php } ?>

  <?php foreach ($links as $link) { ?>
    <link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
  <?php } ?>
  <!-- Template core CSS -->
  <link href="catalog/assets/css/vote_moscow.min.css" rel="stylesheet">
  <?php foreach ($styles as $style) { ?>
    <link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
  <?php } ?>
  <script type="text/javascript">
    var mobile = <?php echo $mobile ;?>;
    var tablet = <?php echo $tablet ;?>;
    var redirect = false;
    var action_ya = false;
  </script>
  <?php echo $google_analytics; ?>
  
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter31626893 = new Ya.Metrika({
                    id:31626893,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/31626893" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->


</head>
<body class="bgm-white <?php echo $class; ?>"> 
<!-- PRELOADER -->
  <div class="page-loader">
    <div class="loader">Loading...</div>
  </div>
  <div class="preaction-loader hidden">
    <div class="preaction ">
      <div id="preaction-hide" class="navigation-hide"><i class="ion-ios-close-outline"></i></div>
    </div>
  </div>
  <div class="preaction-loader-test hidden">
    
    <div class="preaction ">
      <div id="preaction-hide-loader-test" class="navigation-hide"><i class="ion-ios-close-outline"></i></div>
      <div class="message">
        <ul>
          <li><span>1</span>посмотри всех</li>
          <li><span>2</span>подумай </li>
          <li><span>3</span>выбери 5 достойных</li>
          <li><span>4</span>с остальными делай, что хочешь</li>
          <li><span>5</span>прими решение!</li>
        </ul>
      </div>
    </div>
    </div>
  </div>
  <!-- OVERLAY MENU -->
  <div id="overlay-menu" class="overlay-menu">

    <div id="overlay-menu-hide" class="navigation-hide"><i class="ion-ios-close-outline"></i></div>
    
    <div class="overlay-menu-inner">
      <nav class="overlay-menu-nav">
        <ul id="nav">
          <li><a href="<?php echo $add_achievement;?>" class="btn btn-border-d"><i class="ion-ios-plus-empty"></i> Добавить свой объект голосования</a></li>
         </ul>
      </nav>
    </div>
    <div class="overlay-navigation-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 text-center">
            <p class="copyright font-alt m-b-0"&copy;&nbsp;2015&nbsp;<a href="http://result.moscow">МОСКВА 5.0</a>, Все права защищены.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /OVERLAY MENU -->
  <!-- WRAPPER -->
  <div class="wrapper">

  <!-- NAVIGATION -->
    <nav class="navbar navbar-custom navbar-transparent navbar-light navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <!-- YOU LOGO HERE -->
          <?php if ($logo) { ?>
            <a class="navbar-brand" href="<?php echo $home; ?>">
              <img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" width="190"/>
            </a>
          <?php } ?>
        </div>
      
        <!-- ICONS NAVBAR -->
        <ul id="icons-navbar" class="nav navbar-nav navbar-right ">
          <li>
            <a href="#" id="toggle-menu" class="show-overlay" title="Menu">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>
          </li>
        </ul>
        <!-- /ICONS NAVBAR -->
      
        <ul class="extra-navbar nav navbar-nav navbar-right hidden ">
          <li><a href="<?php echo $add_achievement;?>"  class="btn btn-border-nav"><i class="ion-ios-plus-empty"></i> Добавить свой объект голосования</a></li>
        </ul>
      
      </div>
      
    </nav>
    <!-- /NAVIGATION -->

