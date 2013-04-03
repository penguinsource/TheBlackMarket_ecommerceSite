// jQuery sliding bar
(function ($) {
  $.fn.slidePanel = function (opts) {
    opts = $.extend({
      triggerName: '#trigger',
      position: 'absolute',
      triggerTopPos: '80px',
      panelTopPos: '50px',
      panelOpacity: 0.9,
      speed: 'normal',
      ajax: false,
      ajaxSource: null,
      clickOutsideToClose: true
    }, opts || {});

    var panel = this;
    var trigger = $(opts.triggerName);
    var isIE6 = $.browser.msie && $.browser.version == "6.0"

    // ie6 doesn't like fixed position
    if (isIE6) { opts.position = 'absolute' }
    // set css properties for trigger and panel
    trigger.css('position', opts.position)
    trigger.css('top', opts.triggerTopPos);
    panel.css('position', opts.position)
    panel.css('top', opts.panelTopPos);
    panel.css('filter', 'alpha(opacity=' + (opts.panelOpacity * 100) + ')');
    panel.css('opacity', opts.panelOpacity);

    // triggerName mousedown event
    trigger.attr("href", "javascript:void(0)").mousedown(function () {
      panel.animate({ width: 'toggle' });
      trigger.toggleClass("active");
      return false;
    });

    if (opts.clickOutsideToClose) {
      // bind the 'mousedown' event to the document so we can close panel without having to click triggerName
      $(document).bind('mousedown', function () {
        panel.css('width', '80px');
        panel.hide(opts.speed);
        trigger.removeClass('active');
        document.getElementById('passconf').setAttribute("style", "display: none");
      });

      // don't close panel when clicking inside it
      panel.bind('mousedown', function (e) {
        e.stopPropagation();
      });
    };
  };
})(jQuery);


// button functions and setup

// pushes the login button
$(document).ready(function () {
  $("#blogin").click(function () {
    // nothing yet
  });

  // pushes the register button  
  $("#bregister").click(function () {
    document.getElementById('passconf').setAttribute("style", "display: block");
    $('#loginPanel').animate({ width: '230px' });

    // add checks 
  });
});

// set up the sliding panel
$(document).ready(function () {
  $('#loginPanel').slidePanel({
    triggerName: '#trigger2',
    triggerTopPos: '0px',
    panelTopPos: '0px'
  });
});
