<?php
session_start();
if(empty($_SESSION['Students'])){
    header("location:../index.php");
    exit;
}
$id = $_GET['x'];
$yy = $_GET['y'];

// require_once("../includes/connection.php");
// $sel = "SELECT username FROM users WHERE fullname='$yy'";
// $quer = mysqli_query($con,$sel);
// $arry = mysqli_fetch_array($quer);
// $email = $arry['username'];

// echo $email;

$mtu = $_SESSION['Students'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Consultant - SCS</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
</head>

<body id="page-top">
    <div id="wrapper">
    <?php include("../includes/student_nav.php")?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php include("../includes/student_top_nav.php")?>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Make Appointment</h3>
                    </div>
                    <div class="container-fluid">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Available Consultant Date</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="consultantsTable">
                                    <thead>
                                        <tr>
                                            <th>###</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require_once("../includes/connection.php");
                                        $dep = "SELECT * FROM `availability` WHERE consultant_username = '$yy' ORDER BY aid DESC";
                                        $sno = 1;
                                        $sql = mysqli_query($con, $dep);
                                        while($array = mysqli_fetch_array($sql)){
                                            $aid = $array['aid'];
                                            $un = $array['available_date'];
                                            $statuz = $array['statuz'];

                                            echo "
                                            <tr>
                                                <td>$sno</td>
                                                <td>$un</td>";
                                                if($statuz == 'available'){
                                                echo "<td><a href='make_appointment.php?x=$aid' class='btn bg-info text-light'>Make Appointment</a></td>";
                                                }
                                                else{
                                                    echo "<td>Sit Taken</td>";
                                                }
                                            echo "</tr>";
                                            $sno++;
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>###</strong></td>
                                            <td><strong>Date</strong></td>
                                            <td><strong>Action</strong></td>
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
    <script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            selectable: true,
            selectHelper: true,
            validRange: {
                start: moment().format('YYYY-MM-DD')
            },
            select: function(start, end) {
                var startDate = moment(start).format('YYYY-MM-DD');
                $('#selectedDate').val(startDate);
                $('#availabilityForm').submit();
                $('#calendar').fullCalendar('unselect');
            }
        });
    });
    </script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/chart.min.js"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="../assets/js/theme.js"></script>
</body>

</html>
