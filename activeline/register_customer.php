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
                    <form action="api/customers.php" method="post">
                        <fieldset>
                            <legend><?php echo $pLang['register_customer']; ?></legend>

                            <div class="form-group">

                                <label for="customerName">
                                    <?php echo $pLang['customer_name']; ?>:
                                </label>
                                <input type="text" name="customerName" class="form-control" id="customerName"
                                       maxlength="50"
                                       size="50" required/>
                            </div>

                            <div class="form-group">

                                <label for="customerAddress">
                                    <?php echo $pLang['customer_address']; ?>:
                                </label>
                                <textarea name="customerAddress" class="form-control" id="customerAddress"
                                          required maxlength="255"></textarea>
                            </div>

                            <div class="form-group">

                                <label for="customerTel">
                                    <?php echo $pLang['customer_tel']; ?>:
                                </label>
                                <input type="tel" name="customerTel" class="form-control" id="customerTel"
                                       maxlength="20"
                                       size="20" required />
                            </div>

                            <div class="form-group">

                                <label for="customerFax">
                                    <?php echo $pLang['customer_fax']; ?>:
                                </label>
                                <input type="tel" name="customerFax" class="form-control" id="customerFax"
                                       maxlength="20"
                                       size="20" required />
                            </div>

                            <div class="form-group">

                                <label for="customerMobile">
                                    <?php echo $pLang['customer_mobile']; ?>:
                                </label>
                                <input type="tel" name="customerMobile" class="form-control" id="customerMobile"
                                       maxlength="20"
                                       size="20" required />
                            </div>

                            <div class="form-group">

                                <label for="contactName">
                                    <?php echo $pLang['customer_contact_name']; ?>:
                                </label>
                                <input type="text" name="contactName" class="form-control" id="contactName"
                                       maxlength="255"
                                       size="255" required />
                            </div>

                            <div class="form-group">

                                <label for="customerEmail">
                                    <?php echo $pLang['customer_email']; ?>:
                                </label>
                                <input type="email" name="customerEmail" class="form-control" id="customerEmail"
                                       maxlength="255"
                                       size="255" required />
                            </div>

                            <button type="submit" class="btn btn-primary pull-right">
                                Submit
                            </button>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

<?php
/*if (isset($_GET['id']) AND isset($_GET['page']) AND isset($_GET['name'])) {
    $idpage = $_GET['id'];
    require_once 'system/p_'.$_GET['page'].'.php';
}else{
    require_once 'system/_news.php';
    require_once 'system/_main.php';
}*/

require_once 'system2/_footer.php';
