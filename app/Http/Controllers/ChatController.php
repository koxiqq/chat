<?php


namespace App\Http\Controllers;

use App\Message as Message;
use App\Http\Controllers\Controller;


/**
 * Class ChatController
 * @package App\Http\Controllers
 */
class ChatController extends Controller
{

    private static $entytyKeyWords =  [
        'привет'=>'приветствие',
        'который час'=>'время',
        'сколлько времени'=>'время'
];

    /**
     * @return Message[]- возвращает все сообщения которые хранятся в базе данных
     */
    public static function showAll(){
    return Message::all();
}

    /**
     * @param $message - сообщение полученное от пользователя
     * Добавляет сообщение отправленное пользователем в базу данных
     */
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

    /**
     * @param $message
     * @return mixed|string
     * возвращает намерение пользователя в зависимости от отправленного сообщения
     */
    private static function getIntent($message){
    foreach (self::$entytyKeyWords as $keyWord=>$entyty){
        if(strpos($message,$keyWord)!==false) return $entyty;
    }
    return 'unknown';
}

    /**
     * @param $intent
     * @return false|string
     * Возвращает что ответит "бот" на сообщение пользователя
     */
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
