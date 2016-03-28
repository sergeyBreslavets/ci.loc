<?php echo $header; ?>
<?php echo $column_left; ?>
<section id="content">
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h2>Редактирование пункта опроса</h2>
        <ul class="actions">
            <li> <button type="submit" form="form-qitem"  class="btn btn-success"><?php echo $button_save; ?></button></li>
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
          <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-qitem" >
            <ul class="tab-nav" role="tablist">
                <li class="active"><a href="#tab-general" aria-controls="tab-general" role="tab" data-toggle="tab"><?php echo $tab_general; ?></a></li>
                <li><a href="#tab-data" aria-controls="tab-data" role="tab" data-toggle="tab"><?php echo $tab_data; ?></a></li>
                <li><a href="#tab-image" aria-controls="tab-image" role="tab" data-toggle="tab"><?php echo $tab_image; ?></a></li>
                <li><a href="#tab-question" aria-controls="tab-question" role="tab" data-toggle="tab"><?php echo $tab_question; ?></a></li>
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
                                  <input type="text" name="qitem_description[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($qitem_description[$language['language_id']]) ? $qitem_description[$language['language_id']]['title'] : ''; ?>"  id="input-title<?php echo $language['language_id']; ?>" class="form-control" />
                              </div>
                              <?php if (isset($error_title[$language['language_id']])) { ?>
                                <small class="help-block"><?php echo $error_title[$language['language_id']]; ?></small>
                              <?php } ?>
                            </div>

                            <div class="form-group hidden">
                              <div class="fg-line">
                                  <label class="control-label" for="input-address<?php echo $language['language_id']; ?>"><?php echo $entry_address; ?></label>
                                  <input type="text" name="qitem_description[<?php echo $language['language_id']; ?>][address]" value="<?php echo isset($qitem_description[$language['language_id']]) ? $qitem_description[$language['language_id']]['address'] : ''; ?>" id="input-address<?php echo $language['language_id']; ?>" class="form-control" />
                              </div>
                            </div>

                            <div class="form-group hidden required <?php if (isset($error_description[$language['language_id']])) { ?> has-error <?php } ?>">
                              <div class="fg-line">
                                  <label class="control-label m-b-10" for="input-description<?php echo $language['language_id']; ?>"><?php echo $entry_description; ?></label>
                                  <textarea name="qitem_description[<?php echo $language['language_id']; ?>][description]" id="input-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($qitem_description[$language['language_id']]) ? $qitem_description[$language['language_id']]['description'] : ''; ?></textarea>
                              </div>
                              <?php if (isset($error_description[$language['language_id']])) { ?>
                                <small class="help-block"><?php echo $error_description[$language['language_id']]; ?></small>
                              <?php } ?>
                            </div>

                            <div class="form-group  hidden required <?php if (isset($error_meta_title[$language['language_id']])) { ?> has-error <?php } ?>">
                              <div class="fg-line">
                                  <label class="control-label" for="input-meta-title<?php echo $language['language_id']; ?>"><?php echo $entry_meta_title; ?></label>
                                  <input type="text" name="qitem_description[<?php echo $language['language_id']; ?>][meta_title]" value="<?php echo isset($qitem_description[$language['language_id']]) ? $qitem_description[$language['language_id']]['meta_title'] : ''; ?>" id="input-meta-title<?php echo $language['language_id']; ?>" class="form-control" />
                              </div>
                              <?php if (isset($error_meta_title[$language['language_id']])) { ?>
                                <small class="help-block"><?php echo $error_meta_title[$language['language_id']]; ?></small>
                              <?php } ?>
                            </div>

                            <div class="form-group hidden">
                              <div class="fg-line">
                                  <label class="control-label m-b-10" for="input-meta-description<?php echo $language['language_id']; ?>"><?php echo $entry_meta_description; ?></label>
                                  <textarea name="qitem_description[<?php echo $language['language_id']; ?>][meta_description]" class="form-control auto-size" rows="4" id="input-meta-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($qitem_description[$language['language_id']]) ? $qitem_description[$language['language_id']]['meta_description'] : ''; ?></textarea>
                              </div>
                            </div>
                            <div class="form-group hidden">
                              <div class="fg-line">
                                  <label class="control-label m-b-10" for="input-meta-keyword<?php echo $language['language_id']; ?>"><?php echo $entry_meta_keyword; ?></label>
                                  <textarea name="qitem_description[<?php echo $language['language_id']; ?>][meta_keyword]" class="form-control auto-size" rows="4" id="input-meta-keyword<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($qitem_description[$language['language_id']]) ? $qitem_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea>
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
                          <div class="fg-line">
                            <label class="control-label" for="input-quiz_id"><?php echo $entry_quiz; ?></label>
                            <div class="select">
                              <select name="quiz_id" id="input-quiz_id" class="form-control">
                              <option value="0"><?php echo $text_none; ?></option>
                                <?php if (!empty($quiz_results)) { ?>
                                  <?php foreach ($quiz_results as $quiz_result) { ?>
                                    <?php if ($quiz_result['quiz_id'] == $quiz_id) { ?>
                                      <option value="<?php echo $quiz_result['quiz_id']; ?>" selected="selected"><?php echo $quiz_result['quiz_title']; ?></option>
                                    <?php } else { ?>
                                      <option value="<?php echo $quiz_result['quiz_id']; ?>"><?php echo $quiz_result['quiz_title']; ?></option>
                                    <?php } ?>
                                  <?php } ?>
                                <?php } ?>
                               
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group <?php if ($error_keyword) { ?> has-error <?php } ?> hidden">
                          <div class="fg-line">
                              <label class="control-label" for="input-keyword"><?php echo $entry_keyword; ?></label>
                              <input type="text" name="keyword" value="<?php echo $keyword; ?>"  id="input-keyword" class="form-control" />
                          </div>
                          <?php if ($error_keyword) { ?>
                            <small class="help-block"><?php echo $error_keyword; ?></small>
                          <?php } ?>
                        </div><!--/.form-group-->
                      </div>
                      </div>
                      <div class="row">
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
                      <div class="form-group">
                        <div class="fg-line">
                            <label class="control-label" for="input-image"><?php echo $entry_image; ?></label>
                        </div>
                          <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail">
                            <img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" />
                          </a>
                          <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
                      </div> 
                      </div>
                      
                    </div>

                    
                  </div>
                </div>

                <div role="tabpanel" class="tab-pane " id="tab-image">
                  <table id="images" class="table table-striped">
                    <thead>
                      <tr>
                        <th><?php echo $entry_image_title; ?></th>
                        <th><?php echo $entry_link; ?></th>
                        <th><?php echo $entry_image; ?></th>
                        <th><?php echo $entry_sort_order; ?></th>
                        <th></th>
                      </tr>
                    </thead>
                  <tbody>
                    <?php $image_row = 0; ?>
                    <?php foreach ($qitem_images as $qitem_image) { ?>
                      <tr id="image-row<?php echo $image_row; ?>">
                        <td>
                          <?php foreach ($languages as $language) { ?>
                          <div class="input-group <?php if (isset($error_qitem_image[$image_row][$language['language_id']])) { ?>has-error <?php } ?>">
                              <span class="input-group-addon"><?php echo $language['name']; ?></span>
                              <div class="fg-line">
                                <input type="text" name="qitem_image[<?php echo $image_row; ?>][qitem_image_description][<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($qitem_image['qitem_image_description'][$language['language_id']]) ? $qitem_image['qitem_image_description'][$language['language_id']]['title'] : ''; ?>" placeholder="<?php echo $entry_title; ?>" class="form-control" />
                              </div>
                              <?php if (isset($error_qitem_image[$image_row][$language['language_id']])) { ?>
                                <small class="help-block"><?php echo $error_qitem_image[$image_row][$language['language_id']]; ?></small>
                              <?php } ?>
                          </div>
                          <?php } ?>
                        </td>

                        <td class="text-left" style="width: 30%;">
                          <input type="text" name="qitem_image[<?php echo $image_row; ?>][link]" value="<?php echo $qitem_image['link']; ?>" placeholder="<?php echo $entry_link; ?>" class="form-control" />
                        </td>

                        <td class="text-left" style="width: 30%;">
                          <a href="" id="thumb-image<?php echo $image_row; ?>" data-toggle="image" class="img-thumbnail">
                            <img src="<?php echo $qitem_image['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" />
                          </a>
                          <input type="hidden" name="qitem_image[<?php echo $image_row; ?>][image]" value="<?php echo $qitem_image['image']; ?>" id="input-image<?php echo $image_row; ?>" />
                        </td>

                        <td class="text-right">
                          <input type="text" name="qitem_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $qitem_image['sort_order']; ?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" />
                        </td>

                        <td class="text-left">
                          <button type="button" onclick="$('#image-row<?php echo $image_row; ?>, .tooltip').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger">
                            <i class="fa fa-minus-circle"></i>
                          </button>
                        </td>

                      </tr>
                      <?php $image_row++; ?>
                      <?php } ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="4"></td>
                          <td class="text-left"><button type="button" onclick="addImage();" data-toggle="tooltip" title="<?php echo $button_image_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>

                 <div role="tabpanel" class="tab-pane " id="tab-question">
                    <table id="questions" class="table table-striped">
                      <thead>
                        <tr>
                          <th>Изображение(если необходимо)</th>
                          <th>Ответ</th>
                          <th>Ответ системы на ответ</th>
                          <th>ID ответа(номера по порядку - )</th>
                          <th>Статус (правильно - 1)</th>
                          <th><?php echo $entry_sort_order; ?></th>
                          <th></th>
                        </tr>
                      </thead>
                    <tbody>
                      <?php $question_row = 0; ?>
                      <?php foreach ($qitem_questions as $qitem_question) { ?>
                        <tr id="question-row<?php echo $question_row; ?>">
                          <td class="text-left" style="width: 30%;">
                            <a href="" id="thumb-image<?php echo ($question_row+1000); ?>" data-toggle="image" class="img-thumbnail">
                              <img src="<?php echo $qitem_question['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" />
                            </a>
                            <input type="hidden" name="qitem_question[<?php echo $question_row; ?>][image]" value="<?php echo $qitem_question['image']; ?>" id="input-image<?php echo ($question_row+1000); ?>" />
                          </td>
                          <td>
                            <?php foreach ($languages as $language) { ?>
                            <div class="input-group <?php if (isset($error_qitem_question[$question_row][$language['language_id']])) { ?>has-error <?php } ?>">
                                <span class="input-group-addon"><?php echo $language['name']; ?></span>
                                <div class="fg-line">
                                  <input type="text" name="qitem_question[<?php echo $question_row; ?>][qitem_question_description][<?php echo $language['language_id']; ?>][answer_title]" value="<?php echo isset($qitem_question['qitem_question_description'][$language['language_id']]) ? $qitem_question['qitem_question_description'][$language['language_id']]['answer_title'] : ''; ?>" placeholder="<?php echo $entry_title; ?>" class="form-control" />
                                </div>
                                <?php if (isset($error_qitem_question[$question_row][$language['language_id']])) { ?>
                                  <small class="help-block"><?php echo $error_qitem_question[$question_row][$language['language_id']]; ?></small>
                                <?php } ?>
                            </div>
                            <?php } ?>
                          </td>

                          <td>
                            <?php foreach ($languages as $language) { ?>
                            <div class="input-group <?php if (isset($error_qitem_question[$question_row][$language['language_id']])) { ?>has-error <?php } ?>">
                                <span class="input-group-addon"><?php echo $language['name']; ?></span>
                                <div class="fg-line">
                                  <input type="text" name="qitem_question[<?php echo $question_row; ?>][qitem_question_description][<?php echo $language['language_id']; ?>][answer_comment]" value="<?php echo isset($qitem_question['qitem_question_description'][$language['language_id']]) ? $qitem_question['qitem_question_description'][$language['language_id']]['answer_comment'] : ''; ?>" placeholder="<?php echo $entry_title; ?>" class="form-control" />
                                </div>
                                <?php if (isset($error_qitem_question[$question_row][$language['language_id']])) { ?>
                                  <small class="help-block"><?php echo $error_qitem_question[$question_row][$language['language_id']]; ?></small>
                                <?php } ?>
                            </div>
                            <?php } ?>
                          </td>


                          <td class="text-right">
                            <input type="text" name="qitem_question[<?php echo $question_row; ?>][question_id]" value="<?php echo $qitem_question['question_id']; ?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" />
                          </td>
                           <td class="text-right">
                            <input type="text" name="qitem_question[<?php echo $question_row; ?>][correct]" value="<?php echo $qitem_question['correct']; ?>"  class="form-control" />
                          </td>
                          <td class="text-right">
                            <input type="text" name="qitem_question[<?php echo $question_row; ?>][sort_order]" value="<?php echo $qitem_question['sort_order']; ?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" />
                          </td>
                          <td class="text-left">
                            <button type="button" onclick="$('#question-row<?php echo $question_row; ?>, .tooltip').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger">
                              <i class="fa fa-minus-circle"></i>
                            </button>
                          </td>
                        </tr>
                        <?php $question_row++; ?>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="6"></td>
                            <td class="text-left"><button type="button" onclick="addQuestion();" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
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
    html += '  <td>';
  <?php foreach ($languages as $language) { ?>
  html += '    <div class="input-group">';
  html += '      <span class="input-group-addon"><?php echo $language['name']; ?></span><div class="fg-line"><input type="text" name="qitem_image[' + image_row + '][qitem_image_description][<?php echo $language['language_id']; ?>][title]" value="" placeholder="<?php echo $entry_title; ?>" class="form-control" /></div>';
    html += '    </div>';
  <?php } ?>
  html += '  </td>';  
  html += '  <td class="text-left"><input type="text" name="qitem_image[' + image_row + '][link]" value="" placeholder="<?php echo $entry_link; ?>" class="form-control" /></td>'; 
  html += '  <td class="text-left"><a href="" id="thumb-image' + image_row + '" data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="qitem_image[' + image_row + '][image]" value="" id="input-image' + image_row + '" /></td>';
  html += '  <td class="text-right"><input type="text" name="qitem_image[' + image_row + '][sort_order]" value="" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>';
  html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html += '</tr>';
  
  $('#images tbody').append(html);
  
  image_row++;
}

