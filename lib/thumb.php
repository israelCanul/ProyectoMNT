<?php


$save_to_file = true;
$image_quality = 100;
$image_type = -1;
$max_x = 100;
$max_y = 100;
$cut_x = 0;
$cut_y = 0;

setcookie('LiveHelpSession','',time()-3600);
$fileThis = $_SERVER["SCRIPT_FILENAME"];	
$last_modified_time = filemtime($fileThis);
$etag = md5_file($fileThis);	
header("Last-Modified: ".gmdate("D, d M Y H:i:s", $last_modified_time)." GMT");
header("Etag: $etag");
 
$type = (isset($_GET["type"]) && $_GET["type"] != "") ? $_GET["type"] : "img";


$images_folder = str_replace("old/","",$_SERVER["DOCUMENT_ROOT"]) . '/admin/public/images/';
$thumbs_folder = str_replace("old/","",$_SERVER["DOCUMENT_ROOT"]) . '/admin/public/images/';
$to_name = '';

if (isset($_REQUEST['f'])) {
    $save_to_file = intval($_REQUEST['f']) == 1;
}

if(isset($_REQUEST['src'])) {
    $from_name = urldecode($_REQUEST['src']);
} else {
    $from_name = urldecode("no_picture.jpg");
}
if (isset($_REQUEST['dest']) && $_REQUEST['f'] == 1) {

    $to_name = urldecode($_REQUEST['dest']);
} else
    if ($save_to_file) {
        die("Thumbnail file name must be specified.");
    }

if (isset($_REQUEST['q'])) {
    $image_quality = intval($_REQUEST['q']);
}

if (isset($_REQUEST['t'])) {
    $image_type = intval($_REQUEST['t']);
}

if (isset($_REQUEST['x'])) {
    $max_x = intval($_REQUEST['x']);
}

if (isset($_REQUEST['y'])) {
    $max_y = intval($_REQUEST['y']);
}




//if (!file_exists($images_folder)) die('Images folder does not exist (update $images_folder in the script)');
if ($save_to_file && !file_exists($thumbs_folder))
    die('Thumbnails folder does not exist (update $thumbs_folder in the script)');

// Allocate all necessary memory for the image.
// Special thanks to Alecos for providing the code.
ini_set('memory_limit', '-1');

// include image processing code
include ('image.class.php');

$img = new Zubrag_image;

// initialize
$img->max_x = $max_x;
$img->max_y = $max_y;
$img->cut_x = $cut_x;
$img->cut_y = $cut_y;
$img->quality = $image_quality;
$img->save_to_file = $save_to_file;
$img->image_type = $image_type;


// generate thumbnail
$img->GenerateThumbFile($images_folder . $from_name, $thumbs_folder . $to_name);

?>
