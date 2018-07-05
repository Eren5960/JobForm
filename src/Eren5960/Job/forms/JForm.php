<?php

/**
*  _____                    ____   ___    __     ___  
* | ____| _ __  ___  _ __  | ___| / _ \  / /_   / _ \ 
* |  _|  | '__|/ _ \| '_ \ |___ \| (_) || '_ \ | | | |
* | |___ | |  |  __/| | | | ___) |\__, || (_) || |_| |
* |_____||_|   \___||_| |_||____/   /_/  \___/  \___/ 
* 
* @version v1
* @name JobForm
* @author Eren5960
* @link https://github.com/Eren5960/JobForm
*/                  

namespace Eren5960\Job\forms;

use Eren5960\Job\Main;
use Eren5960\Job\lang\Lang;
use pocketmine\form\{Form, MenuForm, MenuOption};
use pocketmine\Player;

class JForm extends Menuform{
	
	/** @var Main $api */
	public $api;
	
	/** @var Lang $lang */
	public $lang;
	
	public function __construct(Player $p){
		$this->api = Main::getAPI();
		$this->lang = new Lang($p);
		parent::__construct(
		$this->lang->translate("Job.title"),
		$this->lang->translate("Job.content"),
		$this->api->buttons($p)
		);
	}
	public function onSubmit(Player $p):?Form{
		if($this->getSelectedOptionIndex() === 0){
			if($this->api->quitJob($p)){
			$p->sendMessage($this->lang->translate("Job.quit"));
			}else{
				$p->sendMessage($this->lang->translate("Job.no.in"));
			}
		}else{
			if($this->api->addJob($p,$this->getSelectedOption()->getText())){
		$p->sendMessage($this->lang->translate("Job.join", [$this->getSelectedOption()->getText()]));
		   }else{
			$p->sendMessage($this->lang->translate("Job.in"));
		   }
		}
		return null;
	}
}