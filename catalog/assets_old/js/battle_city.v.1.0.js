(function($){
    $.fn.equalHeight = function(){
        var t = $(this),
            heightArray = t.map(function(){
              return $(this).height();
            }).get(),
            maxHeight = Math.max.apply(Math, heightArray);
        t.height(maxHeight);
        return t;
    };
})(jQuery);

(function($){
  $.fn.adjustFontSize = function(){
    var adjust = $(this).map(function() {
      var t = $(this),
          el = t.get(0),
          fz = parseFloat(window.getComputedStyle(el, null).getPropertyValue('font-size'));

      if(t.width() > t.parent().width()) {
        fz = fz - 1;
        console.info('adjusting font-size: ' + fz);
        t.css({
          'font-size': fz + 'px'
        });
        return true;
      }
      return false;
    }).get(),
    result = adjust.some(function (currentValue) {
      return currentValue;
    });

    if (result) {
      $(this).adjustFontSize();
    } else {
      return $(this);
    }
  };
})(jQuery);

var yaCounter = 0;
for (var winprop in window) {
    if (winprop.indexOf('yaCounter') !== -1) {
        yaCounter = window[winprop];
    }
}

var $_result_form       = $('#poll-form'),
    $_module_step       = $('.module-step'),
    $_wizard_answer_btn = $('.wizard-variant-btn'),
    wizard_steps        = $('.module-step').length;

//для блокировки постоянного нажатия и отправки ajax
var _send = true,
    _add_form = true;

var sravnenie = {
  preInit: function() {
    $('.wizard-battle-begin').on(MOUSE_DOWN, function(e) {
      e.preventDefault();
      $('.module-intro')
      .animate({
        'opacity': 0
      }, 250, function() {
        $('.module-intro').remove();
        sravnenie.init();
      });
    });
  },
  init: function() {
    //инициализируем опрос
    console.log('init');
    console.log('steps: ' + wizard_steps);
    sravnenie.initBtn();
    // setTimeout(function() {
      sravnenie.wizard(1);
    // }, 150);
  },
  initBtn: function() {
    console.log('initBtn');
    //инициализация вариантов ответов
    // !!
    $_wizard_answer_btn.on(MOUSE_DOWN, function(e) {
      e.preventDefault();

      //получим инфу о шаге
      var step     = $(this).data('step'),
          correct  = $(this).data('correct'),
          question = $(this).data('question'),
          answer   = $(this).data('answer'),
          comment  = $(this).data('comment'),
          image    = $(this).data('image'),
          loser    = correct ? '.piter' : '.moscow';

      var target = $(loser + ' .city-image-wrap'),
          attacker = $(this).siblings('.wizard-variant-image'),
          targetCenterX = target.offset().left + (target.width() / 2),
          targetCenterY = target.offset().top + (target.height() / 2),
          attackerCenterX = attacker.offset().left + (attacker.width() / 2),
          attackerCenterY = attacker.offset().top + (attacker.height() / 2),
          strikeX = targetCenterX - attackerCenterX,
          strikeY = targetCenterY - attackerCenterY;

      $('#step_' + step + ' .btn').addClass('off').off(MOUSE_DOWN);

      //Кидаем в лузера картинку
      TweenMax.to($(this).siblings('.wizard-variant-image'), 1, {
        bezier: {
          type: "cubic",
          values: [
            {x: 0, y: 0},
            {x: 0, y: strikeY/2},
            {x: strikeX/2, y: strikeY},
            {x: strikeX, y: strikeY}
          ]
        },
        opacity: 0,
        scale: 0.5,
        ease: Sine.easeIn,
        onComplete: function() {
          //Трясем лузера
          $('.city-image' + loser)
          .transition({
            x: '-5%',
            y: 0
          }, 25)
          .transition({
            x: '5%',
            y: '-5%'
          }, 25)
          .transition({
            x: 0,
            y: '5%'
          }, 25)
          .transition({
            x: '-5%',
            y: '-5%'
          }, 25)
          .transition({
            x: '5%',
            y: 0
          }, 25)
          .transition({
            x: '-5%',
            y: '5%'
          }, 25)
          .transition({
            x: 0,
            y: '-5%'
          }, 25)
          .transition({
            x: '5%',
            y: '5%'
          }, 25)
          .transition({
            x: 0,
            y: 0
          }, 100, 'easeInOutQuint');

          //Добавляем лузеру оверлейную картинку
          $('<img src="/image/catalog/city_battle/' + (loser === '.moscow' ? 'moscow' : 'piter') + '-over' + (loser === '.moscow' ? (Math.random() > 0.5 ? '-2' : '-1') : '') + '.png" alt="">')
          .prependTo(loser + ' .city-image-overlay')
          .css({
            //Рандомно генерим положение картинки для москвы, или рассчитываем отступ для питера
            'top': (loser === '.moscow' ? Math.random() * (70 - 10) + 10 : 100 - ($(loser + ' .city-image-overlay img').length * (60 / wizard_steps))) + '%'
          })
          .transition({
            'opacity': 0.9
          }, 500);

          if (_add_form) {
            $(this).addClass('my_answer');
            $_result_form.append('<input type="hidden" name="answer[' + question + ']" value="' + answer + '">');
            _add_form = false;
          }

          sravnenie.showNextStep(step);
        }
      });
    });
  },
  wizard: function(_step) {
    console.log('wizard');
    var variant_buttons = $('#step_' + _step).find('.wizard-variant-btn');
    //показываем _step шаг
    _add_form = true;
    $_module_step.removeClass('current');
    $('#step_' + _step)
    .animate({
      'opacity': 0,
      'display': 'block'
    }, 0, function() {
      variant_buttons.css({'line-height': variant_buttons.equalHeight().height() + 'px'});
      $('.wizard-variant-btn span').adjustFontSize();
    })
    .transition({
      y: '400px'
    })
    .delay(100)
    .transition({
      'opacity': 1,
      y: '0px'
    }, 250, function() {
      $(this).addClass('current');
    }, 'easeInOutBack');
  },
  showNextStep: function(_step) {
    console.log('showNextStep');
    if (_step + 1 > wizard_steps) {
      _send = false;
      setTimeout(function () {
        sravnenie.endWizard();
        // !!
        // location.reload(true);
      }, 1000);
    } else {
      $('#step_' + _step)
        .transition({
          'opacity': 0,
          y: '400px'
        }, 250, function() {
          $(this).addClass('hidden');
          sravnenie.wizard(_step + 1);
        });
    }
  },
  endWizard: function() {
    console.log('endWizard');
    sravnenie.sendResult();
  },
  sendResult: function() {
    console.log('sendResult');
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
      beforeSend: function() {},
      complete: function() {},
      success: function(obj) {
        console.log(obj);
        if (obj.success) {
          console.log(obj.redirect);
          window.location.replace(obj.redirect);
        } else {
          $.each(obj.error, function(key, val) {
            console.log(obj.error.key);
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
$(document).ready(function() {
  //
});
$(window).on('load', function() {
  if ($('.wizard-battle').length > 0) {
    sravnenie.preInit();
  }
});
