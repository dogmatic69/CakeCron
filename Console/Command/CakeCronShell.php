<?php
App::uses('AppShell', 'Console/AppShell');

class CakeCronShell extends AppShell {

	public function main() {

	}

	public function run() {
		$Event = new CakeCronEvent('CakeCron.run', new stdClass(), array());
		$this->getEventManager()->dispatch($Event);
	}

	public function status() {
		
	}
}