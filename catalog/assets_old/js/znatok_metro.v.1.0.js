(function($){
    $.fn.equalHeight = function(){
        var t = $(this);
        var heightArray = t.map(function(){
            return $(this).height();
        }).get();
        var maxHeight = Math.max.apply(Math, heightArray);
        t.height(maxHeight);
        return t;
    };
})(jQuery);

var yaCounter = 0;
for (var winprop in window) {
    if (winprop.indexOf('yaCounter') !== -1) {
        yaCounter = window[winprop];
    }
}

var $_result_form = $('#poll-form'),
    $_module_step = $('.module-step'),
    $_li_pagination = $('.pagination li'),
    $_wizard_answer_btn = $('.wizard-btn-answer'),
    $_wizard_next_btn = $('.wizard-btn-next-step'),
    count_steps_of_wizard = $('.module-step').length;
//для блокировки постоянного нажатия и отправки ajax
var _send = true,
    _add_form = true;

var countdown = {
  //!!
  init: function(time, element) {
    countdown.val = parseInt(time);
    countdown.element = element;
    console.log('countdown init: ' + countdown.val + ' seconds');
    countdown.element.parent().removeClass('-warning');
    countdown.element.html(countdown.getString());
    if(countdown.ticker) {
      clearInterval(countdown.ticker);
    }
    countdown.ticker = setInterval(countdown.tick, 1000);
  },
  getTimePart: function(part, isLast) {
    return (part ? (part < 10 ? '0' + part : part) : '00') + (isLast ? '' : ':');
  },
  getString: function() {
    var h = parseInt(countdown.val / (60 * 60) % 24),
        m = parseInt(countdown.val / 60 % 60),
        s = parseInt(countdown.val % 60);
    // return countdown.getTimePart(h) + countdown.getTimePart(m) + countdown.getTimePart(s, true);
    return countdown.getTimePart(m) + countdown.getTimePart(s, true);
  },
  tick: function() {
    countdown.val = countdown.val - 1;
    countdown.element.html(countdown.getString());
    // console.log(countdown.getString());
    if (countdown.val <= 10) {
      countdown.element.parent().addClass('-warning');
    }
    if (countdown.val <= 0) {
      countdown.stop();
    }
  },
  pause: function() {
    clearInterval(countdown.ticker);
    console.log('countdown paused');
  },
  unpause: function() {
    if(countdown.ticker) {
      clearInterval(countdown.ticker);
    }
    countdown.ticker = setInterval(countdown.tick, 1000);
    console.log('countdown unpaused');
  },
  stop: function() {
    clearInterval(countdown.ticker);
    console.log('countdown stopped');
    var firstButton = $('.module-step.current .wizard-btn-answer').first();
    var step = firstButton.data('step'),
        correct = firstButton.data('correct'),
        question = firstButton.data('question'),
        answer = firstButton.data('answer'),
        comment = firstButton.data('comment');
    $_result_form.append('<input type="hidden" name="answer[' + question + ']" value="0">');
    sravnenie.showNextStep($('.module-step.current .wizard-btn-answer').data('step'));
  }
};

var sravnenie = {
  init: function() {
    //инициализируем опрос
    console.log('init sravnenie test');
    $_result_form.append('<input id="module-timer" type="hidden" name="timer" value="0">');
    sravnenie.initBtn();
    setTimeout(function() {
      sravnenie.wizard(1);
    }, 150);

  },
  initBtn: function() {
    //иннициализация ответов
    $_wizard_answer_btn.on(MOUSE_DOWN, function(e) {
      //получим инфу о шаге
      var step = $(this).data('step'),
          correct = $(this).data('correct'),
          question = $(this).data('question'),
          answer = $(this).data('answer'),
          comment = $(this).data('comment');

      $('#step_' + step).addClass('done');
      countdown.pause();
      e.preventDefault();
      console.log('Ответили на вопрос');

      $(this)
        .find('span')
        .removeClass('hidden');
      var _h = 0;

      $(this).closest('.module-answer').find('.wizard-btn-answer').addClass('disabled');

      $(this).addClass(correct ? 'btn-border-green' : 'btn-border-red');
      if (!correct) {
        $('#step_' + step).find('.wizard-btn-answer[data-correct="1"]').addClass('btn-border-green');
      }

      // if (mobile) {
      //   $(this).parents('.module-answer').find('.btn-img').each(function(index) {
      //     $('.hidden-xs').remove();
      //     _h += $(this).height();
      //   });
      // } else {
      //   _h = $(this).parents('.module-answer').find('.btn-img').height();
      // }
      // $(this).parents('.module-answer').height(_h + 20);
      $('html, body').stop().animate({
        scrollTop: $(this).parents('.module-answer').next().offset().top
      }, 1000);
      if (_add_form) {
        $(this)
          .addClass('my_answer');
        $_result_form.append('<input type="hidden" name="answer[' + question + ']" value="' + answer + '">');
        $('#module-timer').val(parseInt($('.module-step.current').data('timeout')) - countdown.val + parseInt($('#module-timer').val()));
        _add_form = false;
      }

      $('#pstep_' + step).attr('class', '').removeClass('active').addClass(correct ? 'correct' : 'no-correct');
      $('#step_' + step).find('.module-answer-img')
        .css({
          'display': 'block',
          'opacity': 0,
          'scale': 0.1
        })
        .transition({
          'opacity': 1,
          'scale': 1
        }, 250);

      $('#step_' + step).find('.module-answer-comment')
        .css({
          'opacity': 0
        })
        .text(comment)
        .transition({
          'opacity': 1
        }, 250).append('<div class="btn btn-border-l col-xs-4 col-xs-offset-4">Далее</div>');

      $('#step_' + step).find('.module-answer-comment .btn').on('click', function () {
        sravnenie.showNextStep(step);
      });

      $('.module-step.current').find('.wizard-btn-answer').off(MOUSE_DOWN);

      // setTimeout(function(){
      //   sravnenie.showNextStep(step);
      // }, 30000);
    });


    $_wizard_next_btn.on(MOUSE_DOWN, function(e) {
      e.preventDefault();
      console.log('Нажали продолжить');
      //получим инфу о шаге
      var step = $(this).data('step');
      sravnenie.showNextStep(step);
    });

    $('.pagination-default').find('a').on(MOUSE_DOWN, function(e) {
      e.preventDefault();

    });
  },
  initComment: function(_step, comment) {

    $('#step_' + _step).find('.module-comment')
      .find('p')
      .html(comment);
    $('#step_' + _step).find('.module-comment')
      .transition({
        'opacity': 0,
        'scale': 0.8
      })
      .css({
        'display': 'block'
      })
      .transition({
        'opacity': 1,
        'scale': 1
      }, 150, function() {});
  },
  wizard: function(_step) {
    var btns = $('#step_' + _step).find('.wizard-btn-answer');
    //показываем _step шаг
    // $('.module-answer-img').hide();
    countdown.init(parseInt($('#step_' + _step).data('timeout')), $('.module-answer-countdown .countdown-time'));

    _add_form = true;
    $_module_step
      .removeClass('current');
    $('#step_' + _step)
      .css({
        'opacity': 0,
        'display': 'block'
      })
      .transition({
        x: '-500px'
      })
      .delay(100)
      .transition({
        'opacity': 1,
        x: '0px'
      }, 250, function() {
        $(this).addClass('current');
      }, 'easeInOutBack');
      btns.css({'line-height': btns.equalHeight().height() + 'px'});

    //  console.log($('.module-step.current').find('.wizard-btn-answer').equalHeight());

    $_li_pagination
      .removeClass('active');
    $('#pstep_' + _step)
      .removeClass('disabled')
      .addClass('active');
    //for mobile
    $('.mobile-pagination').find('.active').html(_step);
    //сформируем текст кнопки
    if (_step == count_steps_of_wizard) {
      $('#step_' + _step).find('.wizard-btn-next-step').html('Получить результат');
    }
  },
  showNextStep: function(_step) {
    if (_step + 1 > count_steps_of_wizard) {
      _send = false;
      sravnenie.endWizard();
    } else {
      $('#step_' + _step)
        .transition({
          'opacity': 0,
          x: '500px'
        }, 250, function() {
          $(this).addClass('hidden');
          sravnenie.wizard(_step + 1);
        });
    }
  },
  endWizard: function() {
    console.log('Опрос завершен');
    sravnenie.sendResult();
  },
  sendResult: function() {
    if (!parseInt($('#module-timer').val())) {
      $('#module-timer').val(0);
    }
    var data = $('#poll-form').serializeArray();
    console.log(data);
    if (yaCounter) {
        yaCounter.reachGoal(rbtn_share);
    }
    var url = '/send_result_quiz';
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
        if (obj['success']) {
          console.log(obj['redirect']);
          window.location.replace(obj['redirect']);
        } else {
          //обкат ошибок
          $.each(obj['error'], function(key, val) {
            console.log(obj['error'][key]);
          });
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
          console.log('error:');
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText + "\r\n" + xhr);
      }
    });
  }
};
$(window).on('load', function() {
  if ($('.wizard-image').length > 0) {
    sravnenie.init();
  }
});
$(document).ready(function() {

});
