<?php
include_once "../Logica/usuario.php";
include_once "../Logica/Metodos.php";
session_start();

if (!isset($_SESSION['usr'])) {
    header("Location: ../Front/IndexMolsy.php");
    exit;
}

$usuario = $_SESSION['usr'];

$html = "<div>
    <h2>Modificar mi perfil</h2>
    <table class='tabla-usuarios'>
        <tr>
            <th>Nombre</th>
            <th>Cédula</th>
            <th>Celular</th>
            <th>Correo</th>
        </tr>";

$html .= '
    <tr>
        <td data-nombreusr="' . htmlspecialchars($usuario->getNombre()) . '">' . htmlspecialchars($usuario->getNombre()) . '</td>
        <td data-ci="' . htmlspecialchars($usuario->getCedula()) . '">' . htmlspecialchars($usuario->getCedula()) . '</td>
        <td data-tel="' . htmlspecialchars($usuario->getTelefono()) . '">' . htmlspecialchars($usuario->getTelefono()) . '</td>
        <td data-corr="' . htmlspecialchars($usuario->getCorreo()) . '">' . htmlspecialchars($usuario->getCorreo()) . '</td>
    </tr>
    </table>
</div>';

header('Content-Type: application/json');
echo json_encode($html);