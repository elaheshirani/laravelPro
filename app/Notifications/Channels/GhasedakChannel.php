<?php


namespace App\Notifications\Channels;


use Illuminate\Notifications\Notification;

class GhasedakChannel
{
    public function send($notifiable, Notification $notification)
    {
        $sms_username = $_POST["username"];
        $sms_password =  $_POST["password"];
        $from_number = array($_POST["from_number"]);
        $to_number = array($_POST["to_number"]);

//$date="29/12/2014 17:24"; //Date example
//list($day, $month, $year, $hour, $minute) = split('[/ :]', $date);

//The variables should be arranged according to your date format and so the separators
//$timestamp = mktime($hour, $minute, 0, $month, $day, $year);

        //$sendDate = array($timestamp);
        $message = array($_POST["message"]);


        $client = new SoapClient("http://parsasms.com/webservice/v2.asmx?WSDL");

        $params = array(
            'username' 	=> $sms_username,
            'password' 	=> $sms_password,
            'senderNumbers' => $from_number,
            'recipientNumbers'=> $to_number,
            //'sendDate'=> $sendDate,
            'messageBodies' => $message
        );

        $results = $client->SendSMS( $params );

        print_r($results);

    }
}
