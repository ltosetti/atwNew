<?php
$params = array();
$metas = array();
$params = $_GET;
// defaults
$params['url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";/*(isset($_GET['url']) ? $_GET['url'] : 'http://www.shaa.it');*/
$params['type'] = (isset($_GET['type']) ? $_GET['type'] : 'article');
if($params['c'] == "Ravenna"){
    $metas['image'] = "share_ravenna";
    $metas['title'] = "Il cacciatore e la regina di ghiaccio";
    $metas['description'] = $params['n']." sei come ".$params['c']." Ravenna, brillante ed appariscente, non ti piace passare inosservato/a. Guai a farti un torto, la vendetta è assicurata!";
    
} elseif  ($params['c'] == "Eric"){
    $metas['image'] = "share_eric";
    $metas['title'] = "Il cacciatore e la regina di ghiaccio";
    $metas['description'] = $params['n']." sei come ".$params['c'].", casual e pratico/a, sempre pronto/a ad aiutare gli altri. Meglio non dar fastidio alle persone che ami, perché ti scateni come una furia!";
    
} else {
    $metas['image'] = "share_freya";
    $metas['title'] = "Il cacciatore e la regina di ghiaccio";
    $metas['description'] = $params['n']." sei come ".$params['c'].", elegante e raffinata/o, non hai mai un capello fuori posto. Ma se qualcuno ti fa arrabbiare, è guerra senza esclusione ti colpi!";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title></title>        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <!-- Open Graph meta tags -->       
        <meta property="og:url" content="<?php echo $params['url']; ?>" />
        <meta property="og:type" content="<?php echo $params['type']; ?>"/>        
        <meta property="og:title" content="<?php echo $metas['title']; ?>"/>
        <meta property="og:image" content="http://www.shaa.it/demo/uci/images/<?php echo $metas['image']; ?>.jpg"/>
        <meta property="og:description" content="<?php echo $metas['description']; ?>"/>
         <!-- twitter meta tags -->
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="<?php echo $params['url']; ?>" />
        <meta name="twitter:title" content="<?php echo $metas['title']; ?>" />
        <meta name="twitter:description" content="<?php echo $metas['description']; ?>" />
        <meta name="twitter:image" content="http://www.shaa.it/demo/uci/images/<?php echo $metas['image']; ?>.jpg" />
        
        <meta name="description" content="<?php echo $metas['description']; ?>" />
        
        <meta itemprop="name" content="">        
        <meta itemprop="image" content="">
        <meta itemprop="description" content="<?php echo $metas['description']; ?>">
    </head>
    <body>
    <?php
        echo '<pre>';
            print_r($params);
            print_r($metas);
        echo '</pre>';
    ?>
    </body>   
</html>
