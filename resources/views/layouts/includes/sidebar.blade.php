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

    <div class="sidebar-content full-height-prev-auto overlay-scrollbar">
      <ul class="sidebar-menu list-style-none p-10 pb-100">

        {{--Purchase-Dropdown--}}
        <li class="menu-item">
          <a href="#" class="link dropdown-toggler {{ ( strpos($viewName, 'purchase-parts') || strpos($viewName, 'searchResult') ) && ! strpos($viewName, 'searchForm') ? 'active' : '' }}">
            <i class="fa fa-home icon"></i>
            <span class="text">Purchases</span>
          </a>
          
          <ul class="sidebar-dropdown list-style-none {{ ( strpos($viewName, 'purchase-parts') || strpos($viewName, 'searchResult') ) && ! strpos($viewName, 'searchForm') ? 'show' : '' }}">
            <li class="menu-item">
              <a href="{{ route('vehicle.parts.purchase.new') }}" class="link {{ strpos($viewName, 'purchase-parts') && strpos($viewName, 'new') ? 'active' : '' }}">
                <i class="fa fa-home icon"></i>
                <span class="text">Parts New Purchase</span>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('vehicle.parts.purchase.all') }}" class="link {{ strpos($viewName, 'purchase-parts') && strpos($viewName, 'index') ? 'active' : '' }}">
                <i class="fa fa-home icon"></i>
                <span class="text">Parts Purchase Index</span>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('vehicle.parts.purchase.search') }}" class="link {{ strpos($viewName, 'purchase-parts') && strpos($viewName, 'searchResult') ? 'active' : '' }}">
                <i class="fa fa-home icon"></i>
                <span class="text">Purchase Search</span>
              </a>
            </li>
          </ul>
        </li>

        {{--Vehicles-Dropdown--}}
        <li class="menu-item">
          <a href="#" class="link dropdown-toggler {{ strpos($viewName, 'vehicles') ? 'active' : '' }}">
            <i class="fa fa-home icon"></i>
            <span class="text">Vehicles</span>
          </a>
          
          <ul class="sidebar-dropdown list-style-none {{ strpos($viewName, 'vehicles') ? 'show' : '' }}">
            <li class="menu-item">
              <a href="{{ route('vehicle.add.new') }}"
                   class="link {{ strpos($viewName, 'vehicles') && strpos($viewName, 'new') ? 'active' : '' }}">
                <i class="fa fa-home icon"></i>
                <span class="text">Add Vehicle</span>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('vehicle.all.show') }}"
                   class="link {{ strpos($viewName, 'vehicles') && strpos($viewName, 'index') ? 'active' : '' }}">
                <i class="fa fa-home icon"></i>
                <span class="text">Vehicle Index</span>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('vehicle.brands') }}"
                   class="link {{ strpos($viewName, 'vehicles') && (strpos($viewName, 'brands') || strpos($viewName, 'brand-edit')) ? 'active' : '' }}">
                <i class="fa fa-home icon"></i>
                <span class="text">Brands</span>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('vehicle.categories') }}"
                   class="link {{ strpos($viewName, 'vehicles') && (strpos($viewName, 'categories') || strpos($viewName, 'category-edit')) ? 'active' : '' }}">
                <i class="fa fa-home icon"></i>
                <span class="text">Categories</span>
              </a>
            </li>
          </ul>
        </li>

        {{--Parts-Dropdown--}}
        <li class="menu-item">
          <a href="#" class="link dropdown-toggler {{ strpos($viewName, 'parts') && ! strpos($viewName, 'purchase') ? 'active' : '' }}">
            <i class="fa fa-home icon"></i>
            <span class="text">Parts</span>
          </a>
          
          <ul class="sidebar-dropdown list-style-none {{ strpos($viewName, 'parts') && ! strpos($viewName, 'purchase') ? 'show' : '' }}">
            <li class="menu-item">
              <a href="{{ route('vehicle.parts.add.new') }}"
                   class="link {{ strpos($viewName, 'parts') && ! strpos($viewName, 'purchase') && strpos($viewName, 'new') ? 'active' : '' }}">
                <i class="fa fa-home icon"></i>
                <span class="text">Add Parts</span>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('vehicle.parts.all') }}"
                   class="link {{ strpos($viewName, 'parts') && ! strpos($viewName, 'purchase') && strpos($viewName, 'index') ? 'active' : '' }}">
                <i class="fa fa-home icon"></i>
                <span class="text">Parts Index</span>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('vehicle.parts.categories') }}"
                   class="link {{ strpos($viewName, 'parts') && ! strpos($viewName, 'purchase') && (strpos($viewName, 'categories') || strpos($viewName, 'category-edit')) ? 'active' : '' }}">
                <i class="fa fa-home icon"></i>
                <span class="text">Categories</span>
              </a>
            </li>
          </ul>
        </li>

        {{--Employees-Dropdown--}}
        <li class="menu-item">
          <a href="#" class="link dropdown-toggler {{ strpos($viewName, 'employees') ? 'active' : '' }}">
            <i class="fa fa-home icon"></i>
            <span class="text">Employees</span>
          </a>
          
          <ul class="sidebar-dropdown list-style-none {{ strpos($viewName, 'employees') ? 'show' : '' }}">
            <li class="menu-item">
              <a href="{{ route('employee.add.new') }}"
                   class="link {{ strpos($viewName, 'employees') && strpos($viewName, 'new') ? 'active' : '' }}">
                <i class="fa fa-home icon"></i>
                <span class="text">Add Employee</span>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('employee.all.show') }}"
                   class="link {{ strpos($viewName, 'employees') && strpos($viewName, 'index') ? 'active' : '' }}">
                <i class="fa fa-home icon"></i>
                <span class="text">Employee Index</span>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('department.add.new') }}"
                   class="link {{ strpos($viewName, 'employees') && strpos($viewName, 'departments') ? 'active' : '' }}">
                <i class="fa fa-home icon"></i>
                <span class="text">Departments</span>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('designation.add.new') }}"
                   class="link {{ strpos($viewName, 'employees') && strpos($viewName, 'designations') ? 'active' : '' }}">
                <i class="fa fa-home icon"></i>
                <span class="text">Designations</span>
              </a>
            </li>
          </ul>
        </li>

        {{--Users-Dropdown--}}
        <li class="menu-item">
          <a href="#" class="link dropdown-toggler {{ strpos($viewName, 'user') ? 'active' : '' }}">
            <i class="fa fa-home icon"></i>
            <span class="text">Users</span>
          </a>
          
          <ul class="sidebar-dropdown list-style-none {{ strpos($viewName, 'user') ? 'show' : '' }}">
            <li class="menu-item">
              <a href="{{ route('user.add.new') }}"
                   class="link {{ strpos($viewName, 'user') && strpos($viewName, 'new') ? 'active' : '' }}">
                <i class="fa fa-home icon"></i>
                <span class="text">New User</span>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('user.all.index') }}"
                   class="link {{ strpos($viewName, 'user') && strpos($viewName, 'index') ? 'active' : '' }}">
                <i class="fa fa-home icon"></i>
                <span class="text">User Index</span>
              </a>
            </li>
          </ul>
        </li>

        {{--Settings-Dropdown--}}
        {{-- @can ( 'isSuperAdmin', Auth::user() ) --}}
        @can ( 'isSuperAdmin' )
          <li class="menu-item">
            <a href="#" class="link dropdown-toggler {{ strpos($viewName, 'settings') ? 'active' : '' }}">
              <i class="fa fa-home icon"></i>
              <span class="text">Settings</span>
            </a>
            
            <ul class="sidebar-dropdown list-style-none {{ strpos($viewName, 'settings') ? 'show' : '' }}">
              <li class="menu-item">
                <a href="#"
                    class="link {{ strpos($viewName, 'settings') ? 'active' : '' }}">
                  <i class="fa fa-home icon"></i>
                  <span class="text">Setting</span>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('database.migration.update') }}"
                    class="link {{ strpos($viewName, 'settings') ? 'active' : '' }}">
                  <i class="fa fa-home icon"></i>
                  <span class="text">Migrate Update</span>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('database.migration.fresh') }}"
                    class="link {{ strpos($viewName, 'settings') ? 'active' : '' }}">
                  <i class="fa fa-home icon"></i>
                  <span class="text">Migrate Fresh</span>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('database.migration.fresh.seed') }}"
                    class="link {{ strpos($viewName, 'settings') ? 'active' : '' }}">
                  <i class="fa fa-home icon"></i>
                  <span class="text">Migrate Fresh + Seed</span>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('database.migration.rollback') }}"
                    class="link {{ strpos($viewName, 'settings') ? 'active' : '' }}">
                  <i class="fa fa-home icon"></i>
                  <span class="text">Migrate Rollback</span>
                </a>
              </li>
            </ul>
          </li>
        @endcan


        {{--Dropdown-Menu--}}
        {{-- <li class="menu-item">
          <a href="#" class="link dropdown-toggler ">
            <i class="fa fa-home icon"></i>
            <span class="text">Dashboard</span>
          </a>
          
          <ul class="sidebar-dropdown list-style-none">
            <li class="menu-item">
              <a href="#" class="link ">
                <i class="fa fa-home icon"></i>
                <span class="text">Dashboard</span>
              </a>
            </li>
          </ul>
        </li> --}}
      </ul>
    </div>
  </div>
</div>