<?php
        include 'top.html';
    ?>
<!-- ###### --header>
    <?php
        include 'include/headerTopDefinition.php';
    ?>
    <!-- ###### -->
<script>

function ValidateEmail(mail)   
{  
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(register.email.value))  
  {  
    return (true)  
  }  
    alert("You have entered an invalid email address!")  
    return (false)  
}



function validateForm()
{
var x=document.register.firstName.value;
if (x==null || x=="")
  {
  alert("First name must be filled out");
  document.register.firstName.focus() ;
  return false;
  }
var x=document.register.lastName.value;
if (x==null || x=="")
  {
  alert("Last name must be filled out");
  document.register.lastName.focus() ;
  return false;
  }
var x=document.register.email.value;
if (x==null || x=="")
  {
  alert("Email must be filled out");
  document.register.email.focus() ;
  return false;
  }
 if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(register.email.value)))
  {  
    alert("Email is invalid");
    document.register.email.focus() ;
    return (false)  
  } 
  
 var radios = document.register.getElementsByName("lvlOfStudy");
    var formValid = false;

    var i = 0;
    while (!formValid && i < radios.length) {
        if (radios[i].checked) formValid = true;
        i++;        
    }

    if (!formValid)
    { alert("Please choose level of study");
      return false;
    }
var x=document.register.getElementById("ProgrammingExperience").value;
if (x=="" || x=="C and C++...")
  {
  alert("Programming Experience must be explained");
  //document.register.ProgrammingExperience.focus() ;
  return false;
  }

  

if (register.rules.checked==false)
  {
  alert("Please accept the rules and regulations to proceed");
  document.register.rules.focus() ;
  return false;
  }
}
</script>

<body id="top">
    <!-- ###### --header>
    <?php
        include 'include/headerTopDefinition.php';
    ?>
           <!-- ###### -->
<section id="content"><div class="ic"></div>
        <div class="main">
            <div class="container">

        <?php
        //print_r($_POST);
        
        echo "<br>";
        if (isset($_POST['submit']))
        {
            //Connect to database
            require_once '../include/dbCnt.class.php';
                $sqlConn = new dbCnt(); 
                $link = $sqlConn->connect('eestec');
            if(!$link)
                echo 'Connection to database failed.';
            else
            {
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];             
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $programmingExperience  = $_POST['ProgrammingExperience'];
                $embeddedExperience     = $_POST['EmbeddedExperience'];
                $legoRobotExperience    = $_POST['LegoRobotExperience'];
                $motivation             = $_POST['Motivation'];             
                $specialFoodDemands     = $_POST['SpecialFoodDemands'];
                
                date_default_timezone_set('Europe/Berlin');
                $date = date('d-m-Y H:i:s');
                
                if(isset($_POST['gender']))
                {
                    //In database, gender = 1 is female; gender = 2 is male.
                    $gender = $_POST['gender'];
                }
                else
                    $gender='NULL';
                if(isset($_POST['bbq']))
                {
                    //In database, gender = 1 is female; gender = 2 is male.
                    $bbq = $_POST['bbq'];
                }
                else
                    $bbq=0;
                if(isset($_POST['lvlOfStudy']))
                {
                    //In database, gender = 1 is female; gender = 2 is male.
                    $lvlOfStudy = $_POST['lvlOfStudy'];
                }
                else
                    $lvlOfStudy='NULL';
                if(isset($_POST['MealsNotRequired']))
                {
                    //In database, gender = 1 is female; gender = 2 is male.
                    $mealsNotRequired = $_POST['MealsNotRequired'];
                }
                else
                    $mealsNotRequired = 'NULL';
                    
                $mName = $_POST['mName'];
                //In database, uni = 1 is TUK; uni = 2 is FHK.
                $uni= $_POST['uni']; 
                // 0 - false; 1 - true
                $query="INSERT INTO eventSBIapplications(firstName";
                $query=$query.", lastName, idGender, email, phone, levelOfStudy";
                $query=$query.", programmingExperience, embeddedExperience";
                $query=$query.", legoRobotExperience, motivation, specialFoodDemands"; 
                $query=$query.", MealsNotRequired, joinForBBQ, dateAdded)"; 
                $query=$query." VALUES ";
                $query=$query."('".$firstName."', '".$lastName."', 0";
                $query=$query.", '".$email."', '".$phone."', '".$lvlOfStudy;
                $query=$query."', '".$programmingExperience."', '".$embeddedExperience."', '".$legoRobotExperience;
                $query=$query."', '".$motivation."', '".$specialFoodDemands."', '".$mealsNotRequired;
                $query=$query."', ".$bbq.", '".$date."')";
                //echo $query;
                
                if($sqlConn->exeQuery($query))
                {
                    echo '<p>You have succesfully registered.</p><br>';
                /*
                 * Confirmation code is generated based on the last name and email as key.
                 */
                $key = $email;
                $confirmationCode = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $lastName, MCRYPT_MODE_CBC, md5(md5($lastName))));                 
		  require_once('../class.phpmailer.php');

   	 	  $mail             = new PHPMailer(); // defaults to using php "mail()"
	        /* $code_temp        = str_replace("+","%2B",$confirmationCode);
                $code             = str_replace("/","%2F",$code_temp);*/
		  $code = urlencode($confirmationCode);
	 	  $body             = "Dear $firstName $lastName, <br><br> Thanks for applying! <br> You will be informed about status of your application on 24th of July. <br><br>If you have any questions, please contact us at eestec@rhrk.uni-kl.de <br><br>Regards,<br>EESTEC Observer - Kaiserslautern<br>http://www.uni-kl.de/eestec .";
		  $mail->SetFrom('eestec@rhrk.uni-kl.de', 'EESTEC-Kaiserslautern');
	
		  $address = $email;
	 	  $mail->AddAddress($address, "NEW MEMBER");
	
		  $mail->Subject    = "Welcome to Lego robots workshop and competition: Shaped By Imagination";
	
 		  $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // Alt Body
	
		  $mail->MsgHTML($body);

		  $mail->AddAttachment("../images/sbiposter.png");      // attachment
	
		  $mail->AddAttachment("../images/poster.jpg");      // attachment
	
	 	 if(!$mail->Send()) {
	  		echo "Mailer Error: " . $mail->ErrorInfo;
		 } else {
	  	 echo "Thank you for registering. <br/>A confirmation email is sent to your email address '".$_POST['email']."' Please Check Email and Spam too. If your application is accepted, you will be informed on this email.";
		 echo '<meta http-equiv="refresh" content="5;url=http://www.uni-kl.de/eestec/sbi">';
		}
 
           }
           else
           {
               echo '<p>Registration error!!!</p><br> 
               Please try again.</p>';
               echo mysql_errno($link) . ": " . mysql_error($link) . "\n";                    
           }                    
         }
           //Close connection
          $sqlConn->closeConn();
         }
         else
         {
             include 'registerSBI.html';
         }

        ?>	
</div>        
	</div>
        </section>

        <!-- ###### --right column>
        <!-- ###### --quick links>
      </div>
      <!-- ###### -->
             <!-- ###### -->
    <?php
        include 'bottom.html';
    ?>
