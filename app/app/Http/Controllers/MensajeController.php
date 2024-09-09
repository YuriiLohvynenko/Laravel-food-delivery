<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
Use App\User;

use Illuminate\Http\Request;

class MensajeController extends Controller
{
  public function sendPush (Request $request)
  {
      //$user = User::find($request->id);
      $mensaje=$request->mensaje;
      //$usuario=$request->usuario;
      $user = User::find($request->usuario);
      $token=$user->token;

      $data = [
          "to" => $token,
          "notification" =>
              [
                  "title" => 'PidemeOnLine',
                  "body" => $mensaje,
                  "icon" => url('/public/images/logo/logo.png')
              ],
      ];
      $dataString = json_encode($data);

      $headers = [
          'Authorization: key=AAAARmipiS8:APA91bHSK4p6e09kFsPzL4f-OzksS8TolrvPItiNMzRBpgnMnpHTkPVQWFzOZfr1XJkBOtFnLQITZuFJ2SjeR3G9il0MpIYJYnPv1EIv1V02e62h8YQljbnJOwy9GBFJH_Xmoj61QrMe',
          'Content-Type: application/json',
      ];

      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

      curl_exec($ch);

      return redirect('/')->with('message', 'Notification sent!');
  }
}
