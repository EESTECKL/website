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
<!-- ####################################################################################################### -->
<div class="wrapper row3">
  <div class="rnd">
    <div id="container" class="clear">
      <!-- ####################################################################################################### -->
      <div id="homepage" class="clear">
        <!-- ###### -->
        <!-- ###### -->
<div id="latestnews" style="width: 640px">
          <h2>Events in which EESTEC Kaiserslautern took part</h2>
          <ul>
              <?php    
                  require_once 'include/dbCnt.class.php';
                  $sqlConn = new dbCnt(); 
                  if(!$sqlConn->connect('eestec'))
                      echo 'Connection to database failed.';
                  $query="SELECT link, article.title, textContent FROM";
                  $query=$query." article, photo, article_has_articleType";
                  $query=$query." WHERE article.idPhoto = photo.idPhoto";
                  $query=$query." AND article.idArticle = article_has_articleType.idArticle";
                  $query=$query." AND article_has_articleType.idArticleType = 2";
                  $query=$query." ORDER BY article.idArticle DESC";
                  // article_has_articleType.idArticleType = 2 - Event articles
                  // Pay attention to capital T 
                  $result = $sqlConn->exeQuery($query);
                  
                    // keeps getting the next row until there are no more to get
                    while($row = mysql_fetch_array($result)) {
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