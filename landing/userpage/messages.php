<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch messages from the database
$sql = "SELECT * FROM messages ORDER BY timestamp DESC";
$result = $conn->query($sql);

$messages = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}

// Include 'header.php' after setting headers
include_once("../userpage/include/header.php");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Announcements</title>
    <style>
        .message-list {
            list-style-type: none;
            padding: 0;
        }

        .message-list li {
            background-color: #f0f5ff;
            border: 2px solid #007bff;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
            margin: 15px 20px 15px 20px;
        }

        .message-list li strong {
            font-weight: bold;
            color: #007bff;
            font-size: 1.2em;
        }

        .message-list li p {
            margin-top: 10px;
            color: #333;
            font-size: 1.1em;
        }

        .message-list li small {
            position: absolute;
            bottom: 10px;
            right: 10px;
            color: #888;
        }

        .back-link {
            text-decoration: none;
            color: #007bff;
            margin: 10% 0 0 20px;
        }

        a:hover {
            text-decoration: underline;
        }

        h1 {
            margin: 3% 0 3% 0;
            text-align: center;
            text-transform: uppercase;
            font-weight: bolder;
        }

        .message-form {
            margin: 3% 0 3% 3%;
        }
    </style>
</head>

<body>
    <h1>Announcements</h1>
    <ul class="message-list">
        <?php foreach ($messages as $message) { ?>
            <li>
                <strong><?= $message['sender'] ?></strong>
                <p><?= $message['message'] ?></p>
                <small><?= $message['timestamp'] ?></small>
            </li>
        <?php } ?>
    </ul>

    <a href="/lara/landing/adminpage/" class="back-link">Back to Dashboard</a>
</body>

</html>

<div style="margin-top: 10%;">
    <?php include_once("../userpage/include/footer.php"); ?>
</div>
