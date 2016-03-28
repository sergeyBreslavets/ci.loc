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
<link rel="apple-touch-icon" href="catalog/assets/images/apple-touch-icon.png">
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
  <link href="catalog/view/theme/cityindex/assets/css/styles.css" rel="stylesheet">
  <?php foreach ($styles as $style) { ?>
    <link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
  <?php } ?>
  
  <script type="text/javascript">
    var mobile = <?php echo $mobile ;?>;
    var tablet = <?php echo $tablet ;?>;
  </script>

  <?php echo $google_analytics; ?>
  

</head>
<body class="<?php echo $class; ?>">
<!-- PRELOADER -->
    <div class="page-loader" style="display: none;">
        <div class="loader">Loading...</div>
    </div>
    <!-- /PRELOADER -->
    <!-- SIDEBAR -->
    <div class="sidebar" id="top">
        <nav class="navbar navbar-custom font-alt">
            <div class="navbar-header navbar-custom">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#custom-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- YOU LOGO HERE -->
                <a class="navbar-brand" href="/">
                    <!-- IMAGE OR SIMPLE TEXT -->
                    cityindex
                </a>
            </div>
            <div class="collapse navbar-collapse" id="custom-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="/about_us">О проекте</a></li>
                    <li><a href="/rating_frack" >Рейтинг фракций Государственной думы РФ</a></li>
                    <li><a href="/rating_department">Рейтинг департаментов</a></li>
                    <li><a href="/rating_official">Рейтинг чиновников Правительства Москвы</a></li>
                    <li><a href="/rating_deputy">Рейтинг депутатов Мосгордумы</a></li>
                    <li><a href="//www.citymetrix.ru/" target="_blank">Рейтинги госучреждений и бизнеса</a></li>
                    <li><a href="/contact-us">Заказать исследование</a></li>
                </ul>
            </div>
        </nav>
        <!-- SOCIAL LINKS -->
        <div class="copyright">
            <ul class="info_copy">
                <li><a href="info@citymetrix.ru">info@citymetrix.ru</a></li>
               <!--  <li><a href="">+7 (495) 660-62-47</a></li> --><!-- 
                <li class="menu__text_subscribe">Подписаться на обновления рейтингов</li> -->
                <!-- <li>
                    <div class="input-group">
                        <input type="email" id="email" name="cemail" class="form-control menu__input-in-menu" placeholder="E-mail*" required="" data-validation-required-message="Введите Email.">
                        <div class="input-group-addon menu__input-in-menu-btn"><i class="fa fa-paper-plane-o"></i></div>
                    </div>
                    <p class="help-block text-danger"></p>
                </li> -->
            </ul>
            <div class="social-icons m-b-20">
                <a href="http://vk.com/cityindex" target="_blank" class="fa fa-vk"></a>
                <a href="https://www.facebook.com/cityindex" target="_blank" class="fa fa-facebook facebook"></a>
            </div>
            <p>© 2015-2016 Сityindex</p>
        </div>
        <!-- /SOCIAL LINKS -->
    </div>
    <!-- /SIDEBAR -->


