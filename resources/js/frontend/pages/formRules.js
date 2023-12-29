(function(yourcode) {
  yourcode(window.jQuery, window, document);
}(function($, window, document){
  $(function(){
    const input = $('input')
    input.on('focus', function(e) {
      const ruleDiv = '#' + $(this).attr('id') + '_rules';
      if ($(ruleDiv).length) {
        $(ruleDiv).attr('hidden', false);
        $('.select2.select2-container').css('pointer-events', 'none')
      }
    })

    input.on('blur', function(e) {
      const ruleDiv = '#' + $(this).attr('id') + '_rules';
      if ($(ruleDiv).length) {
        $(ruleDiv).attr('hidden', true);
        $('.select2.select2-container').css('pointer-events', '')
      }
    })
  })
}))