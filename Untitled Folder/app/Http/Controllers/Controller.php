<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use PHPMailer;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;  
class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	public function singleImageUpload($file,$path=null){
		$filenamewithextension = $file->getClientOriginalName();
		$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
		$extension = $file->getClientOriginalExtension();
		$filenametostore = str_slug($filename).'_'.time().uniqid().'.'.$extension;
		//customize path as per month year
		$path = $path.'/'.date('Y').'/'.date('m');		
        //file store to storage
		return $file->storeAs($path, $filenametostore);

		
	}

	public function multipleImageUpload($files,$path=null){
		$multipleImg = array();
		$path = $path.'/'.date('Y').'/'.date('m');	
		foreach($files as $file){
			$filenamewithextension =$file->getClientOriginalName();
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
			$extension =$file->getClientOriginalExtension();
			$filenametostore = str_slug($filename).'_'.time().uniqid().'.'.$extension;
		    //customize path as per month year
			
            //file store to storage
			$original_file_path = $file->storeAs($path, $filenametostore);

			$multipleImg[] = array(
				'file_path'=>$original_file_path				
			);
		}		
		return $multipleImg;
	}


	public function sendMail($sendTo=null,$subject=null,$body=null){
		require_once(base_path()."/class.phpmailer.php");
  $mail = new PHPMailer(true); //New instance, with exceptions enabled
//From email address and name
  $mail->From = 'tptankit@gmail.com';
  $mail->FromName = 'Ankit Jogani';
//To address and name
  $mail->addAddress($sendTo['email'], $sendTo['name']);

  $mail->isHTML(true);
  $mail->Subject = $subject;
  $mail->Body = $body;
  //$mail->AltBody = "This is the plain text version of the email content";
  return $mail->send();
}
public function sendMailBulk($sendTo=null,$subject=null,$body=null){
	require_once(base_path()."/class.phpmailer.php");
  $mail = new PHPMailer(true); //New instance, with exceptions enabled
//From email address and name
  $mail->From = 'tptankit@gmail.com';
  $mail->FromName = 'Ankit Jogani';
//To address and name
  if(!empty($sendTo)){
  	foreach($sendTo as $To){
  		$mail->addAddress($To, '');
  		$mail->addCC($To, '');
  		$mail->addBCC($To, '');
  	}
  }
  
  
  $mail->isHTML(true);
  $mail->Subject = $subject;
  $mail->Body = $body;
  //$mail->AltBody = "This is the plain text version of the email content";
  return $mail->send();
  
}


}
