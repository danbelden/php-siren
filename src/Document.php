<?php

namespace Siren;

use Siren\Entity;
use Siren\Action;
use Siren\Link;
use LogicException;

class Document
{
    /**
     * @var array
     */
    protected $class = array();

    /**
     * @var array
     */
    protected $properties = array();

    /**
     * @var Entity[]
     */
    protected $entities = array();

    /**
     * @var Action[]
     */
    protected $actions = array();

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
     * Get entities
     *
     * @return Entity[]
     */
    public function getEntities()
    {
        return $this->entities;
    }

    /**
     * Set entities
     *
     * @param Entity[] $entities
     * @return $this
     */
    public function setEntities(array $entities)
    {
        foreach ($entities as $key => $entity) {
            if (!($entity instanceof Entity)) {
                $exMsg = sprintf(
                    'Array key `%s` is not an instance of Entity',
                    $key
                );
                throw new LogicException($exMsg);
            }
        }

        $this->entities = $entities;

        return $this;
    }

    /**
     * Add entity
     *
     * @param Entity $entity
     * @return $this
     */
    public function addEntity(Entity $entity)
    {
        $this->entities[] = $entity;

        return $this;
    }

    /**
     * Get actions
     *
     * @return Action[]
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * Set actions
     *
     * @param Action[] $actions
     * @return $this
     * @throws LogicException
     */
    public function setActions(array $actions)
    {
        foreach ($actions as $key => $action) {
            if (!($action instanceof Action)) {
                $exMsg = sprintf(
                    'Array key `%s` is not an instance of Action',
                    $key
                );
                throw new LogicException($exMsg);
            }
        }

        $this->actions = $actions;

        return $this;
    }

    /**
     * Add action
     *
     * @param Action $action
     * @return $this
     */
    public function addAction(Action $action)
    {
        $this->actions[] = $action;

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

        if (!empty($this->getProperties())) {
            $data['properties'] = $this->getProperties();
        }

        if (!empty($this->getEntities())) {
            $data['entities'] = array();
            foreach ($this->getEntities() as $entity) {
                $data['entities'][] = $entity->toArray();
            }
        }

        if (!empty($this->getActions())) {
            $data['actions'] = array();
            foreach ($this->getActions() as $action) {
                $data['actions'][] = $action->toArray();
            }
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
