<?php

namespace SumoCoders\FrameworkSettingsBundle\Twig;

use SumoCoders\FrameworkSettingsBundle\SettingsManager;
use \Twig_extension;
use Twig_SimpleFilter;

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
    public function getFilters()
    {
        return [
            new Twig_SimpleFilter('setting', [$this, 'settingFilter'])
        ];
    }

    /**
     * @param string $setting
     * @return string
     */
    public function settingFilter($setting)
    {
        if (!$this->settingsManager->has($setting)) {
            return '';
        }

        return $this->settingsManager->get($setting);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'settings_extension';
    }
}
