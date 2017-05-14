<?php

namespace Siren;

use LogicException;

class Field
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var mixed
     */
    protected $value;

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
     * Set name
     *
     * @param string $name
     * @return $this
     * @throws LogicException
     */
    public function setName($name)
    {
        if (!is_string($name)) {
            $exMsg = sprintf('Provided name `%s` is not a string', $name);
            throw new LogicException($exMsg);
        }

        $this->name = $name;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return $this
     * @throws LogicException
     */
    public function setType($type)
    {
        if (!is_string($type)) {
            $exMsg = sprintf('Provided type `%s` is not a string', $type);
            throw new LogicException($exMsg);
        }

        $this->type = $type;

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
     * Set value
     *
     * @param mixed $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Convert object to array
     *
     * @return array
     */
    public function toArray()
    {
        $data = array();

        if ($this->getName() !== null) {
            $data['name'] = $this->getName();
        }

        if ($this->getType() !== null) {
            $data['type'] = $this->getType();
        }

        if ($this->getValue() !== null) {
            $data['value'] = $this->getValue();
        }

        return $data;
    }
}
