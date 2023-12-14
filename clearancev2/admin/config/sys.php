<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function SetSession(){
    ini_set('session.gc_maxlifetime', 1800);

// Start the session
session_start();
}


function Register(){
    require('db.php');
    if(isset($_POST['signup'])){  
        try {
            $dsn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
        
         $user = $_POST['user_name'];
         $email = $_POST['user_email'];
         $pass = $_POST['user_pass'];
         $phone = $_POST['user_no'];
         $auth=true;
         $privilege="admin";
         $pass = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));
          
         //Check if username exists
         $sql = "SELECT COUNT(admin_email) AS num FROM admin WHERE admin_email = :user_name";
         $stmt = $pdo->prepare($sql);
    
         $stmt->bindValue(':user_name', $user);
         $stmt->execute();
         $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
         if($row['num'] > 0){
             echo '<script>alert("Username already exists")</script>';
        }
        else{
    
            $stmt = $dsn->prepare("INSERT INTO admin ( admin_name, admin_email, admin_pass, user_phone,privilege) 
            VALUES ( :user_name,:user_email,:user_pass, :user_no,:pri)");
            $stmt->bindParam(':user_name', $user);
            $stmt->bindParam(':user_email', $email);
            $stmt->bindParam(':user_pass', $pass);
            $stmt->bindParam(':user_no', $phone);
            $stmt->bindParam(':pri', $privilege);
    
            
            
        
           if($stmt->execute()){
            echo '<script>alert("New account created.")</script>';
            //redirect to another page
            echo '<script>window.location.replace("admin/index.php")</script>';
             
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

 function Login(){
    if(isset($_POST['signin'])){  
        // try {
            require('db.php');

            $dsn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //ensure fields are not empty
    $username = !empty($_POST['logmail']) ? trim($_POST['logmail']) : null;
    $passwordAttempt = !empty($_POST['logpass']) ? trim($_POST['logpass']) : null;
    
    $logemail = $_POST['logmail'];
    $logpass = $_POST['logpass'];
  
    //Retrieve the user account information for the given username.
    $sql = "SELECT * FROM admin WHERE admin_email = :user_email";
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
        $validPassword = password_verify($passwordAttempt, $userssss["admin_pass"]);
        
        //If $validPassword is TRUE, the login has been successful.
        if($validPassword){
            
            //Provide the user with a login session.
             
            $_SESSION['user'] = $userssss["admin_email"];
            $_SESSION['pri'] = $userssss["privilege"];
           echo '<script>window.location.replace("admin/index.php");</script>';
            exit;
            
        } else{
            //$validPassword was FALSE. Passwords do not match.
            echo '<script>alert("invalid username orssss password")</script>';
        }
    }
    }
}


//////////////////////////Form////////////

function CurrentDate(){
    $Date=date("Y-m-d H:i:s");
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

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

function Neworder(){
    require('db.php');
    if(isset($_POST['ordersb'])){  
        
            $dsn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $draft=NeworderNumber();
        $Date=CurrentDate();

global $contractnom;
global $requster;

         $job = $_POST['jobno'];
         $trans = "OBS TRANSPORTER TRUCK";
         $FROM = $_POST['fromp'];
         $to = $_POST['top'];
         $contractnom = $_POST['contract'];
         $trucktype = "";

         //  $trucktype = $_POST['trucktype'];
        //  $truckno = $_POST['truckno'];
        //  $driverno = $_POST['driverno'];
         $truckno="";
         $driverno="";
         $bayan = $_POST['bayan'];
        //  $drivername = $_POST['drivername'];
         $drivername ="";
         $dostatus="New";
         $requster="Malik";

         $file=$_FILES["Fasah_Up"]["name"];
         $tmp_name=$_FILES["Fasah_Up"]["tmp_name"];
         $folder_path = 'delor/'.$file;
         $file1=explode(".",$file);
         $ext=$file1[1];
         $allowed=array("jpg","png","gif","pdf","wmv","pdf","zip");
 
        
         
         //Check if username exists
         $sql = "SELECT COUNT(DRAFT_NO) AS num FROM orderes WHERE DRAFT_NO = :draft";
         $stmt = $pdo->prepare($sql);
    
         $stmt->bindValue(':draft', $draft);
         $stmt->execute();
         $row = $stmt->fetch(PDO::FETCH_ASSOC);

     if(in_array($ext,$allowed) &&   empty($_POST['fasahup']))
         { 
      move_uploaded_file($tmp_name,$folder_path);
         if($row['num'] > 0){
             echo '<script>alert("Username already exists")</script>';
        }
        else{
    
            $stmt = $dsn->prepare("INSERT INTO orderes ( DRAFT_NO, BAYAN_NO, JOB_NO, TRANSPORTER, FROMP, TOPL, CONTRACT_NO, TYPE_OF_TRUCK,TRUCK_NO,DRIVER_NAME,DRIVER_MOBILE,Date,auth,requester_name,fasah_up) 
            VALUES ( :DRAFT_NO,:BAYAN_NO,:JOB_NO, :TRANSPORTER, :FROMP,:TOPL,:CONTRACT_NO,:TYPE_OF_TRUCK,:TRUCK_NO,:DRIVER_NAME,:DRIVER_MOBILE,:Date,:auth, :requster,:fasah_upload)");
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
            $stmt->bindParam(':fasah_upload', $file);
    
            
            
        
           if($stmt->execute()){
            require_once('qrcode/vendor/autoload.php');

    $options = new QROptions(
        [
          'eccLevel' => QRCode::ECC_L,
          'outputType' => QRCode::OUTPUT_MARKUP_SVG,
          'version' => 5,
        ]
      );
      
      $qrcode = (new QRCode($options))->render($contractnom,"qrcode/qrcodefile/$contractnom.svg");
    //   $qrcode->render($contract, "qrcode/$contract.svg");


     



            echo '<script>alert("New D/O created.")</script>';
            //redirect to another page
            echo '<script>window.location.replace("admin/index.php")</script>';
            $mail= new MailCreate();
            $mail->MaliSend();
           }else{
               echo '<script>alert("An error occurred")</script>';
           }
        }
        
        } else{
            echo                 '<script>alert("No File Uploaded")</script>';
        }
        
             
    
    }
}


Function TableView(){
    require('db.php');

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


function EditData(){
require('db.php');
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
    $trans = $_POST['trans'];
    $FROM = $_POST['fromp'];
    $to = $_POST['top'];
    $contract = $_POST['contract'];
    $bayan = $_POST['bayan'];
    
    $stmt = $dsn->prepare("UPDATE  orderes SET BAYAN_NO=:BAYAN_NO, JOB_NO=:JOB_NO, TRANSPORTER=:TRANSPORTER, FROMP=:FROMP, TOPL=:TOPL, CONTRACT_NO=:CONTRACT_NO
     WHERE id = :oredr_id");
    $stmt->bindParam(':BAYAN_NO', $bayan);
    $stmt->bindParam(':JOB_NO', $job);
    $stmt->bindParam(':TRANSPORTER', $trans);
    $stmt->bindParam(':FROMP', $FROM);
    $stmt->bindParam(':TOPL', $to);
    $stmt->bindParam(':CONTRACT_NO', $contract);
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
    require('db.php');

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
    require('db.php');

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
    require('db.php');

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
    require('db.php');

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

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

Class MailCreate{

function BackupData(){

    if (isset($_POST['database'])) {
        # code...
        require('db.php');
        require_once __DIR__ . '/phpexcel/vendor/autoload.php';

     
define('DB_HOST', 'localhost');

define('DB_USER', 'root');

define('DB_PASS', '');

define('DB_NAME', 'clearnce');
define('BACKUP_DIR', 'backup');

$date = date('Y-m-d_H-i-s');
$backup_file = BACKUP_DIR . '/' . DB_NAME . '-' . $date . '.sql';
$command = "mysqldump --user=".DB_USER." --password=".DB_PASS." ".DB_NAME." > ".$backup_file;

system($command);
      
//         $tableName = 'orderes';
//         $filename = 'members.xls';

//             // Connect to the database
//             $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        
//             // Create a new PHPExcel object
        
//             // Select data from the table
//             $query = "SELECT * FROM $tableName";
//             $stmt = $pdo->query($query);
        
//             // Fetch the data
//             $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
//             // header( 'Content-Type: application/vnd. ' ) ;
//             header("Content-Type: application/xlsx");    
//             header("Content-Disposition: attachment; filename=$filename");  
//             header("Pragma: no-cache"); 
//             header("Expires: 0");
//             $separator = "\t";

//             $spreadsheet = new Spreadsheet();
// $sheet = $spreadsheet->getActiveSheet();
// $sheet->setCellValue( 'A1' ,'S.No');
// $sheet->setCellValue( 'B1' ,'DRAFT_NO');
// $sheet->setCellValue( 'C1' ,'BAYAN_NO' ) ;
// $sheet->setCellValue( 'D1' ,'JOB_NO');
// $sheet->setCellValue( 'E1' ,'TRANSPORTER');
// $sheet->setCellValue( 'F1' ,'FROMP');
// $sheet->setCellValue( 'G1' ,'TOPL');
// $sheet->setCellValue( 'H1' ,'CONTRACT_NO');
// $sheet->setCellValue( 'I1' ,'TYPE_OF_TRUCK');
// $sheet->setCellValue( 'J1' ,'TRUCK_NO');
// $sheet->setCellValue( 'K1' ,'DRIVER_NAME');
// $sheet->setCellValue( 'L1' ,'DRIVER_MOBILE');
// $sheet->setCellValue( 'M1' ,'Date');
// $sheet->setCellValue( 'N1' ,'auth');
// $sheet->setCellValue( 'O1' ,'D_O');
// $sheet->setCellValue( 'P1' ,'requester_name');
// $sheet->setCellValue( 'Q1' ,'File_no');
// $sheet->setCellValue( 'R1' ,'B_L');
// $sheet->setCellValue( 'S1' ,'Consignee_no');
// $sheet->setCellValue( 'T1' ,'Contact_name');
// $sheet->setCellValue( 'U1' ,'Contact_no');
// $sheet->setCellValue( 'V1' ,'Iqama_no');
// $sheet->setCellValue( 'W1' ,'Item_qu');
// $sheet->setCellValue( 'X1' ,'Port_ty');
// $sheet->setCellValue( 'Y1' ,'Cargo_des');
// $sn=1;
// echo implode($separator, array_keys($data[0])) . "\n";

// foreach ($data as $prod) {
// // echo $prod->product_name;
// // $sheet->setCellValue( 'A1' ,$prod['id']);
// // $sheet->setCellValue( 'B1' ,$prod['id']);
// // $sheet->setCellValue( 'C1' ,$prod['id']) ;
// // $sheet->setCellValue( 'D1' ,$prod['id']);
// // $sheet->setCellValue( 'E1' ,$prod['id']);
// // $sheet->setCellValue( 'F1' ,$prod['id']);
// // $sheet->setCellValue( 'G1' ,$prod['id']);
// // $sheet->setCellValue( 'H1' ,$prod['BAYAN_NO']);
// // $sheet->setCellValue( 'I1' ,'TYPE_OF_TRUCK');
// // $sheet->setCellValue( 'J1' ,'TRUCK_NO');
// // $sheet->setCellValue( 'K1' ,'DRIVER_NAME');
// // $sheet->setCellValue( 'L1' ,'DRIVER_MOBILE');
// // $sheet->setCellValue( 'M1' ,'Date');
// // $sheet->setCellValue( 'N1' ,'auth');
// // $sheet->setCellValue( 'O1' ,'D_O');
// // $sheet->setCellValue( 'P1' ,'requester_name');
// // $sheet->setCellValue( 'Q1' ,'File_no');
// // $sheet->setCellValue( 'R1' ,'B_L');
// // $sheet->setCellValue( 'S1' ,'Consignee_no');
// // $sheet->setCellValue( 'T1' ,'Contact_name');
// // $sheet->setCellValue( 'U1' ,'Contact_no');
// // $sheet->setCellValue( 'V1' ,'Iqama_no');
// // $sheet->setCellValue( 'W1' ,'Item_qu');
// // $sheet->setCellValue( 'X1' ,'Port_ty');
// // $sheet->setCellValue( 'Y1' ,'Cargo_des');
// // $sn++;


// foreach($prod as $k => $v){
//     $prod[$k] = str_replace($separator . "$", "", $prod[$k]);
//     $prod[$k] = preg_replace("/\r\n|\n\r|\n|\r/", " ", $prod[$k]);
//     $prod[$k] = trim($prod[$k]);
// }

// }
// // $writer= new Xlsx($spreadsheet);
// // $writer->save( "php: //output" ) ;
    
// echo implode($separator, $prod) . "\n";

}  

}

    Function MaliSend(){
        require ( 'phpmail/vendor/phpmailer/phpmailer/src/Exception.php');
require 'phpmail/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'phpmail/vendor/phpmailer/phpmailer/src/SMTP.php';

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
$mail->Subject = "New D/O  No.".$GLOBALS['contractnom'];" ";

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





?>
