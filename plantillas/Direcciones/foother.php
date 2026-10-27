 </div>
 </div>
 </div>
 <!-- JavaScript files-->

  <!--
  <script src="../../plantilla/vendor/jquery/jquery.min.js"></script>
-->
  <script src="../../js/sweetalert2.all.min.js"></script>
  <script src="../../plantilla/vendor/popper.js/umd/popper.min.js"> </script>
  <script src="../../plantilla/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="../../plantilla/vendor/jquery.cookie/jquery.cookie.js"> </script>
  <script src="../../plantilla/vendor/chart.js/Chart.min.js"></script>
  <script src="../../plantilla/vendor/jquery-validation/jquery.validate.min.js"></script>
  <script src="../../js/multiselect/jquery.multi-select.js"></script>
  <script src="../../js/multiselect/jquery.slimscroll.js"></script>
  <!-- Main File-->

  <script src="../../plantilla/js/front.js"></script>
  <script type="10ebbf4666eff8b7847248c9-text/javascript">
  $('#my-select, #pre-selected-options').multiSelect()
  </script>
  <script type="10ebbf4666eff8b7847248c9-text/javascript">
    $('#callbacks').multiSelect({
      afterSelect: function(values) {
        alert("Select value: " + values);
      },
      afterDeselect: function(values) {
        alert("Deselect value: " + values);
      }
    });
  </script>
  <script type="10ebbf4666eff8b7847248c9-text/javascript">
    $('#keep-order').multiSelect({
      keepOrder: true
    });
  </script>

  <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="10ebbf4666eff8b7847248c9-|49" defer=""></script>
  <script type="text/javascript" src="../../js/multiselect/js/bootstrap-multiselect.js"></script>
  <script>
   $(document).ready(function() {
     $('#selectormultiple').multiselect();
   });
 </script>
 <script>
   $(document).ready(function() {
     $('#selectormultiple_resp').multiselect({
       width: '100%'
     });
   });
 </script>

 

 </body>

 </html>