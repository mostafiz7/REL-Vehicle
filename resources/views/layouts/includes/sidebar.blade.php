<div id="Sidebar" class="site-sidebar p-fixed h-100 left-0 top-0 bg-sidebar transition z-index-11">
  <div class="sidebar-overlay p-absolute z-index-1"></div>

  <div class="sidebar-wrapper">
    <div class="sidebar-top h-auto">
      <div class="brand-logo text-center p-15 bb-1">
        <a href="/" class="p-5">
          <img src="{{ asset('assets/img/logo-only-red.png') }}" alt="" 
          class="brand-logo logo-only w-100 h-30px transition" />
          <img src="{{ asset('assets/img/logo-red.png') }}" alt="" 
          class="brand-logo logo-text d-none w-100 h-30px transition" />
        </a>
      </div>
        
      <div class="dashboard sidebar-menu">
        <a href="{{ route('admin.dashboard') }}" class="link py-15 px-20 bb-1 {{ strpos($viewName, 'dashboard') ? 'active' : '' }}">
          <i class="fa fa-home icon"></i>
          <span class="text">Dashboard</span>
        </a>
      </div>
    </div>

    <div class="sidebar-content full-height-prev-auto">
      <ul class="sidebar-menu p-10">
        <li class="menu-item">
          <a href="#" class="link dropdown-toggler {{ strpos($viewName, 'dashboard') ? 'active' : '' }}">
            <i class="fa fa-home icon"></i>
            <span class="text">Dashboard</span>
          </a>
          
          <ul class="sidebar-dropdown">
            <li class="menu-item">
              <a href="{{ route('admin.dashboard') }}" class="link {{ strpos($viewName, 'dashboard') ? 'active' : '' }}">
                <i class="fa fa-home icon"></i>
                <span class="text">Dashboard</span>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('admin.dashboard') }}" class="link {{ strpos($viewName, 'dashboard') ? 'active' : '' }}">
                <i class="fa fa-home icon"></i>
                <span class="text">Dashboard</span>
              </a>
            </li>
          </ul>
        </li>

        <li class="menu-item">
          <a href="#" class="link dropdown-toggler {{ strpos($viewName, 'dashboard') ? 'active' : '' }}">
            <i class="fa fa-home icon"></i>
            <span class="text">Dashboard</span>
          </a>
          
          <ul class="sidebar-dropdown">
            <li class="menu-item">
              <a href="{{ route('admin.dashboard') }}" class="link {{ strpos($viewName, 'dashboard') ? 'active' : '' }}">
                <i class="fa fa-home icon"></i>
                <span class="text">Dashboard</span>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('admin.dashboard') }}" class="link {{ strpos($viewName, 'dashboard') ? 'active' : '' }}">
                <i class="fa fa-home icon"></i>
                <span class="text">Dashboard</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>