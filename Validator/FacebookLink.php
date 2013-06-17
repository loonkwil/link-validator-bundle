<?php

namespace SPE\LinkValidatorBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class FacebookLink extends Constraint
{
    public $message = 'Please enter a Facebook link';

    public function validatedBy()
    {
        return __CLASS__ . 'Validator';
    }
}
