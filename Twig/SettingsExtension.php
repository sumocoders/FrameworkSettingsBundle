<?php

namespace SumoCoders\FrameworkSettingsBundle\Twig;

use SumoCoders\FrameworkSettingsBundle\SettingsManager;
use \Twig_extension;
use Twig_SimpleFunction;

class SettingsExtension extends Twig_extension
{
    /** @var SettingsManager */
    private $settingsManager;

    /**
     * @param SettingsManager $settingsManager
     */
    public function __construct(SettingsManager $settingsManager)
    {
        $this->settingsManager = $settingsManager;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('setting', [$this, 'setting'])
        ];
    }

    /**
     * @param string $settingName
     * @return string
     */
    public function setting($settingName)
    {
        if (!$this->settingsManager->has($settingName)) {
            return '';
        }

        return $this->settingsManager->get($settingName);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'settings_extension';
    }
}
