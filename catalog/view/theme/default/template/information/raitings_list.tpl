<?php echo $header; ?>
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<!-- /HERO -->
<?php echo $content_top; ?>

<section class="module-small bg-light under-paralax-block" id="paralax-block">

  <div class="container ">
    <div class="row hidden">
      <div class="col-sm-10 col-sm-offset-1 text-center">
        <a href="/step.html" class="link-blue section-scroll">Узнай какой ты москвич</a>
      </div>
    </div>
    <!-- MODULE TITLE -->
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 text-center">
        <h2 class="module-title font-alt">Выбери лучшие достижения Москвы за 5 лет</h2>
      </div>
    </div>
    <!-- /MODULE TITLE -->
  </div>

</section>
<?php if(!empty($raitings)) { ?>
  <?php foreach ($raitings as $raiting) { ?>
    <!-- STANDARD PARALLAX -->
    <section class="module module-parallax bg-dark-30" data-background="<?php echo $raiting['raiting_image']; ?>">
      <div class="container">
        <!-- MODULE TITLE -->
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3 text-center">
            <div class="col-sm-10 col-sm-offset-1">
              <a href="<?php echo $raiting['raiting_href']; ?>" class="btn btn-border-w" onclick="yaCounter31626893.reachGoal('<?php echo $raiting['share_btn_ya']; ?> '); return true;"><?php echo $raiting['raiting_title']; ?></a>
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