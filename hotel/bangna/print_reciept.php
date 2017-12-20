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

	$id_reservation = $_GET['id'];

	$sql  = "SELECT reciept_no, room_id, customer_id, DATE_FORMAT(end,'%d/%m/%Y') as end,DATE_FORMAT(start,'%d/%m/%Y') as start, FORMAT(price,0) as price, num_days, FORMAT((price * num_days),0) as sumNotDeposit, FORMAT(deposit,0) as deposit, amount as sumAll, description, used_deposit_old ";
	$sql .= " FROM reservation where id=".$id_reservation;

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	    	$reciept_no = $row["reciept_no"];
	    	$room_id = $row["room_id"];
	    	$customer_id = $row["customer_id"];
	    	$end = $row["end"];
        $start = $row["start"];
	    	$price = $row["price"];
	    	$num_days = $row["num_days"];
	    	$sumNotDeposit = $row["sumNotDeposit"];
        $used_deposit_old = $row['used_deposit_old'];
	    	$deposit = $row['deposit'];
	    	$sumAll = $row['sumAll'];
        $description = $row['description'];
	    }
	}

  $calDeposit = $deposit;

  if($used_deposit_old > 0){
    $calDeposit = $deposit - $used_deposit_old;
  }

	$sql_customer = "select c.initial, c.first_name, c.last_name, c.address,p.province, d.district, a.area, c.postal_code, c.home_phone, c.work_phone, c.mobile_phone from customer c left join province p on c.province_id = p.id left join district d on c.district_id = d.id left join area a on c.area_id = a.id where c.id=".$customer_id;
	$result_customer = $conn->query($sql_customer);
	if ($result_customer->num_rows > 0) {
		while($row = $result_customer->fetch_assoc()) {
			$first_name = $row['initial']." ".$row['first_name']." ".$row['last_name'];
			$address = $row['address'];
			$area = $row['area'];
			$district = $row['district'];
			$province = $row['province'];
			$postal_code = $row['postal_code'];
      $mobile_phone = $row['mobile_phone'];
      $work_phone = $row['work_phone'];
      $home_phone = $row['home_phone'];
		}
	}

	$sql_room = "select name from room where id=".$room_id;
	$result_room = $conn->query($sql_room);
	if ($result_room->num_rows > 0) {
		while($row = $result_room->fetch_assoc()) {
			$room_name = $row['name'];
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
    <td height="25" align="center">
    	<span><?=$com_address_th;?>
    	<br>โทร <?=$com_tel;?> แฟ๊กซ์ <?=$com_fax;?></span>
    </td>
  </tr>
  <tr>
    <td height="25" align="center">
    	<span style="font-size: 16px;">ใบรับเงินค่าเช่ารายวัน
      <br>Daily Rental Reciept
      </span>
    </td>
  </tr>
  <tr>
    <td height="25" align="right"><span>วันที่ (Date.) </span>
    	<span style="border-bottom: 2px dotted black;">
    		&nbsp;&nbsp;<?=date("d/m/Y");?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	</span>
    </td>
  </tr>
  <tr>
    <td height="25" align="right"><span>เลขที่ห้อง (Room No.)</span>
    	<span style="border-bottom: 2px dotted black;">
    		&nbsp;&nbsp;&nbsp;&nbsp;<?=$room_name;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	</span>
    </td>
  </tr>
  <tr>
    <td height="25" align="left"><span>ชื่อ-นามสกุล (First Last Name.)</span>
    	<span style="border-bottom: 2px dotted black;">
    		&nbsp;&nbsp;&nbsp;<?=$first_name;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	</span>
    </td>
  </tr>
  <tr>
    <td height="25" align="left"><span>ที่อยู่ (Address.)</span>
    	<span style="border-bottom: 2px dotted black;">
    	    <? if($address != "" || $area != "" || $district != "" || $province != "" || $postal_code != ""){
    	    	echo $address." ";
    	    	if($area != ""){
    	    		echo " ตำบล ".$area." ";
    	    	}
    	    	if($district != ""){
    	    		echo " อำเภอ ".$district." ";
    	    	}
    	    	if($province != ""){
    	    		echo " จังหวัด ".$province." ";
    	    	}
    	    	echo $postal_code;
    	    }else{?>
    	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	    <? } ?>

           <? if($home_phone !="" || $work_phone != "" || $mobile_phone != ""){?>
              <table border="0" width="1000">
                <tr><td height="30">
                <span style="border-bottom: 2px dotted black;">
                  <?
                if($home_phone != ""){
                  echo " เบอร์โทรศัพท์บ้าน ".$home_phone." ";
                }
                if($work_phone != ""){
                  echo " เบอร์โทรศัพท์ที่ทำงาน ".$work_phone." ";
                }
                if($mobile_phone != ""){
                  echo " เบอร์มือถือ ".$mobile_phone." ";
                }
                ?>
                </span>
                </td></tr>

              </table>
            <? } ?>
    	</span>
    </td>
  </tr>
  <tr>
    <td height="25" align="left">

      <span>วันที่เข้า (Check-in Date.)</span>
      <span style="border-bottom: 2px dotted black;">
        &nbsp;&nbsp;&nbsp;<?=$start?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </span>

      <span>วันที่ออก (Check-out Date.)</span>
      <span style="border-bottom: 2px dotted black;">
        &nbsp;&nbsp;&nbsp;<?=$end?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </span>
    </td>
  </tr>
  <tr>
    <td height="25" align="left">
    	<span>วันละ (Rate.)
    	<span style="border-bottom: 2px dotted black;">
    		&nbsp;&nbsp;&nbsp;<?=$price;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	</span>
    	บาท &nbsp;&nbsp;&nbsp;&nbsp;
    	จำนวน
    	<span style="border-bottom: 2px dotted black;">
    		&nbsp;&nbsp;&nbsp;<?=$num_days;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	</span>
    	วัน &nbsp;&nbsp;&nbsp;&nbsp;
    	เป็นเงิน
    	<span style="border-bottom: 2px dotted black;">
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$sumNotDeposit;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	</span>
    	บาท/(Baht.)</span>
    </td>
  </tr>
  <tr>
    <td height="25" align="left">
    	<span>
    		เงินประกัน (Deposit.)
    		<span style="border-bottom: 2px dotted black;">
	    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$calDeposit;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    	</span>
    		บาท/(Baht.) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	</span>
      <span>รวมเป็นเงิน
      <span style="border-bottom: 2px dotted black;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$sumAll;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </span>
      บาท/(Baht.)</span>
      </td>
  </tr>
  <tr>
    <td height="25" align="left">
    	<span>หมายเหตุ
    	<span style="border-bottom: 2px dotted black;">
      <? if($description != "") { ?>
    		&nbsp;&nbsp;&nbsp;&nbsp;<?=$description;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <? }else{ ?>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

      <? } ?>
    	</span></span>
    </td>
  </tr>
  <tr>
    <td height="50" align="center" width="100">
    	<span>ลงชื่อผู้รับเงิน</span>
    	<span style="border-bottom: 2px dotted black;">
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	</span>
    </td>
  </tr>
  <tr>
    <td height="25" align="center"><span>**ต้องย้ายออกภายในเวลา 12.00 น. / Check out time is 12.00 PM.</span></td>
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
	$pdf->Output('invoice.pdf', 'I');
?>