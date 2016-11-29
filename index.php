<?php
class Telegram {
	const BOT_TOKEN = '275682784:AAGX9PhODUTbCJWh0stpVCMWFZooVGw5qlM';
	const API_URL = 'https://api.telegram.org/bot'. self::BOT_TOKEN .'/';
	const CHAT_ID = '280628855';

	public $text = 'Ещё один тест!';

	public function send($text) {
		$parametrs = [
					'chat_id' => self::CHAT_ID,
					'text' => $this->text,
		];

		$url = ''. self::API_URL .'sendMessage?'. http_build_query($parametrs);

		$grub = file_get_contents($url);

		return $grub;
	}
}

$bot = new Telegram();
$bot->send();