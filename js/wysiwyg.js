  (function($){
    $(function(){
      var $cancel = $('#cancel'),
          $insert = $('#insert'),
          $widgetinstance_form = $('#widgetinstance_form'),
          $selectWidget = $('#select-widget');
          xhr = $.ajax({ 
  type: 'POST',
  url: window.parent.widgetinstance.ajaxurl,
  data: {action: 'getWidgets'},
  success: function(result){
    var o = '';
    result= JSON.parse(result);
    $.each(result, function(sidebar, widgets) {
      if (!widgets.length) return;
      o += '<optgroup label="' + sidebar + '">';
      $.each(widgets, function(key, widget) {
        var ti = (widget.title.length) ? ' (' + widget.title + ')' : '' ;
        o += '<option value="' + widget.id + '">' + widget.id + ti + '</option>';
      });
      o += '</optgroup>';
    });
    $selectWidget.append(o);
  },
  complete: function(){
    ; // maybe set ajax running boolean flag to false?      
  }
          });

      $widgetinstance_form.submit(function(e){
        var $selectWidget = $('#select-widget'),
            $format = $('#format:checked'),
            shortcode = '[widget_instance';
        $formatval = ($format.length) ? $format.val() : 0;
        shortcode += ' id="' + $selectWidget.val() + '"' + ' format="' + $formatval +'"';
        shortcode += ']';

        // inserts the shortcode into the active editor
        window.parent.tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
        tinyMCEPopup.close();
        // closes Thickbox
        return false;
        e.preventDefault;
      });
      
      $insert.bind('click', function(){
        $widgetinstance_form.trigger('submit');
        tinyMCEPopup.close();
      });
      
      $cancel.bind('click', function(){
        tinyMCEPopup.close();
      });
      
    });
  })(jQuery);