<?php

namespace SPE\LinkValidatorBundle\Tests\Validator\Constraints;

use SPE\LinkValidatorBundle\Validator\VimeoVideo;
use SPE\LinkValidatorBundle\Validator\VimeoVideoValidator;

class VimeoVideoValidatorTest extends \PHPUnit_Framework_TestCase
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

        $this->validator = new VimeoVideoValidator();
        $this->validator->initialize($this->context);

        $this->constraint = new VimeoVideo(array('message' => 'myMessage'));
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

    public function testValidVimeoVideo()
    {
        $this->shouldBeValid('vimeo.com/58024671');
    }

    public function testValidVimeoVideoWithWww()
    {
        $this->shouldBeValid('www.vimeo.com/58024671');
    }

    public function testValidVimeoVideoWithHttp()
    {
        $this->shouldBeValid('http://vimeo.com/58024671');
    }

    public function testValidVimeoVideoWithHttps()
    {
        $this->shouldBeValid('https://vimeo.com/58024671');
    }

    public function testValidVimeoVideoWithWwwAndHttp()
    {
        $this->shouldBeValid('http://www.vimeo.com/58024671');
    }

    public function testInvalidVimeoVideo()
    {
        $this->shouldNotBeValid('http://www.vimeo.com/a8024671');
    }

    public function testNotVimeoVideo()
    {
        $this->shouldNotBeValid('http://google.com');
    }
}
