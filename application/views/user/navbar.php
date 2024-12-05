 <body>
     <!-- Nav section start -->
     <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
         <div class="container-fluid">
             <a class="navbar-brand" href="/sarikusuma">SARI KUSUMA 99</a>
             <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse" id="navbarSupportedContent">
                 <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                     <li class="nav-item">
                         <a class="nav-link active" aria-current="page" href="/sarikusuma">Home</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="/sarikusuma/about">About</a>
                     <li class="nav-item">
                         <a class="nav-link" href="/sarikusuma/layanan">Layanan</a>
                     </li>
                     </li>
                     <li class="nav-item dropdown">
                         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Dropdown </a>
                         <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                             <li><a class="dropdown-item" href="/sarikusuma/contact">Contact</a></li>
                             <li><a class="dropdown-item" href="/sarikusuma/gallery">Gallery</a></li>
                             <!-- <li><a class="dropdown-item" href="/sarikusuma/layanan">Layanan</a></li> -->
                             <li>
                                 <hr class="dropdown-divider" />
                             </li>
                         </ul>
                     </li>
                 </ul>
                 <div class="d-flex">
                     <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                         <li class="nav-item">
                             <a href="<?= base_url('home/logout') ?>" class="nav-link active">Logout</a>
                         </li>

                     </ul>


                 </div>

                 <!-- <form class="d-flex" method="post">
            <input class="form-control me-2" id="btn Search" type="text" name="keyword" size="30" placeholder="welcome to sari kusuma..." autocomplete="off" aria-label="Search" autofocus />
            <button class="btn btn-outline-light" type="submit" name="cari">Search</button>
          </form> -->
             </div>
         </div>
     </nav>
     <!-- Nav section end -->