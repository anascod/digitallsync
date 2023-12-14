<?php 
use setasign\Fpdi\Fpdi;

function SetSession(){
    ini_set('session.gc_maxlifetime', 1800);

// Start the session
session_start();
}


function Register(){
    require('dp.php');
    if(isset($_POST['signup'])){  
        try {
            $dsn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
        
         $user = $_POST['user_name'];
         $email = $_POST['user_email'];
         $pass = $_POST['user_pass'];
         $phone = $_POST['user_no'];
         $auth=true;
         $prav="user";
         $pass = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));
          
         //Check if username exists
         $sql = "SELECT COUNT(user_name) AS num FROM user WHERE user_name = :user_name";
         $stmt = $pdo->prepare($sql);
    
         $stmt->bindValue(':user_name', $user);
         $stmt->execute();
         $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
         if($row['num'] > 0){
             echo '<script>alert("Username already exists")</script>';
        }
        else{
    
            $stmt = $dsn->prepare("INSERT INTO user ( user_name, user_email, user_pass, user_no, user_auth,privilege) 
            VALUES ( :user_name,:user_email,:user_pass, :user_no, :user_auth,:parv)");
            $stmt->bindParam(':user_name', $user);
            $stmt->bindParam(':user_email', $email);
            $stmt->bindParam(':user_pass', $pass);
            $stmt->bindParam(':user_no', $phone);
            $stmt->bindParam(':user_auth', $auth);
            $stmt->bindParam(':parv', $prav);
    
            
            
        
           if($stmt->execute()){
            echo '<script>alert("New account created.")</script>';
            //redirect to another page
            echo '<script>window.location.replace("login.php")</script>';
             
           }else{
               echo '<script>alert("An error occurred")</script>';
           }
        }
        }catch(PDOException $e){
            $error = "Error: " . $e->getMessage();
            echo '<script type="text/javascript">alert("'.$error.'");</script>';
        }
             
    
    }
}

function Logout(){
    if (isset($_POST['logout'])) {
        unset($_SESSION["id"]);
        unset($_SESSION["user"]);
        header("Location:../login.php");
    }
}
     
        ////////////////////////////////////////////////LOGIN////////////////////////////////////

 function Login(){
    if(isset($_POST['signin'])){  
        // try {
            require('dp.php');

            $dsn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //ensure fields are not empty
    $username = !empty($_POST['logmail']) ? trim($_POST['logmail']) : null;
    $passwordAttempt = !empty($_POST['logpass']) ? trim($_POST['logpass']) : null;
    
    $logemail = $_POST['logmail'];
    $logpass = $_POST['logpass'];
  
    //Retrieve the user account information for the given username.
    $sql = "SELECT id,  user_email , user_pass ,privilege FROM user WHERE user_email = :user_email";
    $stmt = $pdo->prepare($sql);
    
    //Bind value.
    $stmt->bindValue(':user_email', $logemail);
    
    //Execute.
    $stmt->execute();
    
    //Fetch row.
    $userssss = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If $row is FALSE.
    if($userssss === false){
       echo '<script>alert("invalid username or password")</script>';
    } else{
         
        //Compare and decrypt passwords.
        $validPassword = password_verify($passwordAttempt, $userssss["user_pass"]);
        
        //If $validPassword is TRUE, the login has been successful.
        if($validPassword){
            
            //Provide the user with a login session.
             
            $_SESSION['pri'] = $userssss['privilege'];
            $_SESSION['user'] = $userssss['user_email'];
            $_SESSION["login_time_stamp"] = time(); 
            session_write_close();
           echo '<script>window.location.replace("admin/index.php");</script>';
            exit;
            
        } else{
            //$validPassword was FALSE. Passwords do not match.
            echo '<script>alert("invalid username orssss password")</script>';
        }
    }
    }
}




Function TableView(){
    require('dp.php');

    $dsn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $dsn->prepare("SELECT * FROM orderes WHERE requester_name= 'Malik' ORDER BY id DESC");
    $stmt->execute();
    $result = $stmt->fetchAll();
   global $newresult;
   $newresult=$result;

    return
    $newresult;


}



Function MgcTableView(){
    require('dp.php');

    $dsn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $dsn->prepare("SELECT * FROM orderes  WHERE requester_name= 'MGC' ORDER BY id DESC");
    $stmt->execute();
    $result = $stmt->fetchAll();
   global $newresult;
   $newresult=$result;

    return
    $newresult;


}


function EditData(){
    require('dp.php');
    $id=$_GET['id'];
    
    $dsn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
    $stmt = $dsn->prepare("SELECT * FROM orderes WHERE id = :or_id");
    $stmt->bindParam(':or_id', $id);
    $stmt->execute();
    $result = $stmt->fetchAll();
    global $editesult;
    $editesult=$result;
    
    
    
    
    if (isset($_POST['ordered'])) {
    
        $TRANS = $_POST['trans'];
        $TRP = $_POST['trucktype'];
        $TRNO = $_POST['truckno'];
        $DRNA = $_POST['drivername'];
        $DRNO = $_POST['driverno'];
        $Iqama_no = $_POST['Iqama_no'];
        $auth="In Progress";
        $stmt = $dsn->prepare("UPDATE  orderes SET TRANSPORTER=:TRANSPORTER, TYPE_OF_TRUCK=:TYPE_OF_TRUCK, TRUCK_NO=:TRUCK_NO, DRIVER_NAME=:DRIVER_NAME, DRIVER_MOBILE=:DRIVER_MOBILE,auth=:auth,Iqama_no=:iqama
         WHERE id = :oredr_id");
        $stmt->bindParam(':TRANSPORTER', $TRANS);
        $stmt->bindParam(':TYPE_OF_TRUCK', $TRP);
        $stmt->bindParam(':TRUCK_NO', $TRNO);
        $stmt->bindParam(':DRIVER_NAME', $DRNA);
        $stmt->bindParam(':DRIVER_MOBILE', $DRNO);
        $stmt->bindParam(':auth', $auth);
        $stmt->bindParam(':iqama', $Iqama_no);
        $stmt->bindParam(':oredr_id', $id);
    
    
       if($stmt->execute()){
        CreatePdf();

        
        // Displaying the stored QR code from directory
        echo '<script>alert(" D/O Updated.")</script>';
        //redirect to another page
        echo '<script>window.location.replace("admin/index.php")</script>';
         
       }else{
           echo '<script>alert("An error occurred")</script>';
       }
    }
     
    
    if (isset($_POST['orderednodo'])) {
    
       
        $auth="waiting D/O SUBMIT";
        $stmt = $dsn->prepare("UPDATE  orderes SET auth=:auth
         WHERE id = :oredr_id");
        $stmt->bindParam(':auth', $auth);
        $stmt->bindParam(':oredr_id', $id);
    
        
    
       if($stmt->execute()){
    
        
        // Displaying the stored QR code from directory
        echo '<script>alert(" Delvired complet without D/O .")</script>';
        //redirect to another page
        echo '<script>window.location.replace("admin/index.php")</script>';
         
       }else{
           echo '<script>alert("An error occurred")</script>';
       }

        

    
    
    }



    
    if (isset($_POST['submitdo'])) {
    

    
        $auth="Deleverd";
        $file=$_FILES["delord"]["name"];
        $tmp_name=$_FILES["delord"]["tmp_name"];
        $folder_path = '../admin/delor/'.$file;

        $file1=explode(".",$file);
        $ext=$file1[1];
        $allowed=array("jpg","png","gif","pdf","wmv","pdf","zip");

        if(in_array($ext,$allowed) &&   empty($_POST['delord']))
        {
     move_uploaded_file($tmp_name,$folder_path);
           
        $stmt = $dsn->prepare("UPDATE  orderes SET auth=:au_th, D_O=:delv
         WHERE id = :oredr_id");
        $stmt->bindParam(':au_th', $auth);
        $stmt->bindParam(':delv', $file);
        $stmt->bindParam(':oredr_id', $id);
        // echo "ssdasdasad";
        }else{
            echo                 '<script>alert("No File Uploaded")</script>';
        }
        
    
       if($stmt->execute()){
    
        
        // Displaying the stored QR code from directory
        echo '<script>alert(" D/O Submit.")</script>';
        //redirect to another page
        echo '<script>window.location.replace("admin/index.php")</script>';
         
       }else{
           echo '<script>alert("An error occurred")</script>';
       }
    }
    
    return
    $editesult;
    
    }


    


    function NewDoCount(){
        require('dp.php');
    
    $dsn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $auth="New";
    $sql = "SELECT COUNT(auth) AS num FROM orderes WHERE auth = :draft";
             $stmt = $pdo->prepare($sql);
        
             $stmt->bindValue(':draft', $auth);
             $stmt->execute();
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo $row['num'];
    
    }
    
    function DeleverdDoCount(){
        require('dp.php');
    
    $dsn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $auth="deleverd";
    $sql = "SELECT COUNT(auth) AS num FROM orderes WHERE auth = :draft";
             $stmt = $pdo->prepare($sql);
        
             $stmt->bindValue(':draft', $auth);
             $stmt->execute();
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo $row['num'];
    
    }
    
    
    function WhaitDoCount(){
        require('dp.php');
    
    $dsn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $auth="waiting D/O SUBMIT";
    $sql = "SELECT COUNT(auth) AS num FROM orderes WHERE auth = :draft";
             $stmt = $pdo->prepare($sql);
        
             $stmt->bindValue(':draft', $auth);
             $stmt->execute();
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo $row['num'];
    
    }
    
    
    function ProDoCount(){
        require('dp.php');
    
    $dsn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $auth="In Progress";
    $sql = "SELECT COUNT(auth) AS num FROM orderes WHERE auth = :draft";
             $stmt = $pdo->prepare($sql);
        
             $stmt->bindValue(':draft', $auth);
             $stmt->execute();
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo $row['num'];
    
    }


    function CreatePdf(){
        // include composer packages
        require_once __DIR__ . '/pdfma/vendor/autoload.php';
        require('dp.php');
        $id=$_GET['id'];
        
        $dsn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        
        $stmt = $dsn->prepare("SELECT * FROM orderes WHERE id = :or_id");
        $stmt->bindParam(':or_id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll();


        $pdf = new Fpdi();
        $filename  = __DIR__ . '/pdfma/newp/DO.pdf';
        $pageCount = $pdf->setSourceFile($filename);
    

    
        // Iterate through the pages
        for ($pageNumber = 1; $pageNumber <= $pageCount; $pageNumber++) {
            $templateId = $pdf->importPage($pageNumber);
            $pdf->addPage();
            $pdf->useTemplate($templateId);
            
            // Set the current page for editing
            $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetTextColor(25, 25, 112);
        
        foreach($result as $res){
            $pdf->SetXY(20, 67);
            $pdf->Cell(0, 10, $res['id'], 0, 0, 'L');        }
    
    

            foreach($result as $res){

                $pdf->SetXY(35, 92);
                $pdf->Cell(0, 10, $res['Consignee_no'], 0, 0, 'L');}


    

        foreach($result as $res){
            $pdf->SetXY(25, 80);
            $pdf->Cell(0, 10, $res['File_no'], 0, 0, 'L');}
        
    
        foreach($result as $res){
            $pdf->SetXY(84, 67);
            $pdf->Cell(0, 10, $res['JOB_NO'], 0, 0, 'L');}
        

        foreach($result as $res){
            $pdf->SetXY(140, 67);
            $pdf->Cell(0, 10, $res['B_L'], 0, 0, 'L');}
    

        foreach($result as $res){
            $pdf->SetXY(86, 81);
            $pdf->Cell(0, 10, $res['BAYAN_NO'], 0, 0, 'L');
    

        foreach($result as $res){
            $pdf->SetXY(140, 81);
            $pdf->Cell(0, 10, $res['TOPL'], 0, 0, 'L');}
    
        

        foreach($result as $res){
            $pdf->SetXY(45, 104);
            $pdf->Cell(0, 10, $res['CONTRACT_NO'], 0, 0, 'L');}
    

        foreach($result as $res){
            $pdf->SetXY(50, 126);
            $pdf->Cell(0, 10, $res['DRIVER_NAME'], 0, 0, 'L');}
    

        foreach($result as $res){
            $pdf->SetXY(50, 116);
            $pdf->Cell(0, 10, $res['Contact_name'], 0, 0, 'L');}
        

        foreach($result as $res){
            $pdf->SetXY(145, 116);
            $pdf->Cell(0, 10, $res['Contact_no'], 0, 0, 'L');}
      
    

        foreach($result as $res){
            $pdf->SetXY(160, 126);
            $pdf->Cell(0, 10, $res['TRUCK_NO'], 0, 0, 'L');}
    

        foreach($result as $res){
            $pdf->SetXY(158, 135);
            $pdf->Cell(0, 10, $res['Iqama_no'], 0, 0, 'L');}
     

        
        foreach($result as $res){
            $pdf->SetXY(50, 135);
            $pdf->Cell(0, 10, $res['DRIVER_MOBILE'], 0, 0, 'L');}
   
    

        foreach($result as $res){
            $pdf->SetXY(20, 155);
            $pdf->Cell(0, 10, $res['Item_qu'].' '.$res['item_ty'], 0, 0, 'L');}
      
    

        foreach($result as $res){
            $pdf->SetXY(55, 155);
            $pdf->Cell(0, 10, '.', 0, 0, 'L');}
        
    

        foreach($result as $res){
            $pdf->SetXY(87, 155);
            $pdf->Cell(0, 10, $res['Port_ty'], 0, 0, 'L');}


        foreach($result as $res){
            $pdf->SetXY(135, 155);
            $pdf->Cell(0, 10, $res['Cargo_des'], 0, 0, 'L');      }
   
    }
        
        // Save the modified PDF to a new file
        $outputFilename = $filename;

        foreach($result as $res){
            $pdf->SetXY(135, 155);
            $pdf->Cell(0, 10, $res['Cargo_des'], 0, 0, 'L');      }
        $pdf->Output(__DIR__ .'/pdfma/newp/'.$res['DRAFT_NO'].'.pdf', 'F');
     }
    }
        
// $username=
// $usereamil=

// $userpass=
// $userno=
// $sql = "INSERT INTO user (user_name	, user_eamil, user_pass, user_no, user_auth) VALUES (?,?,?,?,?)";
// $stmt= $pdo->prepare($sql);
// $stmt->execute([$name, $surname, $sex]);









?>
