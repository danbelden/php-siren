<?php

namespace Siren;

use Siren\Field;
use LogicException;

class Action
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $href;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $fields = array();

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
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        if (!is_string($title)) {
            $exMsg = sprintf('Provided title `%s` is not a string', $title);
            throw new LogicException($exMsg);
        }

        $this->title = $title;

        return $this;
    }

    /**
     * Get method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set method
     *
     * @param string $method
     * @return $this
     */
    public function setMethod($method)
    {
        if (!is_string($method)) {
            $exMsg = sprintf('Provided method `%s` is not a string', $method);
            throw new LogicException($exMsg);
        }

        $this->method = $method;

        return $this;
    }

    /**
     * Get href
     *
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * Set href
     *
     * @param string $href
     * @return $this
     * @throws LogicException
     */
    public function setHref($href)
    {
        if (!is_string($href)) {
            $exMsg = sprintf('Provided href `%s` is not a string', $href);
            throw new LogicException($exMsg);
        }

        $this->href = $href;

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
     * Get fields
     *
     * @return Field[]
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Set fields
     *
     * @param Field[] $fields
     * @return $this
     * @throws LogicException
     */
    public function setFields(array $fields)
    {
        foreach ($fields as $key => $field) {
            if (!($field instanceof Field)) {
                $exMsg = sprintf(
                    'Array key `%s` is not an instance of Field',
                    $key
                );
                throw new LogicException($exMsg);
            }
        }

        $this->fields = $fields;

        return $this;
    }

    /**
     * Add field
     *
     * @param Field $field
     * @return $this
     */
    public function addfield(Field $field)
    {
        $this->fields[] = $field;

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

        $name = $this->getName();
        if ($name !== null) {
            $data['name'] = $name;
        }

        $title = $this->getTitle();
        if ($title !== null) {
            $data['title'] = $title;
        }

        $method = $this->getMethod();
        if ($method !== null) {
            $data['method'] = $method;
        }

        $href = $this->getHref();
        if ($href !== null) {
            $data['href'] = $href;
        }

        $type = $this->getType();
        if ($type !== null) {
            $data['type'] = $type;
        }

        $fields = $this->getFields();
        if (!empty($fields)) {
            $data['fields'] = array();
            foreach ($fields as $field) {
                $data['fields'][] = $field->toArray();
            }
        }

        return $data;
    }
}
