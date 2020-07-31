<?php


namespace App\Http\Controllers;

use App\Message as Message;
use App\Http\Controllers\Controller;


class ChatController extends Controller
{
    private static $entytyKeyWords =  [
        'привет'=>'приветствие',
        'который час'=>'время',
];
public static function showAll(){
    return Message::all();
}
public static function sendMessage($message){
    Message::create([
        'message'=>$message,
        'sender'=>'user'
    ]);
    //getInfo($message);
    $response=self::getResponse(self::getIntent($message));
    Message::create([
        'message'=>$response,
        'sender'=>'chat'
    ]);
}
private static function getIntent($message){
    foreach (self::$entytyKeyWords as $keyWord=>$entyty){
        if(strpos($message,$keyWord)!==false) return $entyty;
    }
    return 'unknown';
}
    private static function getResponse($intent){
        switch ($intent){
            case 'приветствие':
                return' привет мешок с костями';
                break;
            case 'время': return date('H-i-s');
                break;
            case 'unknown':return 'я тебя не понял';
        }
        return 'unknown';
    }
}
//todo: разобраться с томитой
