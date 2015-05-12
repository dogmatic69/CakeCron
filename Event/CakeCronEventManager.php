<?php
App::uses('CakeEventManager', 'Event');

class CakeCronEventManager extends CakeEventManager {

/**
 * Adds a new listener to an event. Listeners
 *
 * @param callback|CakeEventListener $callable PHP valid callback type or instance of CakeEventListener to be called
 * when the event named with $eventKey is triggered. If a CakeEventListener instance is passed, then the `implementedEvents`
 * method will be called on the object to register the declared events individually as methods to be managed by this class.
 * It is possible to define multiple event handlers per event name.
 *
 * @param string $eventKey The event unique identifier name with which the callback will be associated. If $callable
 * is an instance of CakeEventListener this argument will be ignored
 *
 * @param array $options used to set the `priority` and `passParams` flags to the listener.
 * Priorities are handled like queues, and multiple attachments added to the same priority queue will be treated in
 * the order of insertion. `passParams` means that the event data property will be converted to function arguments
 * when the listener is called. If $called is an instance of CakeEventListener, this parameter will be ignored
 *
 * If this is not done in cli the cron will die
 *
 * @return void
 * @throws InvalidArgumentException When event key is missing or callable is not an
 *   instance of CakeEventListener.
 */
	public function attach($callable, $eventKey = null, $options = array()) {
		if (self::_isCli()) {
			throw new CakeCronCliRequiredException();
		}
		return parent::attach($callable, $eventKey, $options);
	}

/**
 * Returns a list of all listeners for an eventKey in the order they should be called
 *
 * @param string $eventKey Event key.
 * @return array
 */
	public function listeners($eventKey) {
		$return = parent::listeners($eventKey);

		foreach ($listeners as $k => $listener) {
			$crontab = null;
			if (!empty($listener['callable'][0]) && method_exists($listener['callable'][0], 'crontab')) {
				$crontab = $listener['callable'][0]->crontab();
			} else if (!empty($listener['passParams']['crontab'])) {
				$crontab = $listener['passParams']['crontab'];
			}

			$Cron = Cron\CronExpression::factory($crontab);
			if (!$Cron->isDue()) {
				unset($listeners[$k]);
			}

		}

		return $return;
	}

/**
 * Check if the code is being run in CLI
 * 
 * @return boolean
 */
	protected function _isCli() {
		return php_sapi_name() == 'cli';
	}
	
}