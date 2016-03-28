var $_result_form = $('#poll-form'),
  $_module_step = $('.module-step');
  $_li_pagination = $('.pagination li');
  $_wizard_answer_btn = $('.wizard-btn-answer');
  $_wizard_next_btn = $('.wizard-btn-next-step');
//для блокировки постоянного нажатия и отправки ajax
var _send = true;
var _add_form = true;
var whatmuscovite = {
  init:function(){
    //инициализируем опрос
    console.log('init whatmuscovite test');
    whatmuscovite.initBtn();
    setTimeout(function(){whatmuscovite.wizard(1);},150);
    
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
          whatmuscovite.initComment(step,comment);
          $(this)
              .find('span')
              .removeClass('hidden')
          var _h = 0;
          if(mobile){
             $(this).parents('.module-answer').find('.btn-img').each(function( index ) {
                $('.hidden-xs').remove();
                _h += $(this).height() ;  
            });
          } else{
            _h = $(this).parents('.module-answer').find('.btn-img').height()
          }
          $(this).parents('.module-answer').height(_h+20);
            $('html, body').stop().animate({
                scrollTop: $(this).parents('.module-answer').next().offset().top
            }, 1000);
          if(_add_form){
            $(this)
              .addClass('my_answer')
            $_result_form.append('<input type="hidden" name="answer['+ question +']" value="'+ answer +'">');
            _add_form = false;
          }
          
          
          if(correct){
            $('#pstep_'+step).attr('class', '').removeClass('active').addClass('correct');
          }else{
            $('#pstep_'+step).attr('class', '').removeClass('active').addClass('no-correct');
          }
          
        });

        $_wizard_next_btn.on( MOUSE_DOWN, function(e){
          e.preventDefault();
          console.log('Нажали продолжить')
          //получим инфу о шаге
          var step      = $(this).data('step');
          whatmuscovite.showNextStep(step);
        });

        $('.pagination-default').find('a').on(MOUSE_DOWN,function(e){
          e.preventDefault();

      });
  },
  initComment:function(_step,comment){
   
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
    _add_form = true;
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
    if($('.wizard-image').length > 0){
      whatmuscovite.init();
    }
});
$(document).ready(function() {
  
});