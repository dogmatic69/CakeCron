CakePHP Cron runner
===================

This is a plugin to handle running cron jobs in cake, and is pretty much a replacement for crontab that can be modified on the fly and controlled through the database.

This plugin makes use of the cron parser, [mtdowling/cron-expression](https://github.com/mtdowling/cron-expression) through an extension of CakeEvents to bring eventful running of crons for your application.

The idea is that you have a single cron command that runs every minute to the CakeCron plugin. The plugin then triggers `Events` to the rest of the application as required.

P.S. I have implemented distributed crons using multiple servers for redundency using this plugin. Soon I would like to bring something in that will allow that without using too many dependencies. My initial implimentation used CouchBase for distributed key/value store that tracked which server was running what.

To get started run:

```
Console\cake CakeCron.cake_cron --help
```

The console has a command that will output the full crontab entry required to get the plugin in action. From there it is just a case of defining your events and making sure they are loaded.

### Building a cron job

```
namespace MyPlugin\Cron;

use CakeCron\Cron\Listener;

class MyCron extends Listener {

    /**
     * crontab entry (any valid crontab entry, @DAILY etc.)
     *
     * @type string
     */
    public $crontab = '*\5 * * * *'; // will run every 5 minutes

    /**
     * delete users that have not been active for 6 months
     *
     * @return void
     */
    public function run()
    {
        $this->Members->deleteInactiveMembers('-6 months');
    }

}

```

Dont forget to load up the class similar to how Events are done.

```
namespace MyPlugin\Config;

use CakeCron\Cron\Manager;
use MyPlugin\Cron\MyCron;

if (phpsapi() == 'cli') {
    Manager::instance()->attach(new MyCron());
}

```
