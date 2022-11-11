<!DOCTYPE html>
<html>

<head>
    <title>Form</title>
</head>

<body>

    <?php
    
    echo "<h4>Today's date: " . date('d/m/Y') . "</h4>";

    $txt = $err = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['smt'])) {
            $err = 'Required';
        } else {
            $txt = stripslashes(trim($_POST['smt']));
        }
    }

    ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method='post'>
        <label>Enter something</label><span class="error"><?php echo $err ?></span><br>
        <input type="text" name="smt" value="<?php echo $txt ?>" autocomplete="off">
        <input type="submit">
    </form>

    <br>

    <?php 
        if (!empty($txt))
        {
            echo "You typed: " . $txt;
        }
    ?>
</body>

<style>
    .error{
        color: red;
        margin-left: 30px;
    }
</style>

</html>