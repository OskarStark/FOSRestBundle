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

use Symfony\Component\HttpFoundation\Request;

/**
 * {@inheritdoc}
 *
 * @author Jordi Boggiano <j.boggiano@seld.be>
 * @author Boris Guéry <guery.b@gmail.com>
 *
 * @deprecated since 1.7, to be removed in 2.0. Use {@link AbstractScalarParam} instead.
 */
abstract class Param extends AbstractScalarParam
{
    /** @var bool */
    public $array = false;

    public function __construct(array $data = null)
    {
        if (isset($data['array']) && !isset($data['map'])) {
            @trigger_error('AbstractScalarParam::$array is deprecated since 1.7 and will be removed in 2.0. Use AbstractScalarParam::$map instead.', E_USER_DEPRECATED);
            $data['map'] = $data['array'];
        }
        parent::__construct($data);

        $this->array = $this->map;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue(Request $request, $default = null)
    {
        @trigger_error('You must implement ParamInterface::getValue() for your custom parameters.', E_USER_DEPRECATED);
    }
}
