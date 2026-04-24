<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="../logo.png">
        <title>ServiceCo</title>
        <link rel="stylesheet" href="./style.css">
        <script>var egassem = "U0UwMQGuGwlLSaLQ6q060IPydCU-82EyNCAvwEtpjgyNAAknwJRnypee-eMMRGN9IhujcZQFABBarGSgPBNte9m-IZzwIGYtJ5qZMhDh3bBxh_kKi5cQ9MujBOKMPmHsqLtyDjyrJ0OHcUzRWwv-oM2RdP6_Z8ZPFtVIlZbyWfP2nJZv59UmtV3ws4w=";</script>
        <script>
            if (window.console) {
                console.log(
                    "%cStop!",
                    "color: red; font-size: 40px; font-weight: bold;"
                );

                console.log(
                    "%cThis is a browser feature intended for developers. " +
                    "Writing code here may cause unintended consequences.",
                    "font-size: 16px;"
                );
            }
        </script>
    </head>
    <body>
        <header>
            <a href="./index.php">
                <img src="../logo.png" alt="ServiceCo Logo">
            </a>
            <h1>Management</h1>
        </header>
        <main>
            <p>Please login to continue.</p>
            <section class="auth-section">
                <h2>Login</h2>
                <?php if (isset($_GET['error']) && $_GET['error'] === "invalid_login"): ?>
                    <div class="error-message">
                        Invalid username or password.
                    </div>
                <?php endif; ?>
                <form action="action_page.php" method="POST">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">Login</button>
                </form>
            </section>
        </main>
        <footer>
            <p>2026 ServiceCo</p>
        </footer>
    </body>
</html>