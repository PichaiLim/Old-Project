<!--header-->
<header>
    <div id="nav-header">
        <nav class="container">
            <div class="row">
                <div class="col-xs-8">
                    <small><i class="glyphicon glyphicon-user"></i> Contact us on <?php echo $setting->tel; ?> or <?php echo $setting->email; ?></small>
                </div>
                <div class="col-xs-4">
                    <ul class="list-inline pull-right">
                        <li class=" hidden-xs hidden-sm">
                            <small>Join Our Community <i class="glyphicon glyphicon-circle-arrow-right"></i></small>
                        </li>
                        <li>
                            <a class="nav-social-header" href="<?php echo $setting->facebook_url; ?>" target="_blank">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a class="nav-social-header" href="mailto:<?php echo $setting->email; ?>">
                                <i class="fa fa-envelope"></i>
                            </a>
                        </li>
                        <li class="clearfix"> | </li>
                        <li>
                            <a class="flag" href="<?php echo URL ?>index.php?lang=th" role="link">
                                <img src="image/icon/thailand-flag-icon.jpg"
                                     width="20"
                                     alt="th"
                                     role="img">
                            </a>
                        </li>
                        <li>
                            <a class="flag" href="<?php echo URL ?>index.php?lang=en" role="link">
                                <img src="image/icon/english-flag-icon.png"
                                     width="20"
                                     alt="en"
                                     role="img">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- Menu -->
    <nav class="navbar navbar-default" style="margin-bottom: 0;" data-spy="affix" data-offset-top="197">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo URL; ?>index.html">
                    <span><img alt="Brand" src="<?php echo URL; ?>image/<?php echo $setting->logo_website; ?>"
                               class="img-responsive pull-left"
                               width="64" style="position: relative; bottom: 12px;">&nbsp;<?php echo $setting->name_website; ?></span>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <!--<ul class="nav navbar-nav">
                    <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Link</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>-->
                <!--<form class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>-->
                <ul class="nav navbar-nav navbar-right">
                    <?php $navbar = $lnwphp->table_array_all('lp_page', "`show_page` = '0' AND (`position` = '0' OR `position` = '1')", '10'); ?>
                    <?php
                    for ($i = 0; $i < count($navbar); $i++) {
                        if ($navbar[$i]['url_link'] == '') {
                            $navbar[$i]['url_link'] = URL . 'page-' . $navbar[$i]['id'] . '@' . $lnwphp->re_url($navbar[$i]['name_page']) . '.html';
                        }

                        echo '<li><a href="' . $navbar[$i]['url_link'] . '">' . (($_SESSION["lang"] == "th") ? $navbar[$i]['name_page'] : ($navbar[$i]['name_page_eng'] == "") ? $navbar[$i]['name_page'] : $navbar[$i]['name_page_eng']) . '</a></li>';
                    }
                    ?>
                    <li>
                        <a href="<?php echo URL; ?>contact-ติดต่อ@ติดต่อเรา.html">
                            <?php echo $pLang['contact']; ?>
                        </a>
                    </li>
                    <!--<li><a href="page1.html">MaxLoad</a></li>
                    <li><a href="#">Tops</a></li>
                    <li><a href="#">Support</a></li>
                    <li><a href="page2.html">About Us</a></li>-->
                    <!--<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </li>-->
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>

<div class="clearfix"></div>