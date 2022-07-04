<?php

namespace App\Test\Controller;

use App\Entity\Roles;
use App\Repository\RolesRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RolesControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private RolesRepository $repository;
    private string $path = '/roles/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Roles::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Role index');

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
            'role[nombre]' => 'Testing',
            'role[identificador]' => 'Testing',
            'role[descripcion]' => 'Testing',
            'role[isActivo]' => 'Testing',
        ]);

        self::assertResponseRedirects('/roles/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Roles();
        $fixture->setNombre('My Title');
        $fixture->setIdentificador('My Title');
        $fixture->setDescripcion('My Title');
        $fixture->setIsActivo('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Role');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Roles();
        $fixture->setNombre('My Title');
        $fixture->setIdentificador('My Title');
        $fixture->setDescripcion('My Title');
        $fixture->setIsActivo('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'role[nombre]' => 'Something New',
            'role[identificador]' => 'Something New',
            'role[descripcion]' => 'Something New',
            'role[isActivo]' => 'Something New',
        ]);

        self::assertResponseRedirects('/roles/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNombre());
        self::assertSame('Something New', $fixture[0]->getIdentificador());
        self::assertSame('Something New', $fixture[0]->getDescripcion());
        self::assertSame('Something New', $fixture[0]->getIsActivo());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Roles();
        $fixture->setNombre('My Title');
        $fixture->setIdentificador('My Title');
        $fixture->setDescripcion('My Title');
        $fixture->setIsActivo('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/roles/');
    }
}
