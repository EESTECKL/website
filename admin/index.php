<?php
if (isset($_POST['logoff']) and isset($_COOKIE['admin'])) 
      {
        $admin = $_COOKIE['admin'];
        //Delete cookie
        setcookie("admin",$admin, time()-3600,'/');
        header('Location: '.$_SERVER['PHP_SELF']);
        die;
      }
    /*if(!isset($_COOKIE['admin'])) 
    {
    header("Location: http://www.uni-kl.de/eestec/index.php");
    die;
    }*/
    include 'include/headerAndNav.html';
?>

<div id="sadrzaj_okvir">
        <div id="sadrzaj">
                <div id="title" align="center" >
                    We are all heroes
                    <br/>
                    <a href="eventAndroidWorkshop2014.php">Android App Development Workshop: Chocolate Cookie (1.0)</a>
                    <br/>
                    <a href="eventUnityWorkshop2014.php">Unity workshop and competition: Imagine.Create.Enjoy</a>
                    <br/>
                    <a href="eventIntPeaceDay14.php">International day of peace 2014</a>
                    <br/>
                    <a href="eventSBIapplications.php">Lego robots workshop and competition: Shaped By Imagination</a>
                    <br/>
                    <a href="intNight.php">International nite</a>
                    <?php
                        echo '<form action="" method="post">';
                        echo '<button type="submit" name="logoff" value="logoff">Log off</button>';
                        echo '</form>'; 
                    ?>
                 
                </div>
        </div>   
    </div>
    </div>
</body>
</html>
