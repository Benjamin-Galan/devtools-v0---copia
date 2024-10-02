<?php
require '../../includes/functions.php';

$auth = isAuth();
if(!$auth){
    header('Location: /');
}

require '../../includes/config/database.php';
$db = connectDB();

//warnings array
$warnings = [];

$name =  '';
$description = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $description = mysqli_real_escape_string($db, $_POST['description']);

    if (!$name) {
        $warnings[] = "El nombre es obligatorio";
    }

    if (!$description) {
        $warnings[] = "Añade una descripcion";
    }

    if (empty($warnings)) {
        $query = "INSERT INTO categories (name, description) VALUES ('$name', '$description');";
        $result = mysqli_query($db, $query);

        if ($result) {
            header('Location: /admin?result=1');
        }
    }
}

includeTemplate('header');
?>

<main class="form-container">
    <section class="form-section">
        <h2>Crear Nueva Categoría</h2>

        <a href=""></a>

        <?php foreach ($warnings as $warning) { // Muestra errores si los hay 
        ?>
            <div class="alerta error">
                <?php echo $warning; ?>
            </div>
        <?php } ?>

        <form id="categoryForm" method="POST">
            <div>
                <label for="name">Nombre de la Categoría:</label>
                <input type="text" id="categoryName" name="name" value="<?php echo $name; ?>">
            </div>
            <div>
                <label for="description">Descripcion:</label>
                <textarea name="description" id="categoryDesc"><?php echo $description; ?></textarea>
            </div>
            <button type="submit">Crear Categoría</button>
        </form>
    </section>
</main>

<?php include '../../includes/templates/footer.php'; ?>