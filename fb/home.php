<?php
	session_start();
    require 'src/config.php'; 
    require 'src/facebook.php';

    if($config['App_Secret'] && $config['App_ID'] )
    {   

    	$facebook = new Facebook(array(  'appId'  => $config['App_ID'],  'secret' => $config['App_Secret'] ,  'cookie' => true ,'fileUpload' => true));
    }

    if(isset($_POST['status'])){
        list($page_id,$page_token) = split("-",$_POST['page']);
        $page=$_POST['page'];


if(!empty($_FILES["fileToUpload"]["name"])){
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Allow certain file formats
if($imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
       // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

}

//$image='uploads/'.basename($_FILES['fileToUpload']['name']);
  //  echo $image;

try
            {
               
$image['access_token']  = $page_token;
                $image['message']       = $_POST['status'];
                $image['image']         = '@'.realpath("uploads/".$_FILES['fileToUpload']['name']);
                $facebook->setFileUploadSupport(true);
                $publish = $facebook->api('/'.$page_id.'/photos', 'POST', $image);
                           }
            catch(FacebookApiException $e)
            {
                $message = "Sorry, there was a problem uploading your file please try again.";
            }

        
        if(isset($publish))    echo 'Status updated.<br>';
    }
    else{

        $publish = $facebook->api('/'.$page_id.'/feed', 'post',
            array('access_token' => $page_token,
            'message'=> $_POST['status'],
            'from' => $config['App_ID'],
            'to' => $page_id,
            'description' => ' via CSI NSIT',
            ));
        if(isset($publish))    echo 'Status updated.<br>';
    }
}
    
    if(isset($_GET['fbTrue'])){
        $token_url = "https://graph.facebook.com/oauth/access_token?"        . "client_id=".$config['App_ID']."&redirect_uri=" . urlencode($config['callback_url'])        . "&client_secret=".$config['App_Secret']."&code=" . $_GET['code'];
        $response = file_get_contents($token_url);
        // get access token from url
        $params = null;
        parse_str($response, $params);
        //use to parse query string in $response into $params varable
        $_SESSION['token'] = $params['access_token'];
        $graph_url_pages = "https://graph.facebook.com/me/accounts?access_token=".$_SESSION['token'];
        $pages = json_decode(file_get_contents($graph_url_pages));
        // get all pages information from above url.
        $k=0;
        for($i=0;$i<count($pages->data);$i++)    {
            
            if($k==0)    {
                $dropdown=array(array('id'=>$pages->data[$i]->id,'token'=>$pages->data[$i]->access_token,'name'=>$pages->data[$i]->name));
                $k++;
            } else {
                $temp=array(array('id'=>$pages->data[$i]->id,'token'=>$pages->data[$i]->access_token,'name'=>$pages->data[$i]->name));
                $dropdown = array_merge($dropdown,$temp);
            }

        }

        echo '<form action="home.php" method="post" enctype="multipart/form-data"><select name="page" id=status>';
        for($i=0;$i<count($dropdown);$i++){
            echo'<option value="'.$dropdown[$i]['id'].'-'.$dropdown[$i]['token'].'">'.$dropdown[$i]['name'].'</option>';
        }

        '</select>';
        echo '<input type="text" name="status" id="status" placeholder="Post" />';
        echo '<input type="file" name="fileToUpload" id="fileToUpload"><input type="submit" value="Post On Page!"/>';
        echo '</form>';
    } else {
        echo '<a href="https://www.facebook.com/dialog/oauth?client_id='.$config['App_ID'].'&redirect_uri='.$config['callback_url'].'&scope=email,user_about_me,publish_pages,publish_actions,manage_pages"><img src="./images/login-button.png" alt="Sign in with Facebook"/></a>';
    }

    ?>