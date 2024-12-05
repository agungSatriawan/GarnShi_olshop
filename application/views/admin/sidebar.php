   <div class="app-main">
       <div class="app-sidebar sidebar-shadow">
           <div class="app-header__logo">
               <div class="logo-src"></div>
               <div class="header__pane ml-auto">
                   <div>
                       <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                           <span class="hamburger-box">
                               <span class="hamburger-inner"></span>
                           </span>
                       </button>
                   </div>
               </div>
           </div>
           <div class="app-header__mobile-menu">
               <div>
                   <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                       <span class="hamburger-box">
                           <span class="hamburger-inner"></span>
                       </span>
                   </button>
               </div>
           </div>
           <div class="app-header__menu">
               <span>
                   <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                       <span class="btn-icon-wrapper">
                           <i class="fa fa-ellipsis-v fa-w-6"></i>
                       </span>
                   </button>
               </span>
           </div>
           <div class="scrollbar-sidebar">
               <div class="app-sidebar__inner">
                   <ul class="vertical-nav-menu">
                       <li class="app-sidebar__heading">Dashboards</li>
                       <li>
                           <a href="<?= base_url('admin/member') ?>" class="mm-active">
                               <i class="metismenu-icon fa-solid fa-users"></i>
                               Data User
                           </a>
                       </li>
                       <li>
                           <a href="<?= base_url('admin/order') ?>" class="mm-active">
                               <i class="metismenu-icon fa-solid fa-list-check"></i>
                               Data Pesanan
                           </a>
                       </li>
                       <!-- <li class="app-sidebar__heading">Management</li>
                       <li>
                           <a href="stock.html">
                               <i class="metismenu-icon pe-7s-display2"></i>
                               Product Stock
                           </a>
                       </li>
                       <li>
                           <a href="#">
                               <i class="metismenu-icon pe-7s-diamond"></i>
                               User Management
                               <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                           </a>
                           <ul>
                               <li>
                                   <a href="addUser.html">
                                       <i class="metismenu-icon"></i>
                                       Add User
                                   </a>
                               </li>
                           </ul>
                       </li>
                       <li>
                           <a href="#">
                               <i class="metismenu-icon pe-7s-diamond"></i>
                               User Access Menu
                               <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                           </a>
                           <ul>
                               <li>
                                   <a href="addUser.html">
                                       <i class="metismenu-icon"></i>
                                       Add User
                                   </a>
                               </li>
                           </ul>
                       </li> -->
                       <li class="app-sidebar__heading">Data Master</li>
                       <li>
                           <a href="<?= base_url('admin/data_product') ?>">
                               <i class="metismenu-icon pe-7s-display2"></i>
                               Data Product
                           </a>
                       </li>
                   </ul>
               </div>
           </div>
       </div>