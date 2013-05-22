<?php

namespace SPE\LinkValidatorBundle\Tests\Validator\Constraints;

use SPE\LinkValidatorBundle\Validator\YouTubeLink;
use SPE\LinkValidatorBundle\Validator\YouTubeLinkValidator;

class YouTubeLinkValidatorTest extends \PHPUnit_Framework_TestCase
{
    protected $context;
    protected $validator;
    protected $constraint;

    protected function setUp()
    {
        $this->context = $this->getMock(
            'Symfony\Component\Validator\ExecutionContext',
            array(), array(), '', false
        );

        $this->validator = new YouTubeLinkValidator();
        $this->validator->initialize($this->context);

        $this->constraint = new YouTubeLink(array('message' => 'myMessage'));
    }

    protected function tearDown()
    {
        $this->context = null;
        $this->validator = null;
        $this->constraint = null;
    }

    protected function validate($value)
    {
        $this->validator->validate($value, $this->constraint);
    }

    protected function shouldBeValid($value)
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validate($value);
    }

    protected function shouldNotBeValid($value)
    {
        $this->context->expects($this->once())
            ->method('addViolation')
            ->with('myMessage');

        $this->validate($value);
    }


    public function testNullIsValid()
    {
        $this->shouldBeValid(null);
    }

    public function testEmptyStringIsValid()
    {
        $this->shouldBeValid('');
    }

    /**
     * @expectedException Symfony\Component\Validator\Exception\UnexpectedTypeException
     */
    public function testExpectsStringCompatibleType()
    {
        $this->validate(new \stdClass());
    }

    public function testValidYouTubeLink()
    {
        $this->shouldBeValid('youtube.com/watch?v=m2s1kvWk89E');
    }

    public function testValidYouTubeLinkWithWww()
    {
        $this->shouldBeValid('www.youtube.com/watch?v=m2s1kvWk89E');
    }

    public function testValidYouTubeLinkWithHttp()
    {
        $this->shouldBeValid('http://youtube.com/watch?v=m2s1kvWk89E');
    }

    public function testValidYouTubeLinkWithHttps()
    {
        $this->shouldBeValid('https://youtube.com/watch?v=m2s1kvWk89E');
    }

    public function testValidYouTubeLinkWithWwwAndHttp()
    {
        $this->shouldBeValid('http://www.youtube.com/watch?v=m2s1kvWk89E');
    }

    public function testValidYouTubeLinkWithQueryParams()
    {
        $this->shouldBeValid(
            'http://www.youtube.com/watch?v=qguJbbgFHgc&feature=share'
        );
    }

    public function testValidEmbedYouTubeLink()
    {
        $this->shouldBeValid('http://www.youtube.com/embed/m2s1kvWk89E');
    }

    public function testValidShortYouTubeLink()
    {
        $this->shouldBeValid('http://youtu.be/m2s1kvWk89E');
    }

    public function testInvalidYouTubeLink()
    {
        $this->shouldNotBeValid('http://youtu.be/m2s1kvWk89E2');
    }

    public function testNotYouTubeLink()
    {
        $this->shouldNotBeValid('http://google.com');
    }
}
