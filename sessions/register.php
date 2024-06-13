<?php
session_start();
include('../server/baglan.php');

$success = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['register-username'];
    $email = $_POST['register-email'];
    $password = $_POST['register-password'];

    // Kullanıcıyı veritabanında kontrol et
    $sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $error = "Kullanıcı adı veya e-posta zaten mevcut.";
    } else {
        // Kullanıcıyı veritabanına ekle
        $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
        if ($conn->query($sql) === TRUE) {
            $success = "Kayıt başarılı! Giriş yapmak için <a href='/login/'>tıklayın</a>.";
        } else {
            $error = "Kayıt başarısız: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1332 - Kayıt Ol</title>
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

        .error-message, .success-message {
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

        .success-message {
            background-color: #4CAF50;
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
    <?php elseif ($success): ?>
        <div class="success-message" id="success-message"><?php echo $success; ?></div>
    <?php endif; ?>
    <div class="login-wrapper fade-in" id="content">
        <div class="login-container sharey-container">
            <div class="login-box sharey-box">
                <h2>Kayıt Ol</h2>
                <form action="" method="POST" novalidate>
                    <div class="input-group sharey-input-group">
                        <input type="text" id="register-username" name="register-username" placeholder="Kullanıcı Adı" required>
                    </div>
                    <div class="input-group sharey-input-group">
                        <input type="email" id="register-email" name="register-email" placeholder="E-posta" required>
                    </div>
                    <div class="input-group sharey-password-group">
                        <input type="password" id="register-password" name="register-password" placeholder="Parola" required>
                        <span class="toggle-password sharey-toggle-password" onclick="togglePassword()">
                            <i class="fa fa-eye-slash" id="show-password"></i>
                        </span>
                    </div>
                    <button type="submit" class="login-btn sharey-btn">Kayıt Ol</button>
                </form>
            </div>
            <div class="signup-link sharey-signup-link">
                <p>Zaten bir hesabınız var mı? <a href="/login/ ">Giriş Yap</a></p>
            </div>
            <div class="footer sharey-footer">
                <p><strong>Crafted by Sharey</strong> © <span id="year">2024</span></p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            var passwordField = document.getElementById('register-password');
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
            var successMessage = document.getElementById('success-message');
            if (errorMessage) {
                errorMessage.classList.add('show');
                setTimeout(function() {
                    errorMessage.style.display = 'none';
                }, 4000); // Hata mesajı 4 saniye sonra kaybolacak
            }
            if (successMessage) {
                successMessage.classList.add('show');
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 4000); // Başarı mesajı 4 saniye sonra kaybolacak
            }
        });
    </script>
    <script src="/sessions/kar.js" type="text/javascript"></script>
</body>
</html>
