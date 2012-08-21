Modernizr = {
    sessionstorage : false,
    localstorage : false
};

jQuery(document).ready(function() {

    jQuery('body').attr(
        'xmlns:cimbic',
        "http://localhost/somerkivi.net/Content/save/"
    );
    // Instantiate Create
    jQuery('body').midgardCreate({
        url: function() {
            return 'Content/save';
            //return 'javascript:false;';
        }
        //, stanbolUrl: 'http://dev.iks-project.eu:8081'
        , localStorage : false
        , autoSave : true
        , autoSaveInterval : 30000 //30 seconds
        , editorOptions :{
            plugins: {
            'halloreundo' : {}
            ,'halloformat': {formattings: {
                bold: true
                ,italic: true
                ,strikeThrough: false
                ,underline: true
            }}
            ,'halloblock': {}
            ,'hallojustify': {}
            ,'hallolists': {}
            ,'hallolink' : {}
        }
        }
    });

  // Fake Backbone.sync since there is no server to communicate with
  Backbone.sync = function(method, model, options)
  {
      if(method == 'create')
          cimbicUI.contentCreate(model, options);
      else if(method == 'read')
          cimbicUI.contentRead(model, options);
      else if(method == 'update')
          cimbicUI.contentUpdate(model, options);
      else if(method == 'delete')
          cimbicUI.contentDelete(model, options);
      else
          alert('Unknown method '.method);
  };
});

cimbicUI = {
  contentCreate: function (model, options)
  {
      console.log('Creating');
      console.log(model);
      console.log(options);

      options.success(model);
  }

  , contentRead: function (model, options)
  {
      console.log('Reading');
      console.log(model);
      console.log(options);

      options.success(model);
  }

  , contentUpdate: function (model, options)
  {
      var jsonModel = model.toJSONLD();
      console.log('Updating');
      console.log(jsonModel);
      console.log(options);

      alert('saving {0} to {1}'.format(model.id, model.url()));
      options.success(model);
  }

  , contentDelete: function (model, options)
  {
      console.log('Deleting');
      console.log(model.toJSONLD());
      console.log(options);

      options.success(model);
  }
}

String.prototype.format = function () {
    var pattern = /\{\d+\}/g;
    var args = arguments;
    return this.replace(pattern, function (capture) {
        return args[capture.match(/\d+/)];
    });
}