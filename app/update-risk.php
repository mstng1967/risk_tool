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
    if(isset($_GET['i'])){
        $item = $_GET['i'];
        $sql = "SELECT * FROM mis_production WHERE product_name = '$item'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<h1>Tabla de Datos</h1>
                            <form action='' method='POST'>
                                <h3>Agregar nueva fila</h3>
                                <table>
                                    <tr>
                    <th>ID del Riesgo</th>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Proceso/Proyecto</th>
                    <th>Modo de fallo</th>
                    <th>Efecto de fallo</th>
                    <th>SEV Inherente</th>
                    <th>SEV</th>
                    <th>Causas del modo de fallo</th>
                    <th>Stakeholders causantes del riesgo</th>
                    <th>OCC Inherente</th>
                    <th>OCC</th>
                    <th>Controles actuales</th>
                    <th>Control preventivo</th>
                    <th>Control detectivo</th>
                    <th>Control correctivo</th>
                    <th>DET</th>
                    <th>Bottleneck</th>
                    <th>RPN Inherente</th>
                    <th>RPN</th>
                    <th>Nivel de riesgo</th>
                    <th>Stakeholders afectados por la materialización del riesgo</th>
                    <th>¿Aceptable?</th>
                    <th>Acciones</th>
                </tr>
                                    <tr>
                                        <td><input type='text' name='risk_id' value=" . $row["risk_id"] . "></td>
                                        <td><input type='text' name='date' value=" . $row["date"] . "></td>
                                        <td><input type='text' name='product' value=" . $row["product"] . "></td>
                                        <td><input type='text' name='process_project' value=" . $row["process_project"] . "></td>
                                        <td><input type='text' name='failure_mode' value=" . $row["failure_mode"] . "></td>
                                        <td><input type='text' name='failure_effect' value=" . $row["failure_effect"] . "></td>
                                        <td><input type='text' name='SEV_inherent' value=" . $row["SEV_inherent"] . "></td>
                                        <td><input type='text' name='SEV' value=" . $row["SEV"] . "></td>
                                        <td><input type='text' name='failure_mode_cause' value=" . $row["failure_mode_cause"] . "></td>
                                        <td><input type='text' name='stakeholders_cause' value=" . $row["stakeholders_cause"] . "></td>
                                        <td><input type='text' name='OCC_inherent' value=" . $row["OCC_inherent"] . "></td>
                                        <td><input type='text' name='OCC' value=" . $row["OCC"] . "></td>
                                        <td><input type='text' name='current_control' value=" . $row["current_control"] . "></td>
                                        <td><input type='text' name='preventive_control' value=" . $row["preventive_control"] . "></td>
                                        <td><input type='text' name='detective_control' value=" . $row["detective_control"] . "></td>
                                        <td><input type='text' name='corrective_control' value=" . $row["corrective_control"] . "></td>
                                        <td><input type='text' name='DET' value=" . $row["DET"] . "></td>
                                        <td><input type='text' name='bottleneck' value=" . $row["bottleneck"] . "></td>
                                        <td><input type='text' name='RPN_inherent' value=" . $row["RPN_inherent"] . "></td>
                                        <td><input type='text' name='RPN' value=" . $row["RPN"] . "></td>
                                        <td><input type='text' name='risk_level' value=" . $row["risk_level"] . "></td>
                                        <td><input type='text' name='stakeholders_affected' value=" . $row["stakeholders_affected"] . "></td>
                                        <td><input type='text' name='acceptable' value=" . $row["acceptable"] . "></td>
                                        <td><input type='text' name='actions' value=" . $row["actions"] . "></td>
                                    </tr>
                                    <tr>
                                        <td colspan='10'><button type='submit'>Actualizar</button></td>
                                    </tr>
                                </table>
                            </form>";
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
            
            
                $sql = "UPDATE mis_production SET risk_id =  '$col1', date = '$col2', product = '$col3',
                         process_project = '$col4', failure_mode = '$col5', failure_effect = '$col6', SEV_inherent = '$col7', SEV = '$col8', failure_mode_cause = '$col9',
                         stakeholders_cause = '$col10', OCC_inherent = '$col11', OCC = '$col12', current_control = '$col13', preventive_control = '$col14', detective_control = '$col15',
                         corrective_control = '$col16', DET = '$col17', bottleneck = '$col18', RPN_inherent = '$col19', RPN = '$col20', risk_level = '$col21', 
                         stakeholders_affected = '$col22', acceptable = '$col23', actions = '$col24' WHERE product_name = '$item'";
            
                if ($conn->query($sql) === TRUE) {
                    echo "Registro actualizado correctamente";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            
        } else {
            echo "<tr><td colspan='10'>No hay datos disponibles</td></tr>";
        }
    }


// Insertar datos si se ha enviado el formulario
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    $col1 = $_POST['PersonID'];
//    $col2 = $_POST['LastName'];
//    $col3 = $_POST['FirstName'];
//    $col4 = $_POST['Address'];
//    $col5 = $_POST['City'];
//
//
//    $sql = "INSERT INTO mis_production (user_id, financial_year, financial_quarter, product_name,
//             production_unit, total_production, uploded_on) 
//            VALUES ('$col1', '$col2', '$col3', '$col4', '$col5', '$col6', '$col7')";
//
//    if ($conn->query($sql) === TRUE) {
//        echo "Nuevo registro agregado correctamente";
//    } else {
//        echo "Error: " . $sql . "<br>" . $conn->error;
//    }
//}
//
//
?>
<a href="Products2.php" class="btn btn-warning">Volver a la tabla general</a>

<?php
$conn->close();
?>
