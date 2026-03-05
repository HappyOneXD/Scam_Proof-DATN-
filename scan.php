<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: auth/login.php');
    exit;
}

$type   = $_POST['type'] ?? '';
$result = '';
switch ($type) {
    case 'phone':
        $phone = $_POST['phone'] ?? '';
        $result = "Received phone number: " . htmlspecialchars($phone);
        break;
    case 'url':
        $url = $_POST['url'] ?? '';
        $result = "Received URL: " . htmlspecialchars($url);
        break;
    case 'email':
        $email_address = $_POST['email_address'] ?? '';
        $email_content = $_POST['email_content'] ?? '';
        $result = "Received email address: " . htmlspecialchars($email_address)
                . "<br>Content:<br>" . nl2br(htmlspecialchars($email_content));
        break;
    default:
        $result = "Unknown scan type.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scan Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
          rel="stylesheet" crossorigin="anonymous">
</head>
<body class="bg-dark text-white">
    <div class="container py-5">
        <h1>Scan Result</h1>
        <div class="alert alert-light" role="alert">
            <?php echo $result; ?>
        </div>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </div>
</body>
</html>