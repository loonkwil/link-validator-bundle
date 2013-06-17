<?php

namespace SPE\LinkValidatorBundle\Validator;

class FacebookLinkValidator extends LinkValidator
{
    protected $pattern = '/^facebook\.com/i';
}
