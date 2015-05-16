<?php

namespace neTpyceB\Tests\TMCms\Network;

use neTpyceB\TMCms\Network\AgentDetectors;

class AgentDetectorsTest extends \PHPUnit_Framework_TestCase
{
    public function testDetect() {
        $agent_detector = new AgentDetectors();
        $res = $agent_detector->detect();

        $this->assertTrue(is_array($res));
    }

    public function testIsNotBot() {
        $res = AgentDetectors::isBot('mozilla');

        $this->assertFalse($res);
    }

    public function testDetectBot() {
        $agent_detector = new AgentDetectors();
        $res = $agent_detector->detectBot('mozilla', 'firefox');

        $this->assertFalse($res);
    }

    public function testDetectBrowserVersion() {
        $agent_detector = new AgentDetectors();
        $res = $agent_detector->detectBrowserVersion('mozilla', 'firefox');

        $this->assertEquals('', $res);
    }
}