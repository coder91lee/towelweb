<?php
//define('HTTP', $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/');
define('HTTP', $_SERVER['HTTP_HOST'].'/');
define('TOWEL_ASSETS_CDN','http://towelassets.local/');
define('TOWEL_STATIC_CDN','http://towelstatic.local/');
define('TOWEL_ASSETS_DIR','C:\xampp\htdocs\towelweb/assets/');
define('TOWEL_STATIC_DIR','C:\xampp\htdocs\towelweb/public/');

define('HTTP_SERVER', 'http://'.HTTP);
define('HTTP_IMAGE', 'http://'.HTTP.'image/');
define('HTTP_ADMIN', 'http://'.HTTP.'admin/');
define('HTTP_DOWNLOAD', 'http://'.HTTP.'download/');
define('PAGE_NAME', 'TOWEL');
define('PAGE_SEO', 'Trang app miễn phí cho Android, IOS, Java, Windows Phone, Blackberry');
define('NEW_CATE_SEO','Ứng dụng mới nhất');
define('HOT_CATE_SEO','Ứng dụng hot nhất');
define('DOWN_CATE_SEO','Ứng dụng tải nhiều nhất');
define('SEARCH_SEO','Tìm kiếm ứng dụng');
define('USER_SEO','Trang cá nhân');

// HTTPS
define('HTTPS_SERVER', 'http://'.HTTP);
define('HTTPS_IMAGE', 'http://'.HTTP.'image/');

// DIR
define('BASE_DIR', realpath(dirname(__FILE__)));
define('DIR_APPLICATION', BASE_DIR.'/catalog/');
define('DIR_SYSTEM', BASE_DIR.'/system/');
define('DIR_DATABASE', BASE_DIR.'/system/database/');
define('DIR_LANGUAGE', BASE_DIR.'/catalog/language/');
define('DIR_TEMPLATE', BASE_DIR.'/catalog/view/theme/');
define('DIR_CONFIG', BASE_DIR.'/system/config/');
define('DIR_IMAGE', BASE_DIR.'/image/');
define('DIR_CACHE', BASE_DIR.'/system/cache/');
define('DIR_DOWNLOAD', BASE_DIR.'/download/');
define('DIR_LOGS', BASE_DIR.'/system/logs/');

//DIR_TOWEL
define('DIR_IMAGE_TOWEL_SMALL', TOWEL_STATIC_DIR.'/towel/small/');
define('DIR_IMAGE_TOWEL_BIG', TOWEL_STATIC_DIR.'/towel/big/');
define('DIR_IMAGE_TOWEL_CATE_SMALL', TOWEL_STATIC_DIR.'/towel-cate/small/');
define('DIR_IMAGE_TOWEL_CATE_BIG', TOWEL_STATIC_DIR.'/towel-cate/big/');
define('DIR_IMAGE_HOME_IMAGE_SMALL', TOWEL_STATIC_DIR.'/home-image/small/');
define('DIR_IMAGE_HOME_IMAGE_BIG', TOWEL_STATIC_DIR.'/home-image/big/');
define('DIR_IMAGE_TOWEL_IMAGE_SMALL', TOWEL_STATIC_DIR.'/towel-image/small/');
define('DIR_IMAGE_TOWEL_IMAGE_BIG', TOWEL_STATIC_DIR.'/towel-image/big/');

//HTTP_TOWEL
define('HTTP_IMAGE_TOWEL_SMALL', TOWEL_STATIC_CDN.'/towel/small/');
define('HTTP_IMAGE_TOWEL_BIG', TOWEL_STATIC_CDN.'/towel/small/');
define('HTTP_IMAGE_TOWEL_CATE_SMALL', TOWEL_STATIC_CDN.'/towel-cate/small/');
define('HTTP_IMAGE_TOWEL_CATE_BIG', TOWEL_STATIC_CDN.'/towel-cate/small/');
define('HTTP_IMAGE_HOME_IMAGE_SMALL', TOWEL_STATIC_CDN.'/home-image/small/');
define('HTTP_IMAGE_HOME_IMAGE_BIG', TOWEL_STATIC_CDN.'/home-image/big/');
define('HTTP_IMAGE_TOWEL_IMAGE_SMALL', TOWEL_STATIC_CDN.'/towel-image/small/');
define('HTTP_IMAGE_TOWEL_IMAGE_BIG', TOWEL_STATIC_CDN.'/towel-image/big/');

//DB
define('DB_DRIVER', 'mysql');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'towel');
define('DB_PREFIX', '');
?>