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
                            <td><a href="#">All emails</a></td>
                            <td><a href="#">All songs</a></td>
                            <td><a href="#">Story</a></td>
                            <td><a href="#">Spicy</a></td>
                            <td><a href="#">Sweet</a></td>
                            <td><a href="#">Salty</a></td>
                            <td><a href="#">Exotic</a></td>
                            <td><a href="#">Vegetarian</a></td>
                            <td><a href="#">Decoration</a></td>
                        </tr>
                    </table>
                    <?php
                        include 'include/intNight.php';
                    ?>
                </div>
        </div>   
    </div>
    </div>
</body>
</html>
