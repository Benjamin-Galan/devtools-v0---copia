<?php
require 'includes/functions.php';

require 'includes/config/database.php';
$db = connectDB();

//autenticar al usuario
$warnings = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (!$email) {
        $warnings[] = "El nombre de usuario es obligatorio";
    }

    if (!$password) {
        $warnings[] = "Debes añadir la contraseña";
    }

    if (empty($warnings)) {
        $query = "SELECT * FROM admin WHERE email = '{$email}';";
        $result = mysqli_query($db, $query);

        if ($result->num_rows) {
            $admin = mysqli_fetch_assoc($result);

            $auth = password_verify($password, $admin['password']);

            if ($auth) {
                session_start();

                $_SESSION['admin'] = $admin['email'];
                $_SESSION['login'] = true;

                header('Location: /admin');
            } else {
                $warnings[] = "Contraseña incorrecta";
            }
        } else {
            $warnings[] = "El usuario no existe";
        }
    }
}

includeTemplate('header');
?>

<main class="form-container">
    <section class="form-section">
        <h2>Inicio de sesion</h2>

        <?php foreach ($warnings as $warning): ?>
            <div class="alerta error">
                <?php echo $warning; ?>
            </div>
        <?php endforeach; ?>

        <form id="categoryForm" method="POST">
            <div>
                <label for="name">Nombre de Usuario</label>
                <input type="text" id="categoryName" name="email" value="">
            </div>
            <div>
                <label for="description">Contraseña</label>
                <input type="password" id="categoryDesc" name="password">
            </div>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </section>
</main>

<?php include 'includes/templates/footer.php' ?>