 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-black sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-times"></i>
         </div>
         <div class="sidebar-brand-text"><sup>Penjadwalan</sup>SISTEM</div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">



     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Interface
     </div>

     <?php $role_id = $this->session->userdata('role_id');
        $queryMenu = "SELECT * FROM menu JOIN user_access_menu ON menu.id_menu = user_access_menu.menu_id WHERE user_access_menu.role_id = $role_id ORDER BY user_access_menu.menu_id ASC";
        $menu = $this->db->query($queryMenu)->result_array(); ?>

     <?php foreach ($menu as $m) : ?>
         <li class="nav-item <?php if ($title == $m['nama_menu']) {
                                    echo "active";
                                } ?>">
             <a class="nav-link" href="<?= base_url($m['url']) ?>">
                 <i class="<?= $m['icon'] ?>"></i>
                 <span><?= $m['nama_menu'] ?></span>
             </a>
         </li>
     <?php endforeach; ?>

     <!-- Sidebar Hide Toggle -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>
 </ul>


 <!-- End of Sidebar -->

 <!-- Content Wrapper -->