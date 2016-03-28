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
<!-- Template core CSS -->
<link href="catalog/assets/css/vote_moscow.min.css" rel="stylesheet">
<script type="text/javascript">
    var mobile = false;
    var tablet = false;
    var redirect = true;
  </script>
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
<body class="bgm-white"> 
<!-- PRELOADER -->
  <div class="page-loader">
    <div class="loader">Loading...</div>
  </div>
<!-- /.PRELOADER -->