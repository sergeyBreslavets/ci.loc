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
      <div class="row">
        <div class="col-sm-12 text-center">
          <h1 class="module-title font-alt">Это твой результат!</h1>
          <h2 class="module-subtitle font-alt m-b-10">Поделись им с друзьями!</h2>
        </div>
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
        <?php $class = 'col-sm-7 col-md-7'; ?>
        <?php } ?>
        <div class="<?php echo $class; ?> text-center row my-raiting">
          
          <div class="col-sm-12 col-md-2 text-right">
            <ul class="social-icons m-t-0">
              <li><span class="vk-icon social-btn" onclick="yaCounter31626893.reachGoal('<?php echo $share_btn_vk; ?>'); return true;" data-network="vk" data-purl="<?php echo $share_url_vk;?>" data-title='<?php echo $share_title; ?>' data-img="<?php echo $share_image;?>" data-text="<?php echo $share_text; ?>"></span></li>
              <li><span class="facebook-icon social-btn" onclick="yaCounter31626893.reachGoal('<?php echo $share_btn_fb; ?>'); return true;" data-network="facebook" data-purl="<?php echo $share_url_fb;?>" data-title='<?php echo $share_title; ?>' data-img="<?php echo $share_image;?>" data-text="<?php echo $share_text; ?>"></span></li>
              <li><span class="ok-icon social-btn" onclick="yaCounter31626893.reachGoal('<?php echo $share_btn_ok; ?>'); return true;" data-network="ok" data-purl="<?php echo $share_url_ok;?>" data-title='<?php echo $share_title; ?>' data-img="<?php echo $share_image;?>" data-text="<?php echo $share_text; ?>"></span></li>
            </ul>
          </div>
          <div class="col-sm-12 col-md-10 text-center">
            <img src="<?php echo $share_image; ?>" alt='<?php echo $share_title; ?>'>
          </div>
        </div>
       
          <div class="col-sm-5 col-md-5 ">
            <div class="row quiz-list-raiting ">
              <?php if(!empty($quizs)){ ?>
                <?php  $i = 0; ?>
                  <?php if (!empty($quizs[0]) ) { ?>
                  <div class="col-xs-12 text-center quiz-item ">
                      <?php if((int)$quizs[0]['status'] != 1){ ?>
                        <div class="quiz-bg-blue disabled">
                          <p><?php echo $quiz['quiz_title']; ?></p>
                        </div>
                      <?php } else{ ?>
                        <a href="<?php echo $quizs[0]['quiz_href']; ?>"  onclick="yaCounter31626893.reachGoal('<?php echo $quizs[0]['share_id']; ?> '); return true;">
                          <div class="quiz-bg-blue ">
                            <span><?php echo $quizs[0]['quiz_title']; ?></span>
                          </div>
                        </a>
                      <?php } ?>
                  </div>
                  <?php }?>

                  <?php if (!empty($quizs[1]) ) { ?>
                     <div class="col-xs-12 text-center quiz-item ">
                        <?php if((int)$quizs[1]['status'] != 1){ ?>
                          <div class="quiz-bg-green disabled">
                            <p><?php echo $quiz['quiz_title']; ?></p>
                          </div>
                        <?php } else{ ?>
                          <a href="<?php echo $quizs[1]['quiz_href']; ?>"  onclick="yaCounter31626893.reachGoal('<?php echo $quizs[1]['share_id']; ?> '); return true;">
                          <div class="quiz-bg-green ">
                            <span><?php echo $quizs[1]['quiz_title']; ?></span>
                          </div>
                          </a>
                        <?php } ?>
                    </div>
                  <?php }?>

                  <?php if (!empty($quizs[2]) ) { ?>
                     <div class="col-xs-12 text-center quiz-item ">
                        <?php if((int)$quizs[2]['status'] != 1){ ?>
                          <div class="quiz-bg-orange disabled">
                            <p><?php echo $quiz['quiz_title']; ?></p>
                          </div>
                        <?php } else{ ?>
                         <a href="<?php echo $quizs[2]['quiz_href']; ?>"  onclick="yaCounter31626893.reachGoal('<?php echo $quizs[2]['share_id']; ?> '); return true;">
                          <div class="quiz-bg-orange ">
                            <span><?php echo $quizs[2]['quiz_title']; ?></span></div>
                          </a>
                        <?php } ?>
                    </div>
                  <?php }?>

              <?php } ?>
              </div>
              <?php if ($column_right) { ?>
                <?php echo $column_right; ?>
              <?php }?>
          </div>
       
        </div>
      </div>
  </div>
</section>


<?php echo $content_bottom; ?>
<?php echo $footer; ?>