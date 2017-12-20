<div class="clearfix"></div>
<!--footer-->
<footer id="nav-footer">
    <nav class="container">
        <div class="row">
            <!-- Service -->
            <div class="col-xs-12 col-sm-4">
                <p>
                    <strong><?php echo $pLang["service"]; ?></strong>
                </p>
                <ul>
                    <li>
                        <a class="footer-email" href="register_customer.php" title="<?php echo $pLang['register_customer']; ?>">
                            <?php echo $pLang['register_customer']; ?>
                        </a>
                    </li>
                    <li>
                        <a class="footer-email" href="activecode.php" title="<?php echo $pLang['customer_active_code']; ?>">
                            <?php echo $pLang['customer_active_code']; ?> / <?php echo $pLang['product_active_code']; ?>
                        </a>
                    </li>
                </ul>

            </div>

            <!--Email-->
            <div class="col-xs-12 col-sm-4">
                <p>
                    <strong><?php echo $pLang["email"]; ?>: </strong>
                </p>
                <ul>
                    <li>
                        <a class="footer-email" href="mailto:<?php echo $setting->email; ?>">
                            <?php echo $setting->email; ?>
                        </a>
                    </li>
                    <?php if (!empty($setting->email2)): ?>
                        <li>
                            <a class="footer-email" href="mailto:<?php echo $setting->email2; ?>">
                                <?php echo $setting->email2; ?>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-xs-12 col-sm-4">
                <p>
                    <strong><?php echo $pLang["contact"]; ?>:</strong>
                </p>
                <address>
                    <?php echo ($_SESSION['lang'] == "th") ? $setting->address_1 : $setting->address_2; ?>
                    <br/><?php echo $pLang["tel"]; ?> <?php echo $setting->tel; ?><?php echo (!empty($setting->tel1)) ? ', ' . $setting->tel1 : ''; ?>
                    <br/><?php echo (!empty($setting->fax)) ? $pLang["fax"].' ' . $setting->fax : ''; ?>
                    <span class="pull-right">
                        <a href="<?php echo URL; ?>contact-ติดต่อ@ติดต่อเรา.html" class="btn btn-default btn-xs">
                            <strong>
                                Go to contact page
                                <i class="glyphicon glyphicon-circle-arrow-right"></i>
                            </strong>
                        </a>
                        <!--<a href="page3.html" class="btn btn-default btn-xs"><strong>Go to contact page <i
                                        class="glyphicon glyphicon-circle-arrow-right"></i></strong></a>-->
                    </span>
                </address>
                <!--<ul class="list-inline pull-right">
                    <li>
                        <a href="<?php /*echo URL */?>index.php?lang=th" role="link">
                            <img src="image/icon/thailand-flag-icon.jpg"
                                 width="24"
                                 alt="th"
                                 role="img">
                        </a>
                    </li>
                    <li>
                        <a href="<?php /*echo URL */?>index.php?lang=en" role="link">
                            <img src="image/icon/english-flag-icon.png"
                                 width="24"
                                 alt="en"
                                 role="img">
                        </a>
                    </li>
                </ul>-->
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <p class="text text-center">
                    <small>
                        บริษัท แอ็คทีฟไลน์ จำกัด เป็นตัวแทนจำหน่ายซอฟแวร์การวางแผนขนส่งสินค้า Maxload Pro และ Tops
                        Pro แต่เพียงผู้เดียวในประเทศไทย
                    </small>
                    <br/>
                    <small>©2016. P-Soft.asia</small>
                </p>
            </div>
        </div>
    </nav>
</footer>