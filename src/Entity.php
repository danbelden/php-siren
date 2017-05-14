<?php

namespace Siren;

use Siren\Link;
use LogicException;

class Entity
{
    /**
     * @var array
     */
    protected $class = array();

    /**
     * @var array
     */
    protected $rel = array();

    /**
     * @var string
     */
    protected $href;

    /**
     * @var array
     */
    protected $properties = array();

    /**
     * @var Link[]
     */
    protected $links = array();

    /**
     * Get class
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set class
     *
     * @param array $class
     * @return $this
     * @throws LogicException
     */
    public function setClass(array $class)
    {
        foreach ($class as $classItem) {
            if (!is_string($classItem)) {
                $exMsg = sprintf('Provided class `%s` is not a string', $classItem);
                throw new LogicException($exMsg);
            }
        }

        $this->class = $class;

        return $this;
    }

    /**
     * Add class
     *
     * @param string $class
     * @return $this
     * @throws LogicException
     */
    public function addClass($class)
    {
        if (!is_string($class)) {
            $exMsg = sprintf('Provided class `%s` is not a string', $class);
            throw new LogicException($exMsg);
        }

        $currentClass = $this->getClass();
        if (in_array($class, $currentClass)) {
            $exMsg = sprintf('Provided class `%s` is already registered', $class);
            throw new LogicException($exMsg);
        }

        $this->class[] = $class;

        return $this;
    }

    /**
     * Get rel
     *
     * @return array
     */
    public function getRel()
    {
        return $this->rel;
    }

    /**
     * Set rel
     *
     * @param array $rel
     * @return $this
     * @throws LogicException
     */
    public function setRel(array $rel)
    {
        foreach ($rel as $relItem) {
            if (!is_string($relItem)) {
                $exMsg = sprintf('Provided rel `%s` is not a string', $relItem);
                throw new LogicException($exMsg);
            }
        }

        $this->rel = $rel;

        return $this;
    }

    /**
     * Add rel
     *
     * @param string $rel
     * @return $this
     * @throws LogicException
     */
    public function addRel($rel)
    {
        if (!is_string($rel)) {
            $exMsg = sprintf('Provided rel `%s` is not a string', $rel);
            throw new LogicException($exMsg);
        }

        $this->rel[] = $rel;

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
     * Get properties
     *
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Add property
     *
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function addProperty($key, $value)
    {
        $this->properties[$key] = $value;

        return $this;
    }

    /**
     * Set properties
     *
     * @param array $properties
     * @return $this
     * @throws LogicException
     */
    public function setProperties(array $properties)
    {
        $this->properties = $properties;

        return $this;
    }

    /**
     * Get links
     *
     * @return Link[]
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Set links
     *
     * @param Link[] $links
     * @return $this
     * @throws LogicException
     */
    public function setLinks(array $links)
    {
        foreach ($links as $key => $link) {
            if (!($link instanceof Link)) {
                $exMsg = sprintf(
                    'Array key `%s` is not an instance of Link',
                    $key
                );
                throw new LogicException($exMsg);
            }
        }

        $this->links = $links;

        return $this;
    }

    /**
     * Add link
     *
     * @param Link $link
     * @return $this
     */
    public function addLink(Link $link)
    {
        $this->links[] = $link;

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

        if (!empty($this->getClass())) {
            $data['class'] = $this->getClass();
        }

        if (!empty($this->getRel())) {
            $data['rel'] = $this->getRel();
        }

        if ($this->getHref() !== null) {
            $data['href'] = $this->getHref();
        }

        if (!empty($this->getProperties())) {
            $data['properties'] = $this->getProperties();
        }

        if (!empty($this->getLinks())) {
            $data['links'] = array();
            foreach ($this->getLinks() as $link) {
                $data['links'][] = $link->toArray();
            }
        }

        return $data;
    }
}
