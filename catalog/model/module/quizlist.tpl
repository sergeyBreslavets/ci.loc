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
      <?php if(!empty($quizs)){ ?>
        <?php  $i = 0; ?>
          <?php if (!empty($quizs[0]) ) { ?>
          <div class="col-xs-12 col-sm-4 text-center quiz-item ">
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
             <div class="col-xs-12 col-sm-2 text-center quiz-item ">
                <?php if((int)$quizs[1]['status'] != 1){ ?>
                  <div class="quiz-bg-guan disabled">
                    <p><?php echo $quiz['quiz_title']; ?></p>
                  </div>
                <?php } else{ ?>
                  <a href="<?php echo $quizs[1]['quiz_href']; ?>"  onclick="yaCounter31626893.reachGoal('<?php echo $quizs[1]['share_id']; ?> '); return true;">
                  <div class="quiz-bg-guan ">
                    <span><?php echo $quizs[1]['quiz_title']; ?></span>
                  </div>
                  </a>
                <?php } ?>
            </div>
          <?php }?>

          <?php if (!empty($quizs[2]) ) { ?>
             <div class="col-xs-12 col-sm-2 text-center quiz-item ">
                <?php if((int)$quizs[2]['status'] != 1){ ?>
                  <div class="quiz-bg-green disabled">
                    <p><?php echo $quiz['quiz_title']; ?></p>
                  </div>
                <?php } else{ ?>
                  <a href="<?php echo $quizs[2]['quiz_href']; ?>"  onclick="yaCounter31626893.reachGoal('<?php echo $quizs[2]['share_id']; ?> '); return true;">
                  <div class="quiz-bg-green ">
                    <span><?php echo $quizs[2]['quiz_title']; ?></span>
                  </div>
                  </a>
                <?php } ?>
            </div>
          <?php }?>

           <?php if (!empty($quizs[3]) ) { ?>
             <div class="col-xs-12 col-sm-4 text-center quiz-item ">
                <?php if((int)$quizs[3]['status'] != 1){ ?>
                  <div class="quiz-bg-orange disabled">
                    <p><?php echo $quiz['quiz_title']; ?></p>
                  </div>
                <?php } else{ ?>
                  <a href="<?php echo $quizs[3]['quiz_href']; ?>"  onclick="yaCounter31626893.reachGoal('<?php echo $quizs[3]['share_id']; ?> '); return true;">
                  <div class="quiz-bg-orange ">
                    <span><?php echo $quizs[3]['quiz_title']; ?></span></div>
                  </a>
                <?php } ?>
            </div>
          <?php }?>

      <?php } ?>
      </div>
    </div>
  </div>
</section>


