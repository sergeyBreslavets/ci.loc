<?php echo $header; ?>
<section class="module">
  <div class="container">
    <div class="row">
      <?php echo $content_top; ?>
      <?php echo $column_left; ?>
        <div class="col-xs-offset-1 col-xs-10 col-sm-8 col-sm-offset-2">
          <h1 class="mh-line-size-3 font-alt m-b-30 text-center"><?php echo $heading_title; ?></h1>
        </div>
        <div class="col-xs-offset-1 col-xs-10 col-sm-8 col-sm-offset-2">
          <div class="post-entry m-b-30">
          <?php echo $text_message; ?>
          </div>
          <div class="col-xs-offset-3 col-xs-6 col-sm-4 col-sm-offset-4 ">
              <a href="<?php echo $continue; ?>" class="btn btn-block btn-round btn-g"><?php echo $button_continue; ?></a>
          </div>

        </div>

        
      <?php echo $column_right; ?>
      <?php echo $content_bottom; ?>
    </div>
  </div>
</section> 
<?php echo $footer; ?>