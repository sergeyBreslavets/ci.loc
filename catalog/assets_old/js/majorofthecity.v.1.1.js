var $_result_form = $('#poll-form'),
  $_module_step = $('.module-step');
  $_li_pagination = $('.pagination li');
  $_wizard_answer_btn = $('.wizard-btn-answer');
  $_wizard_next_btn = $('.wizard-btn-next-step');
//для блокировки постоянного нажатия и отправки ajax
var _send = true;
var whatmuscovite = {
  init:function(){
    //инициализируем опрос
    console.log('init whatmuscovite test');
    whatmuscovite.initBtn();
    setTimeout(function(){whatmuscovite.wizard(1);},150);
    body_size.css({
        'background-image':'url(image/default/bg_whatthemayor.jpg)',
        'background-size': 'cover'
    });
    $('.wrapper').css('background-color', 'transparent');
    $('section').css('background-color', 'transparent');
  },
  initBtn:function(){

    

    //иннициализация ответов
    $_wizard_answer_btn.on( MOUSE_DOWN, function(e){
          e.preventDefault();
          console.log('Ответили на вопрос')
          //получим инфу о шаге
          var step      = $(this).data('step');
          var correct   = $(this).data('correct');
          var question    = $(this).data('question');
          var answer    = $(this).data('answer');
          var comment     = $(this).data('comment')
          whatmuscovite.showNextStep(step);
          $_result_form.append('<input type="hidden" name="answer['+ question +']" value="'+ answer +'">');
          
          $('#pstep_'+step).attr('class', '').removeClass('active').addClass('disabled');
          
        });

       

        $('.pagination-default').find('a').on(MOUSE_DOWN,function(e){
          e.preventDefault();

      });
  },
  initComment:function(_step,comment){
    $('#step_'+_step).find('.module-question')
      .addClass('hidden')
      .next()
      .addClass('hidden');
    $('#step_'+_step).find('.module-comment')
      .find('p')
      .html(comment);
    $('#step_'+_step).find('.module-comment')
      .transition({'opacity':0,'scale':0.8 })
      .css({'display':'block'})
      .transition({'opacity':1,'scale':1},150,function(){});
  },
  wizard:function(_step){
    //показываем _step шаг
    $_module_step
      .removeClass('current');
    $('#step_'+_step)
      .css({'opacity':0,'display':'block'})
      .transition({ x: '-500px' })
      .delay(100)
      .transition({'opacity':1,x: '0px'},250,function(){
        $(this).addClass('current')
      },'easeInOutBack');

    $_li_pagination
      .removeClass('active');
    $('#pstep_'+_step)
      .removeClass('disabled')
      .addClass('active');
    //for mobile
    $('.mobile-pagination').find('.active').html(_step);
    //сформируем текст кнопки
    if (_step = count_steps_of_wizard) {
      $('#step_'+_step).find('.wizard-btn-next-step').html('Получить результат');
    }
  },
  showNextStep:function(_step){
    if (_step+1 > count_steps_of_wizard) {
          _send = false;
          whatmuscovite.endWizard();
        }else{
          $('#step_'+_step)
        .transition({'opacity':0, x: '500px'},250,function(){
          $(this).addClass('hidden');
          whatmuscovite.wizard(_step+1);
        })
          
        }
  },
  endWizard:function(){
    console.log('Опрос завершен');
      whatmuscovite.sendResult();
  },
  sendResult:function(){
      var data = $('#poll-form').serializeArray(); 
      console.log(data);
      yaCounter31626893.reachGoal(rbtn_share);
      var url = '/send_result_quiz'
         $.ajax({
            url: url,
            type: 'POST',
            data: data,
            dataType: 'json',
            beforeSend: function() {
              
            },  
            complete: function() {
                
            },
            success: function(obj) {
              console.log(obj);
              if(obj['success']){
                console.log(obj['redirect']);
                window.location.replace(obj['redirect']);
              }else{
                //обкат ошибок
                $.each(obj['error'],function(key,val){
                  console.log(obj['error'][key]);
                });
              }
            },
            error: function(xhr, ajaxOptions, thrownError) {
              console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText  + "\r\n" +xhr);
            } 
        });
  }
};
$(window).on('load', function(){
    if($('.wizard-text').length > 0){
      whatmuscovite.init();
    }
});
$(document).ready(function() {
  
});