<?php
namespace JSomerstone\Cimbic\Test\Integration;


class Testcase extends \JSomerstone\Cimbic\Test\Testcase
{
    protected $controller;
    protected $request;

    protected $output = '';

    public static $tempSitePath = '/tmp/fakeSite';

    public static function setUpBeforeClass()
    {
        $fakeSite = realpath(dirname(__DIR__)  . '/Data/FakeSite');

        if (!file_exists(self::$tempSitePath))
        {
            mkdir (self::$tempSitePath);
        }
        \rcopy($fakeSite, self::$tempSitePath);
    }

    public static function tearDownAfterClass()
    {
        rrmdir(self::$tempSitePath);
    }

    public function setUp()
    {
        $_SERVER['HTTP_HOST'] = 'localhost';
        $this->controller = new \JSomerstone\Cimbic\ContentManager(self::$tempSitePath);
    }

    protected function runAction(
        $path = '',
        $URI = null,
        $GET = null, 
        $POST = null)
    {
        ob_start();
        $this->controller->execute($this->request());
        $this->output = ob_get_clean();
    }

    protected function get($url = '', $getParams = null)
    {
        return $this->request($url, $getParams);
    }

    protected function post($url = '', $postParams = null)
    {
        return $this->request($url, null, $postParams);
    }

    protected function uri($url = '', $uri = null)
    {
        return $this->request($url, null, null, $uriParams);
    }

    protected function request(
        $path = '',
        $GET = null, 
        $POST = null,
        $URI = null
    )
    {
        $fakeUri = $path;

        $URI = $URI ?: array();
        $_GET = $GET ?: array();
        $_POST = $POST ?: array();

        if (is_array($URI))
        {
            foreach ($URI as $param => $value)
            {
                $fakeUri . '/' . $param . ':' . $value;
            }
        }

        $_SERVER['REQUEST_URI'] = $fakeUri;

        $this->request = new \JSomerstone\Cimbic\Test\Mock\Request();

        ob_start();
        $this->controller->execute($this->request);
        $this->output = ob_get_clean();

        return $this;
    }

    public function assertOutput($regexp, $message = null)
    {
        $this->assertRegExp($regexp, $this->output, $message);
        return $this;
    }

    public function assertStatus($statusCode, $message = null)
    {
        return $this->assertHeader(
            sprintf('/HTTP\/1.1 %d/', $statusCode),
            $message
        );
    }

    public function assertHeader($regexp, $message = null)
    {
        $headers = \JSomerstone\JSFramework\NativeFunctions::getHeaders();

        foreach ($headers as $header)
        {
            if (preg_match($regexp, $header))
            {
                $this->assertRegexp($regexp, $header);
                return $this;
            }
        }
        $this->fail($message ?: 'Unable to find header that matches regexp: ' . $regexp);
        return $this;
    }
}