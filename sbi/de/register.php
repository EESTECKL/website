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
  alert("Der Vorname muss ausgef&uuml;llt werden");
  document.register.firstName.focus() ;
  return false;
  }
var x=document.register.lastName.value;
if (x==null || x=="")
  {
  alert("Der Nachname muss ausgef&uuml;llt werden");
  document.register.lastName.focus() ;
  return false;
  }
var x=document.register.email.value;
if (x==null || x=="")
  {
  alert("Email muss ausgef&uuml;llt werden");
  document.register.email.focus() ;
  return false;
  }
 if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(register.email.value)))
  {  
    alert("Email ist ung&uuml;ltig");
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
    { alert("Bitte w&auml;hle deinen angestrebten Abschluss aus");
      return false;
    }
var x=document.register.getElementById("ProgrammingExperience").value;
if (x=="" || x=="C and C++...")
  {
  alert("Bitte teile uns deine Programmiererfahrung mit");
  //document.register.ProgrammingExperience.focus() ;
  return false;
  }

  

if (register.rules.checked==false)
  {
  alert("Du musst die Regeln und Bedingungen akzeptieren");
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
            require_once '../../include/dbCnt.class.php';
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
                    echo '<p>Du hast dich erfolgreich angemeldet</p><br>';
                /*
                 * Confirmation code is generated based on the last name and email as key.
                 */
                $key = $email;
                $confirmationCode = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $lastName, MCRYPT_MODE_CBC, md5(md5($lastName))));                 
		  require_once('../../class.phpmailer.php');

   	 	  $mail             = new PHPMailer(); // defaults to using php "mail()"
	        /* $code_temp        = str_replace("+","%2B",$confirmationCode);
                $code             = str_replace("/","%2F",$code_temp);*/
		  $code = urlencode($confirmationCode);
	 	  $body             = "Hallo $firstName $lastName, <br><br> Danke, dass du dich angemeldet hast! <br> Wir werden dich &uuml;ber den Status deiner Bewerbung am 24. Juli informieren. <br><br>Falls du weitere Fragen hast, kannst du dich unter eestec@rhrk.uni-kl.de an uns wenden.<br><br>Mit freundlichem Gruß,<br>EESTEC Observer - Kaiserslautern<br>http://www.uni-kl.de/eestec .";
		  $mail->SetFrom('eestec@rhrk.uni-kl.de', 'EESTEC-Kaiserslautern');
	
		  $address = $email;
	 	  $mail->AddAddress($address, "NEW MEMBER");
	
		  $mail->Subject    = "Willkommen beim Lego-Robots-Workshop und Wettbewerb: Shaped By Imagination";
	
 		  $mail->AltBody    = "Zur richtigen Darstellung der E-Mail benoetigst du einen HTML faehigen E-Mail Client"; // Alt Body
	
		  $mail->MsgHTML($body);

		  $mail->AddAttachment("../images/sbiposter.png");      // attachment
	
		  $mail->AddAttachment("../images/poster.jpg");      // attachment
	
	 	 if(!$mail->Send()) {
	  		echo "Mailer Error: " . $mail->ErrorInfo;
		 } else {
	  	 echo "Danke f&uuml;r die Registrierung <br/>Eine Best&auml;tigungsmail wurde an deine E-Mail Adresse gesendet '".$_POST['email']."' &uuml;berpr&uuml;fe bitte deinen E-mail und Spam-Ordner. Weitere Informationen werden dir &uuml;ber diese E-Mail-Adresse mitgeteilt";
		 echo '<meta http-equiv="refresh" content="5;url=http://www.uni-kl.de/eestec/sbi/de">';
		}
 
           }
           else
           {
               echo '<p>Fehler bei der Registrierung!!!</p><br> 
               Bitte versuche es erneut</p>';
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
