<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Employees Web by TreeUtomo</title>
  <link rel="shortcut icon" type="image/png" href="/assets/img/user4.png" />
  <!-- Link to external CSS -->
  <link rel="stylesheet" href="/assets1/css/styles.min.css" />
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f0f2f5;
      color: #333;
    }
    .page-wrapper {
      display: flex;
    }
    .left-sidebar {
      background-color: #fff;
      border-right: 1px solid #e6e6e6;
      width: 250px;
      padding: 20px;
    }
    .brand-logo img {
      max-width: 100%;
      height: auto;
    }
    .navbar {
      background-color: #343a40;
      color: #fff;
    }
    .navbar .nav-link {
      color: #fff;
    }
    .navbar .nav-link:hover {
      color: #adb5bd;
    }
    .body-wrapper {
      flex-grow: 1;
      background-color: #f8f9fa;
      padding: 20px;
    }
    .footer {
      text-align: center;
      padding: 20px;
      background-color: #343a40;
      color: #fff;
      position: fixed;
      width: 100%;
      bottom: 0;
    }
    .modal-content {
      border-radius: 10px;
    }
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }
    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #004085;
    }
    .btn-secondary {
      background-color: #6c757d;
      border-color: #6c757d;
    }
    .btn-secondary:hover {
      background-color: #5a6268;
      border-color: #545b62;
    }
  </style>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
            <img src="/assets/img/user4.png" alt="IT5 Logo"/>
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        @include('layouts.sidebar')
        {{-- @include('layouts.devices') --}}
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2 text-white"></i>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link " href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="/assets/img/user3.png" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item" id="profile-menu">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <button type="submit" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</button>
                    </form>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <!--  Row 1 -->
          @yield('content')
        </div>
      </div>
      <div class="footer">
        <p class="mb-0 fs-4">Design and Developed by <a href="https://www.linkedin.com/in/te-imam-tree-utomo-65774a225/" target="_blank"
            class="pe-1 text-primary text-decoration-underline">TreeUtomo</a></p>
      </div>
    </div>
  </div>

  <!-- Modal for Profile -->
  <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="profileModalLabel">User Profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
          <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
          <!-- Password field can be added if necessary -->
          <!-- <p><strong>Password:</strong> ********</p> -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script src="/assets1/libs/jquery/dist/jquery.min.js"></script>
  <script src="/assets1/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/assets1/js/sidebarmenu.js"></script>
  <script src="/assets1/js/app.min.js"></script>
  <script src="/assets1/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="/assets1/libs/simplebar/dist/simplebar.js"></script>
  <script src="/assets1/js/dashboard.js"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>

  <script>
    document.getElementById('profile-menu').addEventListener('click', function() {
      var profileModal = new bootstrap.Modal(document.getElementById('profileModal'));
      profileModal.show();
    });
  </script>

  @stack('scripts')
</body>

</html>
