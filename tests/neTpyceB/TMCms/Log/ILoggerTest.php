<?php

namespace Tests\TMCms\Log;

use TMCms\Log\ILogger;

class ILoggerTestInstance implements ILogger {
    /**
     * @return mixed
     */
    public function startLog()
    {
        // TODO: Implement startLog() method.
    }

    /**
     * @param string $str
     */
    public function log($str)
    {
        // TODO: Implement log() method.
    }

    /**
     * @param string $str
     */
    public function err($str)
    {
        // TODO: Implement err() method.
    }

    /**
     * @param string $str
     * @param string $flag
     */
    public function write($str = '', $flag = ILogger::WRITE_LOG)
    {
        // TODO: Implement write() method.
    }

    /**
     * @return mixed
     */
    public function endLog()
    {
        // TODO: Implement endLog() method.
    }
}

class ILoggerTest extends \PHPUnit_Framework_TestCase
{
    public function testCanImplementAllMethods() {
        $logger = new ILoggerTestInstance;
        $logger->startLog();
        $logger->log('log');
        $logger->err('err');
        $logger->write();
        $logger->endLog();

        $this->assertTrue((bool)$logger);
    }
}