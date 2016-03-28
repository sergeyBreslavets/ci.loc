<?php echo $header; ?>
<section class="module message_moroz">
  <div class="container">
    <div class="row">
      <img class="moroz-decor-topleft" src="/image/catalog/message/decor-topleft.png" alt="">
      <img class="moroz-decor-topright" src="/image/catalog/message/decor-topright.png" alt="">
      <img class="moroz-decor-bottom" src="/image/catalog/message/decor-bottom.png" alt="">
      <div class="moroz-main">
        <form id="add-form" class="add-form" role="form">

          <div class="moroz-main-top">
            <div class="text-center">
              <h1 class="module-title font-alt">Письмо мэру Морозу</h1>
              <p class="uppercase">Удивишь мороза своим желанием?<br>Горожане, будем верить, что он существует!</p>
            </div>

            <div class="ajax-response text-center hidden">
              <h5>Ваше письмо отправлено!</h5>
            </div>

            <div class="ajax-hidden">
              <div class="moroz-form-top">
                <div class="form-group">
                  <label for="input-name">Я</label>
                  <input type="text" class="form-control" id="input-name" name="name" placeholder="">
                  <span class="help-block"></span>
                </div>
                <div class="form-group">
                  <label for="input-email">Мне</label>
                  <input type="text" class="form-control" id="input-age" name="age" placeholder="">
                  <span class="help-block"></span>
                </div>
              </div>

              <div class="moroz-message-box-label text-center">Хочу...</div>

              <div class="moroz-form-bottom">
                <div class="form-group">
                  <textarea class="form-control" id="input-message" name="message"></textarea>
                  <span class="help-block"></span>
                  <div class="btn btn-border-l btn-block" id="send_result_message">Отправить</div>
                </div>
              </div>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>
<?php echo $footer; ?>
