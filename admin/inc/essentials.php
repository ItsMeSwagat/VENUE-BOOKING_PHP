<?php

function adminLogin()
{
    session_start();
    if (!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
        echo "
            <script>
                window.location.href='index.php';
            </script>
        ";
    }
}
function redirect($url)
{
    echo "
        <script>window.location.href = '$url';</script>
    ";
}

function alertMsg($msg)
{
    echo "
                        <div class='alert'>
                            <span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span>
                            $msg
                        </div> 
                ";
}
