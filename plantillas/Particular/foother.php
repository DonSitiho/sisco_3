 <!-- <footer class="main-footer">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-6">
                  <p>Secretaría de Contraloría del estado de Michoacán &copy; 2018-2021</p>
                </div>
                <div class="col-sm-6 text-right">
                  <p>Desarrollado por <a href="http://www.secoem.michoacan.gob.mx/" class="external">Depto. Informática</a></p>
                   Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
 <!-- </div>
              </div>
            </div>
          </footer> -->
 </div>
 </div>
 </div>
 <!-- JavaScript files-->

 <script src="../../plantilla/vendor/jquery/jquery.min.js"></script>
 <script src="../../plantilla/vendor/popper.js/umd/popper.min.js"> </script>
 <script src="../../plantilla/vendor/bootstrap/js/bootstrap.min.js"></script>
 <script src="../../plantilla/vendor/jquery.cookie/jquery.cookie.js"> </script>
 <!-- <script src="../../plantilla/vendor/chart.js/Chart.min.js"></script> -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
 <script src="../../plantilla/vendor/jquery-validation/jquery.validate.min.js"></script>
 <script src="../../js/multiselect/jquery.multi-select.js"></script>
 <script src="../../js/multiselect/jquery.slimscroll.js"></script>
 <script src="../../js/sweetalert2.all.min.js"></script>
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

 </body>

 </html>