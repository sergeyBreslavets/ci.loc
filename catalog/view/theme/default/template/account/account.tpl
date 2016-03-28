<?php echo $header; ?>
<section class="module-small bg-dark" data-background="<?php echo $main_image; ?>">
  <div class="container">
    <!-- MODULE TITLE -->
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <h1 class="mh-line-size-3 font-alt m-b-20 text-center"><?php echo $heading_title; ?></h1>
       </div>
    </div>
    <!-- /MODULE TITLE -->
  </div>
</section>
<!-- CONTACT -->
    <section class="module">

      <div class="container">
        <?php echo $content_top; ?>
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
            <h2 class="module-title font-alt"><?php echo $text_my_account; ?></h2>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-offset-1 col-xs-10 col-sm-8 col-sm-offset-2">
            <div class="col-xs-12 col-sm-4 m-b-30">
                <div class="team-item">
                  <div class="team-image">
                    <img src="<?php echo $image; ?>" alt="">
                    <div class="team-detail text-center">
                      
                    </div>
                  </div>
                  <div class="team-descr">
                    <h5 class="team-name font-alt"><?php echo $firstname?>&nbsp;<?php echo $lastname?></h5>
                    
                    <a class="btn btn-border-d btn-xs m-b-20" href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a>
                  </div>
                </div>
              
            </div>
            <div class="col-xs-12 col-sm-8 m-b-30">
                <div class="alert alert-warning" role="alert">модуль статистики находится в тестовом режиме.</div>
                <ul class="project-details m-b-sm-30">
                  <li class="font-alt">Рейтинг: 99</li>
                </ul>
                <h6 class="progress-title font-alt">Количество игр</h6>
                <div class="progress">
                  <div class="progress-bar pb-dark" aria-valuenow="33" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <span class="font-alt">15</span>
                  </div>
                </div>

                <h6 class="progress-title font-alt">Пасы</h6>
                <div class="progress">
                  <div class="progress-bar pb-dark" aria-valuenow="33" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <span class="font-alt">30 (2.0)</span>
                  </div>
                </div>

                <h6 class="progress-title font-alt">Голы</h6>
                <div class="progress">
                  <div class="progress-bar pb-dark" aria-valuenow="33" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <span class="font-alt">12(2.7)</span>
                  </div>
                </div>

                <h6 class="progress-title font-alt">Гол/пас</h6>
                <div class="progress">
                  <div class="progress-bar pb-dark" aria-valuenow="33" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <span class="font-alt">32 (2.0)</span>
                  </div>
                </div>

                <hr class="m-b-30">
                <ul class="project-details m-b-sm-30 mb-t-20">
                  <li class="font-alt">Email: <?php echo $email?></li>
                  <li class="font-alt">Телефон: <?php echo $telephone?></li>
                </ul>
                <p>
                  <a class="btn btn-border-d btn-xs m-b-20" href="<?php echo $edit; ?>"><?php echo $text_edit; ?></a>
                  <a class="btn btn-border-d btn-xs m-b-20" href="<?php echo $password; ?>"><?php echo $text_password; ?></a>
                </p>

            </div>
          </div>
        </div>
      </div>
    </section>
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>
