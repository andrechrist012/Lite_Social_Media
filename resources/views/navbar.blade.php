<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: rgb(59, 121, 172);">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="color: white;"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" style="color: white;"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();"
            >
              <p>
                Logout
              </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>

    </ul>
  </nav>
