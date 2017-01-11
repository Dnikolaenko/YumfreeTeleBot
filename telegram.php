<?php

class Telegram
{
	const BOT_TOKEN = '275682784:AAGX9PhODUTbCJWh0stpVCMWFZooVGw5qlM';
	const API_URL = 'https://api.telegram.org/bot'. self::BOT_TOKEN .'/';
	const CHAT_ID = '280628855';

	protected $text = "";
	public $data;

	public function __construct()
	{
		if(isset($_POST)){
			$msg = $_POST['msg'];
			$this->text = $msg;
		}
	}

	public function send($text)
	{
		$parametrs = [
					'chat_id' => self::CHAT_ID,
					'text' => $this->text,
		];

		$url = ''. self::API_URL .'sendMessage?'. http_build_query($parametrs);

		$grub = file_get_contents($url);
		$link_address = '/';

		if($grub){
			echo "Сообщение отправлено!</br>";
			echo '<a href="' . $link_address . '">Назад</a>';
			return $grub;
		} else {
			echo "Не получилось отправить сообщение!";
			return false;
		}
	}

	public function getUpdates()
	{
		$url = self::API_URL . 'getUpdates';
		$data = file_get_contents($url);
		$all = json_decode($data, true);
		$this->data = $all;
		return $all;
	}

	public function answer()
	{
		$data = $this->data;
		if(!$data == null) {
				foreach($data as $val) {
					foreach($val as $msg) {
							foreach($msg as $pp) {
								//var_dump($pp['text']);
								if($pp['text'] == 'lol') {
									$com = "Ты ввел первую команду!";
									$parametrs = [
												'chat_id' => self::CHAT_ID,
												'text' => $com,
									];
									$url = self::API_URL . 'sendMessage?' . http_build_query($parametrs);
									// var_dump($url);
									$grub = file_get_contents($url);
									return $grub;
								}
							}
					}
				}
		} else {
			echo "Возникла какая то проблема!";
			return false;
		}
	}
}

$bot = new Telegram();
//$bot->send();
$bot->getUpdates();
$bot->answer();
