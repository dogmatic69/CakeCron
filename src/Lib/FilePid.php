<?php
namespace CakeCron\Lib;

use Cake\Filesystem\File;
use Cake\Filesystem\Folder;

/**
 * CakeCronPid
 *
 * Class used to stop the same process excecuting multiple times
 *
 * @author Carl Sutton <dogmatic69>
 */
class FilePid extends File
{
    /**
     * Temp path
     *
     * @var string
     */
    protected $_tmpPath = TMP;

    /**
     * Folder to store PID files
     *
     * @var string
     */
    protected $_pidFolder = 'cake-cron';

    /**
     * Current job being run
     *
     * @var string
     */
    protected $_job = null;

    /**
     * Constructor
     *
     * @param string $job the name of the job being started
     * @param bool $create create the file
     * @param int $mode Mode to apply to the folder holding the file
     */
    public function __construct($job, $create = true, $mode = 0755)
    {
        if (!$this->safe($this->_pidFile)) {
            throw new CakeException(sprintf('Invalid name "%s" given for the PID file', $job));
        }

        $this->_job = $job;

        $this->_pidFile = implode('/', [
            $this->_tmpPath,
            $this->_pidFolder,
            $this->_job,
        ]);

        $this->Folder = new Folder(dirname($this->_pidFile), true, $mode);
        $this->name = basename($this->_pidFile);
        $this->pwd();
    }

    /**
     * get the pid file path
     *
     * @return string
     */
    public function pidFile()
    {
        return $this->_pidFile;
    }

    /**
     * Write a PID file for the current cron job
     *
     * @return bool
     */
    public function lock()
    {
        if (!parent::create()) {
            throw new CakeException('Unable to create the lock file for this PID');
        }

        return parent::write(json_encode([
            'job' => $this->_job,
            'created' => time(),
            ''
        ]));
    }

    /**
     * check if a cron exists for the current job
     *
     * @return bool
     */
    public function exists()
    {
        return paren::exists();
    }

    /**
     * delete a cron pid file for the given job
     *
     * @return void
     */
    public function delete()
    {
    }

    /**
     * As this is extending the File class, we don't need all the functionality
     *
     * @param string $data data being appended
     * @param bool $force force append
     *
     * @throws CakeException anytime this method is called
     *
     * @return void
     */
    public function append($data, $force = false)
    {
        throw new CakeException('Not implemented');
    }
}
