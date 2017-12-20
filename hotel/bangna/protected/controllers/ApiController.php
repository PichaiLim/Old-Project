<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/7/16
 * Time: 08:32
 */

class ApiController extends Controller
{
    // Members
    /**
     * Key which has to be in HTTP USERNAME and PASSWORD headers
     */
    Const APPLICATION_ID = 'ASCCPE';

    /**
     * Default response format
     * either 'json' or 'xml'
     */
    private $format = 'json';

    /**
     * var DateTimeNow = new Exception('NOW()');
     * var Get user id = Yii::app()->user->id;
    */
    private function dateTimeNow(){
        return new Exception('NOW()');
    }

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array();
    }

    public function actions()
    {
        return array(
//            'index'=>'application.controllers.api.IndexAction',
        );
    }

    // Actions
    public function actionIndex(){
        echo "Hello API";
    }


    public function actionList()
    {
        // Get the respective model instance
        switch($_GET['model'])
        {
            case 'province':
                $models = Province::model()->findAll();
                break;
            case 'product':
                $models = Product::model()->findAll();
                break;
            case 'district':
                $models = District::model()->findAll();
                break;
            case 'area':
                 $models = Area::model()->findAll();
                break;
            case 'postal_code':
                $models = Area::model()->findAll();
                break;

            case 'product':
                $models = Product::model()->findAll();
                break;

            case 'employee':
                $models = Employee::model()->findAll();
                break;
            case 'employee_branch':
                $models = EmployeeBranch::model()->findAll();
                break;
            case 'employee_type':
                $models = EmployeeType::model()->findAll();
                break;

            case 'customer':
                $models = Customer::model()->findAll();
                break;

            case 'custometLimitShow':
                $criteria = new CDbCriteria;
                $criteria->select = "t.id, t.initial, t.first_name, t.last_name, t.deposit";
                $criteria->limit = 5;
                $criteria->order = "t.id desc";
                $models = Customer::model()->findAll($criteria);
                break;


            case 'branch':
                $models = Branch::model()->findAll();
                break;
            case 'building':
                $models = Building::model()->findAll();
                break;
            case 'room':
                $models = Room::model()->findAll();
                break;
            case 'roomtype':
                $models = RoomType::model()->findAll();
                break;
            case 'floor':
                $models = Floor::model()->findAll();
                break;
            default:
                // Model not implemented error
                $this->_sendResponse(501, sprintf(
                    'Error: Mode <b>list</b> is not implemented for model <b>%s</b>',
                    $_GET['model']) );
                Yii::app()->end();
        }
        // Did we get some results?
        if(empty($models)) {
            // No
            $this->_sendResponse(200,
                sprintf('No items where found for model <b>%s</b>', $_GET['model']) );
        } else {
            // Prepare response
            $rows = array();
            foreach($models as $model)
                $rows[] = $model->attributes;
            // Send the response
            header('Content-type: application/json');
            $this->_sendResponse(200, CJSON::encode($rows));
            Yii::app()->end();
        }
    }


    public function actionView()
    {

        // Check if id was submitted via GET
        if(!isset($_GET['id']))
            $this->_sendResponse(500, 'Error: Parameter <b>id</b> is missing' );

        switch($_GET['model'])
        {
            // Find respective model
            case 'province':
                $model = Province::model()->findByPk($_GET['id']);
                break;
            case 'district':
                $model = District::model()->findAllByAttributes(array('province_id'=>"{$_GET['id']}"));
                break;
            case 'districtByPK':
                $model = District::model()->findAllByAttributes(array('id'=>"{$_GET['id']}"));
                break;
            case 'areaByPk':
                $model = Area::model()->findAllByAttributes(array('id'=>"{$_GET['id']}"));
                break;
            case 'area':
                $model = Area::model()->findAllByAttributes(array('district_id'=>"{$_GET['id']}"));
                break;
            case 'postal_code':
                $model = PostalCode::model()->findAllByAttributes(array('area_id'=>$_GET['id']));
                break;

            case 'employee':
                $model = Employee::model()->findByPk($_GET['id']);
                break;
            case 'reservationByPk':
                $model = Reservation::model()->findByPk($_GET['id']);
                break;
            case 'employee_type':
                $sql = "SELECT t.id,t.created, (select e.username from employee e where e.id=t.created_by) as created_by, t.updated, (select e.username from employee e where e.id=t.updated_by) as updated_by, t.name,t.remark FROM employee_type t where t.id = {$_GET['id']}";
                $model = Yii::app()->db->createCommand($sql)->queryRow();
                break;

            case 'employee_branch_edit':
                $sql = "select * from employee_branch";
                $sql .= " where  employee_id = {$_GET['id']}";
                $model = Yii::app()->db->createCommand($sql)->queryALL();
                break;

            case 'customer':
                $model = Customer::model()->findByPk($_GET['id']);
                break;

            case 'customerFind':
                $data = $_GET['id'];
                $sql = "SELECT c.id, c.first_name, c.last_name ";
                $sql .= "FROM customer AS c ";
                $sql .= "WHERE c.first_name LIKE '%{$data}%'";
                $sql .= "ORDER BY c.id DESC ";
                $sql .= "LIMIT 5";
                $model = Yii::app()->db->createCommand($sql)->queryALL();
                break;

            case 'validateEmailAndName':
                $data = $_GET['id'];
                $sql = "SELECT email,first_name,last_name ";
                $sql .= " FROM employee ";
                $sql .= " WHERE id = {$data} ";
                $model = Yii::app()->db->createCommand($sql)->queryRow();
                break;

            case 'depositInCustomerByPK':
                $sql = "SELECT deposit ";
                $sql .= " FROM customer ";
                $sql .= " WHERE id = {$_GET['id']} ";
                $model = Yii::app()->db->createCommand($sql)->queryRow();
                break;

            case 'verifyRecieptNo':
                $sql = "SELECT reciept_no ";
                $sql .= " FROM inventory_push ";
                $sql .= " WHERE reciept_no = '{$_GET['id']}' ";
                $model = Yii::app()->db->createCommand($sql)->queryRow();
                break;

            case 'product':
                $model = Product::model()->findByPk($_GET['id']);
                break;
            case 'inventory':
                $sql = "SELECT  i.*,
                                (select e.username from employee e where e.id=i.pushed_by) as pushed_by,
                                (select e.username from employee e where e.id=i.pulled_by) as pulled_by,
                                p.id as 'product_id',
                                p.name as 'product_name',
                                p.unit as 'product_unit',
                                b.name as 'branch_name' ";
                $sql .= "FROM inventory AS i ";
                $sql .= "INNER JOIN product as p ON p.id = i.product_id
                         INNER JOIN branch  as b ON b.id = i.branch_id ";
                $sql .= "WHERE i.branch_id = {$_GET['id']} ";

                $model = Yii::app()->db->createCommand($sql)->queryALL();
                break;
            case 'inventory_push':
                $sql = "SELECT  i.reciept_no, i.created, (select e.username from employee e where e.id=i.created_by) as created_by";
                $sql .= " FROM inventory_push i ";
                $sql .= " ORDER BY i.created DESC";

                $model = Yii::app()->db->createCommand($sql)->queryALL();
                break;

            case 'inventory_push_detail_list':

                $sql = "SELECT p.name as product_name, p.price, ide.quantity, (p.price * ide.quantity) as sum FROM inventory_push_detail AS ide INNER JOIN product as p ON p.id = ide.product_id WHERE ide.inventory_push_id = '{$_GET['id']}' ";
                $model = Yii::app()->db->createCommand($sql)->queryALL();
                break;

            case 'inventory_pull':
                $sql = "SELECT  i.reciept_no, i.created, (select e.username from employee e where e.id=i.created_by) as created_by";
                $sql .= " FROM inventory_pull i ";
                $sql .= " ORDER BY i.created DESC";

                $model = Yii::app()->db->createCommand($sql)->queryALL();
                break;

            case 'inventory_pull_detail_list':

                $sql = "SELECT p.name as product_name, p.price, ide.quantity, (p.price * ide.quantity) as sum FROM inventory_pull_detail AS ide INNER JOIN product as p ON p.id = ide.product_id WHERE ide.inventory_pull_id = '{$_GET['id']}' ";
                $model = Yii::app()->db->createCommand($sql)->queryALL();
                break;

            case 'paymentList':
                $sql = "SELECT ro.name as 'room_name', b.name as 'building_name', c.initial, c.first_name,c.last_name, r.num_days, r.price,r.deposit,r.status, r.payee, r.id,
                        (CASE
                             WHEN (r.deposit_with_me > 0) THEN 'ฝากเงิน'
                                                          ELSE 'ไม่ได้ฝากเงิน'
                        END) as deposit_with_me FROM reservation r, room ro, building b, customer c WHERE r.room_id = ro.id and r.building_id = b.id and r.customer_id = c.id and r.paid_status = 'yes' and r.branch_id = {$_GET['id']}";
                $model = Yii::app()->db->createCommand($sql)->queryALL();
                break;

            case 'reservation':
                $sql  = "SELECT r.id,r.room_id,r.status,r.start,r.end,r.payee,r.created,r.updated,
                        (select e.username from employee e where e.id=r.created_by) as created_by,
                        (select e.username from employee e where e.id=r.updated_by) as updated_by,
                        b.name AS 'branch_name',
                        bu.name AS 'building_name',
                        f.name AS 'floor_name',
                        room.name AS 'room_name',
                        c.initial, c.first_name, c.last_name ";
                $sql .= "FROM reservation AS r ";
                $sql .= "INNER JOIN branch AS b ON b.id = r.branch_id ";
                $sql .= "INNER JOIN building AS bu ON bu.id = r.building_id ";
                $sql .= "INNER JOIN floor AS f ON f.id = r.floor_id ";
                $sql .= "INNER JOIN room AS room ON room.id = r.room_id ";
                $sql .= "INNER JOIN customer AS c ON c.id = r.customer_id ";
                $sql .= "WHERE r.branch_id = {$_GET['id']} and r.status in ('checkin', 'reserved')";

                $model = Yii::app()->db->createCommand($sql)->queryALL();
                break;
            case 'reservation_history':
                $sql  = "SELECT r.id,r.room_id,r.status,r.start,r.end,r.payee,r.created,r.updated,
                        (select e.username from employee e where e.id=r.created_by) as created_by,
                        (select e.username from employee e where e.id=r.updated_by) as updated_by,
                        b.name AS 'branch_name',
                        bu.name AS 'building_name',
                        f.name AS 'floor_name',
                        room.name AS 'room_name',
                        c.initial, c.first_name, c.last_name ";
                $sql .= " FROM reservation AS r ";
                $sql .= " INNER JOIN branch AS b ON b.id = r.branch_id ";
                $sql .= "INNER JOIN building AS bu ON bu.id = r.building_id  ";
                $sql .= "INNER JOIN floor AS f ON f.id = r.floor_id ";
                $sql .= "INNER JOIN room AS room ON room.id = r.room_id ";
                $sql .= "INNER JOIN customer AS c ON c.id = r.customer_id ";
                $sql .= "WHERE r.branch_id = {$_GET['id']} ";
                $sql .= " order by r.created desc";

                $model = Yii::app()->db->createCommand($sql)->queryALL();
                break;
            case 'reservation_history_more':
                $sql  = "SELECT r.id as reservationHistoryId, r.reservation_id as reservationId,r.room_id,r.status,r.start,r.end,r.payee,r.created,r.updated,
                        (select e.username from employee e where e.id=r.created_by) as created_by,
                        (select e.username from employee e where e.id=r.updated_by) as updated_by,
                        b.name AS 'branch_name',
                        bu.name AS 'building_name',
                        f.name AS 'floor_name',
                        room.name AS 'room_name',
                        c.initial, c.first_name, c.last_name ";
                $sql .= " FROM reservation_history AS r ";
                $sql .= " INNER JOIN branch AS b ON b.id = r.branch_id ";
                $sql .= "INNER JOIN building AS bu ON bu.id = r.building_id  ";
                $sql .= "INNER JOIN floor AS f ON f.id = r.floor_id ";
                $sql .= "INNER JOIN room AS room ON room.id = r.room_id ";
                $sql .= "INNER JOIN customer AS c ON c.id = r.customer_id ";
                $sql .= "WHERE r.reservation_id = {$_GET['id']} ";
                $sql .= " order by r.created desc";

                $model = Yii::app()->db->createCommand($sql)->queryALL();
                break;

            case 'addInventoryNotProductByBranchID':
                $sql = "SELECT id,name,price,unit FROM product where id not in (select product_id from inventory where branch_id = {$_GET['id']}) and active = '1'" ;
                $model = Yii::app()->db->createCommand($sql)->queryALL();
                break;

            case 'branch':
                $model = Branch::model()->findByPk($_GET['id']);
                break;
            case 'branchByEmployeeID':
                $model = Branch::model()->findAllByAttributes(array('employee_id'=>$_GET['id']));
                break;

            case 'building':
                $model = Building::model()->findByPk($_GET['id']);
                break;
            case 'buildingByBranchID':
                $model = Building::model()->findAllByAttributes(array('branch_id'=>$_GET['id']));
                break;

            case 'room':
                $sql = "SELECT r.*,
                        b.name AS 'branch_name',
                        buil.name AS 'building_name',
                        f.name AS 'floor_name',
                        rt.name AS 'roomTypeName',
                        rt.price AS 'roomTypePrice',
                        rt.deposit AS 'roomTypeDeposit' ";
                $sql .= "FROM room AS r ";
                $sql .= "INNER JOIN branch AS b ON b.id = r.branch_id ";
                $sql .= "INNER JOIN building AS buil ON buil.id = r.building_id ";
                $sql .= "INNER JOIN floor AS f ON f.id = r.floor_id ";
                $sql .= "INNER JOIN room_type AS rt ON rt.branch_id = b.id ";
                $sql .= "WHERE r.id = {$_GET['id']} ";
                $sql .= "GROUP BY r.id";

                $model = Yii::app()->db->createCommand($sql)->queryRow();
                break;

            case 'roomName':

                $sql = "SELECT rt.name FROM room r, room_type rt " ;
                $sql .= "where r.room_type_id = rt.id and r.id = {$_GET['id']}";

                $model = Yii::app()->db->createCommand($sql)->queryRow();
                break;

            case 'roomOnReservice':
                $sql    = " SELECT room.name AS 'RoomName',
                            floor.name AS 'FloorName',
                            customer.first_name AS 'CustomerFirstName',
                            customer.last_name AS 'CustomerLastName',
                            customer.deposit AS 'CustomerDeposit',
                            branch.name AS 'BranchName',
                            building.name AS 'BuildingName',
                            reservation.*,
                            room_type.id AS 'RoomTypeId',
                            room_type.name AS 'RoomTypeName' ";
                $sql    .= "FROM room ";
                $sql    .= "INNER JOIN reservation ON reservation.room_id = room.id
                            INNER JOIN branch ON branch.id = room.branch_id
                            INNER JOIN building ON building.id = room.building_id
                            INNER JOIN floor ON floor.id = room.floor_id
                            INNER JOIN customer ON customer.id = reservation.customer_id
                            INNER JOIN room_type ON room_type.branch_id = branch.id ";
                $sql    .= "WHERE room.id = {$_GET['id']} ";
                $sql    .= "GROUP BY room.id;";

                $model = Yii::app()->db->createCommand($sql)->queryALL();
//                $model = Room::model()->findByPk($_GET['id']);
                break;
            case 'roomByBranchID':
                $model = Room::model()->findAllByAttributes(array('branch_id'=>$_GET['id']));
                break;
            case 'roomtype':
                $model = RoomType::model()->findByPk($_GET['id']);
                break;
            case 'roomtypeByBranchID':
                $model = RoomType::model()->findAllByAttributes(array('branch_id'=>$_GET['id']));
                break;
            case 'floor':
                $model = Floor::model()->findAllByAttributes(array('branch_id'=>$_GET['id']));
                break;
            case 'floorByPK':
                $model = Floor::model()->findByPk($_GET['id']);
                break;
            default:
                $this->_sendResponse(501, sprintf(
                    'Mode <b>view</b> is not implemented for model <b>%s</b>',
                    $_GET['model']) );
                Yii::app()->end();
        }
        // Did we find the requested model? If not, raise an error
        $response = array();
        $response['id'] = $_GET['id'];
        $response['model'] = $model;

        if(is_null($model))
            $this->_sendResponse(404, 'No Item found with id '.$_GET['id']);
        else
            $this->_sendResponse(200, CJSON::encode($model));
    }


    public function actionCreate()
    {
        switch($_GET['model'])
        {
            // Get an instance of the respective model

            case 'employee_branch':
                $model = new EmployeeBranch;
                break;

            case 'room':
                $model = new Room;
                $model->created = $this->dateTimeNow();
                break;
            case 'roomtype':
                $model = new RoomType;
                $model->created =$this->dateTimeNow();
                break;
            default:
                $this->_sendResponse(501,
                    sprintf('Mode <b>create</b> is not implemented for model <b>%s</b>',
                        $_GET['model']) );
                Yii::app()->end();
        }


        // Try to assign POST values to attributes
        foreach($_POST as $var=>$value) {
            // Does the model have this attribute? If not raise an error
            if ($model->hasAttribute($var)) {
                $model->$var = $value;
            }
            else
            {
                $this->_sendResponse(500,
                    sprintf('Parameter <b>%s</b> is not allowed for model <b>%s</b>', $var,
                        $_GET['model']) );
            }
        }

        // Try to save the model
        if($model->save())
            $this->_sendResponse(200, CJSON::encode($model));
        else {
            // Errors occurred
            $msg = "<h1>Error</h1>";
            $msg .= sprintf("Couldn't create model <b>%s</b>", $_GET['model']);
            $msg .= "<ul>";
            foreach($model->errors as $attribute=>$attr_errors) {
                $msg .= "<li>Attribute: $attribute</li>";
                $msg .= "<ul>";
                foreach($attr_errors as $attr_error)
                    $msg .= "<li>$attr_error</li>";
                $msg .= "</ul>";
            }
            $msg .= "</ul>";
            $this->_sendResponse(500, $msg );
        }
    }


    public function actionUpdate($msg)
    {
        // Parse the PUT parameters. This didn't work: parse_str(file_get_contents('php://input'), $put_vars);
        $json = file_get_contents('php://input'); //$GLOBALS['HTTP_RAW_POST_DATA'] is not preferred: http://www.php.net/manual/en/ini.core.php#ini.always-populate-raw-post-data
        $put_vars = CJSON::decode($json,true);  //true means use associative array

        switch($_GET['model'])
        {
            // Find respective model
            case 'room':
                $model = Room::model()->findByPk($_GET['id']);
                break;
            case 'roomtype':
                $model = RoomType::model()->findByPk($_GET['id']);
                $model->updated = new Exception('NOW()');
                break;
            default:
                $this->_sendResponse(501,
                    sprintf( 'Error: Mode <b>update</b> is not implemented for model <b>%s</b>',
                        $_GET['model']) );
                Yii::app()->end();
        }
        // Did we find the requested model? If not, raise an error
        if($model === null)
            $this->_sendResponse(400,
                sprintf("Error: Didn't find any model <b>%s</b> with ID <b>%s</b>.",
                    $_GET['model'], $_GET['id']) );

        // Try to assign PUT parameters to attributes
        foreach($put_vars as $var=>$value) {
            // Does model have this attribute? If not, raise an error
            if($model->hasAttribute($var))
                $model->$var = $value;
            else {
                $this->_sendResponse(500,
                    sprintf('Parameter <b>%s</b> is not allowed for model <b>%s</b>',
                        $var, $_GET['model']) );
            }
        }
        // Try to save the model
        if($model->save())
            $this->_sendResponse(200, CJSON::encode($model));
        else
            // prepare the error $msg
            // see actionCreate
            // ...
            $this->_sendResponse(500, $msg );
    }

    protected function beforeSave()
    {
        // author_id may have been posted via API POST
        if(is_null($this->author_id) or $this->author_id=='')
            $this->author_id=Yii::app()->user->id;
    }

    public function actionDelete()
    {
        switch($_GET['model'])
        {
            // Load the respective model
            case 'employee':
                $model = Employee::model()->findByPk($_GET['id']);
                break;
            case 'employee_branch':
                $model = EmployeeBranch::model()->findAllByAttributes(array('employee_id'=>$_GET['id']));
                break;
            case 'employee_type':
                $model = EmployeeType::model()->findByPk($_GET['id']);
                break;
            case 'customer':
                $model = Customer::model()->findByPk($_GET['id']);
                break;
            case 'product':
                $model = Product::model()->findByPk($_GET['id']);
                break;
            case 'branch':
                $model = Branch::model()->findByPk($_GET['id']);
                break;
            case 'building':
                $model = Building::model()->findByPk($_GET['id']);
                break;
            case 'room':
                $model = Room::model()->findByPk($_GET['id']);
                break;
            case 'roomtype':
                $model = RoomType::model()->findByPk($_GET['id']);
                break;
            case 'floor':
                $model = Floor::model()->findByPk($_GET['id']);
                break;
            default:
                $this->_sendResponse(501,
                    sprintf('Error: Mode <b>delete</b> is not implemented for model <b>%s</b>',
                        $_GET['model']) );
                Yii::app()->end();
        }
        // Was a model found? If not, raise an error
        if($model === null)
            $this->_sendResponse(400,
                sprintf("Error: Didn't find any model <b>%s</b> with ID <b>%s</b>.",
                    $_GET['model'], $_GET['id']) );

        // Delete the model
        $num = $model->delete();
        if($num>0)
            $this->_sendResponse(200, $num);    //this is the only way to work with backbone
        else
            $this->_sendResponse(500,
                sprintf("Error: Couldn't delete model <b>%s</b> with ID <b>%s</b>.",
                    $_GET['model'], $_GET['id']) );
    }

    private function _sendResponse($status = 200, $body = '', $content_type = 'text/html')
    {
        // set the status
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
        header($status_header);
        // and the content type
        header('Content-type: ' . $content_type);

        // pages with body are easy
        if($body != '')
        {
            // send the body
            echo $body;
        }
        // we need to create the body if none is passed
        else
        {
            // create some body messages
            $message = '';

            // this is purely optional, but makes the pages a little nicer to read
            // for your users.  Since you won't likely send a lot of different status codes,
            // this also shouldn't be too ponderous to maintain
            switch($status)
            {
                case 401:
                    $message = 'You must be authorized to view this page.';
                    break;
                case 404:
                    $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
                    break;
                case 500:
                    $message = 'The server encountered an error processing your request.';
                    break;
                case 501:
                    $message = 'The requested method is not implemented.';
                    break;
            }

            // servers don't always have a signature turned on
            // (this is an apache directive "ServerSignature On")
            $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];

            // this should be templated in a real-world solution
            $body = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
</head>
<body>
    <h1>' . $this->_getStatusCodeMessage($status) . '</h1>
    <p>' . $message . '</p>
    <hr />
    <address>' . $signature . '</address>
</body>
</html>';

            echo $body;
        }
        Yii::app()->end();
    }

    private function _getStatusCodeMessage($status)
    {
        // these could be stored in a .ini file and loaded
        // via parse_ini_file()... however, this will suffice
        // for an example
        $codes = Array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported'
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }
}