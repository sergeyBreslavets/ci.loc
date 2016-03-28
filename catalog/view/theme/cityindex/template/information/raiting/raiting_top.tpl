<?php echo $header; ?>
<?php echo $content_top; ?>

<div class="module module--small">
  <div class="container ">
    <!-- MODULE TITLE -->
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 text-center">
        <h2 class="module-title font-alt">Итоги тестов</h2>
      </div>
    </div>
    <!-- /MODULE TITLE -->
    <div class="row">

      <div class="col-xs-12 col-sm-4 col-md-4 text-center module-achievement">
        <div class="module-achievement__test-title text-center">
          Тест: Какой ты мэр?
        </div>
        <a href="/quiz_major_of_the_city" >
        <div class="module-achievement__test-image text-center">
          <div class="hat-mer"><img src="image/catalog/test_1_l.png"></div>
          <div class="caska"><img src="image/catalog/test_1_r.png"></div>

          <img src="image/catalog/test_1.png">
          <div class="module-achievement__test-image_title module-achievement__test-image_title--blue text-center ">
            Виват, новообращенные  собянинцы! Плитку в руки!
          </div>
        </div>
        </a>
        <a href="/quiz_major_of_the_city" class="btn btn-border-d btn-sm m-t-15">Узнай кто ты?</a>
      </div>

      <div class="col-xs-12 col-sm-4 col-md-4 text-center module-achievement">
        <div class="module-achievement__test-title text-center">
          Тест: Знаток Москвы
        </div>
        <a href="/quiz_znatok_moscow">
        <div class="module-achievement__test-image text-center">
          <img src="image/catalog/test_2.png">
          <div class="module-achievement__test-image_title module-achievement__test-image_title--gyan text-center ">
           Позор!
          </div>
        </div>
        </a>
        <a href="/quiz_znatok_moscow" class="btn btn-border-d btn-sm m-t-15">Проверь себя?</a>
      </div>

      <div class="col-xs-12 col-sm-4 col-md-4 text-center module-achievement">
        <div class="module-achievement__test-title text-center">
          Тест: Битва мэров
        </div>
        <a href="/quiz_battle_mer">
        <div class="module-achievement__test-image text-center">
          <div class="lstr"></div>.
          <div class="rstr"></div>
          <img src="image/catalog/test_3.png">

          <div class="module-achievement__test-image_title module-achievement__test-image_title--green text-center">
           Лужков получил на 20 000 синяков больше!
          </div>
        </div>
        </a>
        <a href="/quiz_battle_mer" class="btn btn-border-d btn-sm m-t-15">Начни бой</a>
      </div>

    </div>
  </div>
</div>

<!-- Facebook Conversion Code for Основные просмотры -->
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
window._fbq.push(['track', '6036712128241', {'value':'0.00','currency':'USD'}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6036712128241&amp;cd[value]=0.00&amp;cd[currency]=USD&amp;noscript=1" /></noscript>

<section class="module" >
  <div class="container">
    <div class="row module-heading">
      <div class="col-sm-12 ">
        <h1 class="module__heading__title     text-center font-alt m-b-0">Независимый народный рейтинг</h1>
        <h2 class="module__heading__subtitle  text-center font-alt m-b-0 m-t-0">Достижения москвы за последние 5 лет</h2>
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
    <?php $class = 'col-sm-12 col-md-6'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div class="<?php echo $class; ?> text-center ">
      <?php if(!empty($raitings)) { ?>
        <?php foreach ($raitings as $raiting) { ?>
          <div class="top-raiting-block active">
            <!-- MODULE TITLE -->
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3 text-center">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                  <h2 class="module-subtitle font-alt m-b-0 "><?php echo $raiting['raiting_title']; ?></h2>
                </div>
              </div>
            </div>
            <!-- /MODULE TITLE -->

            <div class="row">
              <!-- STANDARD PARALLAX -->
              <div class="col-xs-12 col-sm-12 ">
               <?php if(!empty($raiting['top_5'])){ ?>
                  <div class="achievements-bg">
                    <?php foreach ($raiting['top_5'] as $top) { ?>
                      <div class="achievement">
                        <div class="achievement-item">
                          <div class="achievements-gallery_item " id="main_item_<?php echo $top['achievement_id']; ?>">
                            <div class="gallery_item-block"  id="item_<?php echo $top['achievement_id']; ?>" >
                              <div class="gallery_item-action">
                                <span><i class="ion-ios-close-empty"></i></span>
                              </div>
                              <div class="gallery_item-image">
                                <img src="<?php echo $achievements[$top['achievement_id']]['achievement_image']; ?>" alt="<?php echo $achievements[$top['achievement_id']]['achievement_title']; ?>">
                              </div>
                              <div class="gallery_item-heading">
                                <p><?php echo $achievements[$top['achievement_id']]['achievement_title']; ?></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <p class="text-center"><?php echo $top['text_voice']; ?></p>
                      </div>
                    <?php } ?>
                  </div>
                <?php } ?>
              </div>
              <!-- /STANDARD PARALLAX -->
            </div>

            <div class="row">
              <div class="col-sm-6 col-sm-offset-3 text-center">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                  <a href="<?php echo $raiting['raiting_href']; ?>" class="btn btn-blue btn-block" onclick="yaCounter31626893.reachGoal('<?php echo $raiting['share_btn_ya']; ?> '); return true;">Сделать выбор</a>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      <?php } ?>
    </div>
    <?php if ($column_right) { ?>
      <div class="col-sm-12 col-md-6 ">
        <?php echo $column_right; ?>
      </div>
    <?php }?>
    </div>
  </div>
</section>


<?php echo $content_bottom; ?>
<?php echo $footer; ?>
