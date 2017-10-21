<nav class="navbar navbar-default mynav">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand"><strong>POS</strong></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="{{ Request::path() == 'home' ? 'active' : '' }}"><a href="{{route('home')}}"><i class="fa fa-home fa-lg"></i> Home</a></li>
          <li class="{{ Request::path() == 'sales' ? 'active' : '' }}"><a href="{{route('sales-register-page')}}"><i class="fa fa-shopping-cart fa-lg"></i> Sales Register</a></li>
          <li class="{{ Request::path() == 'products' ? 'active' : '' }}"><a href="{{route('product-index')}}"><i class="fa fa-folder-open-o" aria-hidden="true"></i> Products</a></li>
          <li class="{{ Request::path() == 'sales/all' ? 'active' : '' }}"><a href="{{route('sales-page')}}"><i class="fa fa-user" aria-hidden="true"></i> Sales</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reports <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{route('report-summary')}}">Summary Report</a></li>
              <li><a href="#">Detailed Sales Report</a></li>
            </ul>
          </li>
          
        <li class="{{ Request::path() == 'expenses' ? 'active' : '' }}"><a href="{{route('expenses-index')}}"><i class="fa fa-charts" aria-hidden="true"></i> Expenses</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> {{Auth::user()->name}} <span class="caret"></span></a>
          <ul class="dropdown-menu">

            <li role="separator" class="divider"></li>
            <li><a href="{{route('logout')}}">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
