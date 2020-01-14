<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
  <a class="navbar-brand" href="/"><img src={{url('/imagens/disbonslc-logo.png')}} width="144px" height="44px"  alt="SerdManage Logo"/></a>
  <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <!--<li class="nav-item active">
        <a class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Notifications</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Switch account</a>
      </li>-->
      <?php 
        $menus['CHAMADOS'] = "<li class=\"nav-item dropdown\">
          <a class=\"nav-link dropdown-toggle\" id=\"dropdown01\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Chamados</a>
          <div class=\"dropdown-menu\" aria-labelledby=\"dropdown01\">
            <a class=\"dropdown-item\" href=\"chamados\">Consultar Chamados</a>
            <a class=\"dropdown-item\" href=\"chamados/create\">Novo Chamado</a>
          </div>
        </li>";
        $menus['INVENTARIOS'] = "<li class=\"nav-item dropdown\">
          <a class=\"nav-link dropdown-toggle\" id=\"dropdown01\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Inventário</a>
          <div class=\"dropdown-menu\" aria-labelledby=\"dropdown01\">
            <a class=\"dropdown-item\" href=\"inventarios\">Consultar Inventário</a>
            <a class=\"dropdown-item\" href=\"inventarios/create\">Atualizar</a>
          </div>
        </li>" ;

        $permissoes = Request::session()->get('menus');
        foreach($permissoes as $p){
          if (array_key_exists($p, $menus))
            echo $menus[$p];

        }

      ?>
          </ul>
    <div class="form-inline my-2 my-lg-0">
      </span><a href="{{ url('logout') }}" class="btn btn-outline-success my-2 my-sm-0">Logout</a>
    </div>
  </div>
</nav>

<!-- <div class="nav-scroller bg-white box-shadow">
  <nav class="nav nav-underline">
    <a class="nav-link active" href="#">Dashboard</a>
    <a class="nav-link" href="#">
      Friends
      <span class="badge badge-pill bg-light align-text-bottom">27</span>
    </a>
    <a class="nav-link" href="#">Explore</a>
    <a class="nav-link" href="#">Suggestions</a>
    <a class="nav-link" href="#">Link</a>
    <a class="nav-link" href="#">Link</a>
    <a class="nav-link" href="#">Link</a>
    <a class="nav-link" href="#">Link</a>
    <a class="nav-link" href="#">Link</a>
  </nav>
</div> -->