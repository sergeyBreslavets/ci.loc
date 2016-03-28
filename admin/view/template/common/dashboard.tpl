<?php echo $header; ?>
<?php echo $column_left; ?>


<div class="hidden">
  <div class="page-header">
    <div class="container-fluid">
      <h1></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_install) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_install; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
  </div>
</div>

<section id="content">
    <div class="container">
        <div class="block-header">
            <h2><?php echo $heading_title; ?></h2>
        </div>
        <div class="row ">
            <div class="col-sm-8">
              <?php echo $stats_mer_team; ?>
            </div>
            <div class="col-sm-4">
              <?php echo $stats_mer_battle; ?>              
            </div>
            <div class="col-sm-4">
              <?php echo $stats_who_i_moscowman; ?>  
            </div>
        </div>
    </div>
</section>
<?php echo $footer; ?>