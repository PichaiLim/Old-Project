<?php

/**
 * Created by PhpStorm.
 * User: pichai
 * Date: 12/20/2016 AD
 * Time: 8:35 PM
 */

/**
 * การใช้งานของ Class นี้
 * ให้เขียน Url ที่ role
 * การเขียนใช้งานหลักอยู่ในส่วนของ Main()
 * การเรียกใช่้งานอยู่ด้านนอกของ Class นี้
 */
class CustomerActiveCode
{
    public $pdo;
    private $error;
    protected $query;

    /**
     * CustomerActiveCode constructor.
     */
    public function __construct()
    {
        $this->connection();
//        mysqli_set_charset($this->pdo,"utf8");
    }


    /**
     * @return bool
     */
    public function connection()
    {
        if (!$this->pdo) {
            require '../config_database.inc.php';

            try {
                $this->pdo = mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);
                if (mysqli_connect_errno()) {
                    return false;
                }
                return true;
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                die($this->error);
                return false;
            }
        } else {
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            return true;
        }
    }

    /**
     * Function Sql Query
     * @param $qString
     * @return bool
     */
    public function prep_query($qString)
    {
        $this->query = mysqli_query($this->pdo, $qString);
        return true;
    }

    /**
     * Function SQL Num_Rows
     * @return int
     */
    public function query_rows()
    {
        return (mysqli_num_rows($this->query) == 0) ? 0 : mysqli_num_rows($this->query);
    }

    /**
     * Function Sql Fetch Array
     * @param string $query
     * @return array|null
     */
    public function query_result_array($query = "")
    {
        return ($query == "") ? null : mysqli_fetch_all($this->query, PDO::FETCH_ASSOC);
    }

    /**
     * @return bool
     */
    public function disconnection()
    {
        return mysqli_close($this->pdo);
    }

    /**
     * Main Function
     * @param $id
     * @return array
     */
    public function role($id)
    {
        return $arr = array(
            'customer' => array(
                'list' => ("cus/l"),
                'view' => "cus/v/" . (int)$id,
                'create' => ("cus/c"),
            ),
            'product' => array(
                'list' => ("pro/l"),
                'view' => "pro/v/" . (int)$id,
                'create' => ("pro/c"),
            )
        );
    }

    /**
     * @param $arguments
     */
    public function Main($arguments, $request)
    {

        $role = (array)$this->role($arguments["id"]);
        $findByPk = 0;

        // Setting Url
        $url = null;
        if (!empty($arguments)) {
            $url = strtolower($arguments["action"] . '/' . $arguments["controller"]);
            if (isset($arguments["id"])) {
                $url .= '/' . $arguments["id"];
                $findByPk = $arguments["id"];
            }

        }


        switch ($url) {
            case $role["customer"]["list"]:
                /** Url customer_active_code.php?a=cus&con=l */
                echo $this->CustomerActive_List();
                break;

            case $role["customer"]["view"]:
                /** Url customer_active_code.php?a=cus&con=v&id=1 */
                $this->IssetValue($findByPk);
                echo $this->CustomerActive_View($findByPk);
                break;

            case $role["customer"]["create"]:
                /** Url customer_active_code.php?a=cus&con=c  */
                $this->IssetValue($request);
                $this->CustomerActive_Create($request);
                break;
            case $role["product"]["list"]:
                /** Url customer_active_code.php?a=pro&con=l  */
                echo $this->ProductActive_List();
                break;
            case $role["product"]["view"]:
                /** Url customer_active_code.php?a=pro&con=v&id=1  */
                $this->IssetValue($findByPk);
                echo $this->ProductActive_View($findByPk);
                break;
            case $role["product"]["create"]:
                /** Url customer_active_code.php?a=pro&con=c  */
                $this->IssetValue($request);
                $this->ProductActive_Create($request);
                break;
            default:
                /*if (isset($findByPk)) {
                    if ($arguments["action"] == "cus") {
                        echo $this->CustomerActive_View($findByPk);
                    } else if ($arguments["action"] == "pro") {
                        echo $this->ProductActive_View($findByPk);
                    } else {
                        echo "Error 404 Bad Request";
                    }
                }*/
                echo "Error 404 Bad Request";
                break;
        }

    }

    private function IssetValue($para)
    {
        if (empty($para)) {
            echo "Error 404 Bad Request";
            exit(0);
        }
    }


    /** Function CustomerActive */
    /**
     * @return string
     */
    public function CustomerActive_List()
    {
        $query = $this->prep_query("SELECT * FROM in_activate_license");
        $res = $this->query_result_array($query);
        return json_encode($res);
    }


    /**
     * Action $_GET['id'];
     * @param $id
     * @return string
     */
    public function CustomerActive_View($id)
    {
        $query = $this->prep_query("SELECT * FROM in_activate_license WHERE idActivateLicense_in = $id");
        $res = $this->query_result_array($query);
        return json_encode($res);
    }

    /**
     * Action $_POST[];
     * @param $arguments
     * @return string
     */
    public function CustomerActive_Create($arguments)
    {
        $cusID = (string)$arguments['customerID'];
        $cpuID = (string)$arguments['cpuID'];
        $hddID = (string)$arguments['harddiskID'];

        $sql = "INSERT INTO in_activate_license (customerID, cpuID, harddiskID) VALUES ('{$cusID}', '{$cpuID}', '{$hddID}')";
        $query = $this->prep_query($sql);

        if ((boolean)$query != 1) {
            return false;
        }

        header('Location: ../index.php');

        return true;
    }


    /** Function Product Active */

    /**
     * @return string
     */
    public function ProductActive_List()
    {
        $query = $this->prep_query("SELECT * FROM out_activate_license");
        $res = $this->query_result_array($query);
        return json_encode($res);
    }

    /**
     * Action $_GET['id'];
     * @param $id
     * @return string
     */
    public function ProductActive_View($id)
    {
        $query = $this->prep_query("SELECT * FROM out_activate_license WHERE idActivateLicenseOut = $id");
        $res = $this->query_result_array($query);
        return json_encode($res);
    }

    /**
     * Action $_POST[];
     * @param $arguments
     * @return string
     */
    public function ProductActive_Create($arguments)
    {
        $cusID = (string)$arguments['customerID'];
        $licenseID = (string)$arguments['licenseID'];
        $periodTime = (string)$arguments['periodTime'];

        $sql = "INSERT INTO out_activate_license (customerID, licenseID, periodTime) VALUES ('{$cusID}', '{$licenseID}', '{$periodTime}')";
        $query = $this->prep_query($sql);

        if ((boolean)$query != 1) {
            return false;
        }

        header('Location: ../index.php');

        return true;
    }


}


/** New Object */
$obj = new CustomerActiveCode();

// Variable
$arguments = array();

/** Check request $_GET values */
if (!empty($_GET)) {
    $action = ((string)$_GET["a"] == "pro") ? "pro" : "cus";
    $controller = (!empty($_GET['con'])) ? (string)$_GET['con'] : null;
    $id = (isset($_GET['id'])) ? (int)$_GET['id'] : null;

    $arguments["action"] = $action;
    $arguments["controller"] = $controller;
    $arguments["id"] = $id;

    /** Main Function */

    if (!empty($_POST)) {
        $obj->Main($arguments, $_POST);
    } else {
        $obj->Main($arguments, null);
    }

}

$obj->disconnection();