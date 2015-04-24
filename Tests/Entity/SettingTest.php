<?php

namespace SumoCoders\FrameworkSettingsBundle\Tests\Entity;

use SumoCoders\FrameworkSettingsBundle\Entity\Setting;

class SettingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Setting
     */
    protected $setting;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->setting = new Setting();
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        $this->setting = null;
    }

    /**
     * Tests the getters and setters
     */
    public function testGettersAndSetters()
    {
        $this->setting->setEditable(true);
        $this->assertTrue($this->setting->isEditable());

        $this->setting->setName('name');
        $this->assertEquals('name', $this->setting->getName());

        $this->setting->setValue('value');
        $this->assertEquals('value', $this->setting->getValue());
    }
}
