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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $col1 = $_POST['user_id'];
        $col2 = $_POST['financial_year'];
        $col3 = $_POST['financial_quarter'];
        $col4 = $_POST['product_name'];
        $col5 = $_POST['production_unit'];
        $col6 = $_POST['total_production'];
        $col7 = $_POST['uploded_on'];
        
        $sql = "SELECT * FROM mis_production ORDER BY sr_id DESC LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $sr_id = $row["sr_id"] + 1;
            echo $sr_id;
        }
    
        $sql = "INSERT INTO mis_production (sr_id,user_id, financial_year, financial_quarter, product_name,
                production_unit, total_production, uploded_on) 
                VALUES ('$sr_id', '$col1', '$col2', '$col3', '$col4', '$col5', '$col6', '$col7')";
    
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
</head>
<body>
    <h1>Tabla de Datos</h1>

    <form action="" method="POST">
        <h3>Agregar nueva fila</h3>
        <table>
            <tr>
                <td>user_id</td>
                <td>financial_year</td>
                <td>financial_quarter</td>
                <td>product_name</td>
                <td>production_unit</td>
                <td>total_production</td>
                <td>total_production</td>
            </tr>
            <tr>
                <td><input type="number" name="user_id"></td>
                <td><input type="text" name="financial_year"></td>
                <td><input type="number" name="financial_quarter"></td>
                <td><input type="text" name="product_name"></td>
                <td><input type="text" name="production_unit"></td>
                <td><input type="number" name="total_production"></td>
                <td><input type="text" name="uploded_on"></td>
            </tr>
            <tr>
                <td colspan="10"><button type="submit">Agregar Fila</button></td>
            </tr>
        </table>
    </form>
<a href="Products2.php" class="btn btn-warning">Volver a la tabla general</a>
</body>
</html>
<?php
$conn->close();
?>
