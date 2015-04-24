<?php

namespace SumoCoders\FrameworkSettingsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Setting
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SumoCoders\FrameworkSettingsBundle\Entity\SettingRepository")
 */
class Setting
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text")
     */
    private $value;

    /**
     * @var boolean
     *
     * @ORM\Column(name="editable", type="boolean")
     */
    private $editable;

    /**
     * Set name
     *
     * @param string $name
     * @return Setting
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return Setting
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set isEditable
     *
     * @param boolean $editable
     * @return Setting
     */
    public function setEditable($editable)
    {
        $this->editable = $editable;

        return $this;
    }

    /**
     * Is editable
     *
     * @return boolean
     */
    public function isEditable()
    {
        return $this->editable;
    }
}
