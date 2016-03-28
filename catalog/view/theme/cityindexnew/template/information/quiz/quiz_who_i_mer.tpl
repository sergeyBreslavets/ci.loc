
<?php echo $header; ?>
<script type="text/javascript">
    var q = <?php echo $quiz_id; ?>;
    var rbtn_share = '<?php echo $share_rbtn_ya; ?>';
    var count_correct = 5;
    var type = 'medium';
    action_ya = 'btn_quiz_who_i_mer';
</script>
<section class="module" >
    <div class="container">
        <div class="row">
			<div class="col-sm-offset-1 col-sm-10 text-center">
                <h4 class="module-subtitle font-alt m-b-0 count_quiz">Стало мэром <span><?php echo $count_quiz; ?></span> <?php echo $t_voices;?></h4>
                <h2 class="module-subtitle font-alt m-b-0">1 апреля 2016 года тебя назначили мэром Москвы. </h2>
				<h1 class="module-title font-alt m-b-10">Кого из чиновников ты возьмешь в команду, кого уволишь, а кого первый раз видишь?.</h1>

                <h5 class="font-alt m-b-10">Увольняй хоть всех, знакомься со&nbsp;всеми, но&nbsp;в&nbsp;команду ты&nbsp;можешь взять до 5 чиновников</h5>
			</div>
            <div class="wizard chinovniki">
                <?php if(!empty($achievements)) { ?>
        		<div class="col-sm-12 text-center hidden-xs">
                    <ul class="pagination text-center pagination-action">
                        <?php $i = 1; ?>
                        <?php foreach ($achievements as $achievement) { ?>
                            <li id="pstep_<?php echo $i;?>" data-achievement="<?php echo $achievement['achievement_id']; ?>" >
                                <a href="#" data-step="<?php echo $i;?>" ><img src="<?php echo $achievement['achievement_image_face_small'];?>" ></a>
                            </li>
                         <?php $i++;} ?>
                    </ul>
                </div><!-- /.col-md-12 -->
                 <div class="col-xs-6 col-sm-6 section-action-line">
                     <h4 class="font-alt m-b-0 ">У тебя в команде <span id="current_count">0 чиновников</span> </h4>
                 </div>
                <div class="hidden-xs col-sm-6 text-center  section-action">
                    <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                      <div class="btn btn-blue btn-block m-t-20 disabled" id="send_result_quiz_medium">Принять решение</div> 
                    </div>
                </div>
                <div class="col-xs-6 text-center hidden-sm hidden-md hidden-lg">
                   <p class="mobile-pagination"><span class="active">1</span> из <span id="all_question"></span></p>
                </div> 

                <form id="poll-form" role="form">
                    <input type="hidden" name="quiz_id" value="<?php echo $quiz_id;?>">
                </form> 
                <div class="clearfix"></div>
               <div class="hidden-sm hidden-md hidden-lg section-action">
                    <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                      <div class="btn btn-blue btn-block m-t-20 disabled" id="mobile_send_result_quiz_medium">Принять решение</div> 
                    </div>
                </div>
                
                <div class="hidden-xs col-sm-1 col-md-2 col-lg-2 m-t-20 navigation-quiz">
                    <div class="arrow-left" id="prev-step"></div>
                </div>
                <div class="col-xs-12 col-sm-10 col-md-8 col-lg-8 m-t-20">
                    <?php $i = 1; ?>
                    <?php foreach ($achievements as $achievement) { ?>
                        <div class="step_view " id="step_<?php echo $i;?>" >
                            <div class="question">
                                <div class="row">
                                    <div class="col-xs-4 col-sm-4">
                                        <div class="avatar"><img src="<?php echo $achievement['achievement_image_face']; ?>"></div>
                                    </div>
                                    <div class="col-xs-8 col-sm-8">
                                        <h4 class="achievement-title m-t-0"><?php echo $achievement['achievement_title']; ?></h4>
                                        <h4 class="hidden-sm hidden-md hidden-lg achievement-description m-t-0"><?php echo $achievement['achievement_description']; ?></h4>
                                    </div>
                                    <div class="hidden-xs  col-sm-8 "><h4 class="achievement-description m-t-0"><?php echo $achievement['achievement_description']; ?></h4></div>
                                </div>
                            </div>

                            <div class="module-answer ">
                                <div class="hidden-sm hidden-md hidden-lg mobile-face">
                                    <div class="face answer-btn" data-step="<?php echo $i;?>" data-answer="1" data-voice="correct" data-achievement="<?php echo $achievement['achievement_id']; ?>">
                                        <div class="face-btn qlike"></div><span>Да</span>
                                    </div>
                                    <div class="face answer-btn" data-step="<?php echo $i;?>" data-answer="2"  data-voice="other" data-achievement="<?php echo $achievement['achievement_id']; ?>">
                                        <div class="face-btn qwho"></div><span>А кто это?</span>
                                    </div>
                                    <div class="face answer-btn" data-step="<?php echo $i;?>" data-answer="0"  data-voice="no-correct" data-achievement="<?php echo $achievement['achievement_id']; ?>">
                                        <div class="face-btn qdislike"></div><span>Нет</span>
                                    </div>
                                </div>
                                <div class="hidden-xs col-sm-8 col-sm-offset-4">
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
                                        <div class="face answer-btn" data-step="<?php echo $i;?>" data-answer="1" data-voice="correct" data-achievement="<?php echo $achievement['achievement_id']; ?>">
                                            <div class="face-btn qlike"></div><span>Да</span>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
                                        <div class="face answer-btn" data-step="<?php echo $i;?>" data-answer="2"  data-voice="other" data-achievement="<?php echo $achievement['achievement_id']; ?>">
                                            <div class="face-btn qwho"></div><span>А кто это?</span>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
                                        <div class="face answer-btn" data-step="<?php echo $i;?>" data-answer="0"  data-voice="no-correct" data-achievement="<?php echo $achievement['achievement_id']; ?>">
                                            <div class="face-btn qdislike"></div><span>Нет</span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    <?php $i++;} ?>
                </div>
                 <div class="hidden-xs col-sm-1 col-md-2 col-lg-2 m-t-20 navigation-quiz">
                    <div class="arrow-right" id="next-step"></div>
                </div>

                <?php } ?>
            </div><!-- /.wizard -->

        </div>
    </div>
</section>

<?php echo $column_left; ?>
<?php echo $content_top; ?>
<?php echo $column_right; ?>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>