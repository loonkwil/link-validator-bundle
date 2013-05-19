<?php

namespace SPE\LinkValidatorBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class YouTubeLink extends Constraint
{
    public $message = 'Please enter a YouTube link';

    public function validatedBy()
    {
        return __CLASS__ . 'Validator';
    }
}
