<?php
//  if(empty($_SESSION['Admin'])){
//      header("location:../index.php");
//  }
$mtu = $_SESSION['Admin'];
    require_once("../includes/connection.php");
    $dep = "SELECT * FROM users WHERE username = '$mtu'";
    $sql = mysqli_query($con, $dep);
    $array = mysqli_fetch_array($sql);
        $fl = $array['fullname'];

?>
<nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid">
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown no-arrow mx-1">
                                
                                <div class="shadow dropdown-list dropdown-menu dropdown-menu-end" aria-labelledby="alertsDropdown"></div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                        <span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $fl; ?></span>
                                        <img class="border rounded-circle img-profile" src="../assets/img/atc.png">
                                    </a>
                                    
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>