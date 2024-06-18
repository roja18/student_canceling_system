<?php
session_start();
if(empty($_SESSION['Consultant'])){
    header("location:../index.php");
    exit;
}

require_once("../includes/connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['Consultant'])) {
    $consultant_username = $_SESSION['Consultant'];
    $available_date = $_POST['available_date'];

    $query = "INSERT INTO availability (consultant_username, available_date) VALUES ('$consultant_username', '$available_date')";
    if (mysqli_query($con, $query)) {
        $succ = "Availability added successfully.";
    } else {
        $errorz = "Error: " . mysqli_error($con);
    }
}
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
        <?php include("../includes/consultant_nav.php")?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php include("../includes/consultants_top_nav.php")?>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">My Calendar</h3>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-5">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-success fw-bold m-0">My Availability Date</h6>
                                </div>
                                <div class="card-body">
                                    <span>
                                        <?php
                                            if(isset($errorz)){
                                                echo "<div class='alert alert-danger'>
                                                <strong>Fail!</strong> $errorz.
                                                </div>";
                                            }
                                            elseif(isset($succ)){
                                                echo "<div class='alert alert-success'>
                                                <strong>Success!</strong> $succ.
                                                </div>";
                                            }
                                        ?>
                                    </span>
                                    <?php
                                        $mtu = $_SESSION['Consultant']; // Assuming consultant username is stored in session
                                        $dep = "SELECT available_date, aid FROM availability WHERE consultant_username='$mtu' ORDER BY `available_date` ASC";
                                        $sql = mysqli_query($con, $dep);
                                        while($array = mysqli_fetch_array($sql)){
                                            $date = $array['available_date'];
                                            $aid = $array['aid'];
                                            echo "<h4 class='small fw-bold'>$date<span class='float-end'><a href='delete_my_availability.php?x=$aid'><i class='fas fa-trash text-danger'></i></a></span></h4>
                                            <div class='progress progress-sm mb-3'>
                                            </div>";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-success m-0 fw-bold">Create Availability Calendar</p>
                                        </div>
                                        <div class="card-body">
                                            <div id="calendar"></div>
                                            <form id="availabilityForm" method="POST" action="">
                                                <input type="hidden" id="selectedDate" name="available_date">
                                            </form>
                                        </div>
                                    </div>
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
