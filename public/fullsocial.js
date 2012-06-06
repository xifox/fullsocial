(function($) {
  $(window).ready(function() {
    var cssname = '.wp-fullsocial-widget';

    // widgets
    var widgets = $(cssname);
    if (!widgets.length) return;

    // widgets elements
    $.each(widgets, function (i, widget) {
      processWidget($(widget));
    });

    // init widgets
    function processWidget (widget) {
      var plugin_path = widget.data('path');

      // update data
      $.each(widget.find('.wp-fullsocial-widget-tabs ul li'), function (i, tab) {
        tab = $(tab);
        var url = plugin_path + "/fullsocial-ajax.php"
          , params = {
                type: tab.data('type')
            };

        switch(params.type) {
          case 'twitter':
            params.identifiers = tab.data('ids');

            getData(url, params, function () {
              console.log("-> arguments -> ", arguments);
            })

          break;
        }
      });
    }

    /**
     * get data async
     */

      function getData (url, params, fn) {
        $.ajax({
            url: url 
          , data: params
          , success: fn
        });
      }


    /**
     * show block
     */

    function showBlock (n, reference) {
      var widget = reference.closest(cssname)
        , tabs = widget.find('.wp-fullsocial-widget-tabs ul li')
        , blocks = widget.find('.wp-fullsocial-block');

      tabs.removeClass('current');
      tabs.eq(n).addClass('current');

      blocks.removeClass('current');
      blocks.eq(n).addClass('current');

    }

    // delegation in widget tabs
    widgets.delegate('.wp-fullsocial-widget-tabs ul li', 'mouseenter', function (ev) {
      n = $(this).data('n');
      showBlock(n, $(this));
    });

    widgets.delegate('.wp-fullsocial-widget-tabs ul li', 'mouseleave', function (ev) {
      console.log("-> this -> ", this);
    });



  });
})(jQuery);
