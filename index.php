<?php
include 'loginSimple.php';
?>
<!-- ###### -->
    <?php
        include 'include/headerTopDefinition.php';
    ?>
<!-- ###### -->
</head>
<!-- Homepage -->
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
      <h2 align="center"> <font color="navy">WHAT IS EESTEC?</font></h2>

		 <div align="center">	  
		 <font color="navy">
		 <strong>EESTEC (Electrical Engineering Students' European assoCiation) is a non-political, non-profit organization of and for
		 Electrical Engineering and Computer Science (EECS) students at
		 universities, institutes and technical schools in Europe awarding an
		 engineering degree.</strong> The aim is to promote and develop
		 international contacts and the exchange of ideas among the students of
		 EECS. The association achieves its aim through improving technical
		 knowledge of EECS students, introducing them to the industry and the
		 educational system of other countries.
		 <br/>
         Please click on the tabs above to get further and detailed information about EESTEC and Observer Kaiserslautern!</font>
    	 <br/>
    	 <br/>    	 
		 <br/>
    	 </div>
      <!-- ####################################################################################################### -->
      <div id="homepage" class="clear">
        <!-- ###### -->
        <!-- ###### -->
        <div id="latestnews" style="width: 640px">
          <h2>NEWS</h2>
          <ul>
              <?php    
                  require_once 'include/dbCnt.class.php';
                  $sqlConn = new dbCnt(); 
                  if(!$sqlConn->connect('eestec'))
                      echo 'Connection to database failed.';
                  $query="SELECT link, textContent, article.title FROM";
                  $query=$query." article, photo WHERE article.idPhoto = photo.idPhoto";
                  $query=$query." ORDER BY idArticle DESC";
                  $result = $sqlConn->exeQuery($query);

                    // keeps getting the next row until there are no more to get
                    while($row = mysql_fetch_array( $result )) {
                            // Print out the contents of each row into a table
                            echo '<li class="clear">';
                            echo '<div class="imgl"><img src="';
                            echo $row['link'];
                            echo '" alt="" width="125" height ="125px"/></div>';
                            echo '<div class="latestnews" style="width: 500px; height: 132px">';
                            echo '<p><a href="#">';
                            echo $row['title'];
                            echo '<span class="auto-style2"></span></a></p><p>';
                            echo $row['textContent'];
                            echo '</p></div>';
                            echo '</li>';
                    }
                //Close connection
                $sqlConn->closeConn();
              ?> 
          </ul>

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