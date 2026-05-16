<?php
session_start();
unset($_SESSION['buyer_id']);
header('Location: /buyer/login');
