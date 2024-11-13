<h3>Actualizar Riesgo</h3>
<?php
include 'config.php';   

// Comprobar la conexión
if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}
?>

<?php
	$sql = "SELECT * FROM risks ORDER BY risk_id DESC LIMIT 1";
        $result = $con->query($sql);
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
    
        if ($con->query($sql) === TRUE) {
            echo "Nuevo registro añadido correctamente";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
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
                    <td style="width:25%">ID del Riesgo</td>
                    <td ><input type="number" name="risk_id" value="<?php echo $risk_id ?>" readonly></td>

            </tr>
            <tr>
                    <td>Fecha</td>
                    <td><input type="text" name="date"></td>                    
            </tr>
            <tr>            
                    <td>Producto</td>
                    <td><input type="text" name="product"></td>
            </tr>
            <tr>
                    <td>Proceso/Proyecto</td>
                    <td><input type="text" name="process_project"></td>
            </tr>
            <tr>
                    <td>Modo de fallo</td>
                    <td><input style="height:50px;width:500px" type="text" name="failure_mode"></td>
            </tr>
            <tr>
                    <td>Efecto de fallo</td>
                    <td><input style="height:50px;width:500px" type="text" name="failure_effect"></td>
            </tr>
            <tr>
                    <td>SEV Inherente</td>
                    <td><input type="text" name="SEV_inherent"></td>
            </tr>
            <tr>
                    <td>SEV</td>
                    <td><input type="text" name="SEV"></td>
            </tr>
            <tr>
                    <td>Causas del modo de fallo</td>
                    <td><input style="height:50px;width:500px" type="text" name="failure_mode_cause"></td>
            </tr>
            <tr>
                    <td>Stakeholders causantes del riesgo</td>
                    <td><input type="text" name="stakeholders_cause"></td>
            </tr>
            <tr>
                    <td>OCC Inherente</td>
                    <td><input type="text" name="OCC_inherent"></td>
            </tr>
            <tr>
                    <td>OCC</td>
                    <td><input type="text" name="OCC"></td>
            </tr>
            <tr>
                    <td>Controles actuales</td>
                    <td><input style="height:50px;width:500px" type="text" name="current_control"></td>
            </tr>
            <tr>
                    <td>Control preventivo</td>
                    <td><input type="text" name="preventive_control"></td>
            </tr>
            <tr>
                    <td>Control detectivo</td>
                    <td><input type="text" name="detective_control"></td>
            </tr>
            <tr>
                    <td>Control correctivo</td>
                    <td><input type="text" name="corrective_control"></td>
            </tr>
            <tr>
                    <td>DET</td>
                    <td><input type="text" name="DET"></td>
            </tr>
            <tr>
                    <td>Bottleneck</td>
                    <td><input type="text" name="bottleneck"></td>
            </tr>
            <tr>
                    <td>RPN Inherente</td>
                    <td><input type="text" name="RPN_inherent"></td>
            </tr>
            <tr>
                    <td>RPN</td>
                    <td><input type="text" name="RPN"></td>
            </tr>
            <tr>
                    <td>Nivel de riesgo</td>
                    <td><input type="text" name="risk_level"></td>
            </tr>
            <tr>
                    <td>Stakeholders afectados por la materialización del riesgo</td>
                    <td><input type="text" name="stakeholders_affected"></td>
            </tr>
            <tr>
                    <td>¿Aceptable?</td>
                    <td><input type="text" name="acceptable"></td>
            </tr>
            <tr>
                    <td>Acciones</td>
                    <td><input style="height:50px;width:500px" type="text" name="actions"></td>  
            </tr>
            <tr>
                <td colspan="10"><button class="btn btn-warning" type="submit">Añadir riesgo nuevo</button></td>
            </tr>
        </table>
    </form>
<a href="index.php" class="btn btn-warning">Volver a la tabla general</a>
</body>
</html>
<?php
$con->close();
?>
