<?php
require 'includes/functions.php';

require 'includes/config/database.php';
$db = connectDB();

$queryCategories = "SELECT * FROM categories;";
$resultCategories = mysqli_query($db, $queryCategories);

$toolsQuery = "SELECT * FROM tools";
$toolsResult = mysqli_query($db, $toolsQuery);
includeTemplate('header');
?>

<main class="container">
    <section class="elements"></section>
    <div class="tabs categories">
        <button class="tab-button">Todas<a href="elementos.php"></a></button>
        <?php while ($category = mysqli_fetch_assoc($resultCategories)) { ?>
            <button class="tab-button" data-category-id="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></button>
        <?php } ?>
    </div>

    <div id="toolsContainer" class="tools-grid">
        <?php while ($tool = mysqli_fetch_assoc($toolsResult)) { ?>
            <div class="card">
                <h3><?php echo $tool['name']; ?></h3>
                <p><?php echo $tool['description']; ?></p>
                <a href="<?php echo $tool['url']; ?>" class="button">Explorar</a>
            </div>
        <?php } ?>
    </div>

    <div class="load-more-container">
        <button id="loadMoreBtn" class="button">Ver más</button>
    </div>
    </section>
</main>

<?php includeTemplate('footer'); ?>
</div>

<script src="build/js/app.js"></script>
</body>

</html>