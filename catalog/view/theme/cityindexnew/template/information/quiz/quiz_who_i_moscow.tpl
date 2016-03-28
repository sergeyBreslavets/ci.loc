
<?php echo $header; ?>
<script type="text/javascript">
    var q = <?php echo $quiz_id; ?>;
    var rbtn_share = '<?php echo $share_rbtn_ya; ?>';
    var count_correct = 0;
    var type = 'simple';
    //срабатывание события для yandex vtnhbrb
    action_ya = 'btn_quiz_who_i_moscow';//
</script>
<section class="module" >
    <div class="container">
        <div class="row">
			<div class="col-sm-12 text-center">
				<h1 class="module-title font-alt">Узнай какой ты москвич</h1>
				<h4 class="module-subtitle font-alt m-b-0 count_quiz">В опросе участвовало <span><?php echo $count_quiz; ?></span> <?php echo $t_voices;?></h4>
			</div>
      	</div>
      	<div class="wizard">
        <div class="col-sm-12 text-center hidden-xs">
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
              <li id="pstep_15" class="disabled" data-achievement="15" ><a href="#" data-step="15">15</a></li>

              <li id="pstep_16" class="disabled"   data-achievement="16" ><a href="#" data-step="16">16</a></li>
              <li id="pstep_17" class="disabled" data-achievement="17" ><a href="#" data-step="17">17</a></li>
              <li id="pstep_18" class="disabled" data-achievement="18" ><a href="#" data-step="18">18</a></li>
              <li id="pstep_19" class="disabled" data-achievement="19" ><a href="#" data-step="19">19</a></li>
              <li id="pstep_20" class="disabled" data-achievement="20" ><a href="#" data-step="20">20</a></li>
            </ul>
      	</div><!-- /.col-md-12 -->
      	 <form id="poll-form" role="form" action="/result_uznaj_kakoj_ty_moskvich">
      	 	<input type="hidden" name="quiz_id" value="<?php echo $quiz_id;?>">
      	 </form>
      	<div class="col-sm-12 text-center hidden-sm hidden-md hidden-lg">
      		<p class="mobile-pagination"><span class="active">1</span> из <span id="all_question">20</span></p>
      	</div>
  		<div class="clearfix"></div>
  			<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 m-t-20">
				
				<div class="step_view " id="step_1" >
					<div class="question">
						<h4>Благоустройство «Москва-сити» полностью завершится в 2015 году</h4>
					</div>
					<div class="module-answer">
						<div class="col-xs-6 text-right">
							<div class="btn btn-border-l answer-btn" data-step="1" data-answer="1" data-voice="no-correct" data-achievement="1">Верю</div>
						</div>
						<div class="col-xs-6 text-left">
							<div class="btn btn-border-r answer-btn" data-step="1" data-answer="0" data-voice="correct" data-achievement="1">Не верю</div>
						</div>
					</div>
				</div>

				<div class="step_view" id="step_2" >
					<div class="question">
						<h4>В Москве почти 100 километров полностью пешеходных улиц</h4>
					</div>
					<div class="module-answer">
						<div class="col-xs-6 text-right">
							<div class="btn btn-border-l answer-btn" data-step="2" data-answer="1" data-voice="correct" data-achievement="2">Верю</div>
						</div>
						<div class="col-xs-6 text-left">
							<div class="btn btn-border-r answer-btn" data-step="2" data-answer="0" data-voice="no-correct" data-achievement="2">Не верю</div>
						</div>
					</div>
				</div>

				<div class="step_view" id="step_3" >
					<div class="question">
						<h4>В Москве за 4 года построено 14 станций метро</h4>
					</div>
					<div class="module-answer">
						<div class="col-xs-6 text-right">
							<div class="btn btn-border-l answer-btn" data-step="3" data-answer="1" data-voice="correct" data-achievement="3">Верю</div>
						</div>
						<div class="col-xs-6 text-left">
							<div class="btn btn-border-r answer-btn" data-step="3" data-answer="0" data-voice="no-correct" data-achievement="3">Не верю</div>
						</div>
					</div>
				</div>

				<div class="step_view" id="step_4" >
					<div class="question">
						<h4>Число посетителей парков Москвы за пять лет выросло вдвое – до 30 миллионов человек в год</h4>
					</div>
					<div class="module-answer">
						<div class="col-xs-6 text-right">
							<div class="btn btn-border-l answer-btn" data-step="4" data-answer="1" data-voice="correct" data-achievement="4">Верю</div>
						</div>
						<div class="col-xs-6 text-left">
							<div class="btn btn-border-r answer-btn" data-step="4" data-answer="0" data-voice="no-correct" data-achievement="4">Не верю</div>
						</div>
					</div>
				</div>

				<div class="step_view" id="step_5" >
					<div class="question">
						<h4>300 новых парков появилось в Москве</h4>
					</div>
					<div class="module-answer">
						<div class="col-xs-6 text-right">
							<div class="btn btn-border-l answer-btn" data-step="5" data-answer="1" data-voice="correct" data-achievement="5">Верю</div>
						</div>
						<div class="col-xs-6 text-left">
							<div class="btn btn-border-r answer-btn" data-step="5" data-answer="0" data-voice="no-correct" data-achievement="5">Не верю</div>
						</div>
					</div>
				</div>

				<div class="step_view" id="step_6" >
					<div class="question">
						<h4>Московская "Ночь Музеев" самая посещаемая в мире</h4>
					</div>
					<div class="module-answer">
						<div class="col-xs-6 	text-right">
							<div class="btn btn-border-l answer-btn" data-step="6" data-answer="1" data-voice="correct" data-achievement="6">Верю</div>
						</div>
						<div class="col-xs-6 text-left">
							<div class="btn btn-border-r answer-btn" data-step="6" data-answer="0" data-voice="no-correct" data-achievement="6">Не верю</div>
						</div>
					</div>
				</div>

				<div class="step_view" id="step_7" >
					<div class="question">
						<h4>Первый каток на реке Москва был организован зимой 2015 года</h4>
					</div>
					<div class="module-answer">
						<div class="col-xs-6 text-right">
							<div class="btn btn-border-l answer-btn" data-step="7" data-answer="1" data-voice="no-correct" data-achievement="7">Верю</div>
						</div>
						<div class="col-xs-6 text-left">
							<div class="btn btn-border-r answer-btn" data-step="7" data-answer="0" data-voice="correct" data-achievement="7">Не верю</div>
						</div>
					</div>
				</div>

				<div class="step_view" id="step_8" >
					<div class="question">
						<h4>Угоны, грабежи и разбои за последние пять лет снизились в среднем на четверть</h4>
					</div>
					<div class="module-answer">
						<div class="col-xs-6 text-right">
							<div class="btn btn-border-l answer-btn" data-step="8" data-answer="1" data-voice="correct" data-achievement="8">Верю</div>
						</div>
						<div class="col-xs-6 text-left">
							<div class="btn btn-border-r answer-btn" data-step="8" data-answer="0" data-voice="no-correct" data-achievement="8">Не верю</div>
						</div>
					</div>
				</div>

				<div class="step_view" id="step_9" >
					<div class="question">
						<h4>От всех набережных Москвы уберут автомагистрали</h4>
					</div>
					<div class="module-answer">
						<div class="col-xs-6 text-right">
							<div class="btn btn-border-l answer-btn" data-step="9" data-answer="1" data-voice="no-correct" data-achievement="9">Верю</div>
						</div>
						<div class="col-xs-6 text-left">
							<div class="btn btn-border-r answer-btn" data-step="9" data-answer="0" data-voice="correct" data-achievement="9">Не верю</div>
						</div>
					</div>
				</div>

				<div class="step_view" id="step_10" >
					<div class="question">
						<h4>На сегодняшний день в Москве более 200 км велосипедных трасс</h4>
					</div>
					<div class="module-answer">
						<div class="col-xs-6 text-right">
							<div class="btn btn-border-l answer-btn" data-step="10" data-answer="1" data-voice="correct" data-achievement="10">Верю</div>
						</div>
						<div class="col-xs-6 text-left">
							<div class="btn btn-border-r answer-btn" data-step="10" data-answer="0" data-voice="no-correct" data-achievement="10">Не верю</div>
						</div>
					</div>
				</div>

				<div class="step_view" id="step_11" >
					<div class="question">
						<h4>На дорогах в центре города на 25% свободнее из-за введения платной парковки</h4>
					</div>
					<div class="module-answer">
						<div class="col-xs-6 text-right">
							<div class="btn btn-border-l answer-btn" data-step="11" data-answer="1" data-voice="correct" data-achievement="11">Верю</div>
						</div>
						<div class="col-xs-6 text-left">
							<div class="btn btn-border-r answer-btn" data-step="11" data-answer="0" data-voice="no-correct" data-achievement="11">Не верю</div>
						</div>
					</div>
				</div>

				<div class="step_view" id="step_12" >
					<div class="question">
						<h4>Из-за выделенных полос почти на 90% сократилось время задержки автобусов и троллейбусов</h4>
					</div>
					<div class="module-answer">
						<div class="col-xs-6 text-right">
							<div class="btn btn-border-l answer-btn" data-step="12" data-answer="1" data-voice="correct" data-achievement="12">Верю</div>
						</div>
						<div class="col-xs-6 text-left">
							<div class="btn btn-border-r answer-btn" data-step="12" data-answer="0" data-voice="no-correct" data-achievement="12">Не верю</div>
						</div>
					</div>
				</div>

				<div class="step_view" id="step_13" >
					<div class="question">
						<h4>За последний год в Москве обустроено 837 зон для курения</h4>
					</div>
					<div class="module-answer">
						<div class="col-xs-6 text-right">
							<div class="btn btn-border-l answer-btn" data-step="13" data-answer="1" data-voice="no-correct" data-achievement="13">Верю</div>
						</div>
						<div class="col-xs-6 text-left">
							<div class="btn btn-border-r answer-btn" data-step="13" data-answer="0" data-voice="correct" data-achievement="13">Не верю</div>
						</div>
					</div>
				</div>

				<div class="step_view" id="step_14" >
					<div class="question">
						<h4>Каждый второй класс московской школы оборудован электронной доской</h4>
					</div>
					<div class="module-answer">
						<div class="col-xs-6 text-right">
							<div class="btn btn-border-l answer-btn" data-step="14" data-answer="1" data-voice="correct" data-achievement="14">Верю</div>
						</div>
						<div class="col-xs-6 text-left">
							<div class="btn btn-border-r answer-btn" data-step="14" data-answer="0" data-voice="no-correct" data-achievement="14">Не верю</div>
						</div>
					</div>
				</div>


				<div class="step_view" id="step_15" >
					<div class="question">
						<h4>Каждая вторая развязка на&nbsp;Мкад заменена на&nbsp;современный &laquo;многоуровневый&raquo; стандарт</h4>
					</div>
					<div class="module-answer">
						<div class="col-xs-6 text-right">
							<div class="btn btn-border-l answer-btn" data-step="15" data-answer="1" data-voice="correct" data-achievement="15">Верю</div>
						</div>
						<div class="col-xs-6 text-left">
							<div class="btn btn-border-r answer-btn" data-step="15" data-answer="0" data-voice="no-correct" data-achievement="15">Не верю</div>
						</div>
					</div>
				</div>

				<div class="step_view" id="step_16" >
					<div class="question">
						<h4>За 5 лет в городе были сданы в эксплуатацию 75 эстакад</h4>
					</div>
					<div class="module-answer">
						<div class="col-xs-6 text-right">
							<div class="btn btn-border-l answer-btn" data-step="16" data-answer="1" data-voice="correct" data-achievement="16">Верю</div>
						</div>
						<div class="col-xs-6 text-left">
							<div class="btn btn-border-r answer-btn" data-step="16" data-answer="0" data-voice="no-correct" data-achievement="16">Не верю</div>
						</div>
					</div>
				</div>

				<div class="step_view" id="step_17" >
					<div class="question">
						<h4>Московский планетарий – самый посещаемый в Европе</h4>
					</div>
					<div class="module-answer">
						<div class="col-xs-6 text-right">
							<div class="btn btn-border-l answer-btn" data-step="17" data-answer="1" data-voice="correct" data-achievement="17">Верю</div>
						</div>
						<div class="col-xs-6 text-left">
							<div class="btn btn-border-r answer-btn" data-step="17" data-answer="0" data-voice="no-correct" data-achievement="17">Не верю</div>
						</div>
					</div>
				</div>

				<div class="step_view" id="step_18" >
					<div class="question">
						<h4>За последние 5 лет Москва увеличилась вдвое</h4>
					</div>
					<div class="module-answer">
						<div class="col-xs-6 text-right">
							<div class="btn btn-border-l answer-btn" data-step="18" data-answer="1" data-voice="correct" data-achievement="18">Верю</div>
						</div>
						<div class="col-xs-6 text-left">
							<div class="btn btn-border-r answer-btn" data-step="18" data-answer="0" data-voice="no-correct" data-achievement="18">Не верю</div>
						</div>
					</div>
				</div>

				<div class="step_view" id="step_19" >
					<div class="question">
						<h4>Все ведущие театры Москвы полностью отреставрированы</h4>
					</div>
					<div class="module-answer">
						<div class="col-xs-6 text-right">
							<div class="btn btn-border-l answer-btn" data-step="19" data-answer="1" data-voice="correct" data-achievement="19">Верю</div>
						</div>
						<div class="col-xs-6 text-left">
							<div class="btn btn-border-r answer-btn" data-step="19" data-answer="0" data-voice="no-correct" data-achievement="19">Не верю</div>
						</div>
					</div>
				</div>

				<div class="step_view" id="step_20" >
					<div class="question">
						<h4>В Москве отремонтирована каждая вторая школа</h4>
					</div>
					<div class="module-answer">
						<div class="col-xs-6 text-right">
							<div class="btn btn-border-l answer-btn" data-step="20" data-answer="1" data-voice="correct" data-achievement="20">Верю</div>
						</div>
						<div class="col-xs-6 text-left">
							<div class="btn btn-border-r answer-btn" data-step="20" data-answer="0" data-voice="no-correct" data-achievement="20">Не верю</div>
						</div>
					</div>
				</div>



  			</div>
  		</div><!-- /.wizard -->
    </div>
</section>
<?php echo $column_left; ?>
<?php echo $content_top; ?>
<?php echo $column_right; ?>
<?php echo $content_bottom; ?>

<?php echo $footer; ?>