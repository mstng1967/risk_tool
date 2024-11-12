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

// Insertar datos si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $col1 = $_POST['PersonID'];
    $col2 = $_POST['LastName'];
    $col3 = $_POST['FirstName'];
    $col4 = $_POST['Address'];
    $col5 = $_POST['City'];


    $sql = "INSERT INTO Persons (PersonID, LastName, FirstName, Address, City) 
            VALUES ('$col1', '$col2', '$col3', '$col4', '$col5')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo registro agregado correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Obtener los datos de la tabla
$sql = "SELECT * FROM Persons LIMIT 20";
$result = $conn->query($sql);
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
    <h3>Tabla de Datos</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>City</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["PersonID"] . "</td>
                            <td>" . $row["LastName"] . "</td>
                            <td>" . $row["FirstName"] . "</td>
                            <td>" . $row["Address"] . "</td>
                            <td>" . $row["City"] . "</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='10'>No hay datos disponibles</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
