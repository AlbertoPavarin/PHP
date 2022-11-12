<!DOCTYPE html>
<html>

<head>
    <title>Insert Person</title>
</head>

<body>

    <?php

    echo "<h4>Today's date: " . date('d/m/Y') . "</h4>";

    $errName = $errSur = "";

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "prova";

    $conn = new mysqli($servername, $username, $password, $dbName);

    if ($conn->connect_error) {
        die("Connection failed");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['name'])) {
            $errName = 'Required';
        } else {
            $name = stripslashes(trim($_POST['name']));
        }

        if (empty($_POST['surname'])) {
            $errSur = 'Required';
        } else {
            $surname = stripslashes(trim($_POST['surname']));
        }
    }

    ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method='post'>
        <label>Name</label><span class="error"><?php echo $errName ?></span><br>
        <input type="text" name="name" autocomplete="off"><br>
        <label>Surname</label><span class="error"><?php echo $errSur ?></span><br>
        <input type="text" name="surname" autocomplete="off"><br><br>
        <input type="submit">
    </form>
</body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($name) && !empty($surname)) {
    //$sqlCreateDb = "CREATE DATABASE prova";

    /*$sqlCreateTab = "CREATE TABLE person (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name CHAR(30) NOT NULL,
        surname CHAR(30) NOT NULL
    );";*/

    /*$sqlInserInto = "INSERT INTO person(name, surname)
    VALUES ('Mimmo', 'Criscito')";*/

    $smtm = $conn->prepare("INSERT INTO person(name, surname) VALUES(?, ?)");
    $smtm->bind_param('ss', $name, $surname);
    $smtm->execute();

    echo "<br><br>Record created";

    /*$name = "Mary";
    $surname = "Watson";
    $smtm->execute();

    $name = "Peter";
    $surname = "Parker";
    $smtm->execute();*/

    /*$sqlUpdate = "UPDATE person SET name='Mary Jane' WHERE id = 2";

    if ($conn->query($sqlUpdate)) {
        echo "<br><br>Record updated";
    } else {
        echo "<br><br>Error updating record";
    }*/
    
    $sqlSelect = "SELECT p.name, p.surname 
    FROM person p
    WHERE 1=1
    ORDER BY(p.name)";

    if ($response = $conn->query($sqlSelect)) {
        if ($response->num_rows > 0) {
            while ($record = $response->fetch_assoc()) {
                echo "<br><br>Name: " . $record["name"] . "<br>Surname: " . $record["surname"];
            }
        } else {
            echo "<br><br>No record";
        }
    } else {
        die("<br><br>Error selecting records");
    }
}

$conn->close();
?>

<style>
    .error {
        color: red;
        margin-left: 30px;
    }
</style>

</html>