<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
<a href="{{route('home')}}" class="brand-link">
    <img src="{{url('storage/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
          <a href="{{ route('manageuser') }}" class="nav-link {{ Route::currentRouteNamed('manageuser') ? 'active' : '' }}">
              <i class="fas fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('managecategory')}}" class="nav-link {{ Route::currentRouteNamed('managecategory') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>Categories</p>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{route('managebanner')}}" class="nav-link {{ Route::currentRouteNamed('managebanner') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>Banner</p>
                </a>
          </li>
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="fas fa-shopping-cart"></i>
              <p>Products</p>
            </a>
          </li>
         <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="fas fa-shopping-cart"></i>
              <p>Orders</p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>