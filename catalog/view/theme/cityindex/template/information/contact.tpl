<?php echo $header; ?>

 <!-- WRAPPER -->
    <div class="wrapper">
          <!-- SERVICES -->
        <section class="module pb-0">
            <div class="container-fluid container-custom ">
                <!-- MODULE TITLE -->
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <h2 class="module-title font-alt">  Подпишитесь на рассылку</h2>
                        <p class="module-subtitle">Еженедельная рассылка с деталями рейтинга и дайджестом самых заметных инфоповодов.
                    </div>
                </div>
                <!-- /MODULE TITLE -->
                <div class="row multi-columns-row">
                    <div class="col-sm-12 ">
                      <form id="contact-form-email" role="form" novalidate>
                      <div class="row">
                        <div class=" col-xs-12 col-sm-8">
                       <div class="form-group">
                                <label class="sr-only" for="cemail">Email</label>
                                <input type="email" id="email2" name="cemail2" class="form-control" placeholder="E-mail*" required="" data-validation-required-message="Введите Email.">
                                <p class="help-block text-danger"></p>

                        </div></div> 
                        <div class="col-xs-12 col-sm-4">
                               <div class="text-center">
                                <button type="submit2" class="btn btn-block btn-round btn-dark">Подписаться</button>
                            </div>
                            </div>
                         </div>
                      </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- /SERVICES -->
      <!-- CONTACT -->
        <section class="module">
            <div class="container-fluid container-custom">

                <!-- MODULE TITLE -->
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <h2 class="module-title font-alt">Напишите нам </h2>
                        <p class="module-subtitle">Хотите задать вопрос, получить развёрнутый комментарий эксперта или заказать подробное исследование? Оставьте сообщение в свободной форме.</p>
                    </div>
                </div>
                <!-- /MODULE TITLE -->

                <div class="row">

                    <div class="col-sm-8">

                        <form id="contact-form" role="form" novalidate>
                            <div class="form-group">
                                <label class="sr-only" for="cname">Имя</label>
                                <input type="text" id="c_name" class="form-control" name="c_name" placeholder="имя*" required="" >
                                  <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="cemail">Email</label>
                                <input type="email" id="c_email" name="c_email" class="form-control" placeholder="E-mail*" required="" >
                               <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="c_message" name="c_message" rows="7" placeholder="Сообщение*" required=""></textarea>
                                  <span class="help-block"></span>
                            </div>
                            <div class="text-center">
                                <button type="submit" id="send-contact-form" class="btn btn-block btn-round btn-dark">Отправить</button>
                            </div>

                        </form>
                          
                        <!-- Ajax response -->
                         <div class="ajax-response wow zoomIn text-center hidden">
                                <h5>спасибо  ! &nbsp; мы свяжемся с вами. </h5>
                            </div>
                           <!-- <p class="module-subtitle">Или позвоните: +7 (495) 660-62-47</p> -->
                    </div><!-- .col-* -->

                    <div class="col-sm-4">

                        <div class="iconbox iconbox-left m-t-0 m-t-sm-40">
                            <div class="iconbox-icon">
                                <span class="icon-megaphone"></span>
                            </div>
                            <div class="iconbox-header">
                                <h4 class="iconbox-title font-alt">Или позвоните:</h4>
                            </div>
                            <div class="iconbox-content">
                                <p>Телефон: +7 (495) 660-62-47</p>
                            </div>
                        </div>

                   
                    </div><!-- .col-* -->

                </div>

            </div>
        </section>
        <!-- /CONTACT -->



      
        <!-- COUNTERS -->
        <!-- FOOTER -->
        <footer class="footer module-overlay-dark-3">
            <div class="container-fluid container-custom">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="contact-info font-alt">
                            <li><a href="info@citymetrix.ru">info@citymetrix.ru</a></li>
                            <li><a href="">+7 (495) 660-62-47</a></li>
                            <!--     <li><a href="">007 STEET, CITY, USA</a></li> -->
                        </ul>
                        <div class="copyright text-center font-alt">
                            © 2015-2016 <a href="#">cityindex  </a>,Все права защищены.
                        </div>
                    </div>
                </div>
                |
                <!-- SCROLLTOP -->
                <a class="to-top-link" href="#top">
                    <i class="fa fa-angle-up"></i>
                </a>
            </div>
        </footer>
        <!-- /FOOTER -->
    </div>
    <!-- /WRAPPER -->


      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
