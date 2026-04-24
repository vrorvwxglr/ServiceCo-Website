<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

include "../../config.php";

$sql = "SELECT * FROM service_groups ORDER BY name ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="../../logo.png">
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
                <img src="../../logo.png" alt="ServiceCo Logo">
            </a>
            <h1>Management</h1>
        </header>
        <main>
            <p>Welcome to the Management section of Service Product Catalog, this webpage is used to configure service group settings such as logos, names, emails, colors, URLs, and descriptions etc.</p>
        </main>
        <div class="admin-section">
            <table class="groups-table">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Folder</th>
                        <th>Email</th>
                        <th>Color</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                            <td>
                                <img src="../../servicegroups/<?php echo htmlspecialchars($row['folder']); ?>/logo.png" alt="logo">
                            </td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['folder']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td>
                                    <span style="display:inline-block; width:60px; height:20px; background-color:<?php echo htmlspecialchars($row['color']); ?>;border:1px solid #ccc; margin-right:8px; vertical-align:center; border-radius: 5px; "></span>
                                    <?php echo htmlspecialchars($row['color']); ?>
                                </td>
                                <td><?php echo htmlspecialchars($row['description']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No groups found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </body>
    <footer>
        <p>2026 ServiceCo</p>
    </footer>
</html>

<?php $conn->close(); ?>
