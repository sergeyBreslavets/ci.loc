
<?php echo $header; ?>
<script type="text/javascript">
    var q = <?php echo $quiz_id; ?>
</script>
<section class="module" >
    <div class="container">
        <div class="row">
			<div class="col-sm-12 text-center">
                <h2 class="module-subtitle font-alt m-b-0">1 апреля 2016 года тебя назначили мэром Москвы. </h2>
				<h1 class="module-title font-alt m-b-0">Кого из чиновников ты возьмешь в команду, кого уволишь, а кого первый раз видишь?.</h1>
			</div>
            <div class="wizard chinovniki">
                <?php if(!empty($achievements)) { ?>
        		<div class="col-sm-12 text-center hidden-xs">
                    <ul class="pagination text-center">
                        <?php $i = 1; ?>
                        <?php foreach ($achievements as $achievement) { ?>
                            <li id="pstep_<?php echo $i;?>" class=""   >
                                <a href="#" data-step="<?php echo $i;?>"><img src="<?php echo $achievement['achievement_image_face_small'];?>" ></a>
                            </li>
                         <?php $i++;} ?>
                    </ul>
                </div><!-- /.col-md-12 -->
                <form id="poll-form" role="form">
                    <input type="hidden" name="quiz_id" value="<?php echo $quiz_id;?>">
                </form>	
                
                <div class="col-sm-12 text-center hidden-sm hidden-md hidden-lg">
                        <p class="mobile-pagination"><span class="active">1</span> из <span id="all_question">20</span></p>
                </div> 
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 m-t-20">
                    <?php $i = 1; ?>
                    <?php foreach ($achievements as $achievement) { ?>
                        <div class="step_view " id="step_<?php echo $i;?>" >
                            <div class="question">
                                <div class="row">
                                    <div class="col-xs-4 col-sm-5">
                                        <div class="avatar"><img src="<?php echo $achievement['achievement_image_face']; ?>"></div>
                                    </div>
                                    <div class="col-xs-8 col-sm-7"><h4 class="m-t-0"><?php echo $achievement['achievement_title']; ?></h4></div>
                                </div>
                            </div>
                            <div class="module-answer face">
                                <div class="col-xs-12 col-sm-5"></div>
                                <div class="col-xs-12 col-sm-7">
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
                                        <div class="face answer-btn" data-step="<?php echo $i;?>" data-answer="1">
                                            <div class="face-btn qlike"></div><span>Да</span>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
                                        <div class="face answer-btn" data-step="<?php echo $i;?>" data-answer="2">
                                            <div class="face-btn qwho"></div><span>А кто это?</span>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
                                        <div class="face answer-btn" data-step="<?php echo $i;?>" data-answer="0">
                                            <div class="face-btn qdislike"></div><span>Нет</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php $i++;} ?>
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