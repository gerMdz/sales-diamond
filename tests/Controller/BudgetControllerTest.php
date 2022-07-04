<?php

namespace App\Test\Controller;

use App\Entity\Budget;
use App\Repository\BudgetRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BudgetControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private BudgetRepository $repository;
    private string $path = '/budget/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Budget::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Budget index');

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
            'budget[aclaraciones]' => 'Testing',
            'budget[cliente_confirma]' => 'Testing',
            'budget[total]' => 'Testing',
            'budget[nro_budget]' => 'Testing',
            'budget[createdAt]' => 'Testing',
            'budget[updatedAt]' => 'Testing',
            'budget[cliente]' => 'Testing',
            'budget[productos]' => 'Testing',
            'budget[createdBy]' => 'Testing',
            'budget[updatedBy]' => 'Testing',
            'budget[contentChangedBy]' => 'Testing',
        ]);

        self::assertResponseRedirects('/budget/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Budget();
        $fixture->setAclaraciones('My Title');
        $fixture->setCliente_confirma('My Title');
        $fixture->setTotal('My Title');
        $fixture->setNro_budget('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setCliente('My Title');
        $fixture->setProductos('My Title');
        $fixture->setCreatedBy('My Title');
        $fixture->setUpdatedBy('My Title');
        $fixture->setContentChangedBy('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Budget');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Budget();
        $fixture->setAclaraciones('My Title');
        $fixture->setCliente_confirma('My Title');
        $fixture->setTotal('My Title');
        $fixture->setNro_budget('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setCliente('My Title');
        $fixture->setProductos('My Title');
        $fixture->setCreatedBy('My Title');
        $fixture->setUpdatedBy('My Title');
        $fixture->setContentChangedBy('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'budget[aclaraciones]' => 'Something New',
            'budget[cliente_confirma]' => 'Something New',
            'budget[total]' => 'Something New',
            'budget[nro_budget]' => 'Something New',
            'budget[createdAt]' => 'Something New',
            'budget[updatedAt]' => 'Something New',
            'budget[cliente]' => 'Something New',
            'budget[productos]' => 'Something New',
            'budget[createdBy]' => 'Something New',
            'budget[updatedBy]' => 'Something New',
            'budget[contentChangedBy]' => 'Something New',
        ]);

        self::assertResponseRedirects('/budget/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getAclaraciones());
        self::assertSame('Something New', $fixture[0]->getCliente_confirma());
        self::assertSame('Something New', $fixture[0]->getTotal());
        self::assertSame('Something New', $fixture[0]->getNro_budget());
        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getUpdatedAt());
        self::assertSame('Something New', $fixture[0]->getCliente());
        self::assertSame('Something New', $fixture[0]->getProductos());
        self::assertSame('Something New', $fixture[0]->getCreatedBy());
        self::assertSame('Something New', $fixture[0]->getUpdatedBy());
        self::assertSame('Something New', $fixture[0]->getContentChangedBy());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Budget();
        $fixture->setAclaraciones('My Title');
        $fixture->setCliente_confirma('My Title');
        $fixture->setTotal('My Title');
        $fixture->setNro_budget('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setCliente('My Title');
        $fixture->setProductos('My Title');
        $fixture->setCreatedBy('My Title');
        $fixture->setUpdatedBy('My Title');
        $fixture->setContentChangedBy('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/budget/');
    }
}
