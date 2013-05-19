<?php

namespace SPE\LinkValidatorBundle\Tests\Validator\Constraints;

use SPE\LinkValidatorBundle\Validator\YouTubeLink;
use SPE\LinkValidatorBundle\Validator\YouTubeLinkValidator;

class YouTubeLinkValidatorTest extends \PHPUnit_Framework_TestCase
{
    protected $context;
    protected $validator;

    protected function setUp()
    {
        $this->context = $this->getMock('Symfony\Component\Validator\ExecutionContext', array(), array(), '', false);
        $this->validator = new YouTubeLinkValidator();
        $this->validator->initialize($this->context);
    }

    protected function tearDown()
    {
        $this->context = null;
        $this->validator = null;
    }


    public function testNullIsValid()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate(null, new YouTubeLink());
    }

    public function testEmptyStringIsValid()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate('', new YouTubeLink());
    }

    /**
     * @expectedException Symfony\Component\Validator\Exception\UnexpectedTypeException
     */
    public function testExpectsStringCompatibleType()
    {
        $this->validator->validate(new \stdClass(), new YouTubeLink());
    }

    public function testValidYouTubeLink()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $constraint = new YouTubeLink();
        $this->validator->validate('youtube.com/watch?v=m2s1kvWk89E', $constraint);
    }

    public function testValidYouTubeLinkWithWww()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $constraint = new YouTubeLink();
        $this->validator->validate('www.youtube.com/watch?v=m2s1kvWk89E', $constraint);
    }

    public function testValidYouTubeLinkWithHttp()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $constraint = new YouTubeLink();
        $this->validator->validate('http://youtube.com/watch?v=m2s1kvWk89E', $constraint);
    }

    public function testValidYouTubeLinkWithHttps()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $constraint = new YouTubeLink();
        $this->validator->validate('https://youtube.com/watch?v=m2s1kvWk89E', $constraint);
    }

    public function testValidYouTubeLinkWithWwwAndHttp()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $constraint = new YouTubeLink();
        $this->validator->validate('http://www.youtube.com/watch?v=m2s1kvWk89E', $constraint);
    }

    public function testValidYouTubeLinkWithQueryParams()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $constraint = new YouTubeLink();
        $this->validator->validate('http://www.youtube.com/watch?v=qguJbbgFHgc&feature=share', $constraint);
    }

    public function testValidEmbedYouTubeLink()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $constraint = new YouTubeLink();
        $this->validator->validate('http://www.youtube.com/embed/m2s1kvWk89E', $constraint);
    }

    public function testValidShortYouTubeLink()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $constraint = new YouTubeLink();
        $this->validator->validate('http://youtu.be/m2s1kvWk89E', $constraint);
    }

    public function testInvalidYouTubeLink()
    {
        $constraint = new YouTubeLink(array(
            'message' => 'myMessage',
        ));

        $this->context->expects($this->once())
            ->method('addViolation')
            ->with('myMessage');

        $this->validator->validate('http://youtu.be/m2s1kvWk89E2', $constraint);
    }

    public function testNotYouTubeLink()
    {
        $constraint = new YouTubeLink(array(
            'message' => 'myMessage',
        ));

        $this->context->expects($this->once())
            ->method('addViolation')
            ->with('myMessage');

        $this->validator->validate('http://google.com', $constraint);
    }
}
