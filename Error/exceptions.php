<?php
class CakeCronException extends CakeException {

}

class CronTabEntryNotDefinedException extends CakeCronException {

	protected $_messageTemplate = 'Cron tab entry has not been defined';
}

class CakeCronCliRequiredException extends CakeCronException {

	protected $_messageTemplate = 'Cron should only be run in CLI mode';
}