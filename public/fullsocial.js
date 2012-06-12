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
            params.count = tab.data('count');

            tab.click(function(ev) {
              getData(url, params, widget, 0, function (data, textStatus, jqXHR) {
                reprintBlock(0, tab, data);
              });
            });

            //tab.click();

          break;
        }
      });
    }

    /**
     * get data async
     */

      function getData (url, params, widget, n, fn) {
        var tab = widget.find('.wp-fullsocial-widget-tabs ul li:nth-child('
                    + (n + 1) + ')');

        var block = widget.find('.wp-fullsocial-blocks ul li:nth-child('
                          + (n + 1) + ')');
        $.ajax({
            url: url 
          , data: params
          , beforeSend: function () {
              tab.addClass('widget-loading');
              block.addClass('widget-loading');
            }
          , success: function (data) {
              tab.removeClass('widget-loading');
              block.removeClass('widget-loading');
              fn(data);
            }
        });
      }


      /**
       * social apis
       */

      var apis = {};

      apis.twitter = function () {
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

    /**
     * re-print block
     */

    function reprintBlock (n, reference, html) {
      var widget = reference.closest(cssname)
        , tabs = widget.find('.wp-fullsocial-widget-tabs ul li')
        , blocks = widget.find('.wp-fullsocial-block');

      var block = blocks.eq(n).addClass('current');
      block.html(html);
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
