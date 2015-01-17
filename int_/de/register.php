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
var x=document.register.country.value;
if (x==null || x=="")
  {
  alert("Country must be filled out");
  document.register.country.focus() ;
  return false;
  }
var x=document.register.teamName.value;
if (x==null || x=="")
  {
  alert("Team name must be filled out");
  document.register.teamName.focus() ;
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
            require_once '../../include/dbCnt.class.php';
                $sqlConn = new dbCnt(); 
                $link = $sqlConn->connect('eestec');
            if(!$link)
                echo 'Connection to database failed.';
            else
            {
                $firstName = $_POST['firstName'];
                $mName = $_POST['mName'];
                $lastName = $_POST['lastName'];             
                $email = $_POST['email'];
                $teamMembNumber = $_POST['teamMembNumber'];
                $country = $_POST['country'];
                $teamName = $_POST['teamName'];
                $songLink = $_POST['songLink'];
                if($firstName != "" AND $lastName != "" AND $email != "" AND $country != "" AND  $teamName  != "")
                    $inputOK=true;
                else {
                    $inputOK=false;
                }
                /*
                 * 1 - logical true
                 * 0 - logical false
                 * If checkbox checked, then it is logical 1
                 */
                if (isset($_POST['spicy']))
                    $spicy=1;
                else
                    $spicy=0;
                if (isset($_POST['vegetarian']))
                    $vegetarian=1;
                else
                    $vegetarian=0;
                if (isset($_POST['salty']))
                    $salty=1;
                else
                    $salty=0;
                if (isset($_POST['sweet']))
                    $sweet=1;
                else
                    $sweet=0;
                if (isset($_POST['decoration']))
                    $decoration=1;
                else
                    $decoration=0;
                if (isset($_POST['story']))
                    $story=1;
                else
                    $story=0;
                if (isset($_POST['exotic']))
                    $exotic=1;
                else
                    $exotic=0;

                // 0 - false; 1 - true
                $query="INSERT INTO intNightCompetitor(email, firstName";
                $query=$query.", secondName, lastName, teamMembNumber, country";
                $query=$query.", teamName, spicy, vegetarian, salty, sweet,";
                $query=$query."decoration, story, exotic, songLink) VALUES ";
                $query=$query."('".$email."','".$firstName."','".$mName;
                $query=$query."', '".$lastName."', ".$teamMembNumber.", ";
                $query=$query."'".$country."','".$teamName."',".$spicy.",".$vegetarian;
                $query=$query.",".$salty.",".$sweet.",".$decoration.",".$story;
                $query=$query.",".$exotic.",'".$songLink."')";
                //echo $query;
                if($inputOK)
                {
                    if($sqlConn->exeQuery($query))
                    {
                        echo '<p>You have succesfully registered.</p><br> 
                          ';
                    /*
                     * Confirmation code is generated based on the last name and email as key.
                     */
                    $confirmationCode = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($email), $lastName, MCRYPT_MODE_CBC, md5(md5($lastName))));                 
                      require_once('../../class.phpmailer.php');

                      $mail             = new PHPMailer(); // defaults to using php "mail()"
                    /* $code_temp        = str_replace("+","%2B",$confirmationCode);
                    $code             = str_replace("/","%2F",$code_temp);*/
                      $code = urlencode($confirmationCode);
                      $body             = "Dear $firstName $lastName, <br><br> Thanks for registering! <br>
                      For the International Nite: Taste me before you judge me (INT), we hope that you will give your best to prepare meal(s) which will present your country in the best manner. We wish you good luck with preparations and competition. <br><br>
                      You will be informed about presentation details of the event on this email, four days before the event. <br> If you have any further questions, please contact us at eestec@rhrk.uni-kl.de <br><br><br>Regards,
                      <br>EESTEC Observer - Kaiserslautern
                      <br>http://www.uni-kl.de/eestec/";

                      $mail->SetFrom('eestec@rhrk.uni-kl.de', 'EESTEC-Kaiserslautern');

                      $address = $email;
                      $mail->AddAddress($address, "NEW COMPETITOR");

                      $mail->Subject    = "International nite competition";

                      $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // Alt Body

                      $mail->MsgHTML($body);

                      $mail->AddAttachment("int_nite_rules_and_regulations.pdf");      // attachment

                      $mail->AddAttachment("images/poster.jpg");      // attachment

                     if(!$mail->Send()) {
                            echo "Mailer Error: " . $mail->ErrorInfo;
                     } else {
                     echo "A verification email was sent to your email address '".$_POST['email']."' Please Check Email and Spam too.";
                     echo '<meta http-equiv="refresh" content="5;url=http://www.uni-kl.de/eestec/int">';
                    }
 
                    }
                   
                   else
                   {
                       echo '<p>Registration error!!!</p><br> 
                       Please try again.</p>';
                       echo mysql_errno($link) . ": " . mysql_error($link) . "\n";                    
                   }
                }
                else
                {
                    echo '<p>Input error!!!</p><br> 
                       Please try again.</p>';
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
