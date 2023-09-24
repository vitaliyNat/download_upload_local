<?php
if(isset($_POST['submit'])){
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    

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
                //header("Location: index.php?uploadsuccess");
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
?>