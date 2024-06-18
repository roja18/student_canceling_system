<?php
session_start();
if(empty($_SESSION['Consultant'])){
    header("location:../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Admin Dashboard - SCS</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include("../includes/consultant_nav.php")?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php include("../includes/consultants_top_nav.php")?>
                <div class="container-fluid">
                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Sessions</h3>
                        <a class="btn text-light btn-sm d-none d-sm-inline-block" role="button" href="create_session.php" style="background: rgb(17,111,3);">Create Your Sessions</a>
                    </div>
                    <div class="container-fluid">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Sessions List</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="consultantsTable">
                                    <thead>
                                        <tr>
                                            <th>###</th>
                                            <th>Session</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require_once("../includes/connection.php");
                                        $dep = "SELECT * FROM session ORDER BY sid DESC";
                                        $sno = 1;
                                        $sql = mysqli_query($con, $dep);
                                        while($array = mysqli_fetch_array($sql)){
                                            $aid = $array['sid'];
                                            $un = $array['sname'];

                                            echo "
                                            <tr>
                                                <td>$sno</td>
                                                <td>$un</td>
                                                <td><a href='delete_session.php?x=$aid' class='btn bg-danger text-light'>Delete</a></td>
                                            </tr>";
                                            $sno++;
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>###</strong></td>
                                            <td><strong>Session</strong></td>
                                            <td><strong>Action</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include("../includes/footer.php")?>
        </div>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/chart.min.js"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="../assets/js/theme.js"></script>
</body>
</html>