<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <div class="sb-sidenav-menu-heading">Menu</div>
            <a class="nav-link {{request()->segment(1) == 'dashboard' ? 'active' : ''}} " href="{{route('dashboard')}}" wire:navigate>
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Dashboard
            </a>
            @if (auth()->user()->role!=3)
              <a class="nav-link {{request()->segment(1) == 'customer' ? 'active' : ''}} " href="{{route('customer')}}" wire:navigate>
                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                Customer
              </a>
              <a class="nav-link {{request()->segment(1) == 'pesanan' ? 'active' : ''}} " href="{{route('pesanan')}}" wire:navigate>
                <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                Pesanan
              </a>
            @endif

            <a class="nav-link {{request()->segment(1) == 'absensi' ? 'active' : ''}} " href="{{route('absensi')}}" wire:navigate>
              <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
              Absensi
            </a>
            @if (auth()->user()->role==1 || auth()->user()->role==3)
            <a class="nav-link {{request()->segment(1) == 'pencapaian' ? 'active' : ''}} " href="{{route('pencapaian')}}" wire:navigate>
              <div class="sb-nav-link-icon"><i class="fas fa-bolt"></i></div>
              Pencapaian
            </a>  
            @endif
          
            @if (auth()->user()->role==1 )
            <div class="sb-sidenav-menu-heading">Master Data</div>
            <a class="nav-link  {{ request()->segment(1) == 'master' ? 'collapsed' : '' }}
                " href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Master Data
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse {{ request()->segment(1) == 'master' ? 'show' : '' }}" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                {{-- <a class="nav-link" href="#">Daftar Artikel</a>
                <a class="nav-link" href="#">...</a> --}}
                <a class="nav-link {{request()->segment(2) == 'salesman' ? 'active' : ''}} " href="{{route('master.salesman')}}" wire:navigate>
                  <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                  Salesman
                </a>
                <a class="nav-link {{request()->segment(2) == 'tipe' ? 'active' : ''}}" href="{{route('master.tipe')}}" wire:navigate>
                  <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                  Tipe
              </a>
              <a class="nav-link {{request()->segment(2) == 'mobil' ? 'active' : ''}}" href="{{route('master.mobil')}}" wire:navigate>
                <div class="sb-nav-link-icon"><i class="fas fa-car"></i></div>
                Mobil
            </a>
              </nav>
            </div>
            @endif
            @if (auth()->user()->role==1 || auth()->user()->role==3)
              <div class="sb-sidenav-menu-heading">Laporan</div>
              <a class="nav-link  {{ request()->segment(1) == 'laporan' ? 'collapsed' : '' }}
                  " href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts">
                  <div class="sb-nav-link-icon"><i class="fas fa-bar-chart"></i></div>
                  Laporan-Laporan
                  <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
              </a>
              <div class="collapse {{ request()->segment(1) == 'laporan' ? 'show' : '' }}" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  {{-- <a class="nav-link" href="#">Daftar Artikel</a>
                  <a class="nav-link" href="#">...</a> --}}
                  <a class="nav-link {{request()->segment(2) == 'laporan-pesanan' ? 'active' : ''}} "
                    href="{{route('laporan.form','laporan-pesanan')}}" wire:navigate>
                    Laporan Pesanan
                  </a>
                  <a class="nav-link {{request()->segment(2) == 'laporan-pembayaran' ? 'active' : ''}}"
                    href="{{route('laporan.form','laporan-pembayaran')}}" wire:navigate>
                      Laporan Pembayaran
                  </a>
                  <a class="nav-link {{request()->segment(2) == 'laporan-kehadiran' ? 'active' : ''}}" 
                    href="{{route('laporan.form','laporan-kehadiran')}}" wire:navigate>
                    Laporan Kehadiran
                  </a>
                  <a class="nav-link {{request()->segment(2) == 'laporan-pencapaian' ? 'active' : ''}}" 
                    href="{{route('laporan.form','laporan-pencapaian')}}" wire:navigate>
                    Laporan Pencapaian
                  </a>
                  <a class="nav-link {{request()->segment(2) == 'laporan-pencapaian-sales' ? 'active' : ''}}" 
                    href="{{route('laporan.form','laporan-pencapaian-sales')}}" wire:navigate>
                    Laporan Pencapaian Per Sales
                  </a>
                </nav>
              </div>    
            @endif
            @if (auth()->user()->role==1 )
            <a class="nav-link  {{ request()->segment(1) == 'setting' ? 'collapsed' : '' }}
                " href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts3" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>
                Setting
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse {{ request()->segment(1) == 'setting' ? 'show' : '' }}" id="collapseLayouts3" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                {{-- <a class="nav-link" href="#">Daftar Artikel</a>
                <a class="nav-link" href="#">...</a> --}}
                <a class="nav-link {{request()->segment(2) == 'user' ? 'active' : ''}} " href="{{route('setting.user')}}" wire:navigate>
                  <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                  User Aplikasi
                </a>
                <a class="nav-link {{request()->segment(2) == 'harikerja' ? 'active' : ''}}" href="{{route('setting.harikerja')}}" wire:navigate>
                  <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                  Hari Kerja
              </a>
             
              </nav>
            </div>
            @endif
           
        </div>
        <div class="sb-sidenav-footer">
          <div class="small">Logged Role: {{auth()->user()->roles()}}</div>    
        </div>
      </nav>
</div>