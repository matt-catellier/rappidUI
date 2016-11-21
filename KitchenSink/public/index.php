<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rappid Demo Application</title>
    <link rel="stylesheet" type="text/css" href="./build/rappid.min.css">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" type="text/css" href="./css/theme-picker.css">
    <link rel="icon" href="./favicon.ico" type="image/x-icon" />
    <style>
      #custom-btn-xd4r {
        background: red;
      }
    </style>
</head>
<body>
    <div id="app">
        <div class="app-header">
              <div class="app-title">
                  <h1>Rappid</h1>
                  <h1 id="custom-btn-xd4r">Custom Button</h1>
              </div>
              <div class="toolbar-container"></div>
        </div>
        <div class="app-body">
              <div class="stencil-container"></div>
              <div class="paper-container"></div>
              <div class="inspector-container"></div>
              <div class="navigator-container"></div>
        </div>
    </div>
    <!-- Rappid/JointJS dependencies: -->
    <script src="../node_modules/jquery/dist/jquery.js"></script>
    <script src="../node_modules/lodash/index.js"></script>
    <script src="../node_modules/backbone/backbone.js"></script>
    <script src="../node_modules/graphlib/dist/graphlib.core.js"></script>
    <script src="../node_modules/dagre/dist/dagre.core.js"></script>

    <script src="./build/rappid.min.js"></script>

    <!--[if IE 9]>
        <script>
          // `-ms-user-select: none` doesn't work in IE9
          document.onselectstart = function() { return false; };
        </script>
    <![endif]-->

    <!-- Application files:  -->
    <script src="./js/config/halo.js"></script>
    <script src="./js/config/inspector.js"></script>
    <script src="./js/config/stencil.js"></script>
    <script src="./js/config/toolbar.js"></script>
    <script src="./js/views/main.js"></script>
    <script src="./js/views/theme-picker.js"></script>
    <script src="./js/models/joint.shapes.app.js"></script>
    <script>

    </script>

    <!-- Local file warning: -->
    <div id="message-fs" style="display: none;">
      <p>The application was open locally using the file protocol. It is recommended to access it trough a <b>Web server</b>.</p>
      <p>Please see <a href="README.md">instructions</a>.</p>
    </div>
    <script>
        (function() {
            var fs = (document.location.protocol === 'file:');
            var ff = (navigator.userAgent.toLowerCase().indexOf('firefox') !== -1);
            if (fs && !ff) {
               (new joint.ui.Dialog({
                   width: 300,
                   type: 'alert',
                   title: 'Local File',
                   content: $('#message-fs').show()
                })).open();
            }
        })();
    </script>
    <?php
        if(isset($_COOKIE["errors"])) {
          echo $_COOKIE["errors"];
          unset($_COOKIE["errors"]);
        }
        ?>
    <script>
        $(function(){
          $.ajax({
            method:"GET",
            dataType: "JSON",
            url: '../getEmergencyProcedure.php',
            success: function(res){
              if(res.message) {
                alert(res.message);
                return;
              }
              joint.setTheme('modern');
              app = new App.MainView({ el: '#app' });
              themePicker = new App.ThemePicker({ mainView: app });
              themePicker.render().$el.appendTo(document.body);
              app.graph.fromJSON($.parseJSON(res));
            },
            error: function(err){
              console.log(err);
            }
          });

          $('#custom-btn-xd4r').on('click', function(e) {
            $.ajax({
              type: "POST",
              url: '../savePaper.php',
              data: {
                'paper': JSON.stringify(app.graph.attributes)
              },
              success: function(res){
                console.log($.parseJSON(res));
                alert('Successfully saved.');
              },
              error: function(err){
                console.log(err);
                alert('Check console for error');
              }
            });
          });

        });
    </script> 
</body>
</html>
