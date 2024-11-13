<h3>Actualizar Riesgo</h3>
<?php
include 'config.php';   
// Comprobar la conexión
if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}
?>
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
<?php
    if(isset($_GET['i'])){
        $item = $_GET['i'];
        $sql = "SELECT * FROM risks WHERE risk_id = '$item'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<form action='' method='POST'>
                            <table class='display dataTable hoverable  table-striped'>
                                <tr>
                                    <th style='width:25%'>ID del Riesgo</th>
                                    <td><input type='text' name='risk_id' value=" . $row["risk_id"] . " readonly></td>
                                </tr>
                                <tr>
                                    <th>Fecha</th>
                                    <td><input type='text' name='date' value=" . $row["date"] . "></td>
                                </tr>
                                <tr>
                                    <th>Producto</th>
                                    <td><input type='text' name='product' value=" . $row["product"] . "></td>
                                </tr>
                                <tr>
                                    <th>Proceso/Proyecto</th>
                                    <td><input type='text' name='process_project' value=" . $row["process_project"] . "></td>                                
                                </tr>
                                <tr>
                                    <th>Modo de fallo</th>
                                    <td><input style='height:50px;width:500px' type='text' name='failure_mode' value=" . $row["failure_mode"] . "></td>
                                </tr>
                                <tr>
                                    <th>Efecto de fallo</th>
                                    <td><input style='height:50px;width:500px' type='text' name='failure_effect' value=" . $row["failure_effect"] . "></td>
                                </tr>
                                <tr>
                                    <th>SEV Inherente</th>
                                    <td><input type='text' name='SEV_inherent' value=" . $row["SEV_inherent"] . "></td>
                                </tr>
                                <tr>
                                    <th>SEV</th>
                                    <td><input type='text' name='SEV' value=" . $row["SEV"] . "></td>
                                </tr>
                                <tr>
                                    <th>Causas del modo de fallo</th>
                                    <td><input style='height:50px;width:500px' type='text' name='failure_mode_cause' value=" . $row["failure_mode_cause"] . "></td>
                                </tr>
                                <tr>
                                    <th>Stakeholders causantes del riesgo</th>
                                    <td><input type='text' name='stakeholders_cause' value=" . $row["stakeholders_cause"] . "></td>
                                </tr>
                                <tr>
                                    <th>OCC Inherente</th>
                                    <td><input type='text' name='OCC_inherent' value=" . $row["OCC_inherent"] . "></td>
                                </tr>
                                <tr>
                                    <th>OCC</th>
                                    <td><input type='text' name='OCC' value=" . $row["OCC"] . "></td>
                                </tr>
                                <tr>
                                    <th>Controles actuales</th>
                                    <td><input style='height:50px;width:500px' type='text' name='current_control' value=" . $row["current_control"] . "></td>
                                </tr>
                                <tr>
                                    <th>Control preventivo</th>
                                    <td><input type='text' name='preventive_control' value=" . $row["preventive_control"] . "></td>
                                </tr>
                                <tr>
                                    <th>Control detectivo</th>
                                    <td><input type='text' name='detective_control' value=" . $row["detective_control"] . "></td>
                                </tr>
                                <tr>
                                    <th>Control correctivo</th>
                                    <td><input type='text' name='corrective_control' value=" . $row["corrective_control"] . "></td>
                                </tr>
                                <tr>
                                    <th>DET</th>
                                    <td><input type='text' name='DET' value=" . $row["DET"] . "></td>
                                </tr>
                                <tr>
                                    <th>Bottleneck</th>
                                    <td><input type='text' name='bottleneck' value=" . $row["bottleneck"] . "></td>
                                </tr>
                                <tr>
                                    <th>RPN Inherente</th>
                                    <td><input type='text' name='RPN_inherent' value=" . $row["RPN_inherent"] . "></td>
                                </tr>
                                <tr>
                                    <th>RPN</th>
                                    <td><input type='text' name='RPN' value=" . $row["RPN"] . "></td>
                                </tr>
                                <tr>
                                    <th>Nivel de riesgo</th>
                                    <td><input type='text' name='risk_level' value=" . $row["risk_level"] . "></td>
                                </tr>
                                <tr>
                                    <th>Stakeholders afectados por la materialización del riesgo</th>
                                    <td><input type='text' name='stakeholders_affected' value=" . $row["stakeholders_affected"] . "></td>
                                </tr>
                                <tr>
                                    <th>¿Aceptable?</th>
                                    <td><input type='text' name='acceptable' value=" . $row["acceptable"] . "></td>
                                </tr>
                                <tr>
                                    <th>Acciones</th>
                                    <td><input style='height:50px;width:500px' type='text' name='actions' value=" . $row["actions"] . "></td>
                                </tr>


                                    <tr>
                                        <td colspan='10'><button class='btn btn-warning' type='submit'>Actualizar</button></td>
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
            
            
                $sql = "UPDATE risks SET risk_id =  '$item', date = '$col2', product = '$col3',
                         process_project = '$col4', failure_mode = '$col5', failure_effect = '$col6', SEV_inherent = '$col7', SEV = '$col8', failure_mode_cause = '$col9',
                         stakeholders_cause = '$col10', OCC_inherent = '$col11', OCC = '$col12', current_control = '$col13', preventive_control = '$col14', detective_control = '$col15',
                         corrective_control = '$col16', DET = '$col17', bottleneck = '$col18', RPN_inherent = '$col19', RPN = '$col20', risk_level = '$col21', 
                         stakeholders_affected = '$col22', acceptable = '$col23', actions = '$col24' WHERE risk_id = '$item'";
            
                if ($con->query($sql) === TRUE) {
                    echo "Registro actualizado correctamente";
                } else {
                    echo "Error: " . $sql . "<br>" . $con->error;
                }
            }
            
        } else {
            echo "<tr><td colspan='10'>No hay datos disponibles</td></tr>";
        }
    }

?>
<p>
<a href="index.php" class="btn btn-warning">Volver a la tabla general</a>
</p>
<?php
$con->close();
?>
