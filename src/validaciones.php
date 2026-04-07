<?php

function getUserSesion()
{
    return isset($_SESSION['userRegistrado']) &&  $_SESSION['userRegistrado'] ? true : false;
}


