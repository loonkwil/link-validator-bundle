<?php

namespace SPE\LinkValidatorBundle\Tests\Validator\Constraints;

use SPE\LinkValidatorBundle\Validator\FacebookLink;
use SPE\LinkValidatorBundle\Validator\FacebookLinkValidator;

class FacebookLinkValidatorTest extends \PHPUnit_Framework_TestCase
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

        $this->validator = new FacebookLinkValidator();
        $this->validator->initialize($this->context);

        $this->constraint = new FacebookLink(array('message' => 'myMessage'));
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
        $this->shouldBeValid('facebook.com/Google');
    }

    public function testValidVimeoVideoWithWww()
    {
        $this->shouldBeValid('www.facebook.com/Google');
    }

    public function testValidVimeoVideoWithHttp()
    {
        $this->shouldBeValid('http://facebook.com/Google');
    }

    public function testValidVimeoVideoWithHttps()
    {
        $this->shouldBeValid('https://facebook.com/Google');
    }

    public function testValidVimeoVideoWithWwwAndHttp()
    {
        $this->shouldBeValid('http://www.facebook.com/Google');
    }

    public function testInvalidVimeoVideo()
    {
        $this->shouldNotBeValid('http://www.facbook.com/Google');
    }

    public function testNotVimeoVideo()
    {
        $this->shouldNotBeValid('http://google.com');
    }
}
