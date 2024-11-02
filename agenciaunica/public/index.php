<?php require_once('../private/plantillas/header.php'); ?>

<br>
<br>
<br>
<?php
// Verifica si se ha pasado la variable 'page'
if (isset($_GET['page'])) {
    
    // Verifica el valor de 'page' y carga el archivo correspondiente
    if ($_GET['page'] == 'RAG') { // ARCHIVO RANGOS
        include 'RAG.php';
    } elseif ($_GET['page'] == 'GSU') { // ARCHIVO GESTION USUARIO
        include 'GSU.php'; 
    } elseif ($_GET['page'] == 'HOM') { // ARCHIVO HOME
        include 'FO.php'; 
    } elseif ($_GET['page'] == 'GSP') { // ARCHIVO GESTION DE PAGAS
        include 'GSP.php'; 
    } elseif ($_GET['page'] == 'GVE') { // ARCHIVO GESTION VENTAS
        include 'GVE.php'; 
    } elseif ($_GET['page'] == 'GVP') { // ARCHIVO GESTION VENTAS PLACAS
        include 'GVP.php'; 
    }else {
        echo "<h1>Página no encontrada</h1>";
        echo "<p>Redirigiendo a la página principal...</p>";
        header("refresh:3;url=index.php");
        exit();
    }
} else {
    include 'FO.php';
}
?>



<?php require_once('../private/plantillas/footer.php'); ?>