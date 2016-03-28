<?php echo $header; ?>

<div class="module module-parallax" data-background="image/catalog/default/home-d.jpg">
  <div class="container ">
    <div class="row">


      <div class="col-sm-8 col-md-7 ">
        <div class="row  m-t-10">
          <div class="intro-message">
            <div class="intro-message_years"><span class="count">5</span><span>лет</span> прошло с момента, как мэром Москвы стал Сергей Собянин</div>
            <h1 class="intro-message_heading">Что случилось хорошего?<br>Что плохого?</h1>
            <div class="intro-message_end">Давайте решим вместе!</div>
            <a href="#list_of_ratings" class="section-scroll intro-message_arrow" onclick="yaCounter31626893.reachGoal('independent_rating'); return true;"><span>Независимый народный рейтинг</span></a>
          </div>
        </div>
      </div>
      <div class="col-sm-4 col-md-5 ">
          <div class="col-xs-5 col-sm-12">
            <a href="/rating_nakaz_major" class="card card--any">
              <span>Дай наказ мэру</span>
            </a>
            
           
          </div>
          <div class="col-xs-7 col-sm-12">
            <a href="#" class="card card--news" data-toggle="modal" data-target="#myModal"></a>
          </div>
      </div>  
    </div>
  </div>
</div>

<?php echo $content_top; ?>
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

</div>

<?php if(!empty($raitings_top)) { ?>
  <?php $first = true; ?>
  <?php foreach ($raitings_top as $raiting_top) { ?>
    <!-- STANDARD PARALLAX -->
    <div class="module module-small1 module-parallax bg-dark bg-dark-30" data-background="<?php echo $raiting_top['raiting_image']; ?>">
      <div class="container">
        <!-- MODULE TITLE -->
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3 text-center">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1">
              <a href="<?php echo $raiting_top['raiting_href']; ?>" class="btn <?php echo ($first)?'btn-border-red':'btn-border-w'; ?> btn-block"><?php echo $raiting_top['raiting_title']; ?></a>
              <div class="sub-btn m-t-20"><?php echo $raiting_top['raiting_voice']; ?></div>
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
<?php if(!empty($raitings)) { ?>
  <?php foreach ($raitings as $raiting) { ?>
    <!-- STANDARD PARALLAX -->
    <div class="module module-small1 module-parallax bg-dark bg-dark-30" data-background="<?php echo $raiting['raiting_image']; ?>">
      <div class="container">
        <!-- MODULE TITLE -->
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3 text-center">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1">
              <a href="<?php echo $raiting['raiting_href']; ?>" class="btn btn-border-w btn-block" onclick="yaCounter31626893.reachGoal('<?php echo $raiting['share_btn_ya']; ?> '); return true;"><?php echo $raiting['raiting_title']; ?></a>
              <div class="sub-btn m-t-20"><?php echo $raiting['raiting_voice']; ?></div>
            </div>
          </div>
        </div>
        <!-- /MODULE TITLE -->
      </div>
    </div>
    <!-- /STANDARD PARALLAX -->
  <?php } ?>
<?php } ?>
<?php if (!empty($raitings_off)) { ?>
  <div class="module " >
  <div class="container">
    <div class="row module-heading">
      <div class="col-sm-12">
        <h1 class="module__heading__title     text-center font-alt m-b-0">Посмотри, что решили горожане</h1>
      </div>
    </div>
    <?php if(count($raitings_off) == 1) { ?>
      <?php foreach ($raitings_off as $roff) { ?>
        <div class="row module-heading">
          <div class="col-sm-12 ">
            <h3 class="module__heading__subtitle  text-center font-alt m-b-0 m-t-20"><?php echo $roff['raiting_title']; ?></h3>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-xs-offset-0 col-sm-8 col-sm-offset-2  bg-dark-30 module module--rating" data-background="<?php echo $roff['raiting_image']; ?>">
           <div class="module__l-hand"></div>
           <div class="module__r-hand"></div>
          </div>
          <div class="col-xs-12 col-xs-offset-0 col-sm-8 col-sm-offset-2 ">
            <div class="row module-heading">
              <h3 class="module__heading__subtitle  text-center m-b-0 m-t-10">За фестиваль военных оркестров “Спасская Башня”проголосовало <span class="count">2435</span> человек.</h3>
            </div>
          </div>
        </div>
        
      <?php } ?>
    <?php  } else { ?>

    <?php } ?>
     <div class="row">
        <div class="col-sm-6 col-sm-offset-3 text-center">
          <div class="col-xs-12 col-sm-10 col-sm-offset-1 m-t-20">
            <a href="/topresult" class="btn btn-border-d btn-block " data-step="<?php echo $i; ?>">Посмотреть ещё</a>
          </div>
        </div>
      </div>

  </div>
</div>
<?php } ?>











<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Москва 5.0 News</h4>
      </div>
      <div class="modal-body ">
        <p class="text-center">Новый рейтинг &laquo;Дай наказ мэру&raquo; уже привлек более 30&nbsp;000&nbsp;голосов.</p>
        <p class="text-center">Москвичи голосуют за&nbsp;изменения и&nbsp;предлагают свои идеи для города.</p>
        <p class="text-center">Не&nbsp;упусти возможность!</p>
        <div class="separator"></div>
        <p class="text-center">21-го октября будут подведены итоги Собянинской пятилетки.</p>
        <p class="text-center">Мы&nbsp;расскажем все! Будь готов, горожанин!</p>
       <div class="separator"></div>
          <p class="text-center">Более 44 тысяч человек уже поучаствовало в Битве Мэров. </p>
          <p class="text-center">Мы подвели промежуточные итоги. И не так все однозначно! </p>
          <p class="text-center">Пока со счетом <span>30 000+ на 10 000+ (75% / 25%) побеждает Собянин (при 2000+ ничьих)</span>. </p>
          <p class="text-center">Но Лужков не сдается! </p>
          <p class="text-center">Верные лужковцы и собянинцы, ринг вас ждет!!!</p>
        <p class="text-center"><a href="/rating_nakaz_major" class="btn btn-blue ">Жми на кнопки!</a></p>
      </div>
      <div class="modal-footer hidden">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>


<?php echo $content_bottom; ?>
</div><!-- /WRAPPER -->
<?php echo $footer; ?>
   

    