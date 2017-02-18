<?php
namespace NewDay\Routing;

class RouteUmTest extends \PHPUnit_Framework_TestCase
{
    private $router;

    public function setUp()
    {
        $this->router = new Router();
    }

    public function testDeveRetornarRotaContact()
    {
        $this->router->setRouteAndCallback('/contact/{id}', function () {
            return 'contact ok';
        });

        $this->router->setUri('/contact/1');

        $actual = $this->router->getRoute();

        $expected = '/contact';

        $this->assertEquals($expected, $actual);
    }

    public function testDeveExecutarCallbackERetornarHello()
    {
        $this->router->route('/hello', function () {
            return 'Hello';
        });

        $this->router->setUri('/hello');

        $actual = $this->router->run();

        $expected = 'Hello';

        $this->assertEquals($expected, $actual);
    }

    public function testDeveRetornarUriContact()
    {
        $this->router->setUri('forum');
        $actual = $this->router->getUri();

        $expected = 'forum';
        $this->assertEquals($expected, $actual);
    }

    public function testDeveRetornarDuasRotas()
    {
        $this->router->route('rota', 'callback');
        $this->router->route('rotaDois', 'callbackDois');

        $actual = $this->router->getConfigs();

        $expected = [
            ['rota' => 'callback'],
            ['rotaDois'=> 'callbackDois'],
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testDeveRetornarRotaForum()
    {
        $this->router->route('/forum', 'callbackForum');
        $this->router->route('/contact', 'callbackContact');

        $actual = $this->router->getConfigs('/forum');

        $expected = ['/forum' => 'callbackForum'];

        $this->assertEquals($expected, $actual);
    }

    public function testDeveInstanciarClasseHelloERetornarHello()
    {
        $this->router->route('/hello', 'NewDay\Routing\Tests\Hello:say');

        $this->router->setUri('/hello');

        $actual = $this->router->run();

        $expected = 'Hello!';

        $this->assertEquals($expected, $actual);
    }
}
