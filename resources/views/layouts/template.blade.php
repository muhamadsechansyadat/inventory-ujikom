<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('assets/modules/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/modules/fontawesome/css/all.min.css')}}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('assets/modules/izitoast/css/iziToast.min.css')}}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  <!-- <link rel="stylesheet" type="text/css" href="{{asset('dist/css/bootstrap.css')}}"> -->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
  <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{asset('assets/img/avatar/avatar-1.png')}}" width="30" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">
              Hi, @if(isset(Auth::user()->nama_petugas))
                      {{ Auth::user()->nama_petugas }}
                  @elseif(isset(Auth::guard('pegawai')->user()->nama_pegawai))
                      {{ Auth::guard('pegawai')->user()->nama_pegawai }}
                  @endif        
            </div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <!-- <div class="dropdown-title">Logged in 5 min ago</div> -->
              <a href="#" class="dropdown-item has-icon">
                <i class="far fa-user"></i> 
                  @if(isset(Auth::user()->nama_petugas))
                      {!! substr( Auth::user()->nama_petugas,0,15) !!}...
                  @elseif(isset(Auth::guard('pegawai')->user()->nama_pegawai))
                      {!! substr( Auth::guard('pegawai')->user()->nama_pegawai,0,15 ) !!}...
                  @endif
              </a>
              <a href="#" class="dropdown-item has-icon">
                <i class="fas fa-id-card"></i> 
                  @if(isset(Auth::user()->username))
                      {!! substr( Auth::user()->username,0,15) !!}...
                  @elseif(isset(Auth::guard('pegawai')->user()->username))
                      {!! substr( Auth::guard('pegawai')->user()->username,0,15 ) !!}...
                  @endif
              </a>
              <a href="#" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i>
                  @if(isset(Auth::user()->id_level))
                    @if(Auth::user()->id_level == 1)
                      Administrator
                    @else
                      Operator  
                    @endif  
                  @elseif(isset(Auth::guard('pegawai')->user()->username))
                      Pegawai
                  @endif
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item has-icon text-danger">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item has-icon text-danger">
                  <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="dashboard-index.html">Inventaris</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="dashboard-index.html">ve</a>
          </div>
          @if(isset(Auth::user()->id_level))
          @if(Auth::user()->id_level == 1)
          <ul class="sidebar-menu">
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{url('/home')}}">Dashboard</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-plus"></i><span>Data Master</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{url('inven/index')}}">Inventaris</a></li>
                <li><a class="nav-link" href="{{url('pegawai/index')}}">Pegawai</a></li>
                <li><a class="nav-link" href="{{url('jenis/index')}}">Jenis Barang</a></li>
                <li><a class="nav-link" href="{{url('ruang/index')}}">Ruangan</a></li>
                <li><a class="nav-link" href="{{url('level/index')}}">Level</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-plus"></i><span>Peminjaman</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{url('peminjaman/index')}}">Peminjaman</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fa fa-paper-plane"></i><span>Pengembalian</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{url('pengembalian/index')}}">Pengembalian</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fa fa-book"></i><span>Laporan</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{url('report/peminjaman')}}">Peminjaman</a></li>
                <li><a class="nav-link" href="{{url('report/pengembalian')}}">Pengembalian</a></li>
                <li><a class="nav-link" href="{{url('report/ruang')}}">Per Ruang</a></li>
              </ul>
            </li>
            
          </ul>
          @elseif(Auth::user()->id_level == 2)
          <ul class="sidebar-menu">
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{url('/home')}}">Dashboard</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-plus"></i><span>Peminjaman</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{url('operator/peminjaman/index')}}">Peminjaman</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fa fa-paper-plane"></i><span>Pengembalian</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{url('operator/pengembalian/index')}}">Pengembalian</a></li>
              </ul>
            </li>
          </ul>
          @else
          <ul class="sidebar-menu">  
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{url('/home')}}">Dashboard</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-plus"></i><span>Maintenance</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{url('maintenance/index')}}">Maintenance</a></li>
              </ul>
            </li>
          </ul>   
            @endif
            @else
          <ul class="sidebar-menu">  
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{url('/home')}}">Dashboard</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-plus"></i><span>Peminjaman</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{url('pegawai/peminjaman/index')}}">Peminjaman</a></li>
              </ul>
            </li>
          </ul>  
            @endif
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>@yield('title')</h1>
          </div>
            @yield('content')

          <div class="section-body">
          </div>
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2019 <div class="bullet"></div> Design By <a href="https://insta-stalker.com/profile/sechansydt_/">Muhamad Sechan Syadat</a>
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{asset('assets/modules/jquery.min.js')}}"></script>
  <script src="{{asset('assets/modules/popper.js')}}"></script>
  <script src="{{asset('assets/modules/tooltip.js')}}"></script>
  <script src="{{asset('assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
  <script src="{{asset('assets/modules/moment.min.js')}}"></script>
  <script src="{{asset('assets/js/stisla.js')}}"></script>
  
  <!-- Template JS File -->
  <script src="{{asset('assets/js/scripts.js')}}"></script>
  <script src="{{asset('assets/js/custom.js')}}"></script>
  <script src="{{asset('assets/modules/izitoast/js/iziToast.min.js')}}"></script>
  <script src="{{asset('assets/js/page/modules-toastr.js')}}"></script>
  <!-- <script src="{{asset('assets/js/jquery-1.12.4.js')}}"></script> -->
  <script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
    });
  </script>
  <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
  @yield('js')
  @include('component.alert')    
</body>
</html>