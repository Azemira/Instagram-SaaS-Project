<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
      <a class="navbar-brand" href="index.html">Logo</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
          <ul class="nav navbar-nav menu_nav justify-content-end">
              <li class="nav-item active">
                  <a class="nav-link" href="index.html">Home</a>
              </li>
              <li class="nav-item submenu dropdown">
                  <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Packages</a>
                  <ul class="dropdown-menu">
                      <li class="nav-item">
                          <a class="nav-link" href="#">Package 1</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="#">Package 2</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="#">Package 3</a>
                      </li>
                  </ul>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">Subscribe</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">Contact Us</a>
              </li>
              @if(\Auth::check())
              <li class="nav-item button-item">
                  <a href="/logout" class="std_btn">Logout</a>
              </li>
              @else
              <li class="nav-item button-item">
                <a href="/login" class="std_btn">Login</a>
              </li>
              <li class="nav-item button-item">
                <a href="/register" class="std_btn">Sign up</a>
              </li>
              @endif
          </ul>
      </div>
  </div>
</nav>