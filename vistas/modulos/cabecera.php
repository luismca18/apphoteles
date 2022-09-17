  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" >
          <?php if(isset($_SESSION['logoHotel'])){
         $logoActual='img/usuarios/'.$_SESSION['logoHotel'];
         $nomHotel=$_SESSION['nombreHotel'];
       }else{  $logoActual='img/logo.jpg';
       $nomHotel='HotelesApp';
      } ?>
           <?php echo ucwords($nomHotel); ?>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="salir" >
          Cerrar sesión<i class="fas fa-sing-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>