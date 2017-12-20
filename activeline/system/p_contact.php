<?php
if (isset($_POST["subject"]) && $_POST["subject"] != "") {
	$db = new lnwphp_dbpdo;
	$db->execute("INSERT INTO `lp_mail` (`name`, `email`, `subject`, `text`) VALUES (?, ?, ?, ?);",
		array(
			$_POST["name"],
			$_POST["email"],
			$_POST["subject"],
			$_POST["text"])
		);

	$strTo = $setting->email;
	$strSubject = $_POST["subject"];
	$strHeader = "Content-type: text/html; charset=UTF-8\r\n";
	$strHeader .= "From: ".$_POST["name"]."<".$_POST["email"].">\r\nReply-To: ".$_POST["email"]."";
	$strMessage = nl2br($_POST["text"]);
	$flgSend = @mail($strTo,$strSubject,$strMessage,$strHeader);
	if($flgSend)
	{
		$lp = '<div class="alert alert-success" role="alert">ส่งอีเมลถึงเจ้าหน้าที่เรียบร้อยแล้ว</div>';
	}
	else
	{
		$lp = '<div class="alert alert-danger" role="alert">ไม่สามารถส่งอีเมลได้</div>';
	}

}else{
	$lp = "";
}
?>
<div class="row pageshowmenu">
	
	<div class="col-md-3">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title font_bold">Facebook Fanpage</h3>
			</div>
			<div class="panel-body text-center">
				<div class="fb-page" data-href="<?php echo $setting->facebook_url;?>" data-width="100%" data-height="350" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore">lnwPHP Loading...</div></div>
			</div>
		</div>

	</div>

	<div class="col-md-9">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title font_bold">ติดต่อเรา</h3>
			</div>
			<div class="panel-body">

				<?php echo $lp;?>

				<form action="" method="post" class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-2 control-label">ชื่อผู้ติดต่อ</label>
						<div class="col-sm-10">
						<input type="text" name="name" class="form-control" placeholder="ชื่อผู้ติดต่อ" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">อีเมลผู้ติดต่อ</label>
						<div class="col-sm-10">
							<input type="email" name="email" class="form-control" placeholder="อีเมลผู้ติดต่อ" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">เรื่องที่จะติดต่อ</label>
						<div class="col-sm-10">
							<input type="text" name="subject" class="form-control" placeholder="เรื่องที่จะติดต่อ" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">ข้อความติดต่อ</label>
						<div class="col-sm-10">
							<textarea name="text" class="form-control" placeholder="เขียนข้อความติดต่อ *สำคัญมาก ชื่อ เบอร์ติดต่อ อีเมล" required ></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-success">ส่งข้อความถึงเรา</button>
						</div>
					</div>
				</form>
				<hr>
				<div id="map_canvas"></div>
				<p><?php echo $setting->address_1.' '.$setting->address_2.' Tel: '.$setting->tel.' Email: '.$setting->email;?></p>
			</div>
		</div>

	</div>

</div>

<script type="text/javascript">  
var map;
var GGM; 
function initialize() {
    GGM=new Object(google.maps); 
    var my_Latlng  = new GGM.LatLng(<?php echo $setting->map_to_mcu;?>);  
    var my_mapTypeId=GGM.MapTypeId.ROADMAP; 
    var my_DivObj=$("#map_canvas")[0];
    var myOptions = {  
        zoom: 17,
        center: my_Latlng , 
        mapTypeId:my_mapTypeId
    };  
    map = new GGM.Map(my_DivObj,myOptions);
      
    var my_Marker = new GGM.Marker({
        position: my_Latlng,
        map: map,
        draggable:true, 
        title:"คลิกลากเพื่อหาตำแหน่งจุดที่ต้องการ!" 
    });  
      
    GGM.event.addListener(my_Marker, 'dragend', function() {  
        var my_Point = my_Marker.getPosition();
        map.panTo(my_Point);    
        $("#lat_value").val(my_Point.lat());
        $("#lon_value").val(my_Point.lng());
        $("#zoom_value").val(map.getZoom()); 
    });       
  
    GGM.event.addListener(map, 'zoom_changed', function() {  
        $("#zoom_value").val(map.getZoom());  
    });  
  
}
$(function(){
    $("<script/>", {  
      "type": "text/javascript",  
      src: "http://maps.google.com/maps/api/js?v=3.2&sensor=false&language=th&callback=initialize"  
    }).appendTo("body");      
});  
</script> 