<?php
namespace CakeCron\Event\Exception;

use CakeCron\Event\Exception\EventException;

/**
 * used when the cron is called from non-cli
 *
 * @author Carl Sutton <dogmatic69@gmail.com>
 */
class CliRequiredException extends EventException
{
    /**
     * message template for cli required exception
     *
     * @var string
     */
    protected $_messageTemplate = 'Cron should only be run in CLI mode';
}
