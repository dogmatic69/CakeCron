<?php
namespace CakeCron\Shell;

use CakeCron\Event\Event;
use CakeCron\Event\Manager;
use Cake\Console\Shell;

/**
 * CakeCronShell
 *
 * @package dogmatic69.CakeCron.Shell
 *
 * @author Carl Sutton <dogmatic69>
 */
class CronShell extends Shell
{
    /**
     * Gets the option parser instance and configures it.
     *
     * @return ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        $parser->description(
            __d('cake_cron', 'This is the main script that calls all other scripts that need to be run')
        )->addSubcommand('run', [
            'help' => __d('cake_cron', 'Run the script, usually this in run via normal crons at a 1 minute interval')
        ])->addSubcommand('crontab', [
            'help' => __d('cake_cron', 'Output a valid line for use in the crontab')
        ]);

        return $parser;
    }

    /**
     * main shell method
     *
     * @return void
     */
    public function main()
    {
    }

    /**
     * Generate the command to be placed in the crontab
     *
     * @return void
     */
    public function crontab()
    {
        $out = implode("\t", [
            '*/1 * * * *',
            String::insert(':appConsole' . DS . 'bin' . DS . 'cake -app :app -working :working CakeCron.cake_cron run', [
                'app' => APP,
                'working' => basename(APP),
            ]),
        ]);
        $this->out('Paste the following line into the crontab for www-data / apache / webserver user');
        $this->out();
        $this->out($out);
    }

    /**
     * The main cron running method
     *
     * @return void
     */
    public function run()
    {
        $Event = new Event('CakeCron.run', new stdClass(), []);
        Manager::instance()->dispatch($Event);
    }

    /**
     * Check the status of the cron (not yet implemented)
     *
     * @return void
     */
    public function status()
    {
    }
}
