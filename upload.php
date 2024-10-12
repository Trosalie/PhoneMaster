<HTML><BODY>
    <?php
    $nombrePhoto = $_POST["nbphotos"];

    if(!is_dir("upload")){
        mkdir("upload",0200);
    }

    $dir = "upload";
    
    for ($i=0; $i < $nombrePhoto; $i++) { 
        if(is_uploaded_file($_FILES["photo$i"]["tmp_name"])){
            $name = basename($_FILES["photo$i"]["name"]);
            move_uploaded_file($_FILES["photo$i"]["tmp_name"],"$dir/$name");
            print "L'image : $name, a été téléchargée dans le fichier $dir<br>";
        }
    }

    ?>
</BODY></HTML>