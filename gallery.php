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
      <div id="gallery" class="clear">
        <?php    
                  require_once 'include/dbCnt.class.php';
                  $sqlConn = new dbCnt(); 
                  if(!$sqlConn->connect('eestec'))
                      echo 'Connection to database failed.';
                  $query="SELECT * FROM gallery";
                  $result = $sqlConn->exeQuery($query);
                    // keeps getting the next row until there are no more to get
                    while($row = mysql_fetch_array( $result )) {
                            // Print out name of galleries
                            echo '<h4>'.$row['title'].'</h4>';
                            echo '<br>';
                            $query="SELECT DISTINCT photo.title as photoTitle, link, gallery.title as galleryTitle FROM gallery, gallery_has_photo, photo ";
                            $query=$query."WHERE gallery_has_photo.idGallery = ".$row['idGallery'];
                            $query=$query." AND gallery_has_photo.idPhoto = photo.idPhoto";
                            $query=$query." AND gallery.idGallery = ".$row['idGallery'];
                            $query=$query." ORDER BY gallery.idGallery, gallery_has_photo.idGallery DESC";
                            $result1 = $sqlConn->exeQuery($query);
                            //$i=0;
                            while($row1 = mysql_fetch_array( $result1)) 
                            {
                                //print_r($row1);
                                /**
                                 * All names of the gallery folders match to title of the gallry.
                                 * Only change is that there are no free spaces.
                                 * So we must remove whitespaces from gallery title.
                                 * Otherwise, images won't show properly.
                                 * FOR SOME REASON, SERVER WON'T LOAD PHOTOS
                                 * IF EXTENSION IS IN CAPITAL LETTER!!!!
                                 */
                                $titleGallery = str_replace(' ','',$row1['galleryTitle']);
                                //Create path to image and image small:
                                $path='images/galleries/'.$titleGallery.'/'.$row1['link'];
                                $pathSmall='images/galleries/'.$titleGallery.'/small/'.$row1['link'];
                                //$titleGallery = "gallery1";
                                $imgQuery='<a href="'.$path.'" rel="prettyPhoto['.$row1['galleryTitle'].']"';
                                $imgQuery=$imgQuery.' title="'.$row1['galleryTitle'].'">';
                                $imgQuery=$imgQuery.' <img src="'.$pathSmall.'" alt="'.$row1['photoTitle'].'"/></a>';
                                echo $imgQuery;                               			
                            }
                            echo "<br/> <br/> <br/> <br/>";

                    }
                //Close connection
                $sqlConn->closeConn();   
              ?> 
      </div>
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
