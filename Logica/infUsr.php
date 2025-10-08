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
            <th>Contraseña </th>
            <th>Acciones</th>
        </tr>";

$html .= '
    <tr>
        <td>' . htmlspecialchars($usuario->getNombre()) . '</td>
        <td>' . htmlspecialchars($usuario->getCedula()) . '</td>
        <td>' . htmlspecialchars($usuario->getTelefono()) . '</td>
        <td>' . htmlspecialchars($usuario->getCorreo()) . '</td>
        <td>' . htmlspecialchars($usuario->getPass()) . '</td>
        <td>
            <button class="btnmodUsr"
                data-nombreusr="' . htmlspecialchars($usuario->getNombre()) . '"
                data-ci="' . htmlspecialchars($usuario->getCedula()) . '"
                data-corr="' . htmlspecialchars($usuario->getCorreo()) . '"
                data-tel="' . htmlspecialchars($usuario->getTelefono()) . '"
                data-pass="' . htmlspecialchars($usuario->getPass()) . '"
            >Modificar</button>
        </td>
    </tr>
    </table>
</div>';

header('Content-Type: application/json');
echo json_encode($html);
