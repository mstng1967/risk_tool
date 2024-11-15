<h3>Actualizar Riesgo</h3>
<?php
$servername = "mysql"; // Nombre del servicio de MySQL en Docker
$username = "root";
$password = "super-secret-password";
$dbname = "my-wonderful-website";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>

<?php
	$sql = "SELECT * FROM risks ORDER BY risk_id DESC LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $risk_id = $row["risk_id"] + 1;
        }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $col1 = $_POST['risk_id'];
                $col2 = $_POST['date'];
                $col3 = $_POST['product'];
                $col4 = $_POST['process_project'];
                $col5 = $_POST['failure_mode'];
                $col6 = $_POST['failure_effect'];
                $col7 = $_POST['SEV_inherent'];
                $col8 = $_POST['SEV'];
                $col9 = $_POST['failure_mode_cause'];
                $col10 = $_POST['stakeholders_cause'];
                $col11 = $_POST['OCC_inherent'];
                $col12 = $_POST['OCC'];
                $col13 = $_POST['current_control'];
                $col14 = $_POST['preventive_control'];
                $col15 = $_POST['detective_control'];
                $col16 = $_POST['corrective_control'];
                $col17 = $_POST['DET'];
                $col18 = $_POST['bottleneck'];
                $col19 = $_POST['RPN_inherent'];
                $col20 = $_POST['RPN'];
                $col21 = $_POST['risk_level'];
                $col22 = $_POST['stakeholders_affected'];
                $col23 = $_POST['acceptable'];
                $col24 = $_POST['actions'];
        
        
    
        $sql = "INSERT INTO risks (risk_id, date, product, process_project, failure_mode,
                failure_effect, SEV_inherent, SEV, failure_mode_cause, stakeholders_cause, OCC_inherent, OCC, current_control,
                preventive_control, detective_control, corrective_control, DET, bottleneck, RPN_inherent, RPN, risk_level,
                stakeholders_affected, acceptable, actions) 
                VALUES ('$col1', '$col2', '$col3', '$col4', '$col5', '$col6', '$col7', '$col8', '$col9', '$col10',
                '$col11', '$col12', '$col13', '$col14', '$col15', '$col16', '$col17', '$col18', '$col19', '$col20', '$col21',
                '$col22', '$col23', '$col24')";
    
        if ($conn->query($sql) === TRUE) {
            echo "Nuevo registro añadido correctamente";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Datos</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }
    </style>
        <!-- Datatable CSS -->
        <link href='DataTables/datatables.min.css' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- jQuery Library -->
    <script src="jquery-3.3.1.min.js"></script>

    <!-- Datatable JS -->
    <script src="DataTables/datatables.min.js"></script>
    <script src='https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js'></script>
    <script src='https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js'></script>
    <script src='https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js'></script>
    <script src='https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js'></script>
    <script src='https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js'></script>
    <script src='https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js'></script>
</head>
<body>

    <form action="" method="POST">
        <table class='display dataTable hoverable  table-striped'>
            <tr>
                    <td>ID del Riesgo</td>
                    <td>Fecha</td>
                    <td>Producto</td>
                    <td>Proceso/Proyecto</td>
                    <td>Modo de fallo</td>
                    <td>Efecto de fallo</td>
                    <td>SEV Inherente</td>
                    <td>SEV</td>
                    <td>Causas del modo de fallo</td>
                    <td>Stakeholders causantes del riesgo</td>
                    <td>OCC Inherente</td>
                    <td>OCC</td>
                    <td>Controles actuales</td>
                    <td>Control preventivo</td>
                    <td>Control detectivo</td>
                    <td>Control correctivo</td>
                    <td>DET</td>
                    <td>Bottleneck</td>
                    <td>RPN Inherente</td>
                    <td>RPN</td>
                    <td>Nivel de riesgo</td>
                    <td>Stakeholders afectados por la materialización del riesgo</td>
                    <td>¿Aceptable?</td>
                    <td>Acciones</td>
            </tr>
            <tr>
                <td><input type="number" name="risk_id" value="<?php echo $risk_id ?>" readonly></td>
                <td><input type="text" name="date"></td>
                <td><input type="text" name="product"></td>
                <td><input type="text" name="process_project"></td>
                <td><input type="text" name="failure_mode"></td>
                <td><input type="text" name="failure_effect"></td>
                <td><input type="text" name="SEV_inherent"></td>
                <td><input type="text" name="SEV"></td>
                <td><input type="text" name="failure_mode_cause"></td>
                <td><input type="text" name="stakeholders_cause"></td>
                <td><input type="text" name="OCC_inherent"></td>
                <td><input type="text" name="OCC"></td>
                <td><input type="text" name="current_control"></td>
                <td><input type="text" name="preventive_control"></td>
                <td><input type="text" name="detective_control"></td>
                <td><input type="text" name="corrective_control"></td>
                <td><input type="text" name="DET"></td>
                <td><input type="text" name="bottleneck"></td>
                <td><input type="text" name="RPN_inherent"></td>
                <td><input type="text" name="RPN"></td>
                <td><input type="text" name="risk_level"></td>
                <td><input type="text" name="stakeholders_affected"></td>
                <td><input type="text" name="acceptable"></td>
                <td><input type="text" name="actions"></td>            
            </tr>
            <tr>
                <td colspan="10"><button type="submit">Añadir riesgo nuevo</button></td>
            </tr>
        </table>
    </form>
<a href="Products2.php" class="btn btn-warning">Volver a la tabla general</a>
</body>
</html>
<?php
$conn->close();
?>
