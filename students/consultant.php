<?php
session_start();
if(empty($_SESSION['Students'])){
    header("location:../index.php");
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include("../includes/student_nav.php")?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php include("../includes/student_top_nav.php")?>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Consultants</h3>
                    </div>
                    <div class="container-fluid">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Consultants List</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="consultantsTable">
                                    <thead>
                                        <tr>
                                            <th>###</th>
                                            <th>Full Name</th>
                                            <th>Gender</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Session</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require_once("../includes/connection.php");
                                        $dep = "SELECT users.username, users.fullname, users.phone, users.gender, session.sname 
                                        FROM users, session, consultant_sessions 
                                        WHERE session.sid = consultant_sessions.sid 
                                        AND users.username = consultant_sessions.username 
                                        AND users.='Consultant'";
                                        $sno = 1;
                                        $sql = mysqli_query($con, $dep);
                                        while($array = mysqli_fetch_array($sql)){
                                            $un = $array['username'];
                                            $fl = $array['fullname'];
                                            $ph = $array['phone'];
                                            $sname = $array['sname'];
                                            $ge = $array['gender'];

                                            echo "
                                            <tr>
                                                <td>$sno</td>
                                                <td><img class='rounded-circle me-2' width='30' height='30' src='assets/img/avatars/avatar1.jpeg'>$fl</td>
                                                <td>$ge</td>
                                                <td>$un</td>
                                                <td>$ph</td>
                                                <td>$sname</td>
                                            </tr>";
                                            $sno++;
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>###</strong></td>
                                            <td><strong>Full Name</strong></td>
                                            <td><strong>Gender</strong></td>
                                            <td><strong>Email</strong></td>
                                            <td><strong>Phone Number</strong></td>
                                            <td><strong>Session</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <?php include("../includes/footer.php")?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#consultantsTable').DataTable({
                "pagingType": "simple_numbers",
                "lengthMenu": [10, 25, 50, 100],
                "searching": true,
                "info": true,
                "language": {
                    "paginate": {
                        "previous": "«",
                        "next": "»"
                    }
                }
            });
        });
    </script>
</body>

</html>
