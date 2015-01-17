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
                $specialFoodDemands     = $_POST['SpecialFoodDemands'];
                
                date_default_timezone_set('Europe/Berlin');
                $date = date('d-m-Y H:i:s');
                
                if(isset($_POST['chessCompetition']))
                {
                    //In database, gender = 1 is female; gender = 2 is male.
                    $chessCompetition = $_POST['chessCompetition'];
                }
                else
                    $chessCompetition='NULL';
                if(isset($_POST['bringFood']))
                {
                    //In database, gender = 1 is female; gender = 2 is male.
                    $bringFood = $_POST['bringFood'];
                }
                else
                    $bringFood='NULL';
                if(isset($_POST['makeCookies']))
                {
                    //In database, gender = 1 is female; gender = 2 is male.
                    $makeCookies = $_POST['makeCookies'];
                }
                else
                    $makeCookies='NULL';
                if(isset($_POST['makePizza']))
                {
                    //In database, gender = 1 is female; gender = 2 is male.
                    $makePizza = $_POST['makePizza'];
                }
                else
                    $makePizza='NULL';
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
                    
                $query="INSERT INTO eventIntPeaceDay14(firstName";
                $query=$query.", lastName, email, phone, levelOfStudy";
                $query=$query.", chessCompetition, bringFood";
                $query=$query.", makeCookies, makePizza, joinForBBQ"; 
                $query=$query.", specialFoodDemands, dateAdded)"; 
                $query=$query." VALUES ";
                $query=$query."('".$firstName."', '".$lastName;
                $query=$query."', '".$email."', '".$phone."', '".$lvlOfStudy;
                $query=$query."', '".$chessCompetition."', '".$bringFood."', '".$makeCookies;
                $query=$query."', '".$makePizza."', '".$bbq."', '".$specialFoodDemands."', '".$date."')";
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
	 	  $body             = "Dear $firstName $lastName, <br><br> Thanks for registering!<br><br>";
                
                  if(isset($_POST['chessCompetition']))
                      $body = $body."Please be there for the chess competition at 14h.<br>";
                  if(isset($_POST['bringFood']))
                      $body = $body."Thank you for deciding to bring food. We can refund up to 5e receipts. We can refund things necessary for the meal, such as cheese, chocolate, fruits, etc. But we can not refund general stuff, such is 1l of oil and similar. If you have any doubts, please contact us in advance!!!<br>";
                  if(isset($_POST['makeCookies']))
                      $body = $body."Thank you for deciding to make cookies with us. We will meet at 20.00 o'clock, 18.09, at Lutrinastr. 23 (ring at Jahic). No need to bring anything except the ideas.<br>";
                  if(isset($_POST['makePizza']))
                      $body = $body."Thank you for deciding to make pizza with us. We will make them on 21st of September, from 14.30 to 16.30. No need to bring anything except the ideas.<br>";
                  if(isset($_POST['bbq']))
                      $body = $body."Great that you will join us for the BBQ, at 18.00, on 21st of September. Please bring stuff to grill. We can provide coal and the grill, but not the food.<br>";
                  $body = $body."<br><br>If you have any questions, please contact us at eestec@rhrk.uni-kl.de ";
                  $body = $body."<br><br>Regards,<br>EESTEC Observer - Kaiserslautern<br>http://www.uni-kl.de/eestec .";
		  $mail->SetFrom('eestec@rhrk.uni-kl.de', 'EESTEC-Kaiserslautern');
	
		  $address = $email;
	 	  $mail->AddAddress($address, "NEW MEMBER");
	
		  $mail->Subject    = "International day of peace 2014: Make pizza, not war; EESTECers do not fight";
	
 		  $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // Alt Body
	
		  $mail->MsgHTML($body);

		  $mail->AddAttachment("doc/peacePoster.pdf");      // attachment
	
		  $mail->AddAttachment("../images/poster.jpg");      // attachment
	
	 	 if(!$mail->Send()) {
	  		echo "Mailer Error: " . $mail->ErrorInfo;
		 } else {
	  	 echo "Thank you for registering. <br/>A confirmation email is sent to your email address '".$_POST['email']."' Please Check Email and Spam too.";
		 echo '<meta http-equiv="refresh" content="5;url=http://www.uni-kl.de/eestec/inp">';
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
