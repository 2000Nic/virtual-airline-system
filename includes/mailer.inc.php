<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include '../PHPMailer/src/Exception.php';
include '../PHPMailer/src/PHPMailer.php';
include '../PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);
