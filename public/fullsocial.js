(function($) {
  $(window).ready(function() {
    /**
     * constants
     */

    var refreshTime = 5000;

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
      // update data
      $.each(widget.find('.wp-fullsocial-widget-tabs ul li'), function (i, tab) {
        tab = $(tab);
        var params = {
                type: tab.data('type')
              , number: widget.data('number')
            };

        tab.click(function(ev) {
          return;
          if (
               tab.hasClass('widget-loading')
            || tab.data('type') == 'facebook'
          ) return;

          (function(reference) {
            getData(params, widget, tab.data('n'), function (data, textStatus, jqXHR) {
            });
          })(tab);
        });

         //setInterval(function() { tab.click(); }, refreshTime);
      });
    }

    /**
     * get data async
     */

      function getData (params, widget, n, fn) {

        var tab = widget.find('.wp-fullsocial-widget-tabs ul li').eq(n);
        var block = widget.find('.wp-fullsocial-blocks ul li.wp-fullsocial-block').eq(n);

        params.action = 'render_social';
        params.type = tab.data('type');

        $.ajax({
            url: 'wp-admin/admin-ajax.php'
          , data: params
          , beforeSend: function () {
              tab.addClass('widget-loading');
              block.addClass('widget-loading');
            }
          , success: function (data) {
              if ((/(\n0)$/).test(data)) {
                data = data.substr(0, data.length - 2);
              }
 
              tab.removeClass('widget-loading');
              block
                .removeClass('widget-loading')
                .html(data);
            }
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
      $(this).click();
      n = $(this).data('n');
      showBlock(n, $(this));
    });

    widgets.delegate('.wp-fullsocial-widget-tabs ul li', 'mouseleave', function (ev) {
      // console.log("-> this -> ", this);
    });

  });
})(jQuery);
