<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
// use setasign\Tcpdf\Tcpdf;
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
         $privilege='mgc';
         $pass = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));
          
         //Check if username exists
         $sql = "SELECT COUNT(mcg_name) AS num FROM mcg WHERE mcg_name = :user_name";
         $stmt = $pdo->prepare($sql);
    
         $stmt->bindValue(':user_name', $user);
         $stmt->execute();
         $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
         if($row['num'] > 0){
             echo '<script>alert("Username already exists")</script>';
        }
        else{
    
            $stmt = $dsn->prepare("INSERT INTO mcg ( mcg_name,mcg_email, mcg_phone,mcg_pass,privilege) 
            VALUES ( :user_name,:user_email,:user_no,:user_pass,:pri )");
            $stmt->bindParam(':user_name', $user);
            $stmt->bindParam(':user_email', $email);
            $stmt->bindParam(':user_no', $phone);
            $stmt->bindParam(':user_pass', $pass);
            $stmt->bindParam(':pri', $privilege);
    
            
            
        
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
     
        ////////////////////////////////////////////////LOGIN////////////////////////////////////

        function Logout(){
            if (isset($_POST['logout'])) {
                session_destroy();
                header("Location:../login.php");
            }
        }
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
    $sql = "SELECT *  FROM mcg WHERE mcg_email = :user_email";
    $stmt = $pdo->prepare($sql);
    
    //Bind value.
    $stmt->bindValue(':user_email', $logemail);
    
    //Execute.
    $stmt->execute();
    
    //Fetch row.
    $userser = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If $row is FALSE.
    if($userser === false){
       echo '<script>alert("invalid username or password")</script>';
    } else{
         
        //Compare and decrypt passwords.
        $validPassword = password_verify($passwordAttempt, $userser["mcg_pass"]);
        
        //If $validPassword is TRUE, the login has been successful.
        if($validPassword){
            global $_SESSION;
            //Provide the user with a login session.
             
         $_SESSION['usermgc'] = $userser['mcg_email'];
            $_SESSION['pri'] = $userser['privilege'];
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


    $stmt = $dsn->prepare("SELECT * FROM orderes  WHERE requester_name= 'MGC' ORDER BY id DESC");
    $stmt->execute();
    $result = $stmt->fetchAll();
   global $newresult;
   $newresult=$result;

    return
    $newresult;


}


function CurrentDate(){
    $Date=date("Y-m-d");
echo $Date;
return
$Date;
}
function NeworderNumber(){
    $SixDigitRandomNumber = rand(100000,999999);
    echo $SixDigitRandomNumber;
    return
    $SixDigitRandomNumber;

}
// use TCPDF;


function Neworder(){
    require('dp.php');
    if(isset($_POST['ordersb'])){  
        
            $dsn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $draft=NeworderNumber();
        $Date=CurrentDate();

global $contractnom;
global $requster;

         $fileno = $_POST['fileno'];
         $B_L = $_POST['B_L'];
         $Consignee = $_POST['Consignee'];
         $Port_Type = $_POST['Port_Type'];
         $job = $_POST['jobno'];

         $ITEM_Quy = $_POST['ITEM_Quy'];
         $Contact_Person_Name = $_POST['Contact_Person_Name'];
         $Contact_No = $_POST['Contact_No'];
         $trans = "OBS TRANSPORTER TRUCK";
         $Cargo_Description = $_POST[ "Cargo_Description"];
         $FROM = "MGC";
         $to = $_POST['top'];
         $contractnom = $_POST['contract'];
         $trucktype = "";
         $item_t = $_POST['item_type'];

         //  $trucktype = $_POST['trucktype'];
        //  $truckno = $_POST['truckno'];
        //  $driverno = $_POST['driverno'];
         $truckno="";
         $driverno="";
         $bayan = $_POST['bayan'];
        //  $drivername = $_POST['drivername'];
         $drivername ="";
         $dostatus="New";
         $requster="MGC";
         $IQAMA_NO="";

         //Check if username exists
         $sql = "SELECT COUNT(DRAFT_NO) AS num FROM orderes WHERE DRAFT_NO = :draft";
         $stmt = $pdo->prepare($sql);
    
         $stmt->bindValue(':draft', $draft);
         $stmt->execute();
         $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
         if($row['num'] > 0){
             echo '<script>alert("Draft already exists")</script>';
        }
        else{
    
            $stmt = $dsn->prepare("INSERT INTO orderes ( DRAFT_NO, BAYAN_NO, JOB_NO, TRANSPORTER, FROMP, TOPL, CONTRACT_NO, TYPE_OF_TRUCK,TRUCK_NO,DRIVER_NAME,DRIVER_MOBILE,Date,auth,requester_name,File_no,B_L,Consignee_no,Contact_name,Contact_no,Iqama_no,Item_qu,item_ty,Port_ty,Cargo_des) 
            VALUES ( :DRAFT_NO,:BAYAN_NO,:JOB_NO, :TRANSPORTER, :FROMP,:TOPL,:CONTRACT_NO,:TYPE_OF_TRUCK,:TRUCK_NO,:DRIVER_NAME,:DRIVER_MOBILE,:Date,:auth,:requster,:File_no,:B_L,:Consignee_no,:Contact_name,:Contact_no,:Iqama_no,:Item_qu,:item_typ,:Port_ty,:Cargo_des)");
            $stmt->bindParam(':DRAFT_NO', $draft);
            $stmt->bindParam(':BAYAN_NO', $bayan);
            $stmt->bindParam(':JOB_NO', $job);
            $stmt->bindParam(':TRANSPORTER', $trans);
            $stmt->bindParam(':FROMP', $FROM);
            $stmt->bindParam(':TOPL', $to);
            $stmt->bindParam(':CONTRACT_NO', $contractnom);
            $stmt->bindParam(':TYPE_OF_TRUCK', $trucktype);
            $stmt->bindParam(':TRUCK_NO', $truckno);
            $stmt->bindParam(':DRIVER_NAME', $drivername);
            $stmt->bindParam(':DRIVER_MOBILE', $driverno);
            $stmt->bindParam(':Date', $Date);
            $stmt->bindParam(':auth', $dostatus);
            $stmt->bindParam(':requster', $requster);
            $stmt->bindParam(':File_no', $fileno);
            $stmt->bindParam(':B_L', $B_L);
            $stmt->bindParam(':Consignee_no', $Consignee);
            $stmt->bindParam(':Contact_name', $Contact_Person_Name);
            $stmt->bindParam(':Contact_no', $Contact_No);
            $stmt->bindParam(':Iqama_no', $drivername);
            $stmt->bindParam(':Item_qu', $ITEM_Quy);
            $stmt->bindParam(':item_typ', $item_t);
            $stmt->bindParam(':Port_ty', $Port_Type);
            $stmt->bindParam(':Cargo_des', $Cargo_Description);
            
            
        
           if($stmt->execute()){
            require_once('qrcode/vendor/autoload.php');

    $options = new QROptions(
        [
          'eccLevel' => QRCode::ECC_L,
          'outputType' => QRCode::OUTPUT_MARKUP_SVG,
          'version' => 5,
        ]
      );
      
      $qrcode = (new QRCode($options))->render($contractnom,"qrcode/qrcodefile/$draft.svg");
    //   $qrcode->render($contract, "qrcode/$contract.svg");


     


            echo '<script>alert("New D/O created.")</script>';
            // redirect to another page
            echo '<script>window.location.replace("admin/index.php")</script>';
            $mail= new MailCreate();
            $mail->MaliSend();
           }else{
               echo '<script>alert("An error occurred")</script>';
           }
        }
        
             
    
    }
}



function CreatePdf(){
    // include composer packages
    require_once __DIR__ . '/pdfma/vendor/autoload.php';
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
    $pdf->SetXY(20, 67);
    $pdf->Cell(0, 10, 'Modified Text', 0, 0, 'L');

    $pdf->SetXY(35, 92);
    $pdf->Cell(0, 10, 'Consignee', 0, 0, 'L');

    $pdf->SetXY(25, 80);
    $pdf->Cell(0, 10, 'File no', 0, 0, 'L');
    

    $pdf->SetXY(84, 67);
    $pdf->Cell(0, 10, 'Job no', 0, 0, 'L');
    
    $pdf->SetXY(140, 67);
    $pdf->Cell(0, 10, 'B-L no', 0, 0, 'L');

    $pdf->SetXY(86, 81);
    $pdf->Cell(0, 10, 'BAYAN no', 0, 0, 'L');

    $pdf->SetXY(140, 81);
    $pdf->Cell(0, 10, 'DEST no', 0, 0, 'L');

    
    $pdf->SetXY(45, 104);
    $pdf->Cell(0, 10, 'Consignee PO', 0, 0, 'L');

    $pdf->SetXY(50, 126);
    $pdf->Cell(0, 10, 'Driver Name ', 0, 0, 'L');

    $pdf->SetXY(50, 116);
    $pdf->Cell(0, 10, 'Contact Person Name', 0, 0, 'L');
    
    $pdf->SetXY(145, 116);
    $pdf->Cell(0, 10, 'Contact Mob no:', 0, 0, 'L');

    $pdf->SetXY(160, 126);
    $pdf->Cell(0, 10, 'Plate no', 0, 0, 'L');

    $pdf->SetXY(158, 135);
    $pdf->Cell(0, 10, 'Iqama no', 0, 0, 'L');

    $pdf->SetXY(50, 135);
    $pdf->Cell(0, 10, 'Driver MO ', 0, 0, 'L');

    $pdf->SetXY(20, 155);
    $pdf->Cell(0, 10, 'ITEM Q', 0, 0, 'L');

    $pdf->SetXY(55, 155);
    $pdf->Cell(0, 10, 'Weight', 0, 0, 'L');

    $pdf->SetXY(87, 155);
    $pdf->Cell(0, 10, 'PORT', 0, 0, 'L');
    
    $pdf->SetXY(135, 155);
    $pdf->Cell(0, 10, 'Cargo Description', 0, 0, 'L');
}
    
    // Save the modified PDF to a new file
    $outputFilename = $filename;
    $pdf->Output(__DIR__ .'/pdfma/newp/DO1.pdf', 'F');
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
        
            $job = $_POST['jobno'];
            $ITEM_Quy = $_POST['ITEM_Quy'];
            // $ITEM_Quy = $_POST['item_type'];
            $Con_name = $_POST['Con_name'];
            $Contact_no = $_POST['Contact_no'];
            $fil = $_POST['filon'];
            $Cargo_Description = $_POST['Cargo_Description'];
            $B_LL = $_POST['B_L'];
            $Consignee = $_POST['Consignee'];
            $Port_Type = $_POST['Port_Type'];
            $trans = "OBS TRANSPORTER TRUCK";
            $FROM = $_POST['fromp'];
            $to = $_POST['top'];
            $contract = $_POST['contract'];
            $bayan = $_POST['bayan'];
            $auth = "New";
            $item_type = $_POST['item_type'];

     
            $stmt = $dsn->prepare("UPDATE  orderes SET BAYAN_NO=:BAYAN_NO, JOB_NO=:JOB_NO, TRANSPORTER=:TRANSPORTER, FROMP=:FROMP, TOPL=:TOPL, CONTRACT_NO=:CONTRACT_NO,
             File_no=:Fileno, B_L=:B_LL, Consignee_no=:Consignee_no ,Contact_name=:Contact_name, Contact_no=:Contact_no,Item_qu=:ITEM_Quy,item_ty=:item_typ,Port_ty=:Port_ty, Cargo_des=:Cargo_des
             ,auth=:aut_n
             WHERE id = :oredr_id");
            $stmt->bindParam(':BAYAN_NO', $bayan);
            $stmt->bindParam(':JOB_NO', $job);
            $stmt->bindParam(':TRANSPORTER', $trans);
            $stmt->bindParam(':FROMP', $FROM);
            $stmt->bindParam(':TOPL', $to);
            $stmt->bindParam(':CONTRACT_NO', $Contact_no);
            $stmt->bindParam(':Fileno', $fil);
            $stmt->bindParam(':B_LL', $B_LL);
            $stmt->bindParam(':Consignee_no', $Consignee);
            $stmt->bindParam(':Contact_name', $Con_name);
            $stmt->bindParam(':Contact_no', $contract);
            $stmt->bindParam(':ITEM_Quy', $ITEM_Quy);
            $stmt->bindParam(':item_typ', $item_type);
            $stmt->bindParam(':Port_ty', $Port_Type);
            $stmt->bindParam(':Cargo_des', $Cargo_Description);
            $stmt->bindParam(':aut_n', $auth);
            $stmt->bindParam(':oredr_id', $id);


            
            
        
           if($stmt->execute()){
        
            
            // Displaying the stored QR code from directory
            echo '<script>alert(" D/O Updated.")</script>';
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
        
        
        Class MailCreate{
        
            Function MaliSend(){
                require ( '../admin/phpmail/vendor/phpmailer/phpmailer/src/Exception.php');
        require '../admin/phpmail/vendor/phpmailer/phpmailer/src/PHPMailer.php';
        require '../admin/phpmail/vendor/phpmailer/phpmailer/src/SMTP.php';
        
                $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Mailer = "smtp";
            $mail->SMTPDebug  = 1;  
            $mail->SMTPAuth   = TRUE;
            $mail->SMTPSecure = "tls";
            $mail->Port       = 587;
            $mail->Host       = "smtp.gmail.com";
            $mail->Username   = "zaezao888@gmail.com";
            $mail->Password   = "abbpfentwixkvste";
            $mail->IsHTML(true);
        $mail->AddAddress("zaezao90@gmail.com", "Anas");
        $mail->SetFrom("zaezao444@gmail.com", "ANAS");
        $mail->AddReplyTo("am392805@gmail.com", "Anas");
        $mail->AddCC("baramalek122@gmail.com", "cc-recipient-name");
        $mail->Subject = "New D/O  No.".$GLOBALS['contractnom'];" From MGC Please Accepte";
        
        $content = '<b> Please Process for New D/O No '.$GLOBALS['contractnom'];''.' .</b>';
        $mail->MsgHTML($content);
        
        if(!$mail->Send()) {
            echo "Error while sending Email.";
            var_dump($mail);
          } else {
              echo '<script>alert("Email sent successfully")</script>';
          
          }
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
