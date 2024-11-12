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
                                        <td>User ID</td>
                                        <td>Financial Year</td>
                                        <td>Financial Quarter</td>
                                        <td>Product Name</td>
                                        <td>Production Unit</td>
                                        <td>Total Production</td>
                                        <td>Uploded on</td>
                                    </tr>
                                    <tr>
                                        <td><input type='text' name='user_id' value=" . $row["user_id"] . "></td>
                                        <td><input type='text' name='financial_year' value=" . $row["financial_year"] . "></td>
                                        <td><input type='text' name='financial_quarter' value=" . $row["financial_quarter"] . "></td>
                                        <td><input type='text' name='product_name' value=" . $row["product_name"] . "></td>
                                        <td><input type='text' name='production_unit' value=" . $row["production_unit"] . "></td>
                                        <td><input type='text' name='total_production' value=" . $row["total_production"] . "></td>
                                        <td><input type='text' name='uploded_on' value=" . $row["uploded_on"] . "></td>
                                    </tr>
                                    <tr>
                                        <td colspan='10'><button type='submit'>Actualizar</button></td>
                                    </tr>
                                </table>
                            </form>";
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $col1 = $_POST['user_id'];
                $col2 = $_POST['financial_year'];
                $col3 = $_POST['financial_quarter'];
                $col4 = $_POST['product_name'];
                $col5 = $_POST['production_unit'];
                $col6 = $_POST['total_production'];
                $col7 = $_POST['uploded_on'];
            
            
                $sql = "UPDATE mis_production SET user_id =  '$col1', financial_year = '$col2', financial_quarter = '$col3',
                         product_name = '$col4', production_unit = '$col5', total_production = '$col6', uploded_on = '$col7' WHERE product_name = '$item'";
            
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
