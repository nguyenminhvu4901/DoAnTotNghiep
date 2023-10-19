(function(yourcode) {
    yourcode(window.jQuery, window, document);
  }(function($, window, document){
    $(function(){
      $('input').on('focus', function(e) {
        const ruleDiv = '#' + $(this).attr('id') + '_rules';
        $(ruleDiv).attr('hidden', false);
      })
  
      $('input').on('blur', function(e) {
        const ruleDiv = '#' + $(this).attr('id') + '_rules';
        $(ruleDiv).attr('hidden', true);
      })
    })
  }))