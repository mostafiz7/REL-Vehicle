<header id="Site-Header" class="header-area bg-navy-blue text-white">
  
  {{--@include( 'layouts.includes.header-top' )--}}
  {{--@include( 'layouts.includes.header-nav' )--}}
  {{--@if ( ! Auth::check() )
    @include( 'layouts.includes.auth-header' )
  @endif--}}

  <div class="header-navbar fz-14 pt-15 pb-14 px-sm-2">
    <nav class="navbar navbar-expand-lg py-0 pl-10 pr-10">
      <button id="pushMenu" class="sidebar-push">
        <i class="fa fa-bars"></i>
      </button>

      <div class="navbar-header">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="/" class="nav-link">Home</a>
          </li>

          {{--Purchase-Dropdown--}}
          <li class="nav-item dropdown">
            <div id="Header-Nav-Purchases"
                 class="nav-link dropdown-toggle {{ strpos($viewName, 'purchase-parts') ? 'active' : '' }}">
              Purchases
            </div>
            <div class="dropdown-menu" aria-labelledby="Header-Nav-Purchases">
              <div class="dropdown-item">
                <a href="{{ route('vehicle.parts.purchase.all') }}"
                   class="dropdown-link {{ strpos($viewName, 'purchase-parts') && strpos($viewName, 'index') ? 'active' : '' }}">
                  Parts Purchases Index
                </a>
              </div>
              <div class="dropdown-item">
                <a href="{{ route('vehicle.parts.purchase.new') }}"
                   class="dropdown-link {{ strpos($viewName, 'purchase-parts') && strpos($viewName, 'new') ? 'active' : '' }}">
                  Parts New Purchase
                </a>
              </div>
            </div>
          </li>

        </ul>
      </div>
    </nav>
  </div>
</header>