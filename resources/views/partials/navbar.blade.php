<nav class="navbar navbar-expand-lg navbar-dark bg-primary ">
  <div class="container">
      <a class="navbar-brand" href="/">Suka Gunung</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              @if (session('role') == NULL)
                <a class="nav-link {{ ($title === "beranda") ? 'active':'' }}" href="/">Beranda</a>
              @else
                <a class="nav-link {{ ($title === "beranda") ? 'active':'' }}" href="/users/home">Beranda</a>
              @endif
            </li>
            <li class="nav-item">
              <a class="nav-link {{ ($title === "info gunung") ? 'active':'' }}" href="/info gunung">Info Gunung</a>
            </li>
            <li class="nav-item">
              @if (session('role') == NULL)
            @else
                <a class="nav-link {{ ($title === "booking") ? 'active':'' }}" href="/users/booking">Booking</a>
            @endif
            </li>
            <li class="nav-item">
              <a class="nav-link {{ ($title === "sop") ? 'active':'' }}" href="/sop">SOP</a>
            </li>
          </ul>

          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              @if (session('role') == 3)
                <div class="row">
                  <div class="col-md-6">
                    <p>{{session('name')}}</p>
                  </div>
                  <div class="col-md-6">
                    <a class="text-center text-white" href="/logout">Log out</a>
                  </div>
                </div>
              @else 
                <a href="/login" class="nav-link {{ ($title === "login") ? 'active':'' }}"><i class="bi bi-box-arrow-in-right"></i> Login </a>
              @endif
            </li>
          </ul>
      </div>
  </div>
</nav>