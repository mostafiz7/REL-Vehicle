<header id="Site-Header" class="header-area bg-navy-blue text-white">
  
  {{--@include( 'layouts.includes.header-top' )--}}
  {{--@include( 'layouts.includes.header-nav' )--}}
  {{--@if ( ! Auth::check() )
    @include( 'layouts.includes.auth-header' )
  @endif--}}

  <div class="header-navbar fz-14 px-sm-2">
    <nav class="navbar navbar-expand-lg py-0 pl-10 pr-10">
      <button id="pushMenu" class="sidebar-push mr-15">
        <i class="fa fa-bars"></i>
      </button>

      <div class="navbar-header">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="/" class="nav-link {{ str_contains($viewName, 'home') ? 'active' : '' }}">Home</a>
          </li>

          {{--Purchase-Dropdown--}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ strpos($viewName, 'purchase-parts') ? 'active' : '' }}"
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
                <a href="{{ route('vehicle.new.add') }}"
                   class="dropdown-item {{ strpos($viewName, 'vehicles') && strpos($viewName, 'new') ? 'active' : '' }}">
                  Add New Vehicle
                </a>
              </li>
              <li class="">
                <a href="{{ route('vehicle.new.add') }}"
                   class="dropdown-item {{ strpos($viewName, 'vehicles') && strpos($viewName, 'index') ? 'active' : '' }}">
                  Vehicles Index
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </nav>
  </div>
</header>