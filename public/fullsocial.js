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

    /**
     * widget function
     */

    function showRSS (el, rss_block) {
      var n = $(el).prevAll().length;
      var title = $(el).find('a.rss-link').text()
      var link = $(el).find('a.rss-link').attr('href');
      var desc = $(el).find('p').html();
      var viewport = rss_block.find('.viewport');

      rss_block.find('ul li').removeClass('current');

      el.addClass('current');
      viewport.find('h4').text(title);
      viewport.find('p.rss-desc').html(desc);
    };

    // init widgets
    function processWidget (widget) {
      // update data
      $.each(widget.find('.wp-fullsocial-widget-tabs ul li'), function (i, tab) {
        tab = $(tab);
        tab.click(function(ev) {
          return
          if (tab.hasClass('widget-loading') || tab.data('type') == 'facebook') return;

          var n = (tab.prevAll()).length
            , widget = tab.closest(cssname)
            , params = {
                  type: tab.data('type')
                , number: widget.data('number')
              };
          getData(params, widget, n);
        });
        //setInterval(function() { tab.click(); }, refreshTime);
        
        /**
         * add animation/behaviours, etc to soscial blocks
         */

        /**
         * feedrss
         */

        if (widget.find('.wp-fullsocial-widget-feedrss').length) {
          var rss_block = widget.find('.wp-fullsocial-widget-feedrss');
          var current_feed = rss_block.find('ul li:first');

          // add click events to each rss title
          rss_block.delegate('ul li', 'click', function (ev) {
            ev.preventDefault();
            if ($(this).hasClass('current')) return;

            current_feed = $(this);
            showRSS(current_feed, rss_block);
            clearInterval(feedTimer);
            startFeedTimer();
          });

          // auto switching
          var feedTimer;
          var startFeedTimer = function () {
            feedTimer = setInterval(function(){
              if (rss_block.closest('.feedrss').css('display') == 'none') return;

              var new_rss = current_feed.next().length
                              ? current_feed.next()
                              : current_feed.closest('ul').find('li:first');
              current_feed = new_rss;

              showRSS(new_rss, rss_block);
            }, refreshTime);
          }

          startFeedTimer();
        }

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
      var n = ($(this).prevAll()).length
      showBlock(n, $(this));
    });

    widgets.delegate('.wp-fullsocial-widget-tabs ul li', 'mouseleave', function (ev) {
    });

  });
})(jQuery);
