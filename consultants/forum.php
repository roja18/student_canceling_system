<?php
session_start();
if (empty($_SESSION['Consultant'])) {
    header("location:../index.php");
    exit;
}
$mtu = $_SESSION['Consultant'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sessions - SCS</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .post-card {
            margin-bottom: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .post-card img {
            max-width: 100%;
            border-bottom: 1px solid #e0e0e0;
        }
        .post-card h3 {
            margin: 0;
            padding: 15px;
            background: #f8f9fc;
            border-bottom: 1px solid #e0e0e0;
        }
        .post-card p {
            padding: 15px;
        }
        .post-card .comment-section {
            padding: 15px;
            border-top: 1px solid #e0e0e0;
            background: #f8f9fc;
        }
        .post-card .comment-section input[type="text"] {
            width: calc(100% - 70px);
            padding: 10px;
            border-radius: 20px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }
        .post-card .comment-section button {
            padding: 10px 15px;
            border-radius: 20px;
            border: none;
            background: #007bff;
            color: #fff;
            cursor: pointer;
        }
        .post-card .comments-list {
            padding: 15px;
            border-top: 1px solid #e0e0e0;
            background: #ffffff;
        }
        .post-card .comment-item {
            margin-bottom: 10px;
        }
        .post-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include("../includes/consultant_nav.php") ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php include("../includes/consultants_top_nav.php") ?>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Forums</h3>
                        <a class="btn btn-secondary btn-sm d-none d-sm-inline-block" role="button" href="forum_post.php" style="background: rgb(17,111,3);"><i class="fas fa-edit fa-sm fa-fw me-2 text-gray-400"></i>Create a Post</a>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-xl-8 post-container">
                            <?php
                            require_once("../includes/connection.php");
                            $sql = mysqli_query($con, "SELECT * FROM `forum` ORDER BY fid DESC");
                            while ($array = mysqli_fetch_array($sql)) {
                                $apid = $array['fid'];
                                $caption = $array['caption'];
                                $image = $array['image'];
                                $email = $array['email'];

                                echo "<div class='card post-card'>
                                        <div class='card-title'>
                                            <h3>$email</h3>
                                        </div>
                                        <div class='card-body'>
                                            <p>$caption</p>
                                            <img src='../forum/$image' alt='Post Image'>
                                        </div>
                                        <div class='comment-section'>
                                            <input type='text' id='commentInput-$apid' placeholder='Write a comment...'>
                                            <button onclick='submitComment($apid)'><i class='fas fa-paper-plane'></i></button>
                                        </div>
                                        <div class='comments-list' id='commentsList-$apid'>";

                                // Fetch and display comments for the current post
                                $commentSql = mysqli_query($con, "SELECT * FROM `comments` WHERE fid = $apid ORDER BY coid DESC");
                                while ($commentArray = mysqli_fetch_array($commentSql)) {
                                    $commentEmail = $commentArray['email'];
                                    $commentText = $commentArray['comment'];
                                    echo "<div class='comment-item'><strong>$commentEmail:</strong> $commentText</div>";
                                }

                                echo "</div></div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php include("../includes/footer.php") ?>
        </div>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/chart.min.js"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script>
        function submitComment(postId) {
            const commentInput = document.getElementById('commentInput-' + postId);
            const commentText = commentInput.value.trim();

            if (commentText !== '') {
                $.ajax({
                    url: 'submit_comment.php',
                    type: 'POST',
                    data: { postId: postId, comment: commentText },
                    success: function(response) {
                        console.log(response);
                        commentInput.value = '';
                        fetchComments(postId);  // Refresh the comments list
                    }
                });
            }
        }

        function fetchComments(postId) {
            $.ajax({
                url: 'fetch_comments.php',
                type: 'GET',
                data: { postId: postId },
                success: function(response) {
                    const comments = JSON.parse(response);
                    const commentsList = document.getElementById('commentsList-' + postId);
                    commentsList.innerHTML = '';

                    comments.forEach(function(comment) {
                        const commentItem = document.createElement('div');
                        commentItem.className = 'comment-item';
                        commentItem.innerHTML = `<strong>${comment.email}:</strong> ${comment.comment}`;
                        commentsList.appendChild(commentItem);
                    });
                }
            });
        }
    </script>
</body>

</html>
