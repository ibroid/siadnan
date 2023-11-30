 <nav class="sidebar-main">
     <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
     <div id="sidebar-menu">
         <ul class="sidebar-links" id="simple-bar">
             <li class="back-btn">
                 <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
             </li>
             <li class="pin-title sidebar-main-title">
                 <div>
                     <h6>Pinned</h6>
                 </div>
             </li>
             <li class="sidebar-list">
                 <i class="fa fa-thumb-tack"></i>
                 <a class="sidebar-link sidebar-title" href="<?= base_url('dashboard') ?>">
                     <svg class="stroke-icon">
                         <use href="<?= base_url() ?>assets/svg/icon-sprite.svg#stroke-home"></use>
                     </svg>
                     <svg class="fill-icon">
                         <use href="<?= base_url() ?>assets/svg/icon-sprite.svg#fill-home"></use>
                     </svg><span>Dashboard</span></a>
             </li>
             <li class="sidebar-list">
                 <i class="fa fa-thumb-tack"></i>
                 <a class="sidebar-link sidebar-title" href="<?= base_url('pengajuan') ?>">
                     <svg class="stroke-icon">
                         <use href="<?= base_url() ?>assets/svg/icon-sprite.svg#stroke-user"></use>
                     </svg>
                     <span>Pengajuan</span></a>
             </li>
             <li class="sidebar-list">
                 <i class="fa fa-thumb-tack"></i>
                 <a class="sidebar-link sidebar-title" href="<?= base_url('referensi') ?>">
                     <svg class="stroke-icon">
                         <use href="<?= base_url() ?>assets/svg/icon-sprite.svg#stroke-search"></use>
                     </svg>
                     <span>Referensi</span></a>
             </li>
             <li class="sidebar-list">
                 <i class="fa fa-thumb-tack"></i>
                 <a class="sidebar-link sidebar-title" href="<?= base_url('settings') ?>">
                     <svg class="stroke-icon">
                         <use href="<?= base_url() ?>assets/svg/icon-sprite.svg#setting"></use>
                     </svg>
                     <span>Settings</span></a>
             </li>

         </ul>
     </div>
     <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
 </nav>