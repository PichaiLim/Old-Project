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

    $sql  = "SELECT r.start, count(r.room_id) as total_room, sum(r.deposit) as total_deposit, sum(r.amount) as total_amount, sum(r.price) as total_price 
			FROM reservation AS r WHERE r.branch_id = {$branch} and r.status = 'checkout' and r.reciept_no != '' ";
    if(($start != "" && $endDate != "") ){
        $sql .= " and (r.start BETWEEN str_to_date('$start', '%Y-%m-%d') and str_to_date('$endDate', '%Y-%m-%d'))  ";
    }
    $sql .= " group by r.start order by r.start asc ";

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
    	<span style="font-size: 16px;">รายงานสรุปการเข้าพักรายวัน
      </span>
    </td>
  </tr>
  <tr>
    <td height="50" align="left">
    <? if($start != "" && $endDate != ""){ ?>
        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่ </span>
    	<span style="border-bottom: 2px dotted black;">
    		&nbsp;&nbsp;<?=$start;?>&nbsp;&nbsp;&nbsp;&nbsp;
    	</span>
        <span>ถึง </span>
        <span style="border-bottom: 2px dotted black;">
    		&nbsp;&nbsp;<?=$endDate;?>&nbsp;&nbsp;&nbsp;&nbsp;
    	</span>
    <? } ?>
    </td>
  </tr>
  
  <tr>
    <td>
         <table border="0" align="center"  style="border-collapse: collapse;border: 1px solid black;">
        <thead>
        <tr > 
            <th width="10" align="center" style="border: 1px solid black;">ลำดับ</th >
            <th width="200" align="center" style="border: 1px solid black;">วันที่</th >
            <th width="100" align="center" style="border: 1px solid black;">จำนวน</th >
            <th width="100" align="center" style="border: 1px solid black;">รายวัน</th >
            <th width="100" align="center" style="border: 1px solid black;">ประกัน</th >
            <th width="100" align="center" style="border: 1px solid black;">รวม</th >
        </tr >
        </thead>
        <tbody>  
        <?  
         $i = 1;
         if ($result->num_rows > 0) {
	        while($row = $result->fetch_assoc()) {
         ?>
        <tr>
            <td align="center" style="border: 1px solid black;"><?=$i;?></td>
            <td align="center" style="border: 1px solid black;" ><?=$row["start"];?></td >
            <td align="right" style="border: 1px solid black;"><?=$row["total_room"];?></td >
            <td align="right" style="border: 1px solid black;" ><?=$row["total_price"];?></td >
            <td align="right" style="border: 1px solid black;"><?=$row["total_deposit"];?></td>
            <td align="right" style="border: 1px solid black;" ><?=$row["total_amount"];?></td >
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
	$pdf->WriteHTML($html, 2);
	$pdf->Output('invoice.pdf', 'I');
    $conn->close();
?>