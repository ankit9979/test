<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use PHPMailer;

class Controller extends BaseController {

    use AuthorizesRequests,
        AuthorizesResources,
        DispatchesJobs,
        ValidatesRequests;

    public function pr($data) {
        echo "<pre>";
        print_r($data);
        exit;
    }

    var $image;
    var $image_type;

    function load($filename) {
        $image_info = getimagesize($filename);
        $this->image_type = $image_info[2];
        if ($this->image_type == IMAGETYPE_JPEG) {
            $this->image = imagecreatefromjpeg($filename);
        } elseif ($this->image_type == IMAGETYPE_GIF) {
            $this->image = imagecreatefromgif($filename);
        } elseif ($this->image_type == IMAGETYPE_PNG) {
            $this->image = imagecreatefrompng($filename);
        }
    }

    function timeDiff($time1, $time2) {

        $a1 = explode(':', $time1);
        $t1 = $a1[0] * 3600 + $a1[1] * 60;

        $a2 = explode(':', $time2);
        $t2 = $a2[0] * 3600 + $a2[1] * 60;

        $t3 = $t1 - $t2;

        $hours = floor($t3 / 3600);
        $minutes = floor(($t3 % 3600) / 60);
        if ($minutes == 0) {
            $minutes = "00";
        } else {
            $minutes = $minutes;
        }


        return $hours . ":" . $minutes;
    }

    function save_img($filename, $image_type = IMAGETYPE_JPEG, $compression = 75, $permissions = null) {
        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image, $filename, $compression);
        } elseif ($image_type == IMAGETYPE_GIF) {
            imagegif($this->image, $filename);
        } elseif ($image_type == IMAGETYPE_PNG) {
            imagepng($this->image, $filename);
        } if ($permissions != null) {
            chmod($filename, $permissions);
        }
    }

    function output($image_type = IMAGETYPE_JPEG) {
        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image);
        } elseif ($image_type == IMAGETYPE_GIF) {
            imagegif($this->image);
        } elseif ($image_type == IMAGETYPE_PNG) {
            imagepng($this->image);
        }
    }

    function getWidth() {
        return imagesx($this->image);
    }

    function getHeight() {
        return imagesy($this->image);
    }

    function resizeToHeight($height) {
        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width, $height);
    }

    function resizeToWidth($width) {
        $ratio = $width / $this->getWidth();
        $height = $this->getheight() * $ratio;
        $this->resize(150, 150);
    }

    function scale($scale) {
        $width = $this->getWidth() * $scale / 100;
        $height = $this->getheight() * $scale / 100;
        $this->resize($width, $height);
    }

    function resize($width, $height) {
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $new_image;
    }

    public function simple_mail($email, $subject, $message) {

        require_once( base_path() . '/mailer/PHPMailerAutoload.php');
        $mail = new PHPMailer;

        $mail->SMTPDebug = 3;                               // Enable verbose debug output
        $mail->setFrom('raifa@remy-database.co.za', 'UZZI');
        $mail->addAddress($email);
        $mail->addCC('raifa.ali1@gmail.com');
        $mail->addCC('raifa@remy-database.co.za');
        //    $mail->addCC('courses@turningpointtutors.co.za');
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if (!$mail->send()) {
            //   echo 'Message could not be sent.';
            //   echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            //    echo 'Message has been sent';
        }
    }

    public function simple_mail_with_file($email, $subject, $message, $file_name) {

        require_once( base_path() . '/mailer/PHPMailerAutoload.php');
        $mail = new PHPMailer;

        $mail->SMTPDebug = 3;                               // Enable verbose debug output
//$mail->isSMTP();                                      // Set mailer to use SMTP//
//$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
//$mail->SMTPAuth = true;                               // Enable SMTP authentication
//$mail->Username = 'user@example.com';                 // SMTP username
//$mail->Password = 'secret';                           // SMTP password
//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//$mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom('raifa@remy-database.co.za', 'UZZI');
        // Add a recipient
        // Name is optional

        foreach ($email as $em) {
            $mail->addAddress($em);
        }
//$mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC('raifa.ali1@gmail.com');
        $mail->addCC('raifa@remy-database.co.za');
        $mail->addCC('tptankit@gmail.com');
//$mail->addBCC('bcc@example.com');
        foreach ($file_name as $ff) {
            $mail->addAttachment($ff);
        }
        // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if (!$mail->send()) {
            //    echo 'Message could not be sent.';
            //  echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            //   echo 'Message has been sent';
        }
    }

    public function convert_to_csv($input_array, $output_file_name, $delimiter) {
        /** open raw memory as file, no need for temp files */
        $temp_memory = fopen('php://memory', 'w+');
        /** loop through array  */
        foreach ($input_array as $line) {
            /** default php csv handler * */
            fputcsv($temp_memory, $line, $delimiter);
        }
        /** rewrind the "file" with the csv lines * */
        fseek($temp_memory, 0);

        /** modify header to be downloadable csv file * */
        header('Content-Type: application/csv');

        header('Content-Disposition: attachement; filename="' . $output_file_name . '";');
        /** Send file to browser for download */
        fpassthru($temp_memory);
    }

}
