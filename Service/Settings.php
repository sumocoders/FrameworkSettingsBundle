<?php

namespace SumoCoders\FrameworkSettingsBundle\Service;

use Doctrine\ORM\EntityManager;
use SumoCoders\FrameworkSettingsBundle\Entity\Setting;
use SumoCoders\FrameworkSettingsBundle\Entity\SettingRepository;
use SumoCoders\FrameworkSettingsBundle\Exception\DontUseException;
use SumoCoders\FrameworkSettingsBundle\Exception\InvalidInstanceException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class Settings implements ParameterBagInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var SettingRepository
     */
    protected $repository;

    /**
     * Parameter storage.
     *
     * @var array
     */
    protected $settings;

    /**
     * Is the class initialized
     *
     * @var bool
     */
    protected $isInitialized = false;

    /**
     * @param EntityManager     $entityManager
     * @param SettingRepository $repository
     */
    public function __construct($entityManager, $repository)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    /**
     * Initialize the settings
     */
    protected function initialize()
    {
        if (!$this->isInitialized) {
            $this->all();
        }
        $this->isInitialized = true;
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        throw new DontUseException();
    }

    /**
     * {@inheritdoc}
     */
    public function add(array $parameters)
    {
        $this->isInitialized = false;
        foreach ($parameters as $setting) {
            if (!($setting instanceof Setting)) {
                throw new InvalidInstanceException('This is not an instance of the Setting-class.');
            }

            $this->set(
                $setting->getName(),
                $setting->getValue(),
                $setting->isEditable()
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        $settings = $this->repository->findAll();

        if (!empty($settings)) {
            foreach ($settings as $setting) {
                $this->settings[$setting->getName()] = $setting;
            }
        }

        return $this->settings;
    }

    /**
     * {@inheritdoc}
     */
    public function get($name, $defaultValue = null)
    {
        $this->initialize();
        if (!isset($this->settings[$name])) {
            return $defaultValue;
        }

        return $this->settings[$name]->getValue();
    }

    /**
     * Store a setting
     *
     * @param string $name
     * @param mixed  $value
     * @param bool   $isEditable
     * @return $this
     */
    public function set($name, $value, $isEditable = false)
    {
        $this->isInitialized = false;

        if ($this->has($name)) {
            $setting = $this->settings[$name];
        } else {
            $setting = new Setting();
            $setting->setName($name);
        }

        $setting->setValue($value);
        $setting->setIsEditable($isEditable);

        $this->settings[$name] = $setting;

        // store and flush
        $this->entityManager->persist($setting);
        $this->entityManager->flush();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function has($name)
    {
        $this->isInitialized = false;
        $this->initialize();

        return isset($this->settings[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function resolve()
    {
        throw new DontUseException();
    }

    /**
     * {@inheritdoc}
     */
    public function resolveValue($value)
    {
        throw new DontUseException();
    }

    /**
     * {@inheritdoc}
     */
    public function escapeValue($value)
    {
        throw new DontUseException();
    }

    /**
     * {@inheritdoc}
     */
    public function unescapeValue($value)
    {
        throw new DontUseException();
    }
}
