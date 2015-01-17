<?php
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
                    <table>
                        <tr>
				<td><a href="newsletter.php">Newsletter</a></td>
                            <td><a href="allEmails.php">Get all emails</a></td>
                            <td><a href="member_wrote_article.php">Add author of article</a></td>
                            <td><a href="gender.php">Genders</a></td>
                            <td><a href="university.php">Universities</a></td>
                        </tr>
                    </table>
                    <?php
                     date_default_timezone_set('Europe/Berlin');
                     $date = date('d-m-Y H:i:s');
                     echo '<br/>Current date and time: '.$date.'<br/><br/>';
                     // Active and non active members
                     require_once 'include/dbCnt.class.php';
                     $sqlConn = new dbCnt(); 
                     if(!$sqlConn->connect('eestec'))
                        echo 'Connection to database failed.';
                     $query="SELECT email FROM member WHERE active=1";
                     $result = $sqlConn->exeQuery($query);
                     $i=0;
                     while($row = mysql_fetch_array( $result )) {
                         $i = $i+1;
                     }
                     echo 'Active members = '. $i;
                     $query="SELECT email FROM member";
                     $result = $sqlConn->exeQuery($query);
                     $i=0;
                     while($row = mysql_fetch_array( $result )) {
                         $i = $i+1;
                     }
                     echo ' ; Total number of registered members = '. $i.'.    ';
                     include 'include/member.php';
                    ?>
                </div>
        </div>   
    </div>
    </div>
</body>
</html>
