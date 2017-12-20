<?php
	$servername = "localhost";
	$username = "psoftasi_bangna";
	$password = "CMNhINy7L";
	$dbname = "psoftasi_bangna";
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->set_charset('utf8');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$branch = $_GET['branch'];
    $start = $_GET['start'];
    $endDate = $_GET['endDate'];

    $sql  = "SELECT r.id,r.room_id,r.reciept_no ,r.status,r.start,r.end,r.payee,r.created,r.updated, r.deposit,r.amount, r.price , room.name AS 'room_name', c.initial, c.first_name, c.last_name FROM reservation AS r left JOIN room AS room ON room.id = r.room_id left JOIN customer AS c ON c.id = r.customer_id WHERE r.branch_id = {$branch} and r.status = 'checkout' and r.reciept_no != '' ";
    if(($start != "" && $endDate != "") ){
        $sql .= " and (r.start BETWEEN str_to_date('{$start}', '%Y-%m-%d') and str_to_date('{$endDate}', '%Y-%m-%d'))  ";
    }
    $sql .= " order by r.end asc ";
    

	$result = $conn->query($sql);

	$sql_company = "SELECT name_th, name_en, address_th, address_en, tel, fax FROM company limit 1";
    $result_company = $conn->query($sql_company);
    if ($result_company->num_rows > 0) {
        while($row = $result_company->fetch_assoc()) {
        $com_name_th = $row['name_th'];
        $com_name_en = $row['name_en'];
        $com_address_th = $row['address_th'];
        $com_address_en = $row['address_en'];
        $com_tel = $row['tel'];
        $com_fax = $row['fax'];
        }
    }

	require_once('mpdf/mpdf.php');
	ob_start();
?>

<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
</head>
<body>
<div>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="291" align="center">
    	<span style="font-size: 25px;"><b><?=$com_name_th;?></b></span>
    </td>
  </tr>
  <tr>
    <td height="25" align="center">
    	<span><?=$com_address_th;?>
    	<br>โทร <?=$com_tel;?> แฟ๊กซ์ <?=$com_fax;?></span>
    </td>
  </tr>
  <tr>
    <td height="50" align="center">
    	<span style="font-size: 16px;">รายงานการเข้าพักรายวัน
      </span>
    </td>
  </tr>
  <tr>
    <td height="50" align="left">
     <? if($start != "" && $endDate != ""){ ?>
        <span>วันที่ </span>
    	<span style="border-bottom: 2px dotted black;">
    		&nbsp;&nbsp;<?=$start;?>&nbsp;&nbsp;
    	</span>
        <span>ถึง </span>
        <span style="border-bottom: 2px dotted black;">
    		&nbsp;&nbsp;<?=$endDate;?>&nbsp;&nbsp;
    	</span>
     <? } ?>
    </td>
  </tr>
  
  <tr>
    <td>
    <div style=”page-break-after:always”>
         <table border="0" style="border-collapse: collapse;border: 1px solid black;">
        <thead>
        <tr > 
            <th width="10" align="center" style="border: 1px solid black;">ลำดับ</th >
            <th width="20" align="center" style="border: 1px solid black;">วันที่</th >
            <th width="100" align="center" style="border: 1px solid black;">เลขที่ใบเสร็จ</th >
            <th width="20" align="center" style="border: 1px solid black;">ห้อง</th >
            <th width="170" align="center" style="border: 1px solid black;">ชื่อ - สกุล</th >
            <th width="20" align="center" style="border: 1px solid black;">จำนวน</th >
            <th width="20" align="center" style="border: 1px solid black;">รายวัน</th >
            <th width="15" align="center" style="border: 1px solid black;">ประกัน</th >
            <th width="40" align="center" style="border: 1px solid black;">เชคเอ้า</th >
            <th width="15" align="center" style="border: 1px solid black;">รวม</th >
        </tr >
        </thead>
        <tbody>  
        <?  
         $i = 1;
         if ($result->num_rows > 0) {
	        while($row = $result->fetch_assoc()) {
         ?>
        <tr>
            <td style="border: 1px solid black;"><?=$i;?></td>
            <td style="border: 1px solid black;" ><?=$row["start"];?></td >
            <td style="border: 1px solid black;"><?=$row["reciept_no"];?></td >
            <td style="border: 1px solid black;" ><?=$row["room_name"];?></td >
            <td style="border: 1px solid black;">
                <? echo $row["initial"] ." ". $row["first_name"] ." ".$row["last_name"];?>
            </td>
            <td style="border: 1px solid black;" ><?=date_diff($row["start"],$row["end"]);?></td >
            <td style="border: 1px solid black;" ><?=$row["price"];?></td >
            <td style="border: 1px solid black;" ><?=$row["deposit"];?></td >
            <td style="border: 1px solid black;" ><?=$row["end"];?></td >
            <td align="left"  style="border: 1px solid black;" ><?=$row["amount"];?></td >
        </tr >
        <? $i++; 
        } } ?>
        <? if ($result->num_rows == 0) { ?>
        <tr >
            <td colspan="10" style="border: 1px solid black;" >ไม่พบข้อมูล</td>
        </tr>
        <? } ?>
        </tbody>
    </table>
    </div>
    </td>
  </tr>
  
  <tr>
    <td height="50" align="center"><span style="font-size: 20px;"><b><?=$com_name_en;?></b></span></td>
  </tr>
  <tr>
    <td height="25" align="center">
    	<span style="font-size: 16px;"><?=$com_address_en;?>
      <br>Tel. <?=$com_tel;?> Fax. <?=$com_fax;?>
    	</span>
    </td>
  </tr>
</table>
</div>
</body>
</html>
<?Php
	$html = ob_get_contents();
	ob_end_clean();
	$pdf = new mPDF('th', 'A4', '0', 'THSaraban','15','15','5','18');
	$pdf->SetAutoFont();
	$pdf->SetDisplayMode('fullpage');
    $pdf->list_indent_first_level = 0; 
    $mpdf->shrink_tables_to_fit = 1;
    $len = count($matches);
    $i = 1;
    foreach($matches as $value) {
        if ($i < $len) {
            $html .= "<div style='page-break-after:always'>" . $html . "</div>";
        } else {
            $html .= "<div style='page-break-after:avoid'>" . $html . "</div>";
        }
        $i++;
    }

	$pdf->WriteHTML($html, 2);
	$pdf->Output('invoice.pdf', 'I');
    $conn->close();
?>