<?php

namespace Siren;

use Siren\Action;
use Siren\Document;
use Siren\Entity;
use Siren\Field;
use Siren\Link;

class Handler
{
    /**
     * Method to convert a Siren document to a JSON string
     *
     * @param Document $document
     * @return string
     */
    public function toJson(Document $document)
    {
        $documentArray = $document->toArray();

        return json_encode($documentArray);
    }

    /**
     * Method to convert a siren JSON string into a Siren document object
     *
     * @param string $json
     * @return Document
     */
    public function toDocument($json)
    {
        $data = json_decode($json, true);

        $document = new Document();

        if (isset($data['class']) && is_array($data['class'])) {
            $document->setClass($data['class']);
        }

        if (isset($data['properties']) && is_array($data['properties'])) {
            $document->setProperties($data['properties']);
        }

        if (isset($data['entities']) && is_array($data['entities'])) {
            $entities = $this->getEntitiesFromDataArray($data['entities']);
            $document->setEntities($entities);
        }

        if (isset($data['actions']) && is_array($data['actions'])) {
            $actions = $this->getActionsFromDataArray($data['actions']);
            $document->setActions($actions);
        }

        if (isset($data['links']) && is_array($data['links'])) {
            $links = $this->getLinksFromDataArray($data['links']);
            $document->setLinks($links);
        }

        return $document;
    }

    /**
     * Helper method to convert an entities data array to an array of entity objects
     *
     * @param array $entitiesArray
     * @return Entity[]
     */
    protected function getEntitiesFromDataArray(array $entitiesArray)
    {
        $entities = array();
        foreach ($entitiesArray as $entityArray) {
            $entity = new Entity();

            if (isset($entityArray['class']) && is_array($entityArray['class'])) {
                $entity->setClass($entityArray['class']);
            }

            if (isset($entityArray['rel']) && is_array($entityArray['rel'])) {
                $entity->setRel($entityArray['rel']);
            }

            if (isset($entityArray['href']) && is_string($entityArray['href'])) {
                $entity->setHref($entityArray['href']);
            }

            if (isset($entityArray['properties']) && is_array($entityArray['properties'])) {
                $entity->setProperties($entityArray['properties']);
            }

            if (isset($entityArray['links']) && is_array($entityArray['links'])) {
                $links = $this->getLinksFromDataArray($entityArray['links']);
                $entity->setLinks($links);
            }

            $entities[] = $entity;
        }

        return $entities;
    }

    /**
     * Helper method to convert an action data array to an array of action objects
     *
     * @param array $actionsArray
     * @return Action[]
     */
    protected function getActionsFromDataArray(array $actionsArray)
    {
        $actions = array();
        foreach ($actionsArray as $actionArray) {
            $action = new Action();

            if (isset($actionArray['name']) && is_string($actionArray['name'])) {
                $action->setName($actionArray['name']);
            }

            if (isset($actionArray['title']) && is_string($actionArray['title'])) {
                $action->setTitle($actionArray['title']);
            }

            if (isset($actionArray['method']) && is_string($actionArray['method'])) {
                $action->setMethod($actionArray['method']);
            }

            if (isset($actionArray['href']) && is_string($actionArray['href'])) {
                $action->setHref($actionArray['href']);
            }

            if (isset($actionArray['type']) && is_string($actionArray['type'])) {
                $action->setType($actionArray['type']);
            }

            if (isset($actionArray['fields']) && is_array($actionArray['fields'])) {
                $fields = $this->getFieldsFromDataArray($actionArray['fields']);
                $action->setFields($fields);
            }

            $actions[] = $action;
        }

        return $actions;
    }

    /**
     * Helper method to convert a fields data array to an array of field objects
     *
     * @param array $fieldsArray
     * @return Field[]
     */
    protected function getFieldsFromDataArray(array $fieldsArray)
    {
        $fields = array();
        foreach ($fieldsArray as $fieldArray) {
            $field = new Field();

            if (isset($fieldArray['name']) && is_string($fieldArray['name'])) {
                $field->setName($fieldArray['name']);
            }

            if (isset($fieldArray['type']) && is_string($fieldArray['type'])) {
                $field->setType($fieldArray['type']);
            }

            if (isset($fieldArray['value'])) {
                $field->setValue($fieldArray['value']);
            }

            $fields[] = $field;
        }

        return $fields;
    }

    /**
     * Helper method to convert a link data array to an array of link objects
     *
     * @param array $linksArray
     * @return Link[]
     */
    protected function getLinksFromDataArray(array $linksArray)
    {
        $links = array();
        foreach ($linksArray as $linkArray) {
            $link = new Link();

            if (isset($linkArray['rel']) && is_array($linkArray['rel'])) {
                $link->setRel($linkArray['rel']);
            }

            if (isset($linkArray['href']) && is_string($linkArray['href'])) {
                $link->setHref($linkArray['href']);
            }

            $links[] = $link;
        }

        return $links;
    }
}
