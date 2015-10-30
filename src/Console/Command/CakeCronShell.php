<?php
App::uses('AppShell', 'Console/Command');

/**
 * CakeCronShell
 *
 * @author Carl Sutton <dogmatic69>
 */
class CakeCronShell extends AppShell {

/**
 * Gets the option parser instance and configures it.
 *
 * @return ConsoleOptionParser
 */
	public function getOptionParser() {
		$parser = parent::getOptionParser();

		$parser->description(
			__d('cake_cron', 'This is the main script that calls all other scripts that need to be run')
		)->addSubcommand('run', array(
			'help' => __d('cake_cron', 'Run the script, usually this in run via normal crons at a 1 minute interval')
		))->addSubcommand('crontab', array(
			'help' => __d('cake_cron', 'Output a valid line for use in the crontab')
		));

		return $parser;
	}

	public function main() {

	}

/**
 * Generate the command to be placed in the crontab
 *
 * @return void
 */
	public function crontab() {
		$out = implode("\t", array(
			'*/1 * * * *',
			String::insert(':appConsole' . DS . 'cake -app :app -working :working CakeCron.cake_cron run', array(
				'app' => APP,
				'working' => basename(APP),
			)),
		));
		$this->out('Paste the following line into the crontab for www-data / apache / webserver user');
		$this->out();
		$this->out($out);
	}

/**
 * The main cron running method
 *
 * @return void
 */
	public function run() {
		$Event = new CakeCronEvent('CakeCron.run', new stdClass(), array());
		CakeCronEventManager::instance()->dispatch($Event);
	}

/**
 * Check the status of the cron (not yet implemented)
 *
 * @return void
 */
	public function status() {

	}
}
