function swapImages(){
  var $active = $('#menulogo .activelogo');
  var $next = ($('#menulogo .activelogo').next().length > 0) ? $('#menulogo .activelogo').next() : $('#menulogo img:first');
  $active.fadeOut(function(){
    $active.removeClass('activelogo');
    $next.fadeIn().addClass('activelogo');
  });
}
