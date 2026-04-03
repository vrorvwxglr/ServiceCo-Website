<?php
include "./config.php";

$groupColor = [];
$groups = [];

$result = $conn->query("SELECT id, name, folder, color FROM service_groups ORDER BY id ASC");

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        // sidebar list (ID order)
        $groups[] = $row;

        // color dropdown grouping
        $groupColor[$row['color']][] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="./logo.png">
        <title>ServiceCo</title>
        <link rel="stylesheet" href="./style.css">
        <script>var egassem = "z9MbDcm43640Sb31q80Jkl4fN0TT5Fidg_7S7p1f8tqVh_maxnaW1KULYi4zatlmCSqboylWiwW4EdVHiqhh-wTIZogg5fYc4J3noN1o0c6bsH_LUM1pSb9Oo7ZeZ1CBbtbuOESmhcqtSAML1v-JtWen4nicbVQ_bf2j_61URHTENj9cufV-eTCVj5uoHp88";</script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
                <img src="./logo.png" alt="ServiceCo Logo">
            </a>
            <h1>Welcome to Service Product Catalog</h1>
            <div class="sidebar">
                <div class="menu-icon" onclick="toggleMenu()">☰</div>
                <div id="sidebar-content" class="sidebar-content">
                    <?php foreach ($groups as $grp): ?>
                        <a href="./servicegroups/<?php echo htmlspecialchars($grp['folder']); ?>/index.php"><?php echo htmlspecialchars($grp['name']); ?></a>
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
            <form action="#" method="GET" class="search-form">
                <input type="text" id="search-box" placeholder="Search in ServiceCo" autocomplete="off">
                <button type="submit">Search</button>
            </form>
            <div id="search-results" class="dropdown-content"></div>
            <script>
                $(document).ready(function() {
                    $('.search-form').submit(function(event) {
                        event.preventDefault();
                        var searchTerm = $('#search-box').val().toLowerCase();
                        if (searchTerm) {
                            $.get('search.php', { search: searchTerm }, function(response) {
                                $('#search-results').html(response).show();
                            }).fail(function() {
                                $('#search-results').html('<div class="error">There was an error.</div>').show();
                            });
                        } else {
                            $('#search-results').hide();
                        }
                    });
                    $(document).click(function(e) {
                        if (!$(e.target).is('#search-box') && !$(e.target).closest('#search-results').length) {
                            $('#search-results').hide();
                        }
                    });
                });
            </script>
        </header>
        <main>
            <section class="goals">
                <h2>Our Goals</h2>
                <p>An overview of sustainable and service products with their pricing and contact details supporting and strengthening our community partnership.</p>
                <img src="sdg.png" alt="SDG" style="max-width: 100%; height: auto;">
            </section>
            <section id="service-groups">
                <h2>Service Groups</h2>
                <?php foreach ($groupColor as $hex => $groups): ?>
                    <details class="group-color-dropdown">
                        <summary style="background: <?php echo htmlspecialchars($hex); ?>">
                            <?php if ($hex == '#c2593a'): ?>
                                Humanitarian Inclusivity and Equity
                            <?php elseif ($hex == '#435ba6'): ?>
                                Unity and Collaboration
                            <?php elseif ($hex == '#bf8d42'): ?>
                                Sustainable and Resilient Communities
                            <?php elseif ($hex == '#769f57'): ?>
                                Environmental Sustainability
                            <?php else: ?>
                                <?php echo htmlspecialchars($hex); ?>
                            <?php endif; ?>
                        </summary>
                        <div class="logo-wall">
                            <?php foreach ($groups as $grp): ?>
                                <a href="./servicegroups/<?php echo htmlspecialchars($grp['folder']); ?>/index.php"><img src="./servicegroups/<?php echo htmlspecialchars($grp['folder']); ?>/logo.png" alt="<?php echo htmlspecialchars($grp['name']); ?> Logo"></a>
                            <?php endforeach; ?>
                        </div>
                    </details>
                <?php endforeach; ?>
            </section>
        </main>
        <footer>
            <p>2026 ServiceCo</p>
        </footer>
    </body>
</html>