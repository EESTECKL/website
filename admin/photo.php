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
                            <td><a href="gallery_has_photo.php">Add photos to gallery</a></td>
                        </tr>
                    </table>
                    <?php                          
                        include 'include/photo.php';
                    ?>
                </div>
        </div>   
    </div>
    </div>
</body>
</html>
