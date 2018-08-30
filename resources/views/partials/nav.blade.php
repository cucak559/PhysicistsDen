<header id="navheader">
      <nav class="navbar fixed-top navbar-expand-lg navbar-light">
            <div class="container nav-inner">

                  <a class="navbar-brand" href="/"><span class="brand-first">Physicist's</span> <span class="brand-second">den</span></a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                  </button>

                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        @if (Auth::check())
                        <ul class="navbar-nav mr-auto">

                              <li class="nav-item">
                                    <a class="nav-link" href="/topics/all"><i class="fas fa-object-group"></i> Topics</a>
                              </li>
                               <li class="nav-item dropdown">
                                    <a id="articleDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                          <i class="fas fa-newspaper"></i> Articles
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="articleDropdown">
                                          <a class="dropdown-item" href="/articles/all">
                                                All articles
                                          </a>

                                          <a class="dropdown-item" href="/articles/all?views=1">
                                                Most viewed
                                          </a>
                                    </div>

                              </li>

                              <li class="nav-item">
                                    <a class="nav-link" href="/articles/archive"><i class="fas fa-book"></i> Archives </a>
                              </li>

                               <li class="nav-item">
                                    <a class="pt-2 nav-link" href="#myModal" role="button" data-toggle="modal"><i class="fas fa-search"> Search</i></a>
                               </li>

                        </ul>

                          @endif

                        <!-- Right Side Of Navbar -->
                          <ul class="navbar-nav ml-auto">
                              <!-- Authentication Links -->
                              @guest
                                  <li><a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt mr-1"></i>{{ __('Login') }}</a></li>
                                  <li><a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus mr-1"></i>{{ __('Register') }}</a></li>
                              @else

                                  <user-notifications></user-notifications>

                                  <li class="nav-item dropdown">
                                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                          {{ Auth::user()->name }} <span class="caret"></span>
                                      </a>

                                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                          <a class="dropdown-item" href="/groups">
                                            <i class="fas fa-users"></i> My groups
                                          </a>

                                           <a class="dropdown-item" href="/favourites">
                                            <i class="fas fa-star"></i> Favourites
                                          </a>

                                          <a class="dropdown-item" href="{{ route('logout') }}"
                                             onclick="event.preventDefault();
                                                           document.getElementById('logout-form').submit();">
                                              <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                          </a>

                                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                              @csrf
                                          </form>


                                      </div>
                                  </li>
                              @endguest
                          </ul>


                  </div>

            </div>

      </nav>
</header>

@include('modals.search')
