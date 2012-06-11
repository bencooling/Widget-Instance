(function() {
  tinymce.create('tinymce.plugins.widgetinstance', {
    init : function(ed, url) {
      ed.addCommand('mceWidgetinstance', function() {
        ed.windowManager.open({
          file : url + '/tinymce.html',
          width : 480,
          height : 180,
          inline : 1,
          title : 'Add Widget Instance'
        }, {});
      });
      ed.addButton('widgetinstance', {
        cmd : 'mceWidgetinstance',
        image : url + '/tinymce.png'
      });
    },
    getInfo : function() {
      return {
        longname : 'Widgetinstance plugin',
        author : 'Ben Cooling',
        authorurl : 'http://bcooling.com.au',
        infourl : 'http://bcooling.com.au/tinymce',
        version : "1.0"
      };
    }
  });
  tinymce.PluginManager.add('widgetinstance', tinymce.plugins.widgetinstance);
})();