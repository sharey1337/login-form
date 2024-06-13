<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /sessions/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1332 - Anasayfa</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #202632;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            text-align: center;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hoşgeldin, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p>Bu sayfa sadece giriş yapmış kullanıcılar tarafından görülebilir.</p>
        <a href="/sessions/logout.php">Çıkış Yap</a>
        <audio id="welcome-audio" src="/admin/yaraaaa.mp3" autoplay></audio>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var audio = document.getElementById('welcome-audio');
            audio.addEventListener('ended', function() {
                audio.currentTime = 0; // Müzik bittiğinde tekrar çalmayı önlemek için sıfırlıyoruz
            });
        });
    </script>
</body>
</html>
