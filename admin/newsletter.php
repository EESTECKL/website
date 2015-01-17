<?php
include 'include/headerAndNav.html';

?>

<script>

function validateNewsLetter()
{
var x=document.newsletter.subject.value;
if (x==null || x=="")
  {
  alert("subject must be filled out");
  document.newsletter.subject.focus() ;
  return false;
  }
var x=document.newsletter.content.value;
if (x==null || x=="")
  {
  alert("content must be filled out");
  document.newsletter.content.focus() ;
  return false;
  }
if(confirm("ATTENTION! Please check the all the data. Press ok to proceed or else select cancel to edit"))
{
 	if(confirm("Send the Newsletter?"))
	{
		if(confirm("Beware: This is point of no return! Once you Press 'Ok' news letter will be send to all the members. Take care that there are no MISTAKES!!!!!!!!!!!!"))
			return true;
		else
			return false;

	}
	else
		return false;
}
else
 return false;
}
</script>


<div id="sadrzaj_okvir">
        <div id="sadrzaj">
                <div id="title" align="center" >
        <?php
        // Emails are only sent to active members.
        //print_r($_POST);
        echo "<br>";
        
        if (isset($_POST['submit']))
        {		  require_once('class.phpmailer.php');
			$mail             = new PHPMailer();

			$mail->Subject = $_REQUEST['subject'];
			$body = $_REQUEST['content'];
			$attachment1 = $_REQUEST['attachment1'];
			$attachment2 = $_REQUEST['attachment2'];
			$attachment3 = $_REQUEST['attachment3'];
	
		  	$mail->SetFrom('eestec@rhrk.uni-kl.de', 'EESTEC-Kaiserslautern');
                        if (isset($_POST['emailAddress'])and $_REQUEST['emailAddress']!="")
                        {
                            $mail->AddAddress($_REQUEST['emailAddress']);
                            //echo "Adding ".$_REQUEST['emailAddress']." to the list.";
                        }
                        if (isset($_POST['allMembers']))
                        {
                            echo "Send email to all members.";
                            require_once 'include/dbCnt.class.php';
                            $sqlConn = new dbCnt(); 
                            if(!$sqlConn->connect('eestec'))
                                echo 'Connection to database failed.';
                            $query="SELECT email FROM member WHERE active = 1";
                            $result = $sqlConn->exeQuery($query);

                            // keeps getting the next row until there are no more to get
                            echo "adding: <br/>";
                            while($row = mysql_fetch_array( $result )) {
                                // Print out all emails        
                                    $email_id = $row['email'];                    
                                echo $email_id.",";
                                $mail->AddAddress($email_id);
                                    //$mail->AddAddress($row['email']); //uncomment this line to send email to all users. Also comment the line indicated below                      
                            }
                            //Close connection
                            $sqlConn->closeConn();
                            $mail->AddAddress('gautamgala2007@gmail.com'); //comment this line to stop Debug!! also uncomment line above
                            $mail->AddAddress('jasmin.jahic@gmail.com'); //comment this line to stop Debug!! also uncomment line above
                            $mail->AddAddress('ankit7ag@gmail.com'); //comment this line to stop Debug!! also uncomment line above
                        }
			$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // Alt Body
	
		  	$mail->MsgHTML($body);

		  	$mail->AddAttachment( $_REQUEST['attachment1']);      // attachment
		  	$mail->AddAttachment( $_REQUEST['attachment2']);      // attachment
		  	$mail->AddAttachment( $_REQUEST['attachment3']);      // attachment

	 	 	if(!$mail->Send()) {
	  			echo "Mailer Error: " . $mail->ErrorInfo;
		 	} else {
	  	 		echo "<br/><br/>NewsLetter Sent!!";
			}
			echo "<br/><br/>NewsLetter Sent only to selected members!! rest sending part has been commented for safety right now!!";

		 
	  }
         else
         {
	      include 'include/newsletter.html';
         }
        ?>		

                </div>
        </div>   
    </div>
    </div>
</body>
</html>