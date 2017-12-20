<?php
/**
 * Created by PhpStorm.
 * User: pichai
 * Date: 12/24/2016 AD
 * Time: 11:49 PM
 */
session_start();

if (empty($_GET["lang"]) && empty($_SESSION['lang'])) {

    $_SESSION["lang"] = "th";

} else if ($_GET["lang"] == "en" || $_GET["lang"] == "th") {

    $_SESSION["lang"] = $_GET["lang"];

}
//echo $_SESSION['lang'];

/**
 * @package load Config File
 **/
require_once 'config_database.inc.php';
require_once 'lnwphp/lnwphp.php';
require_once 'system2/lang.php';

$pLang = array();

foreach (pLang() as $indexLang => $keyLang) {
    if ($_SESSION["lang"] == $indexLang) {
        foreach ($keyLang as $itemLang => $valueLang) {
            $pLang[$indexLang][$itemLang] = (string)$valueLang;
        }
    }
}
@$pLang = $pLang[$_SESSION['lang']];

/**
 * @package load setting database
 **/
$lnwphp = lnwphp::get_instance();
$setting = $lnwphp->table_array('lp_setting');

/**
 * @package SET URL WEBSITE
 **/
define('URL', $setting->url_web);

/**
 * @package load system theme
 **/
require_once 'system2/_header.php';
require_once 'system2/_navbar.php';
require_once 'system2/_slidshow.php';


/**
 * @package get file in system
 **/
?>

    <!-- Content -->
    <div id="programs">
        <div class="container content">
            <div class="row">
                <div class="col-xs-12">
                    <form action="api/customer_active_code.php?a=cus&con=c" method="post" role="form">
                        <fieldset>
                            <legend><?php echo $pLang['customer_active_code']; ?></legend>

                            <div class="form-group">

                                <label for="customerID">
                                    <?php echo $pLang['customer_id']; ?>:
                                </label>
                                <input type="text" name="customerID" class="form-control" id="customerID"
                                       required maxlength="50" size="50"/>
                            </div>

                            <div class="form-group">

                                <label for="exampleInputPassword1">
                                    <?php echo $pLang['cup_id']; ?>:
                                </label>
                                <input type="text" id="cpuID" name="cpuID" class="form-control" required
                                       maxlength="50" size="50"/>
                            </div>

                            <div class="form-group">

                                <label for="harddiskID">
                                    <?php echo $pLang['harddisk_id']; ?>:
                                </label>
                                <input type="text" id="harddiskID" name="harddiskID" class="form-control"
                                       required maxlength="50" size="50"/>
                            </div>

                            <button type="submit" class="btn btn-primary pull-right">
                                Confirm Customer
                            </button>
                        </fieldset>
                    </form>
                    &nbsp;
                </div>

                <hr class="clearfix">

                <div class="col-xs-12">
                    <form action="api/customer_active_code.php?a=pro&con=c" method="post" role="form">
                        <fieldset>
                            <legend><?php echo $pLang['product_active_code']; ?></legend>

                            <form action="api/customer_active_code.php?a=pro&con=c" method="post"
                                  role="form">
                                <div class="form-group">

                                    <label for="customerID">
                                        <?php echo $pLang['customer_id']; ?>:
                                    </label>
                                    <input type="text" name="customerID" class="form-control"
                                           id="customerID"
                                           required maxlength="50" size="50"/>
                                </div>

                                <div class="form-group">

                                    <label for="exampleInputPassword1">
                                        <?php echo $pLang['license_id']; ?>:
                                    </label>
                                    <input type="text" id="licenseID" name="licenseID" class="form-control"
                                           required
                                           maxlength="50" size="50"/>
                                </div>

                                <div class="form-group">

                                    <label for="harddiskID">
                                        <?php echo $pLang['period_time']; ?>:
                                    </label>
                                    <input type="text" id="periodTime" name="periodTime"
                                           class="form-control"
                                           required maxlength="50" size="50"/>
                                </div>

                                <button type="submit" class="btn btn-success pull-right">
                                    Confirm Product
                                </button>
                            </form>
                        </fieldset>
                    </form>
                </div>e
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

<?php


require_once 'system2/_footer.php';