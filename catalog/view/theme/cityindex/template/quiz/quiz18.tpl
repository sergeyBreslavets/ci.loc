 <section class="module " data-background="image/catalog/test_bg.jpg">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12  col-md-12  col-lg-12 module module__border module__border--white">
        <div class="row">
            <div class="col-xs-4 col-sm-1 col-md-1 col-lg-1 module__logo">
              <a href="/index.html"><img src="assets/images/logo.png" alt="Дума 2016" class="module__logo-image" ></a>
            </div>
            <div class=" col-xs-6 col-sm-5 col-sm-offset-4 col-md-5 col-md-offset-5 col-lg-4 col-lg-offset-6">
                <span class="module__top_text open-sans-exboltit">567 340 <span>горят сердцами</span>
                </span>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
                <div class="module__burger" id="my-button">
                    <a href="#" ><img src="assets/images/burger_1.png" alt=""></a>
                </div>
            </div>
        </div>

        <div class="menu " id="left-menu">
          <div class="menu__burger-close" id="btn_close">
            <img src="assets/images/burger_2.png" alt="">
          </div>
            <ul class="menu__nav">
              <li class="menu__nav-title open-sans-lite"><a href="/index.html">Главная</a></li>
              <li class="menu__nav-step  open-sans-regular">I Этап</li>
              <li class="menu__nav-title open-sans-lite"><a href="/test1.html">3наток думы</a></li>
              <li class="menu__nav-title open-sans-lite"><a href="/test2.html">Кресло депутата</a></li>
              <li class="menu__nav-title open-sans-lite"><a href="/test3.html">Рейтинг партий</a></li>
              <li class="menu__nav-heros open-sans-lite"><a href="#heros">Герои</a></li>
              <li class="menu__nav-step  menu__nav-stepfix open-sans-regular">II Этап</li>
              <li class="menu__nav-title menu__nav-titlefix open-sans-lite">подпишись чтобы выжить</li>
              <li class="input-group menu__nav-input">
                  <input type="text" class="form-control">
                  <div class="input-group-addon"><a href="#"><i class="fa fa-paper-plane-o"></i></a></div>
              </li>
            </ul>
          </div>

           <!-- заголовки  -->
          <div class="row">
            <div class="col-xs-12  center-block">
                <div class="module__title-test open-sans-exboltit">Какой из тебя депутат?</div>
            </div>
            <div class="col-xs-12  center-block text-center ">
              <span class="module__title-testsubtext open-sans-lite ">Ответь на вопросы по истории госдумы и узнай, можешь ли ты стать достойным героем своего дистрикта!</span>
            </div>
          </div>

          <div class="wizard-next ">
          <!-- пагинация  -->
          <div class="row">
            <div class="col-sm-12 text-center hidden-xs">
              <ul class=" pagination text-center module__paginator--wizard ">
                <?php $i = 1; ?>
                  <?php foreach ($step_questions as $step) { ?>
                    <li id="pstep_<?php echo $i ?>" class="disabled open-sans-lite"><a href="#" data-step="<?php echo $i ?>"><?php echo $i ?></a></li>
                    <?php $i++; ?>
                  <?php } ?>
              </ul>
            </div><!-- /.col-md-12 -->
            <div class="col-sm-12 text-center hidden-sm hidden-md hidden-lg">
              <p class="mobile-pagination open-sans-exboltit">
                <span class="active">1</span> из <span id="all_question"><?php echo count($step_questions); ?></span>
              </p>
            </div><!-- /.col-md-12 -->
          </div>
            <?php $i = 1; ?>
            <?php foreach ($step_questions as $step) { ?>
            <!-- шаги викторины   -->
            <div class="module-step quiz-duma-step" id="step_<?= $i; ?>" data-timeout="30">
                <div class="module-question">
                  <div class="row">
                      <div class="col-xs-12  center-block text-center "> 
                        <div class="module__quest open-sans-exboltit">
                          <?php echo $step['title']; ?>
                        </div>
                      </div>
                  </div>                        
                </div><!-- /.module-question  -->

                <div class="module-answer ">
                  <div class="row">
                    <div class=" col-xs-12  center-block text-center ">
                      <div class="countdown-text col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 hidden-xs open-sans-lite hidden">время пошло:</div>
                      <div class="countdown-time col-xs-12 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">00:00</div>
                    </div>
                  </div>
                  <div class="module_comment"> 
                  <div class="row ">
                    <div class="col-xs-12  center-block text-center ">
                      <div class="module__answer "><span class= "icon-two-dots"></span>
                        <div class="module__answer-text"> <span class="open-sans-regular red-text">В отличие от многих стран мира,</span> <span class="open-sans-lite-it module__answer-font_litel"> где парламентские традиции складывались веками, в России первое  <br> представительное учреждение было созвано лишь в 1906 году и было названо Государственной Думой.</div> 
                        <span class= "icon-two-dots"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row ">
                    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-ms-offset-2 col-lg-8 col-lg-offset-2  text-center ">
                      <div class="module__button_close wizard-btn-next-step" data-step="<?php echo $i; ?>" ><div class="icon-button-next"></div></div>       
                    </div>
                  </div>
                </div><!-- /.module-comment+btn -->
                
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
                      <div class="row">
                        <?php $j=1; ?>
                        <?php foreach ($step['ar_questions'] as $question) { ?>
                          <div class="col-xs-12 col-sm-6 text-center m-t-20">
                            <div class="btn btn-block btn-border-white  wizard-btn-answer open-sans-regular "
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
                      </div><!-- /.row  -->
                    </div><!-- /.col-xs-12  -->
                  </div><!-- /.row  -->
                </div><!-- /.module-answer  -->


                
              </div>
              <?php $i++; ?>
              <?php } ?>
          </div>
                  

                    





                          <div class="row">
                              <div class="col-xs-12 col-sm-5 col-sm-offset-7 col-md-4 col-md-offset-8 col-lg-3 col-lg-offset-9 ">
                              <div class="warning-duma  mt-130 ">  <!-- /*mt-130 убрать если нет таймер*/ -->
                                     <div class="icon-hand ml-12"></div><span class = "warning-duma__text open-sans-lite text-center">информбюро думы <br>предупреждает!</span>
                              </div>
                              </div>
                          </div>






                   


                </div>
            </div>
        </div>
    </section>
    <form id="poll-form" role="form" action="/result_quiz_znatok_duma">
      <input type="hidden" name="quiz_id" value="<?php echo $quiz_id;?>">
    </form>