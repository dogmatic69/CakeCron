<?php
App::uses('CakeEventListener', 'Event');

class CakeCronListener implements CakeEventListener {

/**
 * The cron tab entry
 *
 * eg:
 * * * * * *
 * 0 5,6,7 * * tue
 *
 * @var [type]
 */
	public $crontab = null;

/**
 * Constructor
 */
	public function __construct() {
		if (empty($this->crontab)) {
			throw new CronTabEntryNotDefinedException();
		}
	}

/**
 * Events that are triggered for cron jobs
 *
 * There is no need to define other implemented events for crons
 * 
 * @return array
 */
	final public function implementedEvents() {
		return array(
			'CakeCron.run' => 'run',
			'CakeCron.job' => 'job',
		);
	}

/**
 * Main cron run event
 * 
 * @param Even $event the even being triggered
 * 
 * @return boolean
 */
	public function run($event) {
		return true;
	}

/**
 * Method used for scheduling jobs through the cron
 * 
 * @param CakeEvent $event the even being triggered
 * 
 * @return boolean
 */
	public function job($event) {
		return true;
	}

/**
 * Before event
 * 
 * @param Even $event the even being triggered
 *
 * @return boolean
 */
	public function before($event) {
		return true;
	}

/**
 * Before event
 * 
 * @param Even $event the even being triggered
 * 
 * @return boolean
 */
	public function fail($event) {
		return true;
	}

/**
 * Before event
 * 
 * @param Even $event the even being triggered
 * 
 * @return boolean
 */
	public function success($event) {
		return true;
	}

	public function crontab() {
		return $this->crontab;
	}

}