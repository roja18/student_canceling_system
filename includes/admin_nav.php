<?php
 if(empty($_SESSION['Admin'])){
     header("location:../index.php");
 }
?>
<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="background: rgb(17,111,3);">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"></div>
                    <div class="sidebar-brand-text mx-3"><span>ATC - SCS</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link active" href="dashboard.php"><i class="fas fa-tachometer-alt fa-sm fa-fw me-2 text-gray-400"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="session.php"><i class="fas fa-business-time fa-sm fa-fw me-2 text-gray-400"></i><span>Sessions</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="forum.php"><i class="fas fa-thumbs-up fa-sm fa-fw me-2 text-gray-400"></i><span>Forum</span></a>
                    <li class="nav-item"><a class="nav-link" href="consultant.php"><i class="fas fa-user-shield fa-sm fa-fw me-2 text-gray-400"></i><span>Consultants&nbsp;</span></a>
                    <!-- <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-hands-helping fa-sm fa-fw me-2 text-gray-400"></i><span>Feedback&nbsp;</span></a> -->
                    <li class="nav-item"><a class="nav-link" href="profile.php"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i><span>My Profile&nbsp;</span></a>
                    <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i><span>Sign Out&nbsp;</span></a>
                </ul>
            </div>
        </nav>