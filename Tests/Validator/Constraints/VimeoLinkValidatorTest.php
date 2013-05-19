<?php

namespace SPE\LinkValidatorBundle\Tests\Validator\Constraints;

use SPE\LinkValidatorBundle\Validator\VimeoLink;
use SPE\LinkValidatorBundle\Validator\VimeoLinkValidator;

class VimeoLinkValidatorTest extends \PHPUnit_Framework_TestCase
{
    protected $context;
    protected $validator;

    protected function setUp()
    {
        $this->context = $this->getMock('Symfony\Component\Validator\ExecutionContext', array(), array(), '', false);
        $this->validator = new VimeoLinkValidator();
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

        $this->validator->validate(null, new VimeoLink());
    }

    public function testEmptyStringIsValid()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate('', new VimeoLink());
    }

    /**
     * @expectedException Symfony\Component\Validator\Exception\UnexpectedTypeException
     */
    public function testExpectsStringCompatibleType()
    {
        $this->validator->validate(new \stdClass(), new VimeoLink());
    }

    public function testValidVimeoLink()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $constraint = new VimeoLink();
        $this->validator->validate('vimeo.com/58024671', $constraint);
    }

    public function testValidVimeoLinkWithWww()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $constraint = new VimeoLink();
        $this->validator->validate('www.vimeo.com/58024671', $constraint);
    }

    public function testValidVimeoLinkWithHttp()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $constraint = new VimeoLink();
        $this->validator->validate('http://vimeo.com/58024671', $constraint);
    }

    public function testValidVimeoLinkWithHttps()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $constraint = new VimeoLink();
        $this->validator->validate('https://vimeo.com/58024671', $constraint);
    }

    public function testValidVimeoLinkWithWwwAndHttp()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $constraint = new VimeoLink();
        $this->validator->validate('http://www.vimeo.com/58024671', $constraint);
    }

    public function testInvalidVimeoLink()
    {
        $constraint = new VimeoLink(array(
            'message' => 'myMessage',
        ));

        $this->context->expects($this->once())
            ->method('addViolation')
            ->with('myMessage');

        $this->validator->validate('http://www.vimeo.com/a8024671', $constraint);
    }

    public function testNotVimeoLink()
    {
        $constraint = new VimeoLink(array(
            'message' => 'myMessage',
        ));

        $this->context->expects($this->once())
            ->method('addViolation')
            ->with('myMessage');

        $this->validator->validate('http://google.com', $constraint);
    }
}
