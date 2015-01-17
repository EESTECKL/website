<?php
    if (isset($_POST['logoff']) and isset($_COOKIE['user'])) 
      {
        $username = $_COOKIE['user'];
        //Delete cookie
        setcookie("user",$username, time()-3600,'/');
        header('Location: '.$_SERVER['PHP_SELF']);
        die;
      }
    if (isset($_POST['panel']) and isset($_COOKIE['user'])) 
      {
        $username = $_COOKIE['user'];
        header('Location: http://www.uni-kl.de/eestec/login.php');
        die;
      }
    if (isset($_POST['login'])) 
      {
        if(isset($_COOKIE['admin'])) 
          {
             header('Location: http://www.uni-kl.de/eestec/admin/index.php');
             die;
          }
        if((isset($_POST['email'])) and (isset($_POST['pass'])))
        {                 
            
            if(($_POST['email']!='') and ($_POST['pass']!=''))
            {
                //Open connection
                require_once 'include/dbCnt.class.php';
                $sqlConnSimple = new dbCnt(); 
                if(!$sqlConnSimple->connect('eestec'))
                    echo 'Connection to database failed.';
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $key = $email;
               //Admin hardcoded
                if(($email=='eestec' and $pass=='eestecTUK') or ($email=='sonja' and $pass=='best'))
                {    
                    setcookie('admin', 'admin',time()+3600*24*30,'/');
                    header('Location: http://www.uni-kl.de/eestec/admin/');
                    die;
                }
                $pass = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $pass, MCRYPT_MODE_CBC, md5(md5($key))));
                $query = 'SELECT * FROM member WHERE email="'.$email;
                $query = $query.'" AND password="'.$pass.'" and active=1';
                $result = $sqlConnSimple->exeQuery($query);
                $row = mysql_fetch_array( $result );
                if((count($result)==1) and ($row['email'] == $email))
                {
                    setcookie('user', $email,time()+3600*24*30,'/');
                    header('Location: '.$_SERVER['PHP_SELF']);
                    die;
                }
                else
                    header('Location: http://www.uni-kl.de/eestec/login.php');
                    die; 
                //Close connection
                $sqlConnSimple->closeConn(); 
            }
            else
               $message = '<p class="error">Username or password missing.</p>'; 
        }
        else
            $message = '<p class="error">Username or password missing.</p>';

        $email = $_POST['email'];
        $pass = $_POST['pass'];                     
      } 
      
if(!isset($_COOKIE['user'])) 
  {
     echo'<div id="loginSimple">
         <form action="" method="post">
            <input type="text" name="email" size="20" maxlength="45" value="email" >
            <input type="password" name="pass" size="20" maxlength="45" value="password" >
            <button type="submit" name="login" value="login">Log in</button>
         </form>
        </div>';        
  }
  else
  {
      //Open connection
      require_once 'include/dbCnt.class.php';
      $sqlConnSimple = new dbCnt(); 
      if(!$sqlConnSimple->connect('eestec'))
            echo 'Connection to database failed.';
      $email = $_COOKIE['user'];
      $query = 'SELECT * FROM member WHERE email="'.$email.'"';
      $query = $query." AND active=1";
      $result = $sqlConnSimple->exeQuery($query);
      $row = mysql_fetch_array( $result ); 
      echo'<div id="loginSimple">';   
      echo '<form action="" method="post">';
      echo "Welcome, ".$row['firstName']." ".$row['secondName']." ".$row['lastName'];
      echo '  <button type="submit" name="panel" value="panel">Panel</button>';
      echo '  <button type="submit" name="logoff" value="logoff">Log off</button>';
      echo '</form>';
      echo '</div>';
      //Close connection
      $sqlConnSimple->closeConn(); 
      
  }
  if(isset ($message))
      echo $message;
?>
