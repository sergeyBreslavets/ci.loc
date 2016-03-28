
<?php echo $header; ?>
<section class="module upload_achiev" >
  <div class="container">
    <div class="row">
      <div class="col-sm-12 text-center">
        <h1 class="module-title font-alt">Добавь свой объект для голосования.</h1>
      </div>
      <div class="col-sm-12 col-md-offset-2 col-md-8">
        <div class="ajax-response text-center hidden">
          <h5>Спасибо! Мы&nbsp;рассмотрим ваше предложение в&nbsp;ближайшее время!</h5>
        </div>
        <div class="ajax-hidden">
        <form id="add-form" class="add-form" role="form">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="input-message">Введите событие</label>
                <textarea class="form-control" id="input-message" name="message"></textarea>
                <span class="help-block"></span>
              </div>
             
            </div>
            <div class="col-sm-6">
              <div class="row">
                 <div class="col-sm-12">
                  <div class="form-group">
                      <label for="input-firstname">Имя</label>
                      <input type="text" class="form-control" id="input-firstname" name="firstname" placeholder="">
                      <span class="help-block"></span>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="input-email">E-mail</label>
                      <input type="email" class="form-control" id="input-email" name="email" placeholder="">
                      <span class="help-block"></span>
                    </div>
                  </div>    
              </div>
            </div>  
          </div>
          </form>
          <div class="row">
            <div class="col-sm-10 col-sm-offset-1 text-center">
              <p>Горожанин, будь объективным&nbsp;&mdash; добавляй только действительно важные для Москвы события. Объект будет опубликован после прохождения модерации.</p>
            </div>
            <div class="col-sm-6 col-sm-offset-3 text-center">
               <div class="btn btn-border-l btn-block" id="send_result_question">Добавить</div>
            </div>
          </div>
        </div>

      </div>
    </div>

   
    

  </div>

</section>
<?php echo $column_left; ?>
<?php echo $content_top; ?>
<?php echo $column_right; ?>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>