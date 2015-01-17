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
  alert("email-id must be filled out");
  document.register.email.focus() ;
  return false;
  }
 if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(register.email.value)))
  {  
    alert("email-id is invalid");
    document.register.email.focus() ;
    return (false)  
  } 
    var x=document.register.pass.value;
if (x==null || x=="")
  {
  alert("password must be filled out");
  document.register.pass.focus() ;
  return false;
  }
if(x.length<5)
{
  alert("password must be atleast 5 charecters long");
  document.register.pass.focus() ;
  return false;

}
var y=document.register.repass.value;
if (y==null || x!=y)
  {
  alert("entered password don't match");
  document.register.repass.focus() ;
  document.register.pass.focus() ;
  return false;
  }

   var radios = document.getElementsByName("uni");
    var formValid = false;

    var i = 0;
    while (!formValid && i < radios.length) {
        if (radios[i].checked) formValid = true;
        i++;        
    }

    if (!formValid)
    { alert("Please select a university");
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
            require_once 'include/dbCnt.class.php';
                $sqlConn = new dbCnt(); 
                $link = $sqlConn->connect('eestec');
            if(!$link)
                echo 'Connection to database failed.';
            else
            {
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];             
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                //Encrypt password, based on email which is unique in the database
                $key = $email;
                $pass = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $pass, MCRYPT_MODE_CBC, md5(md5($key))));
                //echo strlen($pass);
                //Decrypt
                //$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($encrypted), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
                
                date_default_timezone_set('Europe/Berlin');
                $date = date('d-m-Y H:i:s');
                
                if(isset($_POST['gender']))
                {
                    //In database, gender = 1 is female; gender = 2 is male.
                    $gender = $_POST['gender'];
                }
                else
                    $gender='NULL';

                    
                $mName = $_POST['mName'];
                //In database, uni = 1 is TUK; uni = 2 is FHK.
                $uni= $_POST['uni']; 
                // 0 - false; 1 - true
                $query="INSERT INTO member(email, password, firstName";
                $query=$query.", secondName, lastName, admin, active, alumni";
                $query=$query.", registrationDate";
                $query=$query.", idGender, iduniversity) VALUES ";
                $query=$query."('".$email."', '".$pass."', '".$firstName."', '".$mName;
                $query=$query."', '".$lastName."', 0, 0, 0, '".$date."', ".$gender;
                $query=$query.", ".$uni.")";
                //echo $query;
                if($sqlConn->exeQuery($query))
                {
                    echo '<p>You have succesfully registered.</p><br> 
                      ';
                /*
                 * Confirmation code is generated based on the last name and email as key.
                 */
                $key = $email;
                $confirmationCode = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $lastName, MCRYPT_MODE_CBC, md5(md5($lastName))));                 
		  require_once('class.phpmailer.php');

   	 	  $mail             = new PHPMailer(); // defaults to using php "mail()"
	        /* $code_temp        = str_replace("+","%2B",$confirmationCode);
                $code             = str_replace("/","%2F",$code_temp);*/
		  $code = urlencode($confirmationCode);
	 	  $body             = "Dear $firstName $lastName, <br> Thanks for registering! <br> Please click on the link to complete the registration process: http://www.uni-kl.de/eestec/confirm.php?user_email=$email&user_code=$code <br><br> If you experience some technical difficulty with the registration process, please contact us at eestec@rhrk.uni-kl.de <br><br><br>Regards,<br>EESTEC Observer - Kaiserslautern";
	
		  $mail->SetFrom('eestec@rhrk.uni-kl.de', 'EESTEC-Kaiserslautern');
	
		  $address = $email;
	 	  $mail->AddAddress($address, "NEW MEMBER");
	
		  $mail->Subject    = "Please verify your EESTEC-KL account";
	
 		  $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // Alt Body
	
		  $mail->MsgHTML($body);

		  $mail->AddAttachment("rules_and_regulations.pdf");      // attachment
	
		  $mail->AddAttachment("images/poster.jpg");      // attachment
	
	 	 if(!$mail->Send()) {
	  		echo "Mailer Error: " . $mail->ErrorInfo;
		 } else {
	  	 echo "A verification email was sent to your email address '".$_POST['email']."' Please Check Email and Spam too.";
		 echo '<meta http-equiv="refresh" content="5;url=http://www.uni-kl.de/eestec/index.php">';
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
             include 'int_nite_register.html';
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
