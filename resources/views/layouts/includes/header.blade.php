<header id="Site-Header" class="header-area bg-navy-blue text-white">
  
  {{--@include( 'layouts.includes.header-top' )--}}
  {{--@include( 'layouts.includes.header-nav' )--}}
  {{--@if ( ! Auth::check() )
    @include( 'layouts.includes.auth-header' )
  @endif--}}

  <div class="header-navbar ps-sm-2">
    <nav class="navbar navbar-expand-lg py-0 px-10">
      <a class="navbar-brand pt-7 pb-11" href="/">
        <img src="{{ asset('assets/img/logo-red.png') }}" alt="" 
        class="brand-logo h-30px" />
      </a>
      
      <button id="pushMenu" class="d-none sidebar-push mr-15">
        <i class="fa fa-bars"></i>
      </button>

      <div class="navbar-header ms-auto mt--2">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="/" class="nav-link {{ str_contains($viewName, 'home') || str_contains($viewName, 'searchForm') ? 'active' : '' }}">Home</a>
          </li>

          {{--Purchase-Dropdown--}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ ( strpos($viewName, 'purchase-parts') || strpos($viewName, 'searchResult') ) && ! strpos($viewName, 'searchForm') ? 'active' : '' }}"
               href="#" id="Header-Nav-Purchases" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Purchases
            </a>
            <ul class="dropdown-menu mt--1 brd-0" aria-labelledby="Header-Nav-Purchases">
              <li class="">
                <a href="{{ route('vehicle.parts.purchase.new') }}"
                   class="dropdown-item {{ strpos($viewName, 'purchase-parts') && strpos($viewName, 'new') ? 'active' : '' }}">
                  Parts New Purchase
                </a>
              </li>
              <li class="">
                <a href="{{ route('vehicle.parts.purchase.all') }}"
                   class="dropdown-item {{ strpos($viewName, 'purchase-parts') && strpos($viewName, 'index') ? 'active' : '' }}">
                  Parts Purchase Index
                </a>
              </li>
              <li class="">
                <a href="{{ route('vehicle.parts.purchase.search') }}"
                   class="dropdown-item {{ strpos($viewName, 'purchase-parts') && strpos($viewName, 'searchResult') ? 'active' : '' }}">
                  Purchase Search
                </a>
              </li>
            </ul>
          </li>

          {{--Vehicles-Dropdown--}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ strpos($viewName, 'vehicles') ? 'active' : '' }}"
               href="#" id="Header-Nav-Vehicles" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Vehicles
            </a>
            <ul class="dropdown-menu mt--1 brd-0" aria-labelledby="Header-Nav-Vehicles">
              <li class="">
                <a href="{{ route('vehicle.add.new') }}"
                   class="dropdown-item {{ strpos($viewName, 'vehicles') && strpos($viewName, 'new') ? 'active' : '' }}">
                  Add Vehicle
                </a>
              </li>
              <li class="">
                <a href="{{ route('vehicle.add.new') }}"
                   class="dropdown-item {{ strpos($viewName, 'vehicles') && strpos($viewName, 'index') ? 'active' : '' }}">
                  Vehicle Index
                </a>
              </li>
              <li class="dropdown-item-divider border-secondary-4 my-3"></li>
              <li class="">
                <a href="{{ route('vehicle.brands') }}"
                   class="dropdown-item {{ strpos($viewName, 'vehicles') && strpos($viewName, 'brands') ? 'active' : '' }}">
                  Brands
                </a>
              </li>
              <li class="">
                <a href="{{ route('vehicle.categories') }}"
                   class="dropdown-item {{ strpos($viewName, 'vehicles') && strpos($viewName, 'categories') ? 'active' : '' }}">
                  Categories
                </a>
              </li>
            </ul>
          </li>

          {{--Parts-Dropdown--}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ strpos($viewName, 'parts') && ! strpos($viewName, 'purchase') ? 'active' : '' }}"
               href="#" id="Header-Nav-Parts" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Parts
            </a>
            <ul class="dropdown-menu mt--1 brd-0" aria-labelledby="Header-Nav-Parts">
              <li class="">
                <a href="{{ route('vehicle.parts.add.new') }}"
                   class="dropdown-item {{ strpos($viewName, 'parts') && ! strpos($viewName, 'purchase') && strpos($viewName, 'new') ? 'active' : '' }}">
                  Add Parts
                </a>
              </li>
              <li class="">
                <a href="{{ route('vehicle.parts.add.new') }}"
                   class="dropdown-item {{ strpos($viewName, 'parts') && ! strpos($viewName, 'purchase') && strpos($viewName, 'index') ? 'active' : '' }}">
                  Parts Index
                </a>
              </li>
              <li class="dropdown-item-divider border-secondary-4 my-3"></li>
              <li class="">
                <a href="{{ route('vehicle.parts.categories') }}"
                   class="dropdown-item {{ strpos($viewName, 'parts') && ! strpos($viewName, 'purchase') && strpos($viewName, 'categories') ? 'active' : '' }}">
                  Categories
                </a>
              </li>
            </ul>
          </li>

          {{--Employees-Dropdown--}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ strpos($viewName, 'employees') ? 'active' : '' }}"
               href="#" id="Header-Nav-Employees" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Employees
            </a>
            <ul class="dropdown-menu mt--1 brd-0" aria-labelledby="Header-Nav-Employees">
              <li class="">
                <a href="{{ route('employee.add.new') }}"
                   class="dropdown-item {{ strpos($viewName, 'employees') && strpos($viewName, 'new') ? 'active' : '' }}">
                  Add Employee
                </a>
              </li>
              <li class="">
                <a href="{{ route('employee.add.new') }}"
                   class="dropdown-item {{ strpos($viewName, 'employees') && strpos($viewName, 'index') ? 'active' : '' }}">
                  Employee Index
                </a>
              </li>
              <li class="dropdown-item-divider border-secondary-4 my-3"></li>
              <li class="">
                <a href="{{ route('department.add.new') }}"
                   class="dropdown-item {{ strpos($viewName, 'employees') && strpos($viewName, 'departments') ? 'active' : '' }}">
                  Departments
                </a>
              </li>
              <li class="">
                <a href="{{ route('designation.add.new') }}"
                   class="dropdown-item {{ strpos($viewName, 'employees') && strpos($viewName, 'designations') ? 'active' : '' }}">
                  Designations
                </a>
              </li>
            </ul>
          </li>

          {{--Settings-Dropdown--}}
          {{-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ strpos($viewName, 'settings') ? 'active' : '' }}"
               href="#" id="Header-Nav-Settings" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               Settings
            </a>
            <ul class="dropdown-menu mt--1 brd-0" aria-labelledby="Header-Nav-Settings">
              <li class="">
                <a href="{{ route('database-migration-update') }}"
                   class="dropdown-item {{ strpos($viewName, 'settings') ? 'active' : '' }}">
                  Migrate
                </a>
              </li>
              <li class="">
                <a href="{{ route('database-migration-fresh') }}"
                   class="dropdown-item {{ strpos($viewName, 'settings') ? 'active' : '' }}">
                  Migrate Fresh
                </a>
              </li>
              <li class="">
                <a href="{{ route('database-migration-rollback') }}"
                   class="dropdown-item {{ strpos($viewName, 'settings') ? 'active' : '' }}">
                  Migrate Rollback
                </a>
              </li> --}}
            </ul>
          </li>

        </ul>
      </div>
    </nav>
  </div>
</header>