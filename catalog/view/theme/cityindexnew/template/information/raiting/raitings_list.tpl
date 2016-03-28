<?php echo $header; ?>
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<!-- /HERO -->
<?php echo $content_top; ?>
<script type="text/javascript">
    action_ya = 'btn_independent_rating';
</script>

<section class="module-small bg-light">
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
  <div class="container ">
    <!-- MODULE TITLE -->
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 text-center">
        <h2 class="module-title font-alt">Москва за 5 лет: оцени изменения</h2>
      </div>
    </div>
    <!-- /MODULE TITLE -->
  </div>

</section>
<?php if(!empty($raitings_top)) { ?>
  <?php $first = true; ?>
  <?php foreach ($raitings_top as $raiting_top) { ?>
    <!-- STANDARD PARALLAX -->
    <section class="module module-small1 module-parallax bg-dark bg-dark-30" data-background="<?php echo $raiting_top['raiting_image']; ?>">
      <div class="container">
        <!-- MODULE TITLE -->
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3 text-center">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1">
              <a href="<?php echo $raiting_top['raiting_href']; ?>" class="btn <?php echo ($first)?'btn-border-red':'btn-border-w'; ?> btn-block"><?php echo $raiting_top['raiting_title']; ?></a>
              <div class="sub-btn m-t-20"><?php echo $raiting_top['raiting_voice']; ?></div>
            </div>
          </div>
        </div>
        <!-- /MODULE TITLE -->
      </div>
    </section>
    <!-- /STANDARD PARALLAX -->
    <?php $first = false; ?>
  <?php } ?>
<?php } ?>
<?php if(!empty($raitings)) { ?>
  <?php foreach ($raitings as $raiting) { ?>
    <!-- STANDARD PARALLAX -->
    <section class="module module-small1 module-parallax bg-dark bg-dark-30" data-background="<?php echo $raiting['raiting_image']; ?>">
      <div class="container">
        <!-- MODULE TITLE -->
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3 text-center">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1">
              <a href="<?php echo $raiting['raiting_href']; ?>" class="btn btn-border-w btn-block" onclick="yaCounter31626893.reachGoal('<?php echo $raiting['share_btn_ya']; ?> '); return true;"><?php echo $raiting['raiting_title']; ?></a>
              <div class="sub-btn m-t-20"><?php echo $raiting['raiting_voice']; ?></div>
            </div>
          </div>
        </div>
        <!-- /MODULE TITLE -->
      </div>
    </section>
    <!-- /STANDARD PARALLAX -->
  <?php } ?>
<?php } ?>


<?php echo $content_bottom; ?>
 <!-- FOOTER -->
    <footer class="module bg-light">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <p class="copyright text-center m-b-0">&copy;&nbsp;2015&nbsp;<a href="http://result.moscow">MOSCOW 5.0</a>, Все права защищены.</p>
          </div>
        </div>
      </div>
    </footer>
    <!-- /FOOTER -->
</div><!-- /WRAPPER -->

<?php echo $footer; ?>