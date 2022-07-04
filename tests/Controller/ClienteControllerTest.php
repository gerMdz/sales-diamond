<?php

namespace App\Test\Controller;

use App\Entity\Cliente;
use App\Repository\ClienteRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ClienteControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ClienteRepository $repository;
    private string $path = '/cliente/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Cliente::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Cliente index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'cliente[razon_social]' => 'Testing',
            'cliente[address]' => 'Testing',
            'cliente[phone]' => 'Testing',
            'cliente[emial]' => 'Testing',
            'cliente[cuit]' => 'Testing',
        ]);

        self::assertResponseRedirects('/cliente/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Cliente();
        $fixture->setRazon_social('My Title');
        $fixture->setAddress('My Title');
        $fixture->setPhone('My Title');
        $fixture->setEmial('My Title');
        $fixture->setCuit('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Cliente');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Cliente();
        $fixture->setRazon_social('My Title');
        $fixture->setAddress('My Title');
        $fixture->setPhone('My Title');
        $fixture->setEmial('My Title');
        $fixture->setCuit('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'cliente[razon_social]' => 'Something New',
            'cliente[address]' => 'Something New',
            'cliente[phone]' => 'Something New',
            'cliente[emial]' => 'Something New',
            'cliente[cuit]' => 'Something New',
        ]);

        self::assertResponseRedirects('/cliente/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getRazon_social());
        self::assertSame('Something New', $fixture[0]->getAddress());
        self::assertSame('Something New', $fixture[0]->getPhone());
        self::assertSame('Something New', $fixture[0]->getEmial());
        self::assertSame('Something New', $fixture[0]->getCuit());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Cliente();
        $fixture->setRazon_social('My Title');
        $fixture->setAddress('My Title');
        $fixture->setPhone('My Title');
        $fixture->setEmial('My Title');
        $fixture->setCuit('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/cliente/');
    }
}
