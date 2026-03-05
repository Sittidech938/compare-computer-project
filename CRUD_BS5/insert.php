<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once "config/db.php";

if (isset($_POST['submit'])) {  
    $modelname = $_POST['modelname'];
    $computer_type = $_POST['computer_type'];
    $release_date = $_POST['release_date'];
    $official_product = $_POST['official_product'] ?? null;
    $img = $_FILES['img'];

    $allow = ['jpg','jpeg','png'];
    $extension = explode(".", $img['name']);
    $fileActExt = strtolower(end($extension));
    $fileNew = rand() . "." . $fileActExt;
    $filePath = "uploads/".$fileNew;

    if (in_array($fileActExt, $allow)) {
        if ($img['size'] > 0 && $img['error'] == 0) {
            if (move_uploaded_file($img['tmp_name'], $filePath)) {

                $sql = $conn->prepare("INSERT INTO computer(model_name, computer_type, release_date, image_url, official_product)
                                       VALUES(:model_name, :computer_type, :release_date, :image_url, :official_product)");

                $sql->bindParam(":model_name", $modelname);
                $sql->bindParam(":computer_type", $computer_type);
                $sql->bindParam(":release_date", $release_date);
                $sql->bindParam(":image_url", $filePath);
                $sql->bindParam(":official_product", $official_product);

                if($sql->execute()){
                    $_SESSION['success'] = "Data has been inserted successfully";
                } else {
                    $_SESSION['error'] = "Data has not been inserted successfully";
                }

                header("Location: products.php");
                exit();
            } else {
                $_SESSION['error'] = "Failed to upload image";
                header("Location: products.php");
                exit();
            }
        }
    } else {
        $_SESSION['error'] = "Invalid image format";
        header("Location: products.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Form was not submitted";
    header("Location: products.php");
    exit();
}