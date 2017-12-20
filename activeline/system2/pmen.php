<article class="content">
    <h3 class="page-header">
        <?php echo $pLang['article']; ?>
    </h3>
    <?php
    if($_GET['page'] != "sub"){
        $article_show = $lnwphp->table_array_all('lp_sub_page', "`main_page_id` = '".$idpage."' AND `show_page` = '0'");
    }else{
        $sub = $lnwphp->table_array_all('lp_sub_page', "`id` = '".$idpage."' AND `show_page` = '0'");
        $article_show = $lnwphp->table_array_all('lp_sub_page', "`main_page_id` = '".$sub[0]['main_page_id']."' AND `show_page` = '0'");
//        echo"<per>";
//        print_r($article_show);
//        echo "</pre>";
    }

    ?>
    <ul>
        <?php
        for ($i = 0; $i < count($article_show); $i++):
            $articleName = (($_SESSION['lang'] == 'th') ? $article_show[$i]['name_page'] : ($article_show[$i]['name_page_eng'] == "") ? $article_show[$i]['name_page'] : $article_show[$i]['name_page_eng']);
            $urlLink = (($article_show[$i]['url_link'] == "") ? $_SERVER['REQUEST_URI'] : $article_show[$i]['url_link'].'-'.$article_show[$i]['id'].'@'.$article_show[$i]['name_page'].'.html');
            ?>
            <li>
                <a href="<?php echo $urlLink; ?>"
                   title="<?php echo $articleName; ?>"
                   role="link">
                    <?php echo $articleName; ?>
                </a>
            </li>
        <?php endfor; ?>
    </ul>
</article>

<div class="clearfix">&nbsp;</div>

<!--<article class="content">
    <h3 class="page-header">
        สิ่งที่เกี่ยวข้อง
    </h3>
    <ul>
        <li><a href="#" role="link">...</a></li>
        <li><a href="#" role="link">...</a></li>
        <li><a href="#" role="link">...</a></li>
        <li><a href="#" role="link">...</a></li>
        <li><a href="#" role="link">...</a></li>
        <li><a href="#" role="link">...</a></li>
        <li><a href="#" role="link">...</a></li>
        <li><a href="#" role="link">...</a></li>
    </ul>
</article>-->