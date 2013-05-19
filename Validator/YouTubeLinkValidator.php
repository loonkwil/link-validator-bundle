<?php

namespace SPE\LinkValidatorBundle\Validator;

class YouTubeLinkValidator extends LinkValidator
{
    protected $pattern = '/
        ^
        (
            (?:youtube\.com.*[?&]v=.{11})|
            (?:youtu\.be\/.{11})|
            (?:youtube\.com\/embed\/.{11})
        )
        (?:[\/&?]|$) # End of the pattern or the beginning of a query parameter
        /xi';
}
