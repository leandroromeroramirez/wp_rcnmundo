(function() {
    var useSSL = 'https:' == document.location.protocol;
    var src = (useSSL ? 'https:' : 'http:') +
        '//www.googletagservices.com/tag/js/gpt.js';
    document.write('<scr' + 'ipt src="' + src + '"></scr' + 'ipt>');
  })();

jQuery( document ).ready(function( $ ) {
  var width = $( window ).width();
  width -= 9;
  $('#avaliframe').css('width', width+ 'px');
});