<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$conn = mysqli_connect('db','root','root.pa55', 'db_ejm1');
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Verificar si se aceptaron los términos y condiciones
if (!isset($_POST['terminos'])) {
    $error = "Debe aceptar los términos y condiciones para ingresar.";  
    } else {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM usuarios_login WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['usuario'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}

    $sql = "SELECT * FROM usuarios_login WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['usuario'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>
<!-- pagina de login de usuario-->
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h2>Iniciar Sesión</h2>
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Usuario:</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="terminos" id="terminos" required>
                    <label class="form-check-label" for="terminos">
                    Acepto los <a href="#">términos y condiciones</a>
                </label>
                </div>
                <div class="border rounded p-3 mb-3 bg-white" style="max-height: 200px; overflow-y: auto; font-size: 0.9em;">
                    <strong>Términos y Condiciones:</strong>
                    <p>Al acceder a este sistema, usted acepta que es responsable de mantener la confidencialidad de su cuenta y contraseña,
                        y acepta todas las actividades que se realicen bajo su cuenta. No debe usar este sistema para actividades ilícitas, 
                        y toda la información registrada debe ser veraz. El administrador se reserva el derecho de modificar o eliminar 
                        cuentas en caso de incumplimiento.</p>
                    </div>
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
