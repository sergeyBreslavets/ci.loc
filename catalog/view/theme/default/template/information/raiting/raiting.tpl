
<?php echo $header; ?>

<section class="module raiting-view" >
<!-- Facebook Conversion Code for Основные просмотры -->
<script>(function() {
var _fbq = window._fbq || (window._fbq = []);
if (!_fbq.loaded) {
var fbds = document.createElement('script');
fbds.async = true;
fbds.src = '//connect.facebook.net/en_US/fbds.js';
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(fbds, s);
_fbq.loaded = true;
}
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', '6036712128241', {'value':'0.00','currency':'USD'}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6036712128241&amp;cd[value]=0.00&amp;cd[currency]=USD&amp;noscript=1" /></noscript>
    <script type="text/javascript">
     var action_cl_rbtn_ya = '<?php echo $share_btn_ya; ?>';
    </script>
    <div class="container">
        <div class="row module-heading">
          <div class="col-sm-12 ">
            <h1 class="module__heading__title     text-center font-alt m-b-0"><?php echo $heading_title; ?></h1>
            <h2 class="module__heading__subtitle  text-center font-alt m-b-0 m-t-0"><?php echo $action_title;?></h2>
          </div>
        </div>
        <div class="row">
        <?php if(!empty($achievements)) { ?>
        <form id="achievements-form" role="form">
          <div class="col-xs-12 col-sm-12 ">
            <div class="achievements">
              <div class="achievement">
                <div class="achievement-item">
                  <div class="item_rank">1</div>
                </div>  
              </div>
              <div class="achievement">
                <div class="achievement-item">
                  <div class="item_rank">2</div>
                </div>  
              </div>
              <div class="achievement">
                <div class="achievement-item">
                  <div class="item_rank">3</div>
                </div>  
              </div>
              <div class="achievement">
                <div class="achievement-item">
                  <div class="item_rank">4</div>
                </div>  
              </div>
              <div class="achievement">
                <div class="achievement-item">
                  <div class="item_rank">5</div>
                </div>  
              </div>
            </div>
          </div>
          <input type="hidden" name="rating_id" value="<?php echo $raiting_id; ?>">
        </form>
        <div class="clearfix"></div>

          <div class="col-sm-6 col-sm-offset-3 text-center  section-action">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1">
              <div class="btn btn-blue btn-block m-t-20 disabled" id="send_result_raiting">Принять решение</div> 
            </div>
          </div>
          <div class="col-sm-12 text-center section-action">
            
            <h2 class="module-subtitle font-alt m-b-0 ">выбери 5 из <?php echo $count_achievements;?> событий</h2>
          </div>

          <div class="clearfix"></div>
          <div class="wrap-achievements">
           <div class="achievements-arrow left-arrow hidden" id="larrow">
             <span class="arrow"></span>
           </div>
           <div class="achievements-arrow right-arrow" id="rarrow">
             <span class="arrow" ></span>
           </div>

           	<?php if(!empty($achievements)){ ?>
       		 	<div class="col-xs-12 col-sm-12 achievements-gallery" id="achievements-gallery">
       		 	
           		<?php foreach ($achievements as $achievement) { ?>
           			<div class="achievements-gallery_item " id="main_item_<?php echo $achievement['achievement_id']; ?>">
		                <div class="gallery_item-block"  id="item_<?php echo $achievement['achievement_id']; ?>" data-achievement="<?php echo $achievement['achievement_id']; ?>" data-position="<?php echo $raiting_id;?>">
      							<div class="gallery_item-action">
      								<span><i class="ion-ios-close-empty"></i></span>
      							</div>
      							<div class="gallery_item-image">
      								<img src="<?php echo $achievement['achievement_image']; ?>" alt="<?php echo $achievement['achievement_title']; ?>">
      							</div>
      							<div class="gallery_item-heading">
      								<p><?php echo $achievement['achievement_title']; ?></p>
                      <input type="hidden" name="achives[]" value="<?php echo $achievement['achievement_id']; ?>">
      							</div>
      						</div>
      						<div class="btn-action-mobile m-b-30">
      							<div class="btn btn-blue chose-achievement-mobile" data-item="main_item_<?php echo $achievement['achievement_id']; ?>">Выбрать</div> 
      							<div class="btn btn-off chose-achievement-mobile-disable hidden" data-item="main_item_<?php echo $achievement['achievement_id']; ?>">Убрать</div> 
      						</div>

		            </div>
		            
           		<?php } ?>
           		</div><!-- /.achievements-gallery -->
           	<?php } ?>
		  	</div><!-- /.wrap-achievements -->
        <?php } else { ?>
          <div class="col-sm-12 text-center">
            <h2 class="module-subtitle font-alt m-b-0">Произошла ошибка! зайдите позже.</h2>
          </div>
        <?php } ?>
      </div>
	</div>
	<div class="popup-mobile-action">
		 <div class="popup-mobile-navigation-header">
			<div class="container">
			<div class="row">
			  <div class="col-sm-12 text-right">
			  	<div id="popup-mobile-hide" class="navigation-action"><i class="ion-ios-close-outline"></i></div>
			  </div>
			</div>
			</div>
	    </div>
		
		<div class="btn btn-blue" id="send-result-mobile" onclick="yaCounter31626893.reachGoal('<?php echo $share_rbtn_ya; ?> '); return true;">Принять решение</div> 
	</div>
    </section>
<?php echo $column_left; ?>
<?php echo $content_top; ?>
<?php echo $column_right; ?>
<?php echo $content_bottom; ?>

<?php echo $footer; ?>