<?php
namespace CakeCron\Cron\Exception;

use CakeCron\Cron\Exception\EventException;

/**
 * Used when there is no cron entry defined
 *
 * @package dogmatic69.CakeCron.Cron
 *
 * @author Carl Sutton <dogmatic69@gmail.com>
 */
class NotDefinedException extends EventException
{
    /**
     * message template for not defined exception
     * @var string
     */
    protected $_messageTemplate = 'Cron tab entry has not been defined';
}
