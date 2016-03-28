
<?php echo $header; ?>
    <section class="module preaction-battle">
        <div class="container ">
            <div class="row module-heading ">
                <div class="col-xs-12">
                    <h1 class="module__heading__title     text-center font-alt m-b-0">Битва мэров</h1>
                    <h2 class="module__heading__subtitle  text-center font-alt m-b-20 m-t-0">По результатам <span class="count"><?php echo $count_quiz; ?></span> <?php echo $t_voices;?></h2>
                </div>
            </div>
            <div class="row m-t-20">
                <div class="col-xs-6 col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3 ">
                    <div class="module__fighter">
                        <div class="module__fighter__image">
                            <img src="image/battle/sobyanin.png" >
                        </div>
                        <div class="module__fighter__name">
                            Собянин одержал победу в:
                        </div>
                        <div class="module__fighter__score module__fighter__score--red">
                            <span><?php echo $results_battle['win_mer_1']; ?></span> <?php echo $results_battle['word_win_mer_1']; ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-4 col-md-3 ">
                    <div class="module__fighter">
                        <div class="module__fighter__image">
                            <img src="image/battle/luzhkov.png" >
                        </div>
                        <div class="module__fighter__name">
                            Лужков одержал победу в:
                        </div>
                        <div class="module__fighter__score module__fighter__score--blue">
                            <span><?php echo $results_battle['win_mer_2']; ?></span> <?php echo $results_battle['word_win_mer_2']; ?>
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-12  col-sm-offset-4 col-sm-4 text-center">
                    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1">
                      <div class="module__fighter m-t-10">
                        <div class="module__fighter__score module__fighter__score--green">
                            Ничья в: <span><?php echo $results_battle['friend']; ?></span> <?php echo $results_battle['word_friend']; ?>
                        </div>
                    </div>
                    </div>
                </div>


                <div class="col-xs-12  col-sm-offset-4 col-sm-4 text-center">
                    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1">
                      <div class="btn btn-blue btn-block m-t-20 m-b-20 " id="start_game">Начать битву</div> 
                    </div>
                </div>

            </div>
            <div class="row module-heading">
                <div class="col-xs-12">
                    <h2 class="module__heading__subtitle  text-center font-alt m-b-20 m-t-0">Твой бой окажется ключевым!</h2>
                </div>
            </div>
        </div>
    </section>
<section class="module battle" >
    <div class="hats">
        <div class="hat hat_1"> <img src="image/battle/hat_1.png"></div>
        <div class="hat hat_2"> <img src="image/battle/hat_2.png"></div>
    </div>
    <script type="text/javascript">
        var q = <?php echo $quiz_id; ?>;
        var rbtn_share = '<?php echo $share_rbtn_ya; ?>';
        action_ya = 'btn_quiz_battle_mer';
    </script>
    <div class="container">
        <div class="row module-heading">
            <div class="col-sm-12">
              <h1 class="module__heading__title     text-center font-alt m-b-0">Реши, кто победит.</h1>
              <h2 class="module__heading__subtitle  text-center font-alt m-b-0 m-t-0">Чьи проекты больше повлияли на жизнь москвичей? Судить тебе!</h2>
          </div>
        </div>
        <div class="row ">
			
            <form id="poll-form" role="form" action="/result_uznaj_kakoj_ty_moskvich">
                <input type="hidden" name="quiz_id" value="<?php echo $quiz_id;?>">
            </form>
            <div class="col-xs-6 col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3 ">
                <div class="module__fighter m-t-20">
                    <div class="module__fighter__name module__fighter__name--fight text-center">
                        Лужков
                    </div>
                    <div class="module__fighter__image module__fighter__image--avatar" id="fighter_1">
                        <img src="image/battle/L_fighter1_0.png" class="current">
                        <img src="image/battle/L_fighter1_1.png" data-strike="2">
                        <img src="image/battle/L_fighter1_2.png" data-strike="4">
                        <img src="image/battle/L_fighter1_3.png" data-strike="6">
                        <img src="image/battle/L_fighter1_4.png" data-strike="8">
                        <img src="image/battle/L_fighter1_5.png" data-strike="10">
                        <img src="image/battle/L_fighter1_6.png" data-strike="12">
                        <img src="image/battle/L_fighter1_7.png" data-strike="14">
                    </div>
                    <div class="module__fighter__strike module__fighter__strike--left">
                        <img src="image/battle/perchatki_left.gif">
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-4  col-md-3 ">
                <div class="module__fighter m-t-20">
                    <div class="module__fighter__name module__fighter__name--fight text-center">
                        Собянин
                    </div>
                    <div class="module__fighter__image module__fighter__image--avatar" id="fighter_2">
                        <img src="image/battle/S_Fighter1_0.png" class="current">
                        <img src="image/battle/S_Fighter1_1.png" data-strike="2">
                        <img src="image/battle/S_Fighter1_2.png" data-strike="4">
                        <img src="image/battle/S_Fighter1_3.png" data-strike="6">
                        <img src="image/battle/S_Fighter1_4.png" data-strike="8">
                        <img src="image/battle/S_Fighter1_5.png" data-strike="10">
                        <img src="image/battle/S_Fighter1_6.png" data-strike="12">
                        <img src="image/battle/S_Fighter1_7.png" data-strike="14">
                    </div>
                    <div class="module__fighter__strike module__fighter__strike--right">
                        <img src="image/battle/perchatki_right.gif">
                    </div>
                </div>
            </div>     
            <div class="col-xs-12 text-center">
                <div class="module__fighter__raund">
                    <span class="number count_round">1</span> раунд
                </div>
            </div>
                

              
            
        </div><!-- /.row -->
        
        
        <div class="row strikes ">  
            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 m-t-20 m-b-20">
                
                <div class="round_view " id="step_1" >
                    <div class="col-xs-6">
                        <div class="btn-strike-l battle-strike" data-step="1" data-answer="1" data-voice="correct"  data-achievement="1">
                            <span class="name-strike">Реконструкция МКАД</span>
                            <span class="pic-strike"><img src="image/battle/l-strike.png"></span>
                        </div>

                    </div>
                    <div class="col-xs-6 ">
                        <div class="btn-strike-r battle-strike" data-step="1" data-answer="2" data-voice="no-correct"  data-achievement="1">
                            <span class="pic-strike"><img src="image/battle/r-strike.png"></span>
                            <span class="name-strike">75 новых развязок на МКАД</span>
                        </div>

                    </div>
                </div>

                <div class="round_view " id="step_2" >
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-l battle-strike" data-step="2" data-answer="1" data-voice="correct"  data-achievement="2">
                            <span class="name-strike">Строительство торговых центров</span>
                            <span class="pic-strike"><img src="image/battle/l-strike.png"></span>
                        </div>
                   </div>
     
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-r battle-strike" data-step="2" data-answer="2" data-voice="no-correct"  data-achievement="2">
                            <span class="pic-strike"><img src="image/battle/r-strike.png"></span>
                            <span class="name-strike">Закрытие рынков</span>
                            
                        </div>
                    </div>
                </div>

                <div class="round_view " id="step_3" >
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-l battle-strike" data-step="3" data-answer="1" data-voice="correct"  data-achievement="3">
                            <span class="name-strike">Метро вышло за МКАД</span>
                            <span class="pic-strike"><img src="image/battle/l-strike.png"></span>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-r battle-strike" data-step="3" data-answer="2" data-voice="no-correct"  data-achievement="3">
                            <span class="pic-strike"><img src="image/battle/r-strike.png"></span>
                            <span class="name-strike">14 новых станций метро</span>
                        </div>
                    </div>
                </div>

                <div class="round_view " id="step_4" >
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-l battle-strike" data-step="4" data-answer="1" data-voice="correct"  data-achievement="4">
                            <span class="name-strike">Восстановление Храма Христа Спасителя</span>
                            <span class="pic-strike"><img src="image/battle/l-strike.png"></span>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-r battle-strike" data-step="4" data-answer="2" data-voice="no-correct"  data-achievement="4">
                            <span class="pic-strike"><img src="image/battle/r-strike.png"></span>
                            <span class="name-strike">Благоустройство парков</span>
                        </div>
                    </div>
                </div>

                <div class="round_view " id="step_5" >
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-l battle-strike" data-step="5" data-answer="1" data-voice="correct"  data-achievement="5">
                             <span class="name-strike">Устранение гаражей-ракушек</span>
                            <span class="pic-strike"><img src="image/battle/l-strike.png"></span>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-r battle-strike" data-step="5" data-answer="2" data-voice="no-correct"  data-achievement="5">
                            <span class="pic-strike"><img src="image/battle/r-strike.png"></span>
                            <span class="name-strike">Платная парковка</span>
                        </div>
                    </div>
                </div>

                <div class="round_view " id="step_6" >
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-l battle-strike" data-step="6" data-answer="1" data-voice="correct"  data-achievement="6">
                            <span class="name-strike">Реставрация «Царицыно» </span>
                            <span class="pic-strike"><img src="image/battle/l-strike.png"></span>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-r battle-strike" data-step="6" data-answer="2" data-voice="no-correct"  data-achievement="6">
                            <span class="pic-strike"><img src="image/battle/r-strike.png"></span>
                            <span class="name-strike">Пешеходный центр города</span>
                        </div>
                    </div>
                </div>

                <div class="round_view " id="step_7" >
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-l battle-strike" data-step="7" data-answer="1" data-voice="correct"  data-achievement="7">
                            <span class="name-strike">Запрет митингов</span>
                            <span class="pic-strike"><img src="image/battle/l-strike.png"></span>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-r battle-strike" data-step="7" data-answer="2" data-voice="no-correct"  data-achievement="7">
                            <span class="pic-strike"><img src="image/battle/r-strike.png"></span>
                            <span class="name-strike">Повсеместная установка видеонаблюдения</span>
                        </div>
                    </div>
                </div>

                <div class="round_view " id="step_8" >
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-l battle-strike" data-step="8" data-answer="1" data-voice="correct"  data-achievement="8">
                            <span class="name-strike">Отсутствие парковок</span>
                            <span class="pic-strike"><img src="image/battle/l-strike.png"></span>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-r battle-strike" data-step="8" data-answer="2" data-voice="no-correct"  data-achievement="8"></span>
                            <span class="pic-strike"><img src="image/battle/r-strike.png"></span>
                            <span class="name-strike">Велосипедные дорожки</span>
                        </div>
                    </div>
                </div>

                <div class="round_view " id="step_9" >
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-l battle-strike" data-step="9" data-answer="1" data-voice="correct"  data-achievement="9">
                            <span class="name-strike">Снос исторических зданий</span>
                            <span class="pic-strike"><img src="image/battle/l-strike.png"></span>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-r battle-strike" data-step="9" data-answer="2" data-voice="no-correct"  data-achievement="9"></span>
                            <span class="pic-strike"><img src="image/battle/r-strike.png"></span>
                            <span class="name-strike">Демонтаж рекламных конструкций</span>
                        </div>
                    </div>
                </div>

                <div class="round_view " id="step_10" >
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-l battle-strike" data-step="10" data-answer="1" data-voice="correct"  data-achievement="10">
                            <span class="name-strike">Вырубка деревьев под строительство</span>
                            <span class="pic-strike"><img src="image/battle/l-strike.png"></span>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-r battle-strike" data-step="10" data-answer="2" data-voice="no-correct"  data-achievement="10"></span>
                            <span class="pic-strike"><img src="image/battle/r-strike.png"></span>
                            <span class="name-strike">Замена асфальта на плитку</span>
                        </div>
                    </div>
                </div>

                <div class="round_view " id="step_11" >
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-l battle-strike" data-step="11" data-answer="1" data-voice="correct"  data-achievement="11">
                            <span class="name-strike">Строительство ТТК</span>
                            <span class="pic-strike"><img src="image/battle/l-strike.png"></span>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-r battle-strike" data-step="11" data-answer="2" data-voice="no-correct"  data-achievement="11"></span>
                            <span class="pic-strike"><img src="image/battle/r-strike.png"></span>
                            <span class="name-strike">Воссоздание Малого кольца Московской железной дороги</span>
                        </div>
                    </div>
                </div>

                <div class="round_view " id="step_12" >
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-l battle-strike" data-step="12" data-answer="1" data-voice="correct"  data-achievement="12">
                            <span class="name-strike">Неформальное общение с москвичами</span>
                            <span class="pic-strike"><img src="image/battle/l-strike.png"></span>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-r battle-strike" data-step="12" data-answer="2" data-voice="no-correct"  data-achievement="12"></span>
                            <span class="pic-strike"><img src="image/battle/r-strike.png"></span>
                            <span class="name-strike">Проект «Активный гражданин»</span>
                        </div>
                    </div>
                </div>

                <div class="round_view " id="step_13" >
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-l battle-strike" data-step="13" data-answer="1" data-voice="correct"  data-achievement="13">
                            <span class="name-strike">Строительство моно-рельса</span>
                            <span class="pic-strike"><img src="image/battle/l-strike.png"></span>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-r battle-strike" data-step="13" data-answer="2" data-voice="no-correct"  data-achievement="13"></span>
                            <span class="pic-strike"><img src="image/battle/r-strike.png"></span>
                            <span class="name-strike">Выделенные полосы общественного транспорта</span>
                        </div>
                    </div>
                </div>

                <div class="round_view " id="step_14" >
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-l battle-strike" data-step="14" data-answer="1" data-voice="correct"  data-achievement="14">
                            <span class="name-strike">Реконструкция Манежной площади</span>
                            <span class="pic-strike"><img src="image/battle/l-strike.png"></span>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 ">
                        <div class="btn-strike-r battle-strike" data-step="14" data-answer="2" data-voice="no-correct"  data-achievement="14"></span>
                            <span class="pic-strike"><img src="image/battle/r-strike.png"></span>
                            <span class="name-strike">Реконструкция ВДНХ</span>
                        </div>
                    </div>
                </div>

            

            </div> 
        </div>

        <div class="hidden col-sm-12 text-center hidden-xs">
            <ul class="pagination text-center pagination-default">
              <li id="pstep_1" class="active"  data-achievement="1" ><a href="#" data-step="1">1</a></li>
              <li id="pstep_2" class="disabled" data-achievement="2" ><a href="#" data-step="2">2</a></li>
              <li id="pstep_3" class="disabled" data-achievement="3" ><a href="#" data-step="3">3</a></li>
              <li id="pstep_4" class="disabled" data-achievement="4" ><a href="#" data-step="4">4</a></li>
              <li id="pstep_5" class="disabled" data-achievement="5" ><a href="#" data-step="5">5</a></li>

              <li id="pstep_6" class="disabled"   data-achievement="6" ><a href="#" data-step="1">6</a></li>
              <li id="pstep_7" class="disabled" data-achievement="7" ><a href="#" data-step="2">7</a></li>
              <li id="pstep_8" class="disabled" data-achievement="8" ><a href="#" data-step="3">8</a></li>
              <li id="pstep_9" class="disabled" data-achievement="9" ><a href="#" data-step="4">9</a></li>
              <li id="pstep_10" class="disabled" data-achievement="10" ><a href="#" data-step="5">10</a></li>
            
              <li id="pstep_11" class="disabled"   data-achievement="11" ><a href="#" data-step="11">11</a></li>
              <li id="pstep_12" class="disabled" data-achievement="12" ><a href="#" data-step="12">12</a></li>
              <li id="pstep_13" class="disabled" data-achievement="13" ><a href="#" data-step="13">13</a></li>
              <li id="pstep_14" class="disabled" data-achievement="14" ><a href="#" data-step="14">14</a></li>
            </ul>
        </div><!-- /.col-md-12 -->
	</div>
    
</section>
<?php echo $column_left; ?>
<?php echo $content_top; ?>
<?php echo $column_right; ?>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>