<?php echo $header; ?>
<div class="module module-parallax" data-background="image/catalog/default/home-city.jpg">
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
  <div class="container ">
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-md-7 ">
        <div class="row">
          <div class="intro-message">
            <div class="intro-message_text">
              <div class="intro-message_text-slogan">
                <span class="intro-message_text-big">Твой город</span> твои правила
              </div>
              Оцени новое, предложи лучшее!
            </div>

            <a href="#list_of_ratings" class="section-scroll intro-message_arrow" onclick="yaCounter31626893.reachGoal('independent_rating'); return true;"><span>Независимый народный рейтинг</span></a>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-4 col-md-5 ">
        <div class="col-xs-8 col-xs-offset-2 col-sm-12">
          <div class="news-icon-wrap">
            <div class="news-icon-circle animated infinite pulse"></div>
            <a href="#" class="card card--news" data-toggle="modal" data-target="#myModal"></a>
          </div>
          <div class="message-btn-wrap">
            <a href="/message_moroz" class="btn btn-block btn-border-red message-moroz">Письмо мэру Морозу</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<section class="module module--small quiz-list ">
  <!-- MODULE TITLE -->
  <div class="row">
    <div class="col-sm-10 col-sm-offset-1 text-center">
      <h2 class="module-title font-alt">Пройди тесты</h2>
    </div>
  </div>
  <!-- /MODULE TITLE -->
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
        <div class="col-xs-12 col-sm-4 text-center quiz-item ">
          <a href="/quiz_znatok_metro">
            <div class="quiz-bg-blue ">
              <span>Знаток метро?</span>
            </div>
          </a>
        </div>
        <div class="col-xs-12 col-sm-4 text-center quiz-item ">
          <a href="/quiz_city_battle">
            <div class="quiz-bg-guan ">
              <div class="one-vs-one"><b class="item-one">Москва</b> <i>VS.</i> <b class="item-two">Питер</b></div>
            </div>
          </a>
        </div>
        <div class="col-xs-12 col-sm-4 text-center quiz-item ">
          <a href="/quiz_sravnenie_moscow">
            <div class="quiz-bg-orange ">
              <span>Впору ли обновки?</span>
            </div>
          </a>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-4 col-sm-offset-4 text-center">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 m-t-20">
          <a href="/topresult" class="btn btn-border-d btn-block ">Больше тестов</a>
        </div>
      </div>
    </div>
  </div>
</section>


<div class="module module--small" id="list_of_ratings">
  <div class="container ">
    <!-- MODULE TITLE -->
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 text-center">
        <h2 class="module-title font-alt">Москва за 5 лет: оцени изменения</h2>
      </div>
    </div>
    <!-- /MODULE TITLE -->
  </div>

  <?php if(!empty($raitings)) { ?>
    <?php $first = true; ?>
    <?php foreach ($raitings as $raiting) { ?>
      <!-- STANDARD PARALLAX -->
      <div class="module module-small1 module-parallax bg-dark bg-dark-30" data-background="<?php echo $raiting['raiting_image']; ?>">
        <div class="container">
          <!-- MODULE TITLE -->
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3 text-center">
              <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                <a href="<?php echo $raiting['raiting_href']; ?>" class="btn <?php echo ($first)?'btn-border-red':'btn-border-w'; ?> btn-block" onclick="yaCounter31626893.reachGoal('<?php echo $raiting['share_btn_ya']; ?> '); return true;"><?php echo $raiting['raiting_title']; ?></a>
                <div class="sub-btn m-t-20"><?php echo $raiting['raiting_voice']; ?></div>
              </div>
            </div>
          </div>
          <!-- /MODULE TITLE -->
        </div>
      </div>
      <!-- /STANDARD PARALLAX -->
      <?php $first = false; ?>
    <?php } ?>
  <?php } ?>

  <div class="container">
    <div class="row">
      <div class="col-sm-8 col-sm-offset-2 text-center">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 m-t-20">
          <a href="/topresult" class="btn btn-border-d btn-block ">Итоги голосования первого этапа</a>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- <div class="module module--quiz">
  <div class="container bg-q">
    <img src="image/catalog/bg-q.png">
    <div class="row module-heading m-t-20">
      <div class="col-sm-12">
        <h1 class="module__heading__title  text-center font-alt m-b-0">Только работа, только хардкор!</h1>
      </div>
    </div>
    <div class="row ">
      <div class="col-xs-12 col-xs-offset-0 col-sm-8 col-sm-offset-2 ">
        <div class="row module-heading">
          <h2 class="module__heading__subtitle  text-center font-alt m-b-0 m-t-10">Уже <span class="count">35 000 человек</span> дали наказ мэру!</h2>
        </div>
      </div>
      <div class="col-xs-12 col-xs-offset-0 col-sm-8 col-sm-offset-2 ">
        <div class="row text-center">
          <div class="col-xs-12">
            <h4>Мэр!</h4>
            <p >Хотим: круглосуточного общественного транспорта, как в Нью-Йорке, подземных парковок в центре, как в Барселоне, развитой инфраструктуры для инвалидов, как в Осло!</p>
          </div>

        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3 text-center">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 m-t-20">
          <a href="/rating_nakaz_major" class="btn btn-blue btn-block ">Дать свой наказ</a>
        </div>
      </div>
    </div>
  </div>
</div> -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Москва 5.0 News</h4>
      </div>
      <div class="modal-body text-center">
        <p>Горожане, мы запустили новый этап голосования!</p>
        <p>Поговорим про город.</p>
        <br>
        <p>Три новых теста:</p>
        <p>
          <b>«Знаток метро»</b><br>
          Узнай все тайны подземки, как можно быстрей!
        </p>
        <p>
          <b>«Впору ли обновки»</b><br>
          Сравни прошлое с настоящим. Реши, нравится ли тебе, как меняется Москва!
        </p>
        <p>
          <b>«Битва городов»</b><br>
          Вечному спору между Москвой и Питером будет положен конец!
        </p>
        <br>
        <p>А также рейтинги:</p>
        <ul class="p-l-0 list-unstyled">
          <li>Любимые места в городе</li>
          <li>Городской транспорт</li>
          <li>Деньги городу!</li>
        </ul>
        <p>Твой город – Твои правила!</p>
        <p><a href="/topresult" class="btn btn-blue ">Жми на кнопки!</a></p>
      </div>
      <div class="modal-footer hidden">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>


<?php echo $content_bottom; ?>
</div>
<!-- /WRAPPER -->
<?php echo $footer; ?>
