<header id="SiteHeader" class="header-area bg-navy-blue text-white">
  
  {{--@include( 'layouts.includes.header-top' )--}}
  {{--@include( 'layouts.includes.header-nav' )--}}
  {{--@if ( ! Auth::check() )
    @include( 'layouts.includes.auth-header' )
  @endif--}}

  <div class="header-navbar ps-sm-2">
    <nav class="navbar navbar-expand-lg py-5 px-10">
      {{-- <a class="navbar-brand mr-30 pt-7 pb-11" href="/">
        <img src="{{ asset('assets/img/logo-red.png') }}" alt="" 
        class="brand-logo h-30px" />
      </a> --}}
      
      @if ( Auth::check() && request()->route()->getName() != 'homepage' )
        {{-- bg-transparent text-white --}}
        <button id="PushMenu" class="sidebar-push fz-22 lh-1 mr-15 ml--5 py-3 px-5 border-0">
          <i class="fa fa-bars lh-1"></i>
        </button>
      @endif

      <div class="navbar-header">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="/" class="nav-link {{ str_contains($viewName, 'home') || str_contains($viewName, 'searchForm') ? 'active' : '' }}">Home</a>
          </li>
          
          {{-- @if ( Auth::check() && request()->route()->getName() == 'homepage' ) --}}
          @if ( Auth::check() )
            <li class="nav-item">
              <a href="{{ route('admin.dashboard') }}" class="nav-link {{ strpos($viewName, 'dashboard') ? 'active' : '' }}">
                Dashboard
              </a>
            </li>

            {{--Purchase-Dropdown--}}
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle {{ ( strpos($viewName, 'purchase-parts') || strpos($viewName, 'searchResult') ) && ! strpos($viewName, 'searchForm') ? 'active' : '' }}"
                id="Header-Nav-Purchases" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                  <a href="{{ route('vehicle.all.show') }}"
                    class="dropdown-item {{ strpos($viewName, 'vehicles') && strpos($viewName, 'index') ? 'active' : '' }}">
                    Vehicle Index
                  </a>
                </li>
                <li class="dropdown-item-divider border-secondary-4 my-3"></li>
                <li class="">
                  <a href="{{ route('vehicle.brands') }}"
                    class="dropdown-item {{ strpos($viewName, 'vehicles') && (strpos($viewName, 'brands') || strpos($viewName, 'brand-edit')) ? 'active' : '' }}">
                    Brands
                  </a>
                </li>
                <li class="">
                  <a href="{{ route('vehicle.categories') }}"
                    class="dropdown-item {{ strpos($viewName, 'vehicles') && (strpos($viewName, 'categories') || strpos($viewName, 'category-edit')) ? 'active' : '' }}">
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
                  <a href="{{ route('vehicle.parts.all') }}"
                    class="dropdown-item {{ strpos($viewName, 'parts') && ! strpos($viewName, 'purchase') && strpos($viewName, 'index') ? 'active' : '' }}">
                    Parts Index
                  </a>
                </li>
                <li class="dropdown-item-divider border-secondary-4 my-3"></li>
                <li class="">
                  <a href="{{ route('vehicle.parts.categories') }}"
                    class="dropdown-item {{ strpos($viewName, 'parts') && ! strpos($viewName, 'purchase') && (strpos($viewName, 'categories') || strpos($viewName, 'category-edit')) ? 'active' : '' }}">
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
                  <a href="{{ route('employee.all.show') }}"
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


            {{-- User-and-Settings-Dropdown --}}
            @can( 'isSuperAdmin', Auth::user() )
              {{-- User-Dropdown --}}
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ strpos($viewName, 'user') ? 'active' : '' }}"
                  href="#" id="Header-Nav-Users" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Users
                </a>
                <ul class="dropdown-menu mt--1 brd-0" aria-labelledby="Header-Nav-Users">
                  <li class="">
                    <a href="{{ route('user.add.new') }}"
                      class="dropdown-item {{ strpos($viewName, 'user') && strpos($viewName, 'new') ? 'active' : '' }}">
                      Add User
                    </a>
                  </li>
                  <li class="">
                    <a href="{{ route('user.all.index') }}"
                      class="dropdown-item {{ strpos($viewName, 'user') && strpos($viewName, 'index') ? 'active' : '' }}">
                      User Index
                    </a>
                  </li>
                </ul>
              </li>
              
              {{-- Settings-Dropdown --}}
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ strpos($viewName, 'settings') ? 'active' : '' }}"
                  href="#" id="Header-Nav-Settings" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Settings
                </a>
                <ul class="dropdown-menu mt--1 brd-0" aria-labelledby="Header-Nav-Settings">
                  <li class="">
                    <a href="{{ url('/migration-update') }}"
                      class="dropdown-item {{ strpos($viewName, 'settings') ? 'active' : '' }}">
                      Migrate Update
                    </a>
                  </li>
                  <li class="">
                    <a href="{{ url('/migration-fresh') }}"
                      class="dropdown-item {{ strpos($viewName, 'settings') ? 'active' : '' }}">
                      Migrate Fresh
                    </a>
                  </li>
                  <li class="">
                    <a href="{{ url('/migration-fresh-seed') }}"
                      class="dropdown-item {{ strpos($viewName, 'settings') ? 'active' : '' }}">
                      Migrate Fresh Seed
                    </a>
                  </li>
                  <li class="">
                    <a href="{{ url('/migration-rollback') }}"
                      class="dropdown-item {{ strpos($viewName, 'settings') ? 'active' : '' }}">
                      Migrate Rollback
                    </a>
                  </li>
                  <li class="">
                    <a href="{{ url('/db-seed') }}"
                      class="dropdown-item {{ strpos($viewName, 'settings') ? 'active' : '' }}">
                      Database Seed
                    </a>
                  </li>
                </ul>
              </li>
            @endcan
          @endif
        </ul>
      </div>

      <!-- Right Side of Navbar -->
      <div class="navbar-header right ms-auto">
        <ul class="navbar-nav">
          {{--Authentication-Links--}}
          @guest
            {{-- @if (Route::has('login')) --}}
            @if ( ! request()->routeIs('login') )
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">
                  {{ __('Login') }}
                </a>
              </li>
            @endif

            {{-- @if (Route::has('register')) --}}
            {{-- @if ( ! request()->routeIs('register') )
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">
                  {{ __('Register') }}
                </a>
              </li>
            @endif --}}
          @else
            <li class="nav-item dropdown">
              <a id="Header-Nav-Account" class="nav-link dropdown-toggle {{ strpos($viewName, 'my-profile') ? 'active' : '' }}"
                href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
              </a>

              <ul class="dropdown-menu dropdown-menu-right mt--1 brd-0"
                aria-labelledby="Header-Nav-Account">
                <li class="">
                  <a href="{{ route('homepage') }}" class="dropdown-item {{ '' }}">
                    Account Settings
                  </a>
                </li>

                <li class="">
                  <a href="{{ route('profile.password.change') }}" class="dropdown-item {{ strpos($viewName, 'password-change') ? 'active' : '' }}">
                    Password Change
                  </a>
                </li>
                
                <li class="dropdown-item-divider border-secondary-4 my-3"></li>

                <li class="">
                  <a href="{{ route('logout') }}" class="dropdown-item {{ '' }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                </li>
              </ul>
            </li>
          @endguest
        </ul>
      </div>
    </nav>
  </div>
</header>