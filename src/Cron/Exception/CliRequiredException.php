<?php
namespace CakeCron\Cron\Exception;

use CakeCron\Cron\Exception\EventException;

/**
 * used when the cron is called from non-cli
 *
 * @package dogmatic69.CakeCron.Cron
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
