<?php echo $header; ?>
<?php echo $content_top; ?>
<section class="module" >
  <div class="container">
      <div class="row">
        <div class="col-sm-12 text-center">
          <h1 class="module-title font-alt"><?php echo $heading_title; ?></h1>
          <h2 class="module-subtitle font-alt m-b-10"><?php echo $sub_heading_title; ?></h2>
        </div>
        <!-- CONTENT -->
        <?php if ($column_left) { ?>
          <div class="col-xs-12 col-sm-4 col-md-3">
            <?php echo $column_left; ?>
          </div>
        <?php } ?>
        <?php if ($column_left && $column_right) { ?>
        <?php $class = 'col-sm-4 col-md-3'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
        <?php $class = 'col-sm-7 col-md-7'; ?>
        <?php } else { ?>
        <?php $class = 'col-sm-12'; ?>
        <?php } ?>
        <div class="<?php echo $class; ?> text-center row my-raiting">
          
          <div class="col-sm-12 col-md-2 text-right">
            <ul class="social-icons m-t-0">
              <li><span class="vk-icon social-btn" onclick="yaCounter31626893.reachGoal('test_vk_sharing'); return true;" data-network="vk" data-purl="<?php echo $share_url;?>" data-title='<?php echo $share_title; ?>' data-img="<?php echo $share_img;?>" data-text="<?php echo $share_text; ?>"></span></li>
              <li><span class="facebook-icon social-btn" onclick="yaCounter31626893.reachGoal('test_fb_sharing'); return true;" data-network="facebook" data-purl="<?php echo $share_url;?>" data-title='<?php echo $share_title; ?>' data-img="<?php echo $share_img;?>" data-text="<?php echo $share_text; ?>"></span></li>
              <li><span class="ok-icon social-btn" onclick="yaCounter31626893.reachGoal('test_ok_sharing'); return true;" data-network="ok" data-purl="<?php echo $share_url;?>" data-title='<?php echo $share_title; ?>' data-img="<?php echo $share_img;?>" data-text="<?php echo $share_text; ?>"></span></li>
            </ul>
          </div>
          <div class="col-sm-12 col-md-10 text-center">
            <img src="<?php echo $img; ?>" alt='<?php echo $share_title; ?>'>
          </div>
        </div>
        <?php if ($column_right) { ?>
          <div class="col-sm-5 col-md-5 ">
            <?php echo $column_right; ?>
          </div>
        <?php }?>
        <div class="col-sm-12 text-center m-t-30">
          <h2 class="module-title font-alt">Благодарим за участие в независимом народном рейтинге! </h2>
          <h2 class="module-subtitle font-alt m-b-30 "><?php echo $text_more_raiting; ?></h2>
        </div>
        </div>
      </div>
  </div>
    </section>


<?php echo $content_bottom; ?>
<img src="//www.freetopay.ru/cpix.php?ofr=1677&sig=78ff9c0dd1f9f2fcdb221da167ac34c6" width="1" height="1">
<?php if ($social === 'true') { ?>
<script type="text/javascript">
    redirect = 'quiz_uznaj_kakoj_ty_moskvich';
</script>
<? } ?>
<?php echo $footer; ?>