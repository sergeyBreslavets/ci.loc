<?php echo $header; ?>
<?php echo $content_top; ?>
<section class="module" >

<!-- Facebook Conversion Code for Те, кто прошел тест или рейтинг -->
<script>(function() {
var _fbq = window._fbq || (window._fbq = []);
if (!_fbq.loaded) {
var fbds = document.createElement('script');
fbds.async = true;
fbds.src = '//connect.facebook.net/en_US/fbds.js';
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(fbds, s);
_fbq.loaded = true;
}
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', '6032466264977', {'value':'0.00','currency':'RUB'}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6032466264977&amp;cd[value]=0.00&amp;cd[currency]=RUB&amp;noscript=1" /></noscript>
<!-- Facebook Conversion Code for Прохождение теста на сайте -->
<script>(function() {
var _fbq = window._fbq || (window._fbq = []);
if (!_fbq.loaded) {
var fbds = document.createElement('script');
fbds.async = true;
fbds.src = '//connect.facebook.net/en_US/fbds.js';
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(fbds, s);
_fbq.loaded = true;
}
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', '6036712432441', {'value':'0.00','currency':'USD'}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6036712432441&amp;cd[value]=0.00&amp;cd[currency]=USD&amp;noscript=1" /></noscript>
  <div class="container">
    <div class="row module-heading">
      <div class="col-sm-12 ">
        <h1 class="module__heading__title     text-center font-alt m-b-0"><?php echo $heading_title; ?></h1>
        <h2 class="module__heading__subtitle  text-center font-alt m-b-0 m-t-0"><?php echo $sub_heading_title;?></h2>
      </div>
    </div>
      <div class="row">
        <!-- CONTENT -->
        <?php if ($column_left) { ?>
          <div class="col-xs-12 col-sm-4 col-md-3">
            <?php echo $column_left; ?>
          </div>
        <?php } ?>
        <?php if ($column_left && $column_right) { ?>
        <?php $class = 'col-sm-4 col-md-3'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
        <?php $class = 'col-sm-7 col-md-7'; ?>
        <?php } else { ?>
        <?php $class = 'col-sm-12'; ?>
        <?php } ?>
        <div class="<?php echo $class; ?> text-center row my-raiting">
          
          <div class="col-xs-12 col-sm-12 col-md-2 text-right">
            <ul class="social-icons m-t-0">
              <li><span class="vk-icon social-btn" onclick="yaCounter31626893.reachGoal('rating_vk_sharing'); return true;" data-network="vk" data-purl="<?php echo $share_url;?>" data-title='<?php echo $share_title; ?>' data-img="<?php echo $share_img;?>" data-text="<?php echo $share_text; ?>"></span></li>
              <li><span class="facebook-icon social-btn" onclick="yaCounter31626893.reachGoal('rating_fb_sharing'); return true;" data-network="facebook" data-purl="<?php echo $share_url;?>" data-title='<?php echo $share_title; ?>' data-img="<?php echo $share_img;?>" data-text="<?php echo $share_text; ?>"></span></li>
              <li><span class="ok-icon social-btn" onclick="yaCounter31626893.reachGoal('rating_ok_sharing'); return true;" data-network="ok" data-purl="<?php echo $share_url;?>" data-title='<?php echo $share_title; ?>' data-img="<?php echo $share_img;?>" data-text="<?php echo $share_text; ?>"></span></li>
            </ul>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-10 text-center">
            <img src="<?php echo $share_image; ?>">
          </div>
        </div>
        <?php if ($column_right) { ?>
          <div class="col-sm-5 col-md-5 ">
            <?php echo $column_right; ?>
          </div>
        <?php }?>
         <div class="col-sm-12 text-center">
          <h3 class=" font-alt">Сравни свой результат с самыми популярными событиями этого раздела по мнению <?php echo $main_scores;?>. </h3>
        </div>
        <div class="col-sm-12 m-t-30 ">
          <?php if(!empty($top_5)){ ?>
          <?php $i=1; ?>
            <div class="col-xs-12 col-sm-12 ">
              <div class="achievements-bg">
                <?php foreach ($top_5 as $top) { ?>
                <div class="achievement">
                  <div class="achievement-item">
                    <div class="achievements-gallery_item " id="main_item_<?php echo $top['achievement_id']; ?>">
                        <div class="gallery_item-block"  id="item_<?php echo $top['achievement_id']; ?>" >
                          <div class="gallery_item-action">
                            <span><i class="ion-ios-close-empty"></i></span>
                          </div>
                          <div class="gallery_item-image">
                            <img src="<?php echo $achievements[$top['achievement_id']]['achievement_imageb']; ?>" alt="<?php echo $achievements[$top['achievement_id']]['achievement_title']; ?>">
                          </div>
                          <div class="gallery_item-heading">
                            <p><?php echo $achievements[$top['achievement_id']]['achievement_title']; ?></p>
                          </div>
                        </div>
                    </div>
                  </div>
                   <p class="text-center"><?php echo $top['text_voice']; ?></p>
                  </div>
                  <?php if($i==5){break;}?>
                  <?php $i++;} ?>

              </div>
            </div>
            <?php } ?>
        </div>
        <div class="col-sm-12 text-center m-t-30">
					<h2 class="module-title font-alt">Благодарим за участие в независимом народном рейтинге! </h2>
					<h2 class="module-subtitle font-alt m-b-30 "><?php echo $text_more_raiting; ?></h2>
				</div>
        </div>
      </div>
  </div>
    </section>


<?php echo $content_bottom; ?>
<img src="//www.freetopay.ru/cpix.php?ofr=1678&sig=c85b3808183d0833b1fa5b880cd28ec4" width="1" height="1">
<?php if ($social === 'true') { ?>
<script type="text/javascript">
   redirect = 'list_of_ratings';
</script>
<? } ?>
<?php echo $footer; ?>