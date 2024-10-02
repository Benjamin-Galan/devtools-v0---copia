<?php
require '../../includes/functions.php';

$auth = isAuth();
if(!$auth){
    header('Location: /');
}

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('Location: /admin');
}

require '../../includes/config/database.php';
$db = connectDB();

$query = "SELECT * FROM categories WHERE id = {$id}";
$result = mysqli_query($db, $query);
$category = mysqli_fetch_assoc($result);

$warnings = [];

$name = $category['name'];
$description = $category['description'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $description = mysqli_real_escape_string($db, $_POST['description']);

    if(!$name){
        $warnings[] = "Debes añadir un nombre"; 
    }

    if (!$description) {
        $warnings[] = "Añade una descripcion";
    }

    if(empty($warnings)){
        $query = "UPDATE categories SET name = '{$name}', description = '{$description}' WHERE id = {$id};";
        $result = mysqli_query($db, $query);

        if($result){
            header('Location: /admin?result=2');
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
                <input type="text" id="categoryName" name="name" value="<?php echo $name ?>">
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