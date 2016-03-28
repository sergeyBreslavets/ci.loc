<section class="module">
  <div class="container">
    <div class="row module-heading">
      <div class="col-sm-12">
        <h1 class="module__heading__title     text-center font-alt m-b-0">Битва городов</h1>
        <h2 class="module__heading__subtitle  text-center font-alt m-b-0 m-t-0">Реши, какая из столиц тебе ближе!</h2>
        <h3 class="module__heading__subtitle  text-center font-alt m-b-0 m-t-0">
          В опросе участвовало <span class="count"><?php echo $count_people; ?></span> <?php echo $voices;?>
        </h3>
      </div>
    </div>

    <div class="row wizard-battle m-t-20 m-b-20">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
        <div class="col-xs-6 text-center">
          <div class="city-title">Москва</div>
          <div class="city-image moscow">
            <div class="city-image-wrap">
                <img src="image/catalog/city_battle/moscow-main.jpg" alt="Москва">
                <div class="city-image-overlay">
                  <!-- !!Здесь спецэффекты для Москвы -->
                </div>
            </div>
          </div>
        </div>
        <div class="col-xs-6 text-center">
          <div class="city-title">Питер</div>
          <div class="city-image piter">
            <div class="city-image-wrap">
                <img src="image/catalog/city_battle/piter-main.jpg" alt="Питер">
                <div class="city-image-overlay">
                  <!-- !!Здесь спецэффекты для Питера -->
                </div>
            </div>
          </div>
        </div>
      </div>

      <!-- !! -->
      <div class="module-intro col-xs-12">
        <div class="module-intro-image col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-4">
          <img src="image/catalog/city_battle/city-battle-intro.png" alt="">
        </div>
        <div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-4 col-lg-2 col-lg-offset-5">
          <div class="module-intro-btn">
            <div class="btn btn-block btn-blue wizard-battle-begin">
              <span>Начать</span>
            </div>
          </div>
        </div>
      </div>
      <!-- !! -->

      <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
        <?php $i = 1; ?>
        <?php foreach ($step_questions as $step) { ?>
          <div class="module-step" id="step_<?php echo $i; ?>">
            <div class="module-step-text text-center"><?php echo $i; ?> раунд</div>
            <?php $j = 1; ?>
            <?php foreach ($step['ar_questions'] as $question) { ?>
              <div class="wizard-variant var<?php echo $j; ?> col-xs-6 col-sm-5 <?php echo ($j == 2 ? 'col-sm-offset-2' : '');?> text-center m-t-20">
                <div class="wizard-variant-image">
                  <img src="<?php echo $question['image']; ?>" alt="">
                </div>
                <div class="btn btn-block wizard-variant-btn"
                  data-step="<?php echo $i; ?>"
                  data-question="<?php echo $step['qitem_id']; ?>"
                  data-answer="<?php echo $question['question_id']; ?>"
                  data-correct="<?php echo $question['correct']; ?>"
                  data-comment="<?php echo $question['answer_comment']; ?>"
                  data-image="<?php echo $question['image']; ?>">
                  <span>
                    <?php echo $question['answer_title']; ?>
                  </span>
                </div>
              </div>
              <?php $j++; ?>
            <?php } ?>
          </div>
          <?php $i++; ?>
        <?php } ?>
      </div>
    </div>
  </div>
</section>

<form id="poll-form" role="form" action="/result_uznaj_kakoj_ty_moskvich">
  <input type="hidden" name="quiz_id" value="<?php echo $quiz_id;?>">
</form>
<script type="text/javascript">
  var q = <?php echo $quiz_id; ?>;
  var rbtn_share = '<?php echo $share_rbtn_ya; ?>';
  //срабатывание события для yandex метрики
  action_ya = 'btn_quiz_znatok_moscow';
</script>
