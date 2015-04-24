<?php

namespace SumoCoders\FrameworkSettingsBundle\Tests\Service;

use SumoCoders\FrameworkSettingsBundle\Entity\Setting;
use SumoCoders\FrameworkSettingsBundle\SettingsManager;

class SettingsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SettingsManager
     */
    protected $settings;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $entityManager = $this
            ->getMockBuilder('\Doctrine\Common\Persistence\ObjectManager')
            ->disableOriginalConstructor()
            ->getMock();

        $repository = $this->getMockBuilder('SumoCoders\FrameworkSettingsBundle\Entity\SettingRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $this->settings = new SettingsManager(
            $entityManager,
            $repository
        );
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        $this->settings = null;
    }

    public function testClearIsNotImplemented()
    {
        $this->setExpectedException(
            'SumoCoders\FrameworkSettingsBundle\Exception\DontUseException'
        );
        $this->settings->clear();
    }

    public function testAddInvalidItem()
    {
        $this->setExpectedException(
            'SumoCoders\FrameworkSettingsBundle\Exception\InvalidInstanceException'
        );

        $invalidItem = new \StdClass();
        $this->settings->add(
            array($invalidItem)
        );
    }

    public function testAddValidItems()
    {
        $setting1 = new Setting();
        $setting1->setName('name')
            ->setValue('John Doe');
        $setting2 = new Setting();
        $setting2->setName('foo')
            ->setValue('bar');

        $this->settings->add(
            array(
                $setting1,
                $setting2
            )
        );

        $this->assertTrue($this->settings->has('name'));
        $this->assertEquals($setting1->getValue(), $this->settings->get('name'));
        $this->assertTrue($this->settings->has('foo'));
        $this->assertEquals($setting2->getValue(), $this->settings->get('foo'));
    }

    public function testGetAll()
    {
        $setting1 = new Setting();
        $setting1->setName('name')
            ->setValue('John Doe');
        $setting2 = new Setting();
        $setting2->setName('foo')
            ->setValue('bar');

        $this->settings->add(
            array(
                $setting1,
                $setting2
            )
        );

        $all = $this->settings->all();

        $this->assertArrayHasKey(
            $setting1->getName(),
            $all
        );
        $this->assertArrayHasKey(
            $setting2->getName(),
            $all
        );
    }

    public function testSetSimpleValue()
    {
        $this->settings->set('name', 'John Doe');
        $this->assertTrue($this->settings->has('name'));
        $this->assertEquals('John Doe', $this->settings->get('name'));
    }

    public function testHasInvalidItem()
    {
        $this->assertFalse($this->settings->has('foobar'));
    }

    public function testHasValidItem()
    {
        $this->settings->set('foo', 'bar');
        $this->assertTrue($this->settings->has('foo'));
    }

    public function testResolveIsNotImplemented()
    {
        $this->setExpectedException(
            'SumoCoders\FrameworkSettingsBundle\Exception\DontUseException'
        );
        $this->settings->resolve();
    }

    public function testResolveValueIsNotImplemented()
    {
        $this->setExpectedException(
            'SumoCoders\FrameworkSettingsBundle\Exception\DontUseException'
        );
        $this->settings->resolveValue('foo');
    }

    public function testEscapeValueIsNotImplemented()
    {
        $this->setExpectedException(
            'SumoCoders\FrameworkSettingsBundle\Exception\DontUseException'
        );
        $this->settings->escapeValue('foo');
    }

    public function testUnescapeValueIsNotImplemented()
    {
        $this->setExpectedException(
            'SumoCoders\FrameworkSettingsBundle\Exception\DontUseException'
        );
        $this->settings->unescapeValue('foo');
    }
}
