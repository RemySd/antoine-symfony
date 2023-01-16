<?php

namespace App\Test\Controller;

use App\Entity\Intervenant;
use App\Repository\IntervenantRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IntervenantControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private IntervenantRepository $repository;
    private string $path = '/intervenant/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Intervenant::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Intervenant index');

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
            'intervenant[id_intervenant]' => 'Testing',
            'intervenant[id_utilisateur]' => 'Testing',
            'intervenant[id_role]' => 'Testing',
            'intervenant[id_matiere]' => 'Testing',
            'intervenant[nb_heure]' => 'Testing',
        ]);

        self::assertResponseRedirects('/intervenant/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Intervenant();
        $fixture->setId_intervenant('My Title');
        $fixture->setId_utilisateur('My Title');
        $fixture->setId_role('My Title');
        $fixture->setId_matiere('My Title');
        $fixture->setNb_heure('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Intervenant');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Intervenant();
        $fixture->setId_intervenant('My Title');
        $fixture->setId_utilisateur('My Title');
        $fixture->setId_role('My Title');
        $fixture->setId_matiere('My Title');
        $fixture->setNb_heure('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'intervenant[id_intervenant]' => 'Something New',
            'intervenant[id_utilisateur]' => 'Something New',
            'intervenant[id_role]' => 'Something New',
            'intervenant[id_matiere]' => 'Something New',
            'intervenant[nb_heure]' => 'Something New',
        ]);

        self::assertResponseRedirects('/intervenant/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getId_intervenant());
        self::assertSame('Something New', $fixture[0]->getId_utilisateur());
        self::assertSame('Something New', $fixture[0]->getId_role());
        self::assertSame('Something New', $fixture[0]->getId_matiere());
        self::assertSame('Something New', $fixture[0]->getNb_heure());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Intervenant();
        $fixture->setId_intervenant('My Title');
        $fixture->setId_utilisateur('My Title');
        $fixture->setId_role('My Title');
        $fixture->setId_matiere('My Title');
        $fixture->setNb_heure('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/intervenant/');
    }
}
