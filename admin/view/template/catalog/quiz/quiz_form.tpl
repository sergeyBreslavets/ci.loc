<?php echo $header; ?>
<?php echo $column_left; ?>
<section id="content">
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h2>Редактирование опроса</h2>
        <ul class="actions">
            <li> <button type="submit" form="form-information"  class="btn btn-success"><?php echo $button_save; ?></button></li>
            <li>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>">
                    <i class="md md-replay"></i>
                </a>
            </li>
        </ul>
      </div>
      <div class="card-body card-padding table-responsive">

        <?php if ($error_warning) { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $error_warning; ?>
        </div>
        <?php } ?>
         <div role="tabpanel">
          <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-information" >
            <ul class="tab-nav" role="tablist">
                <li class="active"><a href="#tab-general" aria-controls="tab-general" role="tab" data-toggle="tab"><?php echo $tab_general; ?></a></li>
                <li><a href="#tab-data" aria-controls="tab-data" role="tab" data-toggle="tab"><?php echo $tab_data; ?></a></li>
                <li><a href="#tab-image" aria-controls="tab-image" role="tab" data-toggle="tab">Изображения для шаринга</a></li>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="tab-general">
                  <div role="tabpanel">


                    <ul class="tab-nav" role="tablist" id="language" data-tab-color="amber">
                        <?php foreach ($languages as $language) { ?>
                          <li>
                            <a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab">
                              <?php echo $language['name']; ?>
                            </a>
                          </li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content">
                      <?php foreach ($languages as $language) { ?>
                        <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">

                          <div class="card-body card-padding">

                            <div class="form-group required <?php if (isset($error_title[$language['language_id']])) { ?> has-error <?php } ?>">
                              <div class="fg-line">
                                  <label class="control-label" for="input-title<?php echo $language['language_id']; ?>"><?php echo $entry_title; ?></label>
                                  <input type="text" name="quiz_description[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($quiz_description[$language['language_id']]) ? $quiz_description[$language['language_id']]['title'] : ''; ?>"  id="input-title<?php echo $language['language_id']; ?>" class="form-control" />
                              </div>
                              <?php if (isset($error_title[$language['language_id']])) { ?>
                                <small class="help-block"><?php echo $error_title[$language['language_id']]; ?></small>
                              <?php } ?>
                            </div>

                            <div class="form-group  required <?php if (isset($error_meta_title[$language['language_id']])) { ?> has-error <?php } ?>">
                              <div class="fg-line">
                                  <label class="control-label" for="input-meta-title<?php echo $language['language_id']; ?>"><?php echo $entry_meta_title; ?></label>
                                  <input type="text" name="quiz_description[<?php echo $language['language_id']; ?>][meta_title]" value="<?php echo isset($quiz_description[$language['language_id']]) ? $quiz_description[$language['language_id']]['meta_title'] : ''; ?>" id="input-meta-title<?php echo $language['language_id']; ?>" class="form-control" />
                              </div>
                              <?php if (isset($error_meta_title[$language['language_id']])) { ?>
                                <small class="help-block"><?php echo $error_meta_title[$language['language_id']]; ?></small>
                              <?php } ?>
                            </div>

                            <div class="form-group ">
                              <div class="fg-line">
                                  <label class="control-label m-b-10" for="input-meta-description<?php echo $language['language_id']; ?>"><?php echo $entry_meta_description; ?></label>
                                  <textarea name="quiz_description[<?php echo $language['language_id']; ?>][meta_description]" class="form-control auto-size" rows="4" id="input-meta-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($quiz_description[$language['language_id']]) ? $quiz_description[$language['language_id']]['meta_description'] : ''; ?></textarea>
                              </div>
                            </div>
                            <div class="form-group ">
                              <div class="fg-line">
                                  <label class="control-label m-b-10" for="input-meta-keyword<?php echo $language['language_id']; ?>"><?php echo $entry_meta_keyword; ?></label>
                                  <textarea name="quiz_description[<?php echo $language['language_id']; ?>][meta_keyword]" class="form-control auto-size" rows="4" id="input-meta-keyword<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($quiz_description[$language['language_id']]) ? $quiz_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea>
                              </div>
                            </div>

                          </div><!--/.card-body -->
                        </div><!-- /tab-pane -->
                        <?php } ?>
                    </div><!-- /.tab-content -->
                  </div><!-- /.tabpanel -->
                </div><!-- /#tab-general -->

                <div role="tabpanel" class="tab-pane" id="tab-data">
                  <div class="card-body card-padding">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-2 control-label" for="input-image"><?php echo $entry_image; ?></label>
                          <div class="col-sm-10">
                            <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail">
                              <img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" />
                            </a>
                            <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group ">
                          <div class="fg-line">
                            <label class="control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
                            <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
                          </div>
                        </div><!--/.form-group-->
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group <?php if ($error_keyword) { ?> has-error <?php } ?>">
                          <div class="fg-line">
                              <label class="control-label" for="input-keyword"><?php echo $entry_keyword; ?></label>
                              <input type="text" name="keyword" value="<?php echo $keyword; ?>"  id="input-keyword" class="form-control" />
                          </div>
                          <?php if ($error_keyword) { ?>
                            <small class="help-block"><?php echo $error_keyword; ?></small>
                          <?php } ?>
                        </div><!--/.form-group-->
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <div class="fg-line">
                            <label class="control-label" for="input-status"><?php echo $entry_status; ?></label>
                            <div class="select">
                              <select name="status" id="input-status" class="form-control">
                                <?php if (!empty($ar_status)) { ?>
                                  <?php foreach ($ar_status as $value) { ?>
                                  <?php if ($value['status_id'] == $status) { ?>
                                    <option value="<?php echo $value['status_id']; ?>" selected="selected"><?php echo $value['title']; ?></option>
                                  <?php } else { ?>
                                  <option value="<?php echo $value['status_id']; ?>"><?php echo $value['title']; ?></option>
                                  <?php } ?>
                                  <?php } ?>
                                <?php } ?>

                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <div class="fg-line">
                              <label class="control-label" for="input-template_id"><?php echo $entry_template; ?></label>
                              <input type="text" name="template_id" value="<?php echo $template_id; ?>"  id="input-template_id" class="form-control" />
                          </div>
                        </div><!--/.form-group-->
                      </div>
                      <div class="col-sm-6">
                          <div class="form-group">
                            <div class="fg-line">
                              <label class="control-label" for="input-status"><?php echo $entry_visibility; ?></label>
                              <div class="select">
                                <select name="visibility" id="input-visibility" class="form-control">
                                  <?php if ($visibility) { ?>
                                  <option value="0"><?php echo $text_disabled; ?></option>
                                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                  <?php } else { ?>
                                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                  <option value="1"><?php echo $text_enabled; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                          </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <div class="fg-line">
                            <label class="control-label" for="input-type_id">Тип опроса</label>
                            <div class="select">
                              <select name="type_id" id="input-type_id" class="form-control">
                                <?php if (!empty($ar_type_quiz)) { ?>
                                  <?php foreach ($ar_type_quiz as $type) { ?>
                                  <?php if ($type['type_id'] == $type_id) { ?>
                                    <option value="<?php echo $type['type_id']; ?>" selected="selected"><?php echo $type['title']; ?></option>
                                  <?php } else { ?>
                                  <option value="<?php echo $type['type_id']; ?>"><?php echo $type['title']; ?></option>
                                  <?php } ?>
                                  <?php } ?>
                                <?php } ?>

                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


                 <div role="tabpanel" class="tab-pane " id="tab-image">
                  <table id="images" class="table table-striped">
                    <thead>
                        <tr>
                          <th>Изображение</th>
                          <th>Share-title</th>
                          <th>Share-description</th>
                          <th>Процент от</th>
                          <th>Процент до</th>
                          <th><?php echo $entry_sort_order; ?></th>
                          <th></th>
                        </tr>
                      </thead>
                  <tbody>
                    <?php $image_row = 0; ?>
                    <?php foreach ($quiz_shares as $quiz_share) { ?>
                      <tr id="image-row<?php echo $image_row; ?>">

                        <td class="text-left">
                          <a href="" id="thumb-image<?php echo $image_row; ?>" data-toggle="image" class="img-thumbnail">
                            <img src="<?php echo $quiz_share['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" />
                          </a>
                          <input type="hidden" name="quiz_share[<?php echo $image_row; ?>][image]" value="<?php echo $quiz_share['image']; ?>" id="input-image<?php echo $image_row; ?>" />
                        </td>
                        <td>
                          <?php foreach ($languages as $language) { ?>
                          <div class="input-group <?php if (isset($error_quiz_share[$image_row][$language['language_id']])) { ?>has-error <?php } ?>">
                              <span class="input-group-addon"><?php echo $language['name']; ?></span>
                              <div class="fg-line">
                                <input type="text" name="quiz_share[<?php echo $image_row; ?>][quiz_share_description][<?php echo $language['language_id']; ?>][share_title]" value="<?php echo isset($quiz_share['quiz_share_description'][$language['language_id']]) ? $quiz_share['quiz_share_description'][$language['language_id']]['share_title'] : ''; ?>"  class="form-control" />
                              </div>
                              <?php if (isset($error_quiz_share[$image_row][$language['language_id']])) { ?>
                                <small class="help-block"><?php echo $error_quiz_share[$image_row][$language['language_id']]; ?></small>
                              <?php } ?>
                          </div>
                          <?php } ?>
                        </td>

                        <td>
                          <?php foreach ($languages as $language) { ?>
                          <div class="input-group <?php if (isset($error_quiz_share[$image_row][$language['language_id']])) { ?>has-error <?php } ?>">
                              <span class="input-group-addon"><?php echo $language['name']; ?></span>
                              <div class="fg-line">
                                <input type="text" name="quiz_share[<?php echo $image_row; ?>][quiz_share_description][<?php echo $language['language_id']; ?>][share_comment]" value="<?php echo isset($quiz_share['quiz_share_description'][$language['language_id']]) ? $quiz_share['quiz_share_description'][$language['language_id']]['share_comment'] : ''; ?>" placeholder="<?php echo $entry_title; ?>" class="form-control" />
                              </div>
                              <?php if (isset($error_quiz_share[$image_row][$language['language_id']])) { ?>
                                <small class="help-block"><?php echo $error_quiz_share[$image_row][$language['language_id']]; ?></small>
                              <?php } ?>
                          </div>
                          <?php } ?>
                        </td>


                        <td class="text-left" >
                          <input type="text" name="quiz_share[<?php echo $image_row; ?>][percent_start]" value="<?php echo $quiz_share['percent_start']; ?>"  class="form-control" />
                        </td>

                        <td class="text-left" >
                          <input type="text" name="quiz_share[<?php echo $image_row; ?>][percent_end]" value="<?php echo $quiz_share['percent_end']; ?>" class="form-control" />
                        </td>

                        <td class="text-right">
                          <input type="text" name="quiz_share[<?php echo $image_row; ?>][sort_order]" value="<?php echo $quiz_share['sort_order']; ?>"  class="form-control" />
                        </td>

                        <td class="text-left">
                          <button type="button" onclick="$('#image-row<?php echo $image_row; ?>, .tooltip').remove();" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger">
                            <i class="fa fa-minus-circle"></i>
                          </button>
                        </td>

                      </tr>
                      <?php $image_row++; ?>
                      <?php } ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="7"></td>
                          <td class="text-left"><button type="button" onclick="addImage();" data-toggle="tooltip" title="<?php echo $button_image_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>

              </div><!-- /.tab-content-->
          </form>
        </div><!-- /.tabpanel -->
      </div><!--/.card -->
    </div> <!--/.container -->
</section>
<script type="text/javascript"><!--
var image_row = <?php echo $image_row; ?>;

function addImage() {
  html  = '<tr id="image-row' + image_row + '">';
  html += '  <td class="text-left"><a href="" id="thumb-image' + image_row + '" data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="quiz_share[' + image_row + '][image]" value="" id="input-image' + image_row + '" /></td>';

  html += '  <td>';
  <?php foreach ($languages as $language) { ?>
  html += '    <div class="input-group">';
  html += '      <span class="input-group-addon"><?php echo $language['name']; ?></span><div class="fg-line"><input type="text" name="quiz_share[' + image_row + '][quiz_share_description][<?php echo $language['language_id']; ?>][share_title]" value=""  class="form-control" /></div>';
    html += '    </div>';
  <?php } ?>
  html += '  </td>';

   html += '  <td>';
  <?php foreach ($languages as $language) { ?>
  html += '    <div class="input-group">';
  html += '      <span class="input-group-addon"><?php echo $language['name']; ?></span><div class="fg-line"><input type="text" name="quiz_share[' + image_row + '][quiz_share_description][<?php echo $language['language_id']; ?>][share_comment]" value="" class="form-control" /></div>';
    html += '    </div>';
  <?php } ?>
  html += '  </td>';

  html += '  <td class="text-left"><input type="text" name="quiz_share[' + image_row + '][percent_start]" value="0"  class="form-control" /></td>';
  html += '  <td class="text-left"><input type="text" name="quiz_share[' + image_row + '][percent_end]"   value="0"  class="form-control" /></td>';


  html += '  <td class="text-right"><input type="text" name="quiz_share[' + image_row + '][sort_order]" value="10"  class="form-control" /></td>';

  html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html += '</tr>';

  $('#images tbody').append(html);

  image_row++;
}
//--></script>
<script type="text/javascript"><!--
  $('#language a:first').tab('show');
//--></script>
<?php echo $footer; ?>
