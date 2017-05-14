<?php

namespace Siren;

use LogicException;

class Link
{
    /**
     * @var array
     */
    protected $rel = array();

    /**
     * @var string
     */
    protected $href;

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
     * Convert object to array
     *
     * @return array
     */
    public function toArray()
    {
        $data = array();

        if (!empty($this->getRel())) {
            $data['rel'] = $this->getRel();
        }

        if ($this->getHref() !== null) {
            $data['href'] = $this->getHref();
        }

        return $data;
    }
}
