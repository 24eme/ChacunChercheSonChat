<?php
include("header.php");
$fileList = glob('data/*wifi');
$fileList = array_reverse($fileList);
echo "<h1>les mesures</h1>";
foreach($fileList as $filename){
    //Use the is_file function to make sure that it is not a directory.
    if(is_file($filename)){
        echo '<p id="'.$filename.'"><a href="add_place.php?place='.urlencode($filename).'">'.$filename.'</a>';
        if (file_exists($filename.".localization")) {
            echo " OK";
            if (!filesize($filename.".localization")) {
                echo " KO";
            }else{
                echo file_get_contents($filename.".localization");
            }
        }
        echo '</p>';
    }
}
include("footer.php");
