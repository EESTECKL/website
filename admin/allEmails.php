<?php
include 'include/headerAndNav.html';

?>
<div id="sadrzaj_okvir">
        <div id="sadrzaj">
                <div id="title" align="center" >
                <?php                          
                  require_once 'include/dbCnt.class.php';
                  $sqlConn = new dbCnt(); 
                  if(!$sqlConn->connect('eestec'))
                      echo 'Connection to database failed.';
                  $query="SELECT email FROM member";
                  $result = $sqlConn->exeQuery($query);

                    // keeps getting the next row until there are no more to get
                    while($row = mysql_fetch_array( $result )) {
                            // Print out all emails                            
                            echo $row['email'].",";                            
                    }
                //Close connection
                $sqlConn->closeConn();
                ?>
                </div>
        </div>   
    </div>
    </div>
</body>
</html>