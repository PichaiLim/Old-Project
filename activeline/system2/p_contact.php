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
    $strHeader .= "From: " . $_POST["name"] . "<" . $_POST["email"] . ">\r\nReply-To: " . $_POST["email"] . "";
    $strMessage = nl2br($_POST["text"]);
    $flgSend = @mail($strTo, $strSubject, $strMessage, $strHeader);
    if ($flgSend) {
        $lp = '<div class="alert alert-success" role="alert">ส่งอีเมลถึงเจ้าหน้าที่เรียบร้อยแล้ว</div>';
    } else {
        $lp = '<div class="alert alert-danger" role="alert">ไม่สามารถส่งอีเมลได้</div>';
    }

} else {
    $lp = "";
}

$contactAddress = (($_SESSION['lang'] == "th") ? $setting->address_1 : ($setting->address_2 == "") ? $setting->address_1 : $setting->address_2);
$tel = ($setting->tel1 == "") ? $setting->tel : $setting->tel . ', ' . $setting->tel1;
$fax = ($setting->fax == "") ? "" : $pLang['fax'] . ' ' . $setting->fax;
?>

<!-- Content -->
<div id="programs">
    <div class="container content">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="page-header">Contact Us</h3>
            </div>
            <div class="col-xs-12 col-md-6">
                <p><strong>Address:</strong></p>
                <address>
                    <i class="glyphicon glyphicon-map-marker"></i> <?php echo $contactAddress; ?>
                    <br/><i class="glyphicon glyphicon-phone-alt"></i> <?php echo $pLang['tel'] . ' ' . $tel; ?>
                    <br/><i class="fa fa-fax"></i> <?php echo $fax; ?>
                </address>
                <p>
                    <strong>Email: </strong>
                    <a href="mailto:<?php echo $setting->email; ?>"><?php echo $setting->email; ?></a>
                    <?php if ($setting->email2 != ""): ?>
                        ,
                        <a href="mailto:<?php echo $setting->email2; ?>"><?php echo $setting->email2; ?></a>
                    <?php endif; ?>
                </p>

                <hr>

                <div class="text text-center">
                    <img id="map" src="image/demo/Active-Line-Map.jpg" data-src="http://placehold.it/550x290"
                         class="img-responsive" alt="...">&nbsp;
                    <!--<div id="map" class="img-t"></div>&nbsp;-->
                </div>
            </div>

            <div class="col-xs-12 col-md-6">
                <form action="#mail_contact" method="post" role="form">
                    <?php echo $lp; ?>
                    <fieldset>
                        <legend>ติดต่อเรา</legend>

                        <div class="form-group">
                            <label for="exampleInputName">Name:</label>
                            <input type="text" name="name" class="form-control" id="exampleInputName"
                                   placeholder="Full Name"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address:</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                   placeholder="Email"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputSubject">Subject:</label>
                            <input type="text" name="subject" class="form-control" id="exampleInputSubject"
                                   placeholder="Subject"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputMessage">Message:</label>
                            <textarea name="text"
                                      id="exampleInputMessage"
                                      class="form-control"
                                      cols="30"
                                      rows="5"
                                      placeholder="Message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-info btn-sm">
                            <i class="glyphicon glyphicon-send"></i>
                            Send Email
                        </button>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div id="map_canvas"></div>
            </div>
        </div>
    </div>
</div>

<div class="clearfix"></div>

<script type="text/javascript">
    var map;
    var GGM;
    function initialize() {
        GGM = new Object(google.maps);
        var my_Latlng = new GGM.LatLng(<?php echo $setting->map_to_mcu;?>);
        var my_mapTypeId = GGM.MapTypeId.ROADMAP;
        var my_DivObj = $("#map_canvas")[0];
        var myOptions = {
            zoom: 17,
            center: my_Latlng,
            mapTypeId: my_mapTypeId
        };
        map = new GGM.Map(my_DivObj, myOptions);

        var my_Marker = new GGM.Marker({
            position: my_Latlng,
            map: map,
            draggable: true,
            title: "คลิกลากเพื่อหาตำแหน่งจุดที่ต้องการ!"
        });

        GGM.event.addListener(my_Marker, 'dragend', function () {
            var my_Point = my_Marker.getPosition();
            map.panTo(my_Point);
            $("#lat_value").val(my_Point.lat());
            $("#lon_value").val(my_Point.lng());
            $("#zoom_value").val(map.getZoom());
        });

        GGM.event.addListener(map, 'zoom_changed', function () {
            $("#zoom_value").val(map.getZoom());
        });

    }
    $(function () {
        $("<script/>", {
            "type": "text/javascript",
            src: "http://maps.google.com/maps/api/js?v=3.2&sensor=false&language=th&callback=initialize"
        }).appendTo("body");
    });
</script>