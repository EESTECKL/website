<?php
    if (isset($_POST['login'])) 
      {
        if((isset($_POST['email'])) and (isset($_POST['pass'])))
        {
            if(($_POST['email']!='') and ($_POST['pass']!=''))
            {
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $key = $email;
                //Admin hardcoded
                if($email=='eestec' and $pass=='eestecTUK')
                {    
                    setcookie('admin', 'eestec',time()+3600*24*30,'/');
                    header('Location: http://www.uni-kl.de/eestec/admin/index.php');
                    die;
                }
                $pass = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $pass, MCRYPT_MODE_CBC, md5(md5($key))));
                //Open connection
                require_once 'include/dbCnt.class.php';
                $sqlConn = new dbCnt();
                if(!$sqlConn->connect('eestec'))
                    echo 'Connection to database failed.';
                $query = 'SELECT * FROM member WHERE email="'.$email;
                $query = $query.'" AND password="'.$pass.'" and active=1';
                $result = $sqlConn->exeQuery($query);
                $row = mysql_fetch_array( $result );
                $sqlConn->closeConn();
                if((count($result)==1) and ($row['email'] == $email))
                {
                    setcookie('user', $email,time()+3600*24*30,'/');
                    header('Location: '.$_SERVER['PHP_SELF']);
                    die;
                }
                else
                    $message = '<p class="error">Username or password wrong.</p>';                       
            }
            else
               $message = '<p class="error">Username or password missing.</p>'; 
        }
        else
            $message = '<p class="error">Username or password missing.</p>';

        $email = $_POST['email'];
        $pass = $_POST['pass'];                     
      } 
      
      if (isset($_POST['logoff']) and isset($_COOKIE['user'])) 
      {
        $username = $_COOKIE['user'];
        //Delete cookie
        setcookie("user",$username, time()-3600,'/');
        header('Location: '.$_SERVER['PHP_SELF']);
        die;
      }
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
<!-- ####################################################################################################### -->
<div class="wrapper row3">
  <div class="rnd">
    <div id="container" class="clear">
      <!-- ####################################################################################################### -->
      <div id="homepage" class="clear">
        <!-- ###### -->
        <!-- ###### -->
        <div id="latestnews" style="width: 640px">
        <?php
          if(!isset($_COOKIE['user'])) 
          {
             include 'include/login.html';           
          }
          else
          {
              require_once 'include/dbCnt.class.php';
              $sqlConn = new dbCnt(); 
              if(!$sqlConn->connect('eestec'))
                echo 'Connection to database failed.';
              $email = $_COOKIE['user'];
              $query = 'SELECT * FROM member WHERE email="'.$email.'"';
              $query = $query." AND active=1";
              $result = $sqlConn->exeQuery($query);
              $row = mysql_fetch_array($result);

              echo '<table style="text-align:center;">';
              echo '<tr><td>Email:</td><td>';
              echo $row['email'];
              echo '</td></tr><tr><td>Name:</td><td>';
              echo $row['firstName'];
              echo '</td></tr>';
              echo '<tr><td>Middle name:</td><td>';
              echo $row['secondName'];
              echo '</td></tr>';
              echo '<tr><td>Last name:</td><td>';
              echo $row['lastName'];
              echo '</td></tr>';
              echo '<tr><td>Member since:</td><td>';
              echo $row['registrationDate'];
              echo '</td></tr>';
              echo '</table>';
              echo '<form action="" method="post">';
              echo '<button type="submit" name="logoff" value="logoff">Log off</button>';
              echo '</form>'; 
              $sqlConn->closeConn();  
          }
          if(isset ($message))
              echo $message;
          //Close connection

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