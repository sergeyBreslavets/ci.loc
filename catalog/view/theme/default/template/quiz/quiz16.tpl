
<section class="module" >
    <div class="container">
      <div class="row module-heading">
        <div class="col-sm-12">
          <h1 class="module__heading__title     text-center font-alt m-b-0">Знаток метро?</h1>
          <h2 class="module__heading__subtitle  text-center font-alt m-b-0 m-t-0">Знаешь ли ты метро, как знаем его мы?</h2>
          <h3 class="module__heading__subtitle  text-center font-alt m-b-0 m-t-0">В опросе участвовало <span class="count"><?php echo $count_people; ?></span> <?php echo $voices;?></h3>
        </div>
      </div>
    <div class="row wizard-image m-b-20">
      <div class="col-sm-12 text-center hidden-xs">
          <ul class="pagination text-center pagination-default">
            <?php $i = 1; ?>
            <?php foreach ($step_questions as $step) { ?>
              <li id="pstep_<?php echo $i ?>" class="disabled"><a href="#" data-step="<?php echo $i ?>"><?php echo $i ?></a></li>
            <?php $i++; ?>
            <?php } ?>
          </ul>
      </div><!-- /.col-md-12 -->
      <div class="col-sm-12 text-center hidden-sm hidden-md hidden-lg">
        <p class="mobile-pagination">
          <span class="active">1</span> из <span id="all_question"><?php echo count($step_questions); ?></span>
        </p>
      </div><!-- /.col-md-12 -->
      <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
        <?php $i = 1; ?>
        <?php foreach ($step_questions as $step) { ?>
          <div class="module-step quiz-metro-step" id="step_<?= $i; ?>" data-timeout="30">
            <div class="module-question">
              <h4 class="module-question__title m-b-10"><?php echo $step['title']; ?></h4>
            </div>

            <div class="module-answer ">
              <div class="module-answer-countdown text-center m-t-20">
                <div class="countdown-text col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 hidden-xs">До прибытия следующего вопроса осталось:</div>
                <div class="countdown-time col-xs-12 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">00:00</div>
                <div class="module-answer-comment text-center m-b-10"></div>
              </div>
              <div class="module-answer-img">
                  <img src="<?php echo $step['image']; ?>">
              </div>
              <?php $j=1; ?>

              <?php foreach ($step['ar_questions'] as $question) {?>
                <div class="col-xs-12 col-sm-6 text-center m-t-20">
                  <div class="btn btn-block  wizard-btn-answer btn-border-blue "
                    data-step="<?php echo $i; ?>"
                    data-question="<?php echo $step['qitem_id']; ?>"
                    data-answer="<?php echo $question['question_id']; ?>"
                    data-correct="<?php echo $question['correct']; ?>"
                    data-comment="<?php echo $question['answer_comment']; ?>">
                        <span><?php echo $question['answer_title']; ?></span>
                  </div>
                </div>
                <?php $j++; ?>
              <?php } ?>
            </div>

            <div class="module-comment">
              <div class="module-comment__block">
                <div class="module-comment__btn">
                  <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 text-center">
                      <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                        <div class="btn btn-blue btn-block wizard-btn-next-step" data-step="<?php echo $i; ?>">Продолжить</div>
                      </div>
                    </div>
                  </div>
                </div><!-- /.module-comment__btn -->
              </div>
            </div>
          </div>
        <?php $i++; ?>
        <?php } ?>

      </div><!-- /.col-xs-12 -->


      <div class="col-sm-12 text-center hidden">
          <ul class="pagination text-center pagination-default">
            <?php $i = 1; ?>
            <?php foreach ($step_questions as $step) { ?>
              <li id="pstep_<?php echo $i ?>" class="disabled"><a href="#" data-step="<?php echo $i ?>"><?php echo $i ?></a></li>
            <?php $i++; ?>
            <?php } ?>
          </ul>
      </div><!-- /.col-md-12 -->


      <div class="col-sm-12 text-center hidden-sm hidden-md hidden-lg hidden">
        <p class="mobile-pagination">
          <span class="active">1</span> из <span id="all_question">20</span>
        </p>
      </div><!-- /.col-md-12 -->

    </div>
</section>
<form id="poll-form" role="form" action="/result_uznaj_kakoj_ty_moskvich">
  <input type="hidden" name="quiz_id" value="<?php echo $quiz_id;?>">
</form>
<script type="text/javascript">
    var q = <?php echo $quiz_id; ?>;
    var count_steps_of_wizard = <?php echo count($step_questions); ?>;
    var rbtn_share = '<?php echo $share_rbtn_ya; ?>';
    //срабатывание события для yandex метрики
    action_ya = 'btn_quiz_znatok_moscow';

</script>
