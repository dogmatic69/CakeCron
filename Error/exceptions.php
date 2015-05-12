<?php
/**
 * CakeCronException
 * 
 * @author Carl Sutton <dogmatic69>
 */
class CakeCronException extends CakeException {

}

/**
 * Used when there is no cron entry defined
 * 
 * @author Carl Sutton <dogmatic69>
 */
class CronTabEntryNotDefinedException extends CakeCronException {

	protected $_messageTemplate = 'Cron tab entry has not been defined';
}

/**
 * used when the cron is called from non-cli
 * 
 * @author Carl Sutton <dogmatic69>
 */
class CakeCronCliRequiredException extends CakeCronException {

	protected $_messageTemplate = 'Cron should only be run in CLI mode';
}