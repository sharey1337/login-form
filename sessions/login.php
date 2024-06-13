<?php
session_start();
include('../server/baglan.php');

$error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['login-username'];
    $password = $_POST['login-password'];
    
    // Kullanıcıyı veritabanında kontrol et
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Giriş başarılı, oturumu başlat
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: /anasayfa/");
        exit();
    } else {
        $error = "Geçersiz kullanıcı adı veya parola";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1332 - Giriş Yap</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="/sessions/loginstyles.css">
    <style>
        .fade-in {
            animation: fadeIn 1s ease-in-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .error-message {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-family: 'Roboto', sans-serif;
            display: none;
            z-index: 2000;
        }

        .show {
            display: block;
            animation: fadeInOut 4s ease-in-out;
        }

        @keyframes fadeInOut {
            0% { opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { opacity: 0; }
        }
    </style>
</head>
<body>
    <?php if ($error): ?>
        <div class="error-message" id="error-message"><?php echo $error; ?></div>
    <?php endif; ?>
    <div class="login-wrapper fade-in" id="content">
        <div class="login-container sharey-container">
            <div class="login-box sharey-box">
                <h2>Giriş Yap</h2>
                <form action="" method="POST" novalidate>
                    <div class="input-group sharey-input-group">
                        <input type="text" id="login-username" name="login-username" placeholder="Kullanıcı Adı" required>
                    </div>
                    <div class="input-group sharey-password-group">
                        <input type="password" id="login-password" name="login-password" placeholder="Parola" required>
                        <span class="toggle-password sharey-toggle-password" onclick="togglePassword()">
                            <i class="fa fa-eye-slash" id="show-password"></i>
                        </span>
                    </div>
                    <button type="submit" class="login-btn sharey-btn">Giriş</button>
                </form>
            </div>
            <div class="signup-link sharey-signup-link">
                <p>Hesabınız yok mu? <a href="/register/">Kayıt Ol</a></p>
            </div>
            <div class="footer sharey-footer">
                <p><strong>Crafted by Sharey</strong> © <span id="year">2024</span></p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            var passwordField = document.getElementById('login-password');
            var showPasswordIcon = document.getElementById('show-password');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                showPasswordIcon.className = 'fa fa-eye';
            } else {
                passwordField.type = 'password';
                showPasswordIcon.className = 'fa fa-eye-slash';
            }
        }
        document.getElementById('year').textContent = new Date().getFullYear();

        window.addEventListener('load', function() {
            var errorMessage = document.getElementById('error-message');
            if (errorMessage) {
                errorMessage.classList.add('show');
                setTimeout(function() {
                    errorMessage.style.display = 'none';
                }, 4000); // Hata mesajı 4 saniye sonra kaybolacak
            }
        });
    </script>
    <script src="/sessions/kar.js" type="text/javascript"></script>
</body>
</html>
