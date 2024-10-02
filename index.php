<?php
require 'includes/functions.php';

require 'includes/config/database.php';
$db = connectDB();

$queryCategories = "SELECT * FROM categories;";
$resultCategories = mysqli_query($db, $queryCategories);

$toolsQuery = "SELECT * FROM tools LIMIT 12";
$toolsResult = mysqli_query($db, $toolsQuery);
includeTemplate('header', $inicio = true);
?>

<main class="container">
    <section class="introduction">
        <div class="astronaut-container">
            <div class="halo"></div>
            <img src="src/img/astronauta.webp" alt="Astronaut floating in space" class="astronaut-image">
        </div>
        <div class="introduction-text">
            <h1>Herramientas para Desarrolladores</h1>
            <p class="description">Explora una colección curada de las mejores herramientas para impulsar tu
                productividad como desarrollador.</p>
        </div>
    </section>

    <div id="toolsContainer" class="tools-grid blur">
        <?php while ($tool = mysqli_fetch_assoc($toolsResult)) { ?>
            <div class="card">
                <h3><?php echo $tool['name']; ?></h3>
                <p><?php echo $tool['description']; ?></p>
                <a href="<?php echo $tool['url']; ?>" class="button">Explorar</a>
            </div>
        <?php } ?>
    </div>

    <div class="explore-container">
        <div class="explore-btn">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-rocket" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M4 13a8 8 0 0 1 7 7a6 6 0 0 0 3 -5a9 9 0 0 0 6 -8a3 3 0 0 0 -3 -3a9 9 0 0 0 -8 6a6 6 0 0 0 -5 3" />
                <path d="M7 14a6 6 0 0 0 -3 6a6 6 0 0 0 6 -3" />
                <path d="M15 9m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
            </svg>
            <a href="elementos.php">Explorar</a>
        </div>
    </div>
</main>

<?php include 'includes/templates/footer.php' ?>