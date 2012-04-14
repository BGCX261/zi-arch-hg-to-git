<?php
/**
 * Created by b17
 * 4/13/12 8:27 PM
 */

namespace Arch\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Form;

abstract class AbstractCrudAuthTestCase extends WebTestCase
{
    protected $_url = '';

    public function testIndexAction()
    {
        $client = static::createClient();
        $client->followRedirects(true);
        $crawler = $client->request('GET', $this->_url);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $links = $crawler->filter('a:contains("show")')->extract(array('href'));
        foreach ($links as $link) {
            $client->request('GET', $link);
            $this->assertEquals(200, $client->getResponse()->getStatusCode());
        }
    }

    public function testNewAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', "{$this->_url}/new");
        $this->assertEquals(401, $client->getResponse()->getStatusCode());

        $client = static::createAuthedClient();
        $crawler = $client->request('GET', "{$this->_url}/new");
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testCreateAction()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', "{$this->_url}/create");
        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }

    public function testEditAction()
    {
        $client = static::createClient();
        $client->request('GET', "{$this->_url}/1/edit");
        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }

    public function testUpdateAction()
    {
        $client = static::createClient();
        $client->request('POST', "{$this->_url}/1/update");
        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }

    public function testDeleteAction()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', "{$this->_url}/1/delete");
        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }

    /**
     * @static
     * @return \Symfony\Bundle\FrameworkBundle\Client
     */
    static public function createAuthedClient()
    {
        return static::createClient(array(), array(
            'PHP_AUTH_USER' => 'b17',
            'PHP_AUTH_PW'   => 'b17',
        ));
    }
}
