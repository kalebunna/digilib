 <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
     <ul id="sidebarnav">
         <li class="sidebar-item bg-light {{ request()->is('/') ? 'selected' : '' }}">
             <a class="sidebar-link" href="{{ route('home') }}" aria-expanded="false">
                 <span>
                     <i class="ti ti-aperture"></i>
                 </span>
                 <span class="hide-menu">Home</span>
             </a>
         </li>
         <li class="nav-small-cap">
             <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
             <span class="hide-menu">Data Master</span>
         </li>
         <li class="sidebar-item {{ request()->is('kategori/*') ? 'selected' : '' }}">
             <a class="sidebar-link" href="{{ route('kategori.index') }}" aria-expanded="false">
                 <span>
                     <i class="ti ti-aperture"></i>
                 </span>
                 <span class="hide-menu">Kategori</span>
             </a>
         </li>
         <li class="sidebar-item">
             <a class="sidebar-link" href="{{ route('buku.index') }}" aria-expanded="false">
                 <span>
                     <i class="ti ti-aperture"></i>
                 </span>
                 <span class="hide-menu">Buku</span>
             </a>
         </li>
         <li class="sidebar-item {{ request()->is('petugas/*') ? 'selected' : '' }}">
             <a class="sidebar-link" href="{{ route('petugas.index') }}" aria-expanded="false">
                 <span>
                     <i class="ti ti-aperture"></i>
                 </span>
                 <span class="hide-menu">Petugas</span>
             </a>
         </li>
         <li class="sidebar-item {{ request()->is('member/*') ? 'selected' : '' }}">
             <a class="sidebar-link" href="{{ route('member.index') }}" aria-expanded="false">
                 <span>
                     <i class="ti ti-aperture"></i>
                 </span>
                 <span class="hide-menu">Member</span>
             </a>
         </li>

         <li class="nav-small-cap">
             <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
             <span class="hide-menu">Transaksi</span>
         </li>
         <li class="sidebar-item">
             <a class="sidebar-link" href="{{ route('peminjaman') }}" aria-expanded="false">
                 <span>
                     <i class="ti ti-aperture"></i>
                 </span>
                 <span class="hide-menu">Peminjaman</span>
             </a>
         </li>
         <li class="sidebar-item">
             <a class="sidebar-link" href="{{ route('pengembalian') }}" aria-expanded="false">
                 <span>
                     <i class="ti ti-aperture"></i>
                 </span>
                 <span class="hide-menu">Pengembalian</span>
             </a>
         </li>

         <li class="nav-small-cap">
             <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
             <span class="hide-menu">Report</span>
         </li>
         <li class="sidebar-item">
             <a class="sidebar-link" href="./index.html" aria-expanded="false">
                 <span>
                     <i class="ti ti-aperture"></i>
                 </span>
                 <span class="hide-menu">Laporan</span>
             </a>
         </li>
     </ul>
 </nav>


 <div class="fixed-profile bg-light-secondary sidebar-ad mt-3 rounded p-3">
     <div class="hstack gap-3">
         <div class="john-img">
             <img src="images/user-1.jpg" class="rounded-circle" width="40" height="40" alt="">
         </div>
         <div class="john-title">
             <h6 class="fs-4 fw-semibold mb-0">Mathew</h6>
             <span class="fs-2 text-dark">Designer</span>
         </div>
         <button class="text-primary ms-auto border-0 bg-transparent" tabindex="0" type="button" aria-label="logout"
             data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="logout">
             <i class="ti ti-power fs-6"></i>
         </button>
     </div>
 </div>
 <!-- End Sidebar navigation -->
