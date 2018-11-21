<?php

error_reporting( E_ALL );
ini_set( "display_errors", 1 );

include_once "models/Page_Data.class.php";
$pageData = new Page_Data();
$pageData->title = "Public Part";
$pageData->addCSS("css/blog.css");
$pageData->content = include_once "views/navigation-html.php";

$dbInfo = "mysql:host=localhost;dbname=simple_blog;charset=utf8";
$dbUser = "root";
$dbPassword = "0000";
$db = new PDO( $dbInfo, $dbUser, $dbPassword );
$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

$pageRequested = isset( $_GET['page'] );
$controller = "blog";
if ( $pageRequested ) {
    if ( $_GET['page'] === "search" ) {
        $controller = "search";
    }
}

$pageData->content .= include_once "views/search-form-html.php";

$pageData->content .= include_once "controllers/$controller.php";

$page = include_once "views/page.php";
echo $page;