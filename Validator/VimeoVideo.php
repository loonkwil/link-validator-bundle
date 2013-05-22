<?php

namespace SPE\LinkValidatorBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class VimeoVideo extends Constraint
{
    public $message = 'Please enter a Vimeo link';

    public function validatedBy()
    {
        return __CLASS__ . 'Validator';
    }
}
