<?php
    if(!isset($_SESSION['user_id'])){
        header("Location: /404");
    }