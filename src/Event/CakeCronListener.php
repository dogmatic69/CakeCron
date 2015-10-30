<?php
App::uses('CakeEventListener', 'Event');
App::uses('CakeCronEventManager', 'CakeCron.Event');


/**
 * CakeCronListener
 *
 * Extend the CakeEventListener to provide some handy methods for running the crons
 *
 * @author Carl Sutton <dogmatic69>
 */
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
 * attach instance of the class to the event manager
 *
 * @throws InvalidArgumentException if trying to atach this class as the event.
 *
 * @return void
 */
	public static function attach() {
		if (get_called_class() == __CLASS__) {
			throw new InvalidArgumentException('Cant attach CakeCronListener as an event');
		}

		if (php_sapi_name() != 'cli') {
			return false;
		}

		return CakeCronEventManager::instance()->attach(new static());
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
 * Dispatch a command to another Shell. Similar to Object::requestAction()
 * but intended for running shells from other shells.
 *
 * ### Usage:
 *
 * With a string command:
 *
 *	`return $this->dispatchShell('schema create DbAcl');`
 *
 * Avoid using this form if you have string arguments, with spaces in them.
 * The dispatched will be invoked incorrectly. Only use this form for simple
 * command dispatching.
 *
 * With an array command:
 *
 * `return $this->dispatchShell('schema', 'create', 'i18n', '--dry');`
 *
 * @return mixed The return of the other shell.
 * @link http://book.cakephp.org/2.0/en/console-and-shells.html#Shell::dispatchShell
 */
	public function dispatchShell() {
		$args = func_get_args();
		if (is_string($args[0]) && count($args) === 1) {
			$args = explode(' ', $args[0]);
		}

		$Dispatcher = new ShellDispatcher($args, false);
		return $Dispatcher->dispatch();
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

/**
 * Get the crontab entry
 *
 * @param string $eventKey the event being fired so that the crontab can be configured
 *
 * @return
 */
	public function crontab($eventKey = null) {
		return $this->crontab;
	}

}
