<div class="header">
    <!-- Navbar Header -->
    <nav
      class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom" data-background-color="red2" >
      <div class="container-fluid">
        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
          <li class="nav-item topbar-user dropdown hidden-caret">
            <a
              class="dropdown-toggle profile-pic"
              data-bs-toggle="dropdown"
              href="#"
              aria-expanded="false"
            >
              {{-- <div class="avatar-sm">
                <img
                  src="{{asset('assets/img/profile.jpg') }}"
                  alt="..."
                  class="avatar-img rounded-circle"
                />
              </div> --}}
              <span class="profile-username">
                <span class="fw-bold">{{ auth()->user()->name }}</span>
              </span>
              <i class="fa fa fa-chevron-down fa-xs ms-2"></i>
            </a>
            <ul class="dropdown-menu dropdown-user animated fadeIn">
              <div class="dropdown-user-scroll scrollbar-outer">
                <li>
                  <div class="user-box">
                    {{-- <div class="avatar-lg">
                      <img
                        src="{{asset('assets/img/profile.jpg') }}"
                        alt="image profile"
                        class="avatar-img rounded"
                      />
                    </div> --}}
                    <div class="u-text">
                      <h4>{{ auth()->user()->name }}</h4>
                      <p class="text-muted">{{ auth()->user()->email }}</p>
                      <a
                        href="{{ route('profile.edit') }}"
                        class="btn btn-xs btn-black btn-sm"
                        >Edit Profile</a
                      >
                    </div>
                  </div>
                </li>
                <li>
                  <div class="dropdown-divider"></div>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
                </li>
              </div>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Navbar -->
  </div>