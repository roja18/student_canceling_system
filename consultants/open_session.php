<?php
session_start();
if (empty($_SESSION['Consultant'])) {
    header("location:../index.php");
    exit;
}
$y = $_GET['x'];
$mtu = $_SESSION['Consultant'];
$_SESSION['receiver'] = $y;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .chat-container {
            max-width: 700px;
            margin: 0 auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .chat-header, .chat-footer {
            background: #26a626;
            color: #fff;
            padding: 15px;
        }

        .chat-header {
            border-bottom: 1px solid #006fcc;
        }

        .chat-footer {
            display: flex;
            align-items: center;
        }

        .chat-footer input[type="text"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 20px;
            margin-right: 10px;
        }

        .chat-footer button {
            background: #006fcc;
            border: none;
            padding: 10px 15px;
            color: #fff;
            border-radius: 20px;
            cursor: pointer;
        }

        .chat-body {
            max-height: 500px;
            overflow-y: auto;
            padding: 15px;
        }

        .message {
            display: flex;
            margin-bottom: 15px;
        }

        .message .content {
            background: #f1f1f1;
            border-radius: 20px;
            padding: 10px 15px;
            max-width: 70%;
        }

        .message.student .content {
            background: #e0f7fa;
            margin-left: auto;
        }

        .message.consultant .content {
            background: #e8f5e9;
            margin-right: auto;
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
                        <h3 class="text-dark mb-0">Chat with Student</h3>
                    </div>
                    <div class="container-fluid">
                        <div class="chat-container">
                            <div class="chat-header">
                                <h5>Chat with Student</h5>
                            </div>
                            <div class="chat-body" id="chat-body">
                                <!-- Messages will be appended here dynamically -->
                            </div>
                            <div class="chat-footer">
                                <input type="text" id="messageInput" placeholder="Type your message...">
                                <button id="sendBtn">Send</button>
                            </div>
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
        function sendMessage() {
            const messageInput = document.getElementById('messageInput');
            const messageText = messageInput.value.trim();

            if (messageText !== '') {
                $.ajax({
                    url: 'send_message.php',
                    type: 'POST',
                    data: { message: messageText },
                    success: function(response) {
                        console.log(response);
                        fetchMessages();
                        messageInput.value = '';
                    }
                });
            }
        }

        function fetchMessages() {
            $.ajax({
                url: 'fetch_messages.php',
                type: 'GET',
                success: function(response) {
                    const messages = JSON.parse(response);
                    const chatBody = document.getElementById('chat-body');
                    chatBody.innerHTML = '';

                    messages.forEach(function(message) {
                        const messageElement = document.createElement('div');
                        messageElement.className = 'message ' + (message.sender === '<?php echo $_SESSION['Consultant']; ?>' ? 'consultant' : 'student');
                        messageElement.innerHTML = `<div class="content">${message.message}</div>`;
                        chatBody.appendChild(messageElement);
                    });

                    // Auto scroll to the bottom
                    chatBody.scrollTop = chatBody.scrollHeight;
                }
            });
        }

        document.getElementById('sendBtn').addEventListener('click', sendMessage);

        // Fetch messages periodically
        setInterval(fetchMessages, 3000);
        // Initial fetch
        fetchMessages();
    </script>
</body>

</html>
