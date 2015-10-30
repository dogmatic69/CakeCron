<?php
namespace CakeCron\Event\Exception;

use CakeCron\Event\Exception\EventException;

/**
 * Used when there is no cron entry defined
 *
 * @package dogmatic69.CakeCron.Event
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
