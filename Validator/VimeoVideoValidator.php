<?php

namespace SPE\LinkValidatorBundle\Validator;

class VimeoVideoValidator extends LinkValidator
{
    protected $pattern = '/
        ^
        vimeo.com\/[0-9]+
        (?:[\/&?]|$) # End of the pattern or the beginning of a query parameter
        /xi';
}
