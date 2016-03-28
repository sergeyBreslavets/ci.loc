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
  <link href="catalog/view/theme/duma/assets/css/duma.min.css" rel="stylesheet">
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
  

</head>
<body class="bgm-white <?php echo $class; ?>">
<div class="page-loader"><!-- preloader -->
  <div class="page-loader loader">Loading...</div>
</div><!-- /.preloader -->


