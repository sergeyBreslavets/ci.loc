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



