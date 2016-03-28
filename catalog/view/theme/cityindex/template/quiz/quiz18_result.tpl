<?php echo $header; ?>
 <section class="module " data-background="image/catalog/test_bg.jpg">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12  col-md-12  col-lg-12 module module__border module__border--white">
        <div class="row">
            <div class="col-xs-4 col-sm-1 col-md-1 col-lg-1 module__logo">
              <a href="/index.html"><img src="assets/images/logo.png" alt="Дума 2016" class="module__logo-image" ></a>
            </div>
            <div class=" col-xs-6 col-sm-5 col-sm-offset-4 col-md-5 col-md-offset-5 col-lg-4 col-lg-offset-6">
                <span class="module__top_text open-sans-exboltit">567 340 <span>горят сердцами</span>
                </span>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
                <div class="module__burger" id="my-button">
                    <a href="#" ><img src="assets/images/burger_1.png" alt=""></a>
                </div>
            </div>
        </div>

        <div class="menu " id="left-menu">
          <div class="menu__burger-close" id="btn_close">
            <img src="assets/images/burger_2.png" alt="">
          </div>
            <ul class="menu__nav">
              <li class="menu__nav-title open-sans-lite"><a href="/index.html">Главная</a></li>
              <li class="menu__nav-step  open-sans-regular">I Этап</li>
              <li class="menu__nav-title open-sans-lite"><a href="/test1.html">3наток думы</a></li>
              <li class="menu__nav-title open-sans-lite"><a href="/test2.html">Кресло депутата</a></li>
              <li class="menu__nav-title open-sans-lite"><a href="/test3.html">Рейтинг партий</a></li>
              <li class="menu__nav-heros open-sans-lite"><a href="#heros">Герои</a></li>
              <li class="menu__nav-step  menu__nav-stepfix open-sans-regular">II Этап</li>
              <li class="menu__nav-title menu__nav-titlefix open-sans-lite">подпишись чтобы выжить</li>
              <li class="input-group menu__nav-input">
                  <input type="text" class="form-control">
                  <div class="input-group-addon"><a href="#"><i class="fa fa-paper-plane-o"></i></a></div>
              </li>
            </ul>
          </div>

           <!-- заголовки  -->
          <div class="row">
            <div class="col-xs-12  center-block">
                <div class="module__title-test open-sans-exboltit">Какой из тебя депутат?</div>
            </div>
            <div class="col-xs-12  center-block text-center ">
              <span class="module__title-testsubtext open-sans-lite ">Ответь на вопросы по истории госдумы и узнай, можешь ли ты стать достойным героем своего дистрикта!</span>
            </div>
          </div>
<div class="col-sm-12 col-md-2 text-right">
            <ul class="social-icons m-t-0">
              <li><span class="vk-icon social-btn" onclick="yaCounter31626893.reachGoal('<?php echo $share_btn_vk; ?>'); return true;" data-network="vk" data-purl="<?php echo $share_url_vk;?>" data-title='<?php echo $share_title; ?>' data-img="<?php echo $share_image;?>" data-text="<?php echo $share_text; ?>"></span></li>
              <li><span class="facebook-icon social-btn" onclick="yaCounter31626893.reachGoal('<?php echo $share_btn_fb; ?>'); return true;" data-network="facebook" data-purl="<?php echo $share_url_fb;?>" data-title='<?php echo $share_title; ?>' data-img="<?php echo $share_image;?>" data-text="<?php echo $share_text; ?>"></span></li>
              <li><span class="ok-icon social-btn" onclick="yaCounter31626893.reachGoal('<?php echo $share_btn_ok; ?>'); return true;" data-network="ok" data-purl="<?php echo $share_url_ok;?>" data-title='<?php echo $share_title; ?>' data-img="<?php echo $share_image;?>" data-text="<?php echo $share_text; ?>"></span></li>
            </ul>
          </div>
          
                <div class="col-sm-12 col-md-10 text-center">
            <img src="<?php echo $share_image; ?>" alt='<?php echo $share_title; ?>'>
          </div>    


          
          
                      





          <div class="row">
              <div class="col-xs-12 col-sm-5 col-sm-offset-7 col-md-4 col-md-offset-8 col-lg-3 col-lg-offset-9 ">
              <div class="warning-duma  mt-130 ">  <!-- /*mt-130 убрать если нет таймер*/ -->
                     <div class="icon-hand ml-12"></div><span class = "warning-duma__text open-sans-lite text-center">информбюро думы <br>предупреждает!</span>
              </div>
              </div>
          </div>






                   


                </div>
            </div>
        </div>
    </section>
    <form id="poll-form" role="form" action="/result_quiz_znatok_duma">
      <input type="hidden" name="quiz_id" value="<?php echo $quiz_id;?>">
    </form>
<?php echo $footer; ?>