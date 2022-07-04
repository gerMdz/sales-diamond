<?php

namespace App\Test\Controller;

use App\Entity\ItemBudget;
use App\Repository\ItemBudgetRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ItemBudgetControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ItemBudgetRepository $repository;
    private string $path = '/item/budget/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(ItemBudget::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ItemBudget index');

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
            'item_budget[costo]' => 'Testing',
            'item_budget[unidad_costo]' => 'Testing',
            'item_budget[cantidad_costo]' => 'Testing',
            'item_budget[excendentes]' => 'Testing',
            'item_budget[excedentes_costo]' => 'Testing',
            'item_budget[observacion]' => 'Testing',
            'item_budget[createdAt]' => 'Testing',
            'item_budget[updatedAt]' => 'Testing',
            'item_budget[budget]' => 'Testing',
            'item_budget[producto]' => 'Testing',
            'item_budget[createdBy]' => 'Testing',
            'item_budget[updatedBy]' => 'Testing',
            'item_budget[contentChangedBy]' => 'Testing',
        ]);

        self::assertResponseRedirects('/item/budget/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new ItemBudget();
        $fixture->setCosto('My Title');
        $fixture->setUnidad_costo('My Title');
        $fixture->setCantidad_costo('My Title');
        $fixture->setExcendentes('My Title');
        $fixture->setExcedentes_costo('My Title');
        $fixture->setObservacion('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setBudget('My Title');
        $fixture->setProducto('My Title');
        $fixture->setCreatedBy('My Title');
        $fixture->setUpdatedBy('My Title');
        $fixture->setContentChangedBy('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ItemBudget');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new ItemBudget();
        $fixture->setCosto('My Title');
        $fixture->setUnidad_costo('My Title');
        $fixture->setCantidad_costo('My Title');
        $fixture->setExcendentes('My Title');
        $fixture->setExcedentes_costo('My Title');
        $fixture->setObservacion('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setBudget('My Title');
        $fixture->setProducto('My Title');
        $fixture->setCreatedBy('My Title');
        $fixture->setUpdatedBy('My Title');
        $fixture->setContentChangedBy('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'item_budget[costo]' => 'Something New',
            'item_budget[unidad_costo]' => 'Something New',
            'item_budget[cantidad_costo]' => 'Something New',
            'item_budget[excendentes]' => 'Something New',
            'item_budget[excedentes_costo]' => 'Something New',
            'item_budget[observacion]' => 'Something New',
            'item_budget[createdAt]' => 'Something New',
            'item_budget[updatedAt]' => 'Something New',
            'item_budget[budget]' => 'Something New',
            'item_budget[producto]' => 'Something New',
            'item_budget[createdBy]' => 'Something New',
            'item_budget[updatedBy]' => 'Something New',
            'item_budget[contentChangedBy]' => 'Something New',
        ]);

        self::assertResponseRedirects('/item/budget/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getCosto());
        self::assertSame('Something New', $fixture[0]->getUnidad_costo());
        self::assertSame('Something New', $fixture[0]->getCantidad_costo());
        self::assertSame('Something New', $fixture[0]->getExcendentes());
        self::assertSame('Something New', $fixture[0]->getExcedentes_costo());
        self::assertSame('Something New', $fixture[0]->getObservacion());
        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getUpdatedAt());
        self::assertSame('Something New', $fixture[0]->getBudget());
        self::assertSame('Something New', $fixture[0]->getProducto());
        self::assertSame('Something New', $fixture[0]->getCreatedBy());
        self::assertSame('Something New', $fixture[0]->getUpdatedBy());
        self::assertSame('Something New', $fixture[0]->getContentChangedBy());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new ItemBudget();
        $fixture->setCosto('My Title');
        $fixture->setUnidad_costo('My Title');
        $fixture->setCantidad_costo('My Title');
        $fixture->setExcendentes('My Title');
        $fixture->setExcedentes_costo('My Title');
        $fixture->setObservacion('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setBudget('My Title');
        $fixture->setProducto('My Title');
        $fixture->setCreatedBy('My Title');
        $fixture->setUpdatedBy('My Title');
        $fixture->setContentChangedBy('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/item/budget/');
    }
}
