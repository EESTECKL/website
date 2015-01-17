<?php
include 'loginSimple.php';
?>
<!-- ###### -->
    <?php
        include 'include/headerTopDefinition.html';
    ?>
<!-- ###### -->
</head>
<body id="top">
    <!-- ###### -->
        <?php
            include 'include/headerWithNavigationSimple.html';
        ?>
    <!-- ###### -->
<div class="wrapper row3">
  <div class="rnd">
    <div id="container" class="clear">
      <div id="homepage" class="clear">
        <div id="latestnews" style="width: 640px">
        <?php
            if (isset($_POST['confirm']))
            {
                //Connect to database
            require_once 'include/dbCnt.class.php';
                $sqlConn = new dbCnt(); 
                $link = $sqlConn->connect('eestec');
                if(!$link)
                    echo 'Connection to database failed.';
                else
                {
		      $email = $_GET['user_email'];
                    $pass = $_POST['pass'];             
                    $confCode = $_GET['user_code'];
                    $key = $email;
                    $pass = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $pass, MCRYPT_MODE_CBC, md5(md5($key))));         
                
                    
                    $query="SELECT * FROM member WHERE email='".$email."' AND ";
                    $query=$query."password='".$pass."'";
                    //echo $query; 
                    if($sqlConn->exeQuery($query))
                    {
                    $result=$sqlConn->exeQuery($query);
                    $row = mysql_fetch_array( $result);
                    //Check if user exists with this email and pass:
                        if(isset ($row['email']))
                        {
                            $key = $row['email'];
                            $lastName = $row['lastName'];
                            $confirmationCode = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $lastName, MCRYPT_MODE_CBC, md5(md5($lastName))));                
                            //Check if confirmation code is valid:
                            if($confCode==$confirmationCode)
                            {
                                $active = $row['active'];
                                if($active==1)
                                    echo '<p>Your account is already activated!</p><br>';
                                else
                                {
                                    $query="UPDATE member SET active=1 ";
                                    $query=$query."WHERE email ='".$email."'";                   
                                    //echo $query;
                                    if($sqlConn->exeQuery($query))
                                    {
                                        echo '<p>Your account has been activated!</p><br>';
                                    }
                                    else
                                    {
                                        echo '<p>Activation error, please try again!</p><br>';
                                        include 'include/confirmUser.html';
                                    }
                                }                               
                            }
                            else
                             {   echo '<p>Confirmation code wrong. Please try again! <br> If the error persists, please contact us at eestec@rhrk.uni-kl.de</p><br>';
				 }
                        }
                        else
                            echo '<p>Email or password wrong, Please try again! <br> In case if you forgot your password, please contact us at eestec@rhrk.uni-kl.de</p><br>';
                     
                    /*
                     * Send email to the user with the confirmation code.
                     * Include link http://www.uni-kl.de/eestec/confirm.php .
                     * Maybe provide link including confirmation code.
                     */    
                    }
                    else
                    {
                        echo '<p>Activation error, Please try again! <br> If the error persists, please contact us at eestec@rhrk.uni-kl.de</p><br>';
                        echo mysql_errno($link) . ": " . mysql_error($link) . "\n";  
                        include 'include/confirmUser.html';
                    }                    
                }
            //Close connection
            $sqlConn->closeConn();
            }
            else
            {     echo "<p>Thank you for registration. For any additional information, feel free to contact us on eestec@rhrk.uni-kl.de.</p>";

            echo "<H1>EMAIL: " . $_GET["user_email"] . "<br></H1>";	

                echo "<H1>Enter your password to activate the account</H1>";
                include 'include/confirmUser.html';
            }
                
        ?>		
                
        </div>

        <!-- ###### -->
         <?php
            include 'include/rightColumn.html';
         ?>
        <!-- ###### -->
      </div>
      <!-- ###### -->
        <?php
            include 'include/quicklyLinks.html';
        ?>
      <!-- ###### -->
      </div>
  </div>
</div>
    <!-- ###### -->
        <?php

            include 'include/bottom.html';
        ?>
    <!-- ###### -->
</body>
</html>