<section class="module-small quiz-list ">
  <div class="container">
    <div class="row">
      <?php if(!empty($quizs)){ ?>
        <?php  $i = 1; ?>
        <?php foreach ($quizs as $quiz) { ?>

          <?php if ($i == 1 ) { ?>
          <div class="col-sm-6 text-center quiz-item ">
            <div class="quiz-bg-blue <?php echo ($quiz['status'] > 1)?'disabled':'';?> ">
              <?php if((int)$quiz['status'] != 1){ ?>
                <p><?php echo $quiz['quiz_title']; ?></p>
              <?php } else{ ?>
                <a href="<?php echo $quiz['quiz_href']; ?>"><span><?php echo $quiz['quiz_title']; ?></span></a>
              <?php } ?>
            </div>
          </div>
          <?php } else if($i == 2){ ?>
          <div class="col-sm-6 text-center quiz-item">
            <div class="quiz-bg-orange <?php echo ($quiz['status'] > 1)?'disabled':'';?>">
              <?php if((int)$quiz['status'] != 1){ ?>
                <p><?php echo $quiz['quiz_title']; ?></p>
              <?php } else{ ?>
                <a href="<?php echo $quiz['quiz_href']; ?>"><span><?php echo $quiz['quiz_title']; ?></span></a>
              <?php } ?>
            </div>
          </div>
          <?php } else{ ?>
          <div class="col-sm-6 col-sm-offset-3 text-center quiz-item">
            <div class="quiz-bg-orange <?php echo ($quiz['status'] > 1)?'disabled':'';?>">
              <?php if((int)$quiz['status'] != 1){ ?>
                <p><?php echo $quiz['quiz_title']; ?></p>
              <?php } else{ ?>
                <a href="<?php echo $quiz['quiz_href']; ?>"><span><?php echo $quiz['quiz_title']; ?></span></a>
              <?php } ?>
            </div>
          </div>
          <?php $i = 1;} ?>

        <?php $i++; } ?>
      <?php } ?>
    </div>
  </div>
</section>