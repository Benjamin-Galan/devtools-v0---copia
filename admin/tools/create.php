<?php
require '../../includes/functions.php';

$auth = isAuth();
if(!$auth){
    header('Location: /');
}

require '../../includes/config/database.php';
$db = connectDB();

$warnings = [];

$name = '';
$description = '';
$url = '';
$categoryId = '';

$query = "SELECT * FROM categories";
$result = mysqli_query($db, $query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $url = mysqli_real_escape_string($db, $_POST['url']);
    $categoryId = mysqli_real_escape_string($db, $_POST['category']);

    $image = $_FILES['image'];

    if (!$name) {
        $warnings[] = "Debes añadir un nombre";
    }

    if (!$description) {
        $warnings[] = "Debes añadir una descripcion";
    }

    // if (!$url) {
    //     $warnings[] = "Debes añadir un enlace";
    // }

    if (!$categoryId) {
        $warnings[] = "Selecciona una categoría";
    }

    if (empty($warnings)) {
        $imgDir = '../../images/';

        if(!is_dir($imgDir)){
            mkdir($imgDir);
        }

        $imgName = md5(uniqid(rand(), true)) . ".jpg";

        move_uploaded_file($image['tmp_name'], $imgDir . $imgName);

        $query = "INSERT INTO tools (name, image, description, url, category_id) 
                  VALUES ('$name', '$imgName', '$description', '$url', '$categoryId');";

        $result = mysqli_query($db, $query);

        if ($result) {
            header('Location: /admin');
        }
    }
}

includeTemplate('header');
?>

<main class="form-container">
    <section class="form-section">
        <h2>Crear Nueva Herramienta</h2>

        <?php
        foreach ($warnings as $warning) { ?>
            <div class="alerta error">
                <?php echo $warning ?>
            </div>
        <?php }
        ?>

        <form id="toolForm" method="POST" enctype="multipart/form-data">
            <div>
                <label for="name">Nombre de la Herramienta:</label>
                <input type="text" id="toolName" name="name" value="<?php echo $name; ?>">
            </div>
            <div>
                <label for="description">Descripción:</label>
                <textarea id="toolDescription" name="description"><?php echo $description; ?></textarea>
            </div>
            <div>
                <label for="url">Enlace (opcional):</label>
                <input type="url" id="toolLink" name="url" value="<?php echo $url; ?>">
            </div>
            <div>
                <label for="image">Imagen (opcional):</label>
                <input type="file" id="toolImage" name="image">
            </div>
            <div>
                <label for="toolCategory">Categoría:</label>
                <select id="toolCategory" name="category">
                    <option value="">Selecciona una categoría</option>
                    <?php while ($category = mysqli_fetch_assoc($result)) { ?>
                        <option <?php echo $categoryId === $category['id'] ? 'selected' : ''; ?> value="<?php echo $category['id']; ?>"> <?php echo $category['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit">Crear Herramienta</button>
        </form>
    </section>
</main>

<?php include '../../includes/templates/footer.php'; ?>