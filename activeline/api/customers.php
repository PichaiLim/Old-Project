<?php
/**
 * Created by PhpStorm.
 * User: pichai
 * Date: 12/20/2016 AD
 * Time: 6:51 PM
 */
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require '../config_database.inc.php';

try{
    $con = mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($con,"utf8");
    $name = (string)$_POST['customerName'];
    $address = (string)$_POST['customerAddress'];
    $tel = (string)$_POST['customerTel'];
    $fax = (string)$_POST['customerFax'];
    $mobile = (string)$_POST['customerMobile'];
    $contact = (string)$_POST['contactName'];
    $email = (string)$_POST['customerEmail'];

    $sql = "INSERT INTO customers (`customerName`,`customerAddress`, `customerTel`, `customerFax`, `customerMobile`, `contactName`, `customerEmail`, `createDate`) VALUES ";
    $sql .= "('$name', '$address', '$tel', '$fax', '$mobile', '$contact', '$email', NOW())";

    if($query = mysqli_query($con, $sql)){
        header('Location: ../index.php');
    }


}catch (PDOException $e)
{
    echo $e->getMessage();
}
