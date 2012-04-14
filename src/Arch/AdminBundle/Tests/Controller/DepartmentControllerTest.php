<?php

namespace Arch\AdminBundle\Tests\Controller;

use \Symfony\Component\DomCrawler\Form;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DepartmentControllerTest extends AbstractCrudAuthTestCase
{
    protected $_url = '/department';

    public function testCreateEntity()
    {
        $client = static::createAuthedClient();
        $client->followRedirects(true);
        $crawler = $client->request('GET', '/department/new');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Create')->form();
        $form['arch_adminbundle_departmenttype[name]'] = "";
        $crawler = $client->submit($form);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($crawler->filter('html:contains("NameDepartment name should not be blank.")')->count() > 0);

        $crawler = $client->request('GET', '/department/new');
        $form = $crawler->selectButton('Create')->form();
        $form['arch_adminbundle_departmenttype[name]'] = "Test department";

        $crawler = $client->submit($form);
        $this->assertTrue($crawler->filter("td:contains('Test department')")->count() > 0);
    }
}