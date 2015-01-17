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
                            <td><a href="articleType.php">Types of article</a></td>
                            <td><a href="article_has_articleType.php">Article has type</a></td>
                            <td><a href="article_has_photo_not_in_gallery.php">Article's photos</a></td>
                            <td><a href="article_has_video.php">Article's videos</a></td>
                            <td><a href="article_has_gallery.php">Article's galleries</a></td>
                            <td><a href="member_wrote_article.php">Add author of article</a></td>
                        </tr>
                    </table>
                    <?php
                     date_default_timezone_set('Europe/Berlin');
                     $date = date('d-m-Y H:i:s');
                     echo '<br/>Current date and time: '.$date.'<br/><br/>';
                     
                    
                        include 'include/article.php';
                    ?>
                </div>
        </div>   
    </div>
    </div>
</body>
</html>