var question_row = <?php echo $question_row; ?>;

function addQuestion() {
  html  = '<tr id="question-row' + question_row + '">';
  html += '  <td class="text-left" ><a href="" id="thumb-image' + (question_row+1000)  + '" data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="qitem_question[' + (question_row+1000)  + '][image]" value="" id="input-image' + (question_row+1000) + '" /></td>';

    html += '  <td style="width: 30%;">';
  <?php foreach ($languages as $language) { ?>
  html += '    <div class="input-group">';
  html += '      <span class="input-group-addon"><?php echo $language['name']; ?></span><div class="fg-line"><input type="text" name="qitem_question[' + (question_row+1000) + '][qitem_question_description][<?php echo $language['language_id']; ?>][answer_title]" value=""  class="form-control" /></div>';
    html += '    </div>';
  <?php } ?>
  html += '  </td>';  
  
   html += '  <td style="width: 30%;">';
  <?php foreach ($languages as $language) { ?>
  html += '    <div class="input-group">';
  html += '      <span class="input-group-addon"><?php echo $language['name']; ?></span><div class="fg-line"><input type="text" name="qitem_question[' + (question_row+1000) + '][qitem_question_description][<?php echo $language['language_id']; ?>][answer_comment]" value=""  class="form-control" /></div>';
    html += '    </div>';
  <?php } ?>
  html += '  </td>'; 
 

  html += '<td class="text-right" style="width: 10%;">'
  html += '<div class="input-group"><div class="fg-line"><input type="text" name="qitem_question[' + (question_row+1000) + '][question_id]" value="0" class="form-control" /></div></div>';
  html += '</td>';

  html += '<td class="text-right" style="width: 10%;">'
  html += '<div class="input-group"><div class="fg-line"><input type="text" name="qitem_question[' + (question_row+1000) + '][correct]" value="0"  class="form-control" /></div></div>';
  html += '</td>';

  html += '<td class="text-right" style="width: 10%;">'
  html += '<div class="input-group"><div class="fg-line"><input type="text" name="qitem_question[' + (question_row+1000) + '][sort_order]" value="0"  class="form-control" /></div></div>';
  html += '</td>';

  html += '  <td class="text-left"><button type="button" onclick="$(\'#question-row' + (question_row+1000)  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html += '</tr>';
  
  $('#questions tbody').append(html);
  
  question_row++;
}
//--></script>
<script type="text/javascript"><!--
 <?php foreach ($languages as $language) { ?>
/*  $('#input-description<?php echo $language['language_id']; ?>').summernote({
    height: 300
  });*/
  <?php } ?>
  $('#language a:first').tab('show');
//--></script>
<?php echo $footer; ?>