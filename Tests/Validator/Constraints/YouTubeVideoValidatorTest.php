<?php

namespace SPE\LinkValidatorBundle\Tests\Validator\Constraints;

use SPE\LinkValidatorBundle\Validator\YouTubeVideo;
use SPE\LinkValidatorBundle\Validator\YouTubeVideoValidator;

class YouTubeVideoValidatorTest extends \PHPUnit_Framework_TestCase
{
    protected $context;
    protected $validator;
    protected $constraint;

    protected function setUp()
    {
        $this->context = $this->getMock(
            'Symfony\Component\Validator\Context\ExecutionContext',
            array(), array(), '', false
        );

        $this->validator = new YouTubeVideoValidator();
        $this->validator->initialize($this->context);

        $this->constraint = new YouTubeVideo(array('message' => 'myMessage'));
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

    public function testValidYouTubeVideo()
    {
        $this->shouldBeValid('youtube.com/watch?v=m2s1kvWk89E');
    }

    public function testValidYouTubeVideoWithWww()
    {
        $this->shouldBeValid('www.youtube.com/watch?v=m2s1kvWk89E');
    }

    public function testValidYouTubeVideoWithHttp()
    {
        $this->shouldBeValid('http://youtube.com/watch?v=m2s1kvWk89E');
    }

    public function testValidYouTubeVideoWithHttps()
    {
        $this->shouldBeValid('https://youtube.com/watch?v=m2s1kvWk89E');
    }

    public function testValidYouTubeVideoWithWwwAndHttp()
    {
        $this->shouldBeValid('http://www.youtube.com/watch?v=m2s1kvWk89E');
    }

    public function testValidYouTubeVideoWithQueryParams()
    {
        $this->shouldBeValid(
            'http://www.youtube.com/watch?v=qguJbbgFHgc&feature=share'
        );
    }

    public function testValidEmbedYouTubeVideo()
    {
        $this->shouldBeValid('http://www.youtube.com/embed/m2s1kvWk89E');
    }

    public function testValidShortYouTubeVideo()
    {
        $this->shouldBeValid('http://youtu.be/m2s1kvWk89E');
    }

    public function testInvalidYouTubeVideo()
    {
        $this->shouldNotBeValid('http://youtu.be/m2s1kvWk89E2');
    }

    public function testNotYouTubeVideo()
    {
        $this->shouldNotBeValid('http://google.com');
    }
}
