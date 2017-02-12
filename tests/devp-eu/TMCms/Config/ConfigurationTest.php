<?php

namespace Tests\TMCms\Templates;

use TMCms\Config\Configuration;

$configuration_test_env = [
    'values' => [
        'test' => true
    ]
];

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    public function testAddConfigurationEnv()
    {
        global $configuration_test_env;

        $config = Configuration::getInstance();
        $config->addConfigurationEnv('test_instance', $configuration_test_env);

        $res = $config->getCurrentEnv();

        $this->assertEquals('test_instance', $res);
    }

    public function testGetValue()
    {
        global $configuration_test_env;

        $config = Configuration::getInstance();
        $config->addConfigurationEnv('test_instance', $configuration_test_env);

        $res = $config->get('values')['test'];

        $this->assertTrue($res);
    }
}