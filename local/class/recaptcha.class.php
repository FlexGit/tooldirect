<?php
class Recaptcha{	public function verify($token)
	{		$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".RECAPTCHA_SECRET_KEY."&response=".$token);
		return json_decode($response);	}}
?>