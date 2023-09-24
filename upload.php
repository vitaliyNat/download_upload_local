<?php
function rearrange( $arr ){
    foreach( $arr as $key => $all ){
        foreach( $all as $i => $val ){
            $new[$i][$key] = $val;    
        }    
    }
    return $new;
}
if(isset($_POST['submit'])){
    $file = rearrange($_FILES['file']);
    print_r($file);
    
    
    for ($i=0; $i <count($file) ; $i++)
    
     {
    $fileName = $file['name'][i];
    $fileTmpName = $file['tmp_name'][i];
    $fileSize = $file['size'][i];
    $fileError = $file['error'][i];
    $fileType = $file['type'][i];
    

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png', 'heic','mov');

    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize< 40000000000){
                $fileNameNew = uniqid('',true).".".$fileActualExt;
                #$fileDestination = 'files/'.$fileNameNew;
                $fileDestination = 'files/'.$fileName;

                move_uploaded_file($fileTmpName, $fileDestination);
                header("Location: index.php?uploadsuccess");
            }else{
                echo "YOUR FILE IS TOO BIG!";
            }
        }else{
            echo "THERE WAS AN ERROR UPLOADING YOUR FILE!";
        }

    }else{
        echo "YOU CAN NO UPLOAD FILES OF THIS TYPE!";
    }
     }
    
}
?>