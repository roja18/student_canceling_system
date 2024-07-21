<?php
session_start();
if (empty($_SESSION['Consultant'])) {
    header("location:../index.php");
}
$mtu = $_SESSION['Consultant'];

// Include the helper function
function compareWithCurrentDate($givenDate, $username) {
    $currentDate = new DateTime();
    $dateToCompare = new DateTime($givenDate);

    if ($dateToCompare < $currentDate) {
        return "<td><a href='#' class='btn bg-danger text-light'>Session Closed</a></td>";
    } elseif ($dateToCompare > $currentDate) {
        return "<td><a href='open_session.php?x=$username' class='btn bg-success text-light'>Open Session</a></td>";
    } else {
        return "<td><a href='open_session.php?x=$username' class='btn bg-success text-light'>Open Session</a></td>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Consultant Dashboard - SCS</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
    <?php include("../includes/consultant_nav.php")?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php include("../includes/consultants_top_nav.php")?>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Appointments</h3>
                    </div>
                    <div class="container-fluid">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Appointments List</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="consultantsTable">
                                    <thead>
                                        <tr>
                                            <th>###</th>
                                            <th>Date</th>
                                            <th>Session</th>
                                            <th>Username of Student</th>
                                            <th>Session On</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require_once("../includes/connection.php");
                                        $dep = "SELECT appointment.username, availability.available_date, session.sname 
                                        FROM `availability`, appointment, session, consultant_sessions
                                        WHERE appointment.aid = availability.aid 
                                        AND session.sid = consultant_sessions.sid
                                        AND availability.consultant_username = '$mtu'";
                                        $sno = 1;
                                        $sql = mysqli_query($con, $dep);
                                        while ($array = mysqli_fetch_array($sql)) {
                                            // $aid = $array['sid'];    
                                            $date = $array['available_date'];
                                            $sname = $array['sname'];
                                            $un = $array['username'];

                                            echo "
                                            <tr>
                                                <td>$sno</td>
                                                <td>$date</td>
                                                <td>$sname</td>
                                                <td>$un</td>";
                                            echo compareWithCurrentDate($date, $un);
                                            echo "</tr>";
                                            
                                            $sno++;
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>###</strong></td>
                                            <td><strong>Date</strong></td>
                                            <td><strong>Session</strong></td>
                                            <td><strong>Username of Student</strong></td>
                                            <td><strong>Session On</strong></td>
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
