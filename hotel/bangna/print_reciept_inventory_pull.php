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

	$id_reciept_no = $_GET['id'];

	$sql  = "SELECT i.reciept_no,i.created, e.initial,e.first_name,e.last_name FROM inventory_pull i, employee e where i.created_by = e.id  and  i.reciept_no = '".$id_reciept_no."' ";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	    	$reciept_no = $row["reciept_no"];
	      $created = $row["created"];
	    	$nameBy = $row["initial"]." ".$row["first_name"]." ".$row["last_name"];
	    }
	}

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

  $sql_inventory_detail = "SELECT p.name as product_name, p.price, ide.quantity, (p.price * ide.quantity) as sum FROM inventory_pull_detail AS ide INNER JOIN product as p ON p.id = ide.product_id WHERE ide.inventory_pull_id = '".$id_reciept_no."' ";
  $result_inventory_detail = $conn->query($sql_inventory_detail);


  $sql_sum = "SELECT sum(p.price * ide.quantity) as sum FROM inventory_pull_detail AS ide INNER JOIN product as p ON p.id = ide.product_id WHERE ide.inventory_pull_id = '".$id_reciept_no."' ";
  $result_sum = $conn->query($sql_sum);
  if ($result_sum->num_rows > 0) {
    while($row = $result_sum->fetch_assoc()) {
      $sumAll = $row['sum'];
    }
  }

	$conn->close();
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
		เลขที่ (NO.)
	<span style="border-bottom: 2px dotted black;">
		&nbsp;&nbsp;<?=$reciept_no;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</span>
<div>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="291" align="center">
    	<span style="font-size: 25px;"><b><?=$com_name_th;?></b></span>
    </td>
  </tr>
  <tr>
    <td height="80" align="center">
    	<span><?=$com_address_th;?>
    	<br>โทร <?=$com_tel;?> แฟ๊กซ์ <?=$com_fax;?></span>
    </td>
  </tr>
  <tr>
    <td height="25" align="center">
    	<span style="font-size: 16px;">ใบเบิกของ
      </span>
    </td>
  </tr>
  <tr>
    <td height="25" align="right"><span>วันที่ (Date.) </span>
    	<span style="border-bottom: 2px dotted black;">
    		&nbsp;&nbsp;<?=$created;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	</span>
    </td>
  </tr>
  <tr>
    <td height="25" align="right"><span>ชื่อผู้เบิกของ</span>
    	<span style="border-bottom: 2px dotted black;">
    		&nbsp;&nbsp;&nbsp;&nbsp;<?=$nameBy;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	</span>
    </td>
  </tr>
  <tr height="25" >
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <table border="0" style="border-collapse: collapse;border: 1px solid black;">
        <thead>
            <tr role="row">
              <th width="300"  align="center" style="border: 1px solid black;">
                <span>ประเภท</span>
              </th>
              <th width="150"  align="center" style="border: 1px solid black;">
                <span>ราคาต่อหน่วย</span>
              </th>
              <th width="150"  align="center" style="border: 1px solid black;">
                <span>จำนวน</span>
              </th>
              <th width="150"  align="center" style="border: 1px solid black;">
                <span>ราคารวม</span>
              </th>
            </tr>
        </thead>
         <tbody>
          <?
          if ($result_inventory_detail->num_rows > 0) {
            while($row = $result_inventory_detail->fetch_assoc()) {
          ?>
              <tr class="text-left">
                  <td align="left" style="border: 1px solid black;"><?=$row['product_name'];?></td>
                  <td align="right" style="border: 1px solid black;"><?=$row['price'];?></td>
                  <td align="right" style="border: 1px solid black;"><?=$row['quantity'];?></td>
                  <td align="right" style="border: 1px solid black;"><?=$row['sum'];?></td>
              </tr>
          <? } } ?>
          </tbody>
      </table>
    </td>
  </tr>
 <tr height="25" >
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td height="25" align="left">
    	<span>รวมเป็นเงิน
    	<span style="border-bottom: 2px dotted black;">
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$sumAll;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	</span>
    	บาท/(Baht.)</span>
    </td>
  </tr>
  <tr>
    <td height="25" align="center"></td>
  </tr>
  <tr>
    <td height="25">
      <table border="0">
        <tr>
          <td align="left" width="350">
            <span>ลงชื่อผู้เบิกของ</span>
            <span style="border-bottom: 2px dotted black;">
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </span>
          </td>
          <td align="right" width="400">
            <span>ลงชื่อผู้อนุมัติ</span>
            <span style="border-bottom: 2px dotted black;">
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </span>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td height="25" align="center"></td>
  </tr>
  <tr>
    <td height="25" align="center"><span style="font-size: 20px;"><b><?=$com_name_en;?></b></span></td>
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
	$pdf->Output('recirpt_inventory.pdf', 'I');
?>