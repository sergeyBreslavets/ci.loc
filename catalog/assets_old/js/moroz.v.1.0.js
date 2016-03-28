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

var moroz = {
  	init:function(){
      $('body').css({
        'min-height': '100%',
        'background-image': 'url(/image/catalog/message/snow-bg.jpg)',
        // 'background-image': 'url(/image/catalog/message/full-bg.jpg)',
        'background-position': '50% 0',
        'background-repeat': 'no-repeat',
        'background-size': 'cover',
        // 'background-size': (window.innerWidth > 1920 ? 'cover' : 'auto'),
      }).find('.wrapper').css({
        'background': 'none',
        'height': '100%'
      });
      // $('.navbar').hide();

      if($('.upload_achiev').length > 0){
          $('.navbar-right').addClass('hidden');
      }
      $(document).on(MOUSE_DOWN,'#send_result_message',function(e){
          e.preventDefault();
          moroz.sendAddMessage();
          if(yaCounter){
            yaCounter.reachGoal('add_the_object');
          }
      });
    },
    sendAddMessage:function(){
        var data = $('#add-form').serializeArray();
        var url = '/message_upload';
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
                //очишаем все help-block
                $('#add-form').find('.form-group').removeClass('has-error').find('.help-block').empty();
                if(obj.success){
                    $('.ajax-hidden').addClass('hidden');
                    $('.ajax-response').removeClass('hidden');
                }else{
                    //обкат ошибок
                    $.each(obj.error,function(key,val){
                      console.log(obj.error[key]);
                      if(obj.error[key]){
                        $('#add-form').find('#input-'+key).parents('.form-group').addClass('has-error');
                        $('#add-form').find('#input-'+key).next().html(val);
                      }
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText  + "\r\n" +xhr);
            }
        });
    }
};
$(document).ready(function() {
  //
});
$(window).on('load', function() {
    moroz.init();
    function getIEVersion(){
        // var agent = navigator.userAgent;
        // var reg = /MSIE\s?(\d+)(?:\.(\d+))?/i;
        var matches = navigator.userAgent.match(/MSIE\s?(\d+)(?:\.(\d+))?/i);
        if (matches !== null) {
            return { major: matches[1], minor: matches[2] };
        }
        return { major: "-1", minor: "-1" };
    }

    var ie_version =  getIEVersion();
    console.info(ie_version);
    if((parseInt(ie_version.major) < 0 || parseInt(ie_version.major) > 10)){
        // do something
        console.log('pointer-events supported');
    } else {
      console.log('pointer-events not supported');
      $('.moroz-decor-bottom').css({
        'z-index': '-1'
      });
    }
});
