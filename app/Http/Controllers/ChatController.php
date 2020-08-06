<?php


namespace App\Http\Controllers;

use App\Message as Message;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\Types\Array_;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Http\Request;


/**
 * Class ChatController
 * @package App\Http\Controllers
 */
class ChatController extends Controller
{

    private $entytyKeyWords = [
        'привет' => 'приветствие',
        'который час' => 'время',
        'сколлько времени' => 'время'
    ];

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAll()
    {
        $messages = Message::all();
        return view('welcome', ['messages' => $messages]);
    }

    /**
     * @param $request
     */
    public function sendMessage(Request $request)
    {
        $message = $request['messageText'];
        Message::create([
            'message' => $message,
            'sender' => 'user'
        ]);
        //self::getInfo($message);
        $response = $this->getResponse($this->getIntent($message));
        Message::create([
            'message' => $response,
            'sender' => 'chat'
        ]);
        $data = ['bot' => $response,
            'userMsg' => $message];
        return $data;
    }

    /**
     * @param $message
     * @return mixed|string
     * возвращает намерение пользователя в зависимости от отправленного сообщения
     */
    private function getIntent($message)
    {
        foreach ($this->entytyKeyWords as $keyWord => $entyty) {
            if (strpos($message, $keyWord) !== false) return $entyty;
        }
        return 'unknown';
    }

    /**
     * @param $intent
     * @return false|string
     * Возвращает что ответит "бот" на сообщение пользователя
     */
    private function getResponse($intent)
    {
        switch ($intent) {
            case 'приветствие':
                return ' привет мешок с костями';
            case 'время':
                return date('H:i:s');
            case 'unknown':
                return 'я тебя не понял';
        }
        return 'unknown';
    }

    /* private static function getInfo($message)
     {
         //$file = fopen('C:\\Program Files (x86)\\OSPanel\\domains\\chat\\python\\exe.win-amd64-3.8\\input.txt', 'w');
         $file = fopen('C:\\Program Files (x86)\\OSPanel\\domains\\chat\\python\\exe.win-amd64-3.8\\input.txt', 'w');
         fwrite($file, $message);
         fclose($file);
         $process = new Process(['C:\\Program Files (x86)\\OSPanel\\domains\\chat\\python\\exe.win-amd64-3.8\\getinfo.exe']);
         $process->run();
         //$result = shell_exec("C:\\Program Files\\Python38\\python.exe " . app_path(). "\\python\\getinfo.py");
         //passthru("C:\\python\\python.exe 'C:\\Program Files (x86)\\OSPanel\\domains\\chat\\python\\getinfo.py'",$result);
         var_dump($process->getErrorOutput());
         return $process->getOutput();
     }*/
}
