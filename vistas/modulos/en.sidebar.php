<script src="https://kit.fontawesome.com/ed07566918.js" crossorigin="anonymous"></script>

<?php
  $url_actual = "http://" . $_SERVER["SERVER_NAME"]."/vistas/";
?>
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="overflow-x: hidden;">
    <div class="brand-link">
      <?php if(isset($_SESSION['logoHotel'])){
         $logoActual='img/usuarios/'.$_SESSION['logoHotel'];
         $nomHotel=$_SESSION['nombreHotel'];
       }else{  $logoActual='img/logo.jpg';
       $nomHotel='HotelesApp';
      } ?>
      <img src="<?php echo $url_actual.$logoActual;?>" alt="HotelesApp" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light" style="font-style: italic; color:#343a40;" id="mnNombre"> .</span>
    </div>
    <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition">
      <div class="os-resize-observer-host observed">
        <div class="os-resize-observer" style="left: 0px; right: auto;">
        </div>
      </div>
      <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
        <div class="os-resize-observer">
        </div>
      </div>
      <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 567px;">
      </div>
      <div class="os-padding">
        <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;"><div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                <a href="ensolicitudes"  class="nav-link">
                  <i class="fas fa-clipboard-list"></i>
                  <p>Monitoring</p> 
                </a>
              </li>
              <li class="nav-item">
                <a href="endashboard"  class="nav-link">
                  <i class="fas fa-chart-line"></i>
                  <p>Statistics</p> 
                </a>
              </li>
              <li class="nav-item">
                <a href="enresolutor"  class="nav-link">
                  <i class="fas fa-cogs"></i>
                  <p>Setting</p> 
                </a>
              </li>
              <li class="nav-item">
                <a href="ensoporte"  class="nav-link">
                  <i class="fa-solid fa-circle-question"></i>
                  <p>Technical support</p> 
                </a>
              </li>              
            </ul>
          </nav>
        </div>
        <!-- /.sidebar-menu -->
      </div>
    </div>
    <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
      <div class="os-scrollbar-track">
        <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);">
        </div>
      </div>
    </div>
    <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
        <div class="os-scrollbar-track">
          <div class="os-scrollbar-handle" style="height: 39.6925%; transform: translate(0px, 0px);">
          </div>
        </div>
    </div>
    <div class="os-scrollbar-corner">
    </div>
    <!-- /.sidebar -->
  </aside>