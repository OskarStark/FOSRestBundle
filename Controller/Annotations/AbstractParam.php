<?php

/*
 * This file is part of the FOSRestBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\RestBundle\Controller\Annotations;

use Symfony\Component\Validator\Constraints;

/**
 * {@inheritdoc}
 *
 * @author Jordi Boggiano <j.boggiano@seld.be>
 * @author Boris Guéry <guery.b@gmail.com>
 * @author Ener-Getick <egetick@gmail.com>
 */
abstract class AbstractParam implements ParamInterface
{
    /** @var string */
    public $name;
    /** @var string */
    public $key;
    /** @var mixed */
    public $default;
    /** @var string */
    public $description;
    /** @var bool */
    public $strict = false;
    /** @var bool */
    public $nullable = false;
    /** @var array */
    public $incompatibles = array();

    /**
     * Constructor.
     *
     * @param array $data An array of key/value parameters.
     */
    public function __construct(array $data = null)
    {
        if (null === $data) {
            @trigger_error('Since 1.7, you must pass your parameter values to the constructor.', E_USER_DEPRECATED);
            $data = array('name' => null);
        }
        if (isset($data['value'])) {
            $data['name'] = $data['value'];
            unset($data['value']);
        }

        $this->name = $data['name'];
        if (isset($data['key'])) {
            $this->key = $data['key'];
        }
        if (isset($data['default'])) {
            $this->default = $data['default'];
        }
        if (isset($data['description'])) {
            $this->description = $data['description'];
        }
        if (isset($data['strict'])) {
            $this->strict = !!$data['strict'];
        }
        if (isset($data['nullable'])) {
            $this->nullable = !!$data['nullable'];
        }
        if (isset($data['incompatibles'])) {
            $this->incompatibles = $data['incompatibles'];
        }
    }

    /** {@inheritdoc} */
    public function getName()
    {
        return $this->name;
    }

    /** {@inheritdoc} */
    public function getDefault()
    {
        return $this->default;
    }

    /** {@inheritdoc} */
    public function getDescription()
    {
        return $this->description;
    }

    /** {@inheritdoc} */
    public function getIncompatibilities()
    {
        return $this->incompatibles;
    }

    /** {@inheritdoc} */
    public function getConstraints()
    {
        $constraints = array();
        if (!$this->nullable) {
            $constraints[] = new Constraints\NotNull();
        }

        return $constraints;
    }

    /** {@inheritdoc} */
    public function isStrict()
    {
        return $this->strict;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key ?: $this->name;
    }
}
