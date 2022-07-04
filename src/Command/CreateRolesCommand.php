<?php

namespace App\Command;

use App\Entity\Roles;
use App\Repository\RolesRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateRolesCommand extends Command
{
    protected static $defaultName = 'sd:create-roles';
    protected static $defaultDescription = 'Crea los roles del sistema';
    protected static array $default_roles = [
        'ADMIN',
        'VENTAS',
        'SUPERVISOR_VENTAS'
    ];
    private RolesRepository $rolesRepository;
    private EntityManagerInterface $entityManager;


    /**
     * @param RolesRepository $rolesRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(RolesRepository $rolesRepository, EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->rolesRepository = $rolesRepository;
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    /**
     * @throws \Doctrine\ORM\Exception\ORMException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
//        $arg1 = $input->getArgument('arg1');
//
//        if ($arg1) {
//            $io->note(sprintf('You passed an argument: %s', $arg1));
//        }
//
//        if ($input->getOption('option1')) {
//            // ...
//        }

        foreach ($this::$default_roles as $role){
            $rol = $this->rolesRepository->findBy(['identificador' => 'ROLE_'.$role]);
            if(!$rol){
                $rol = new Roles();
                $rol->setIdentificador('ROLE_'.$role);
                $rol->setDescripcion($role . ' Describir');
                $rol->setIsActivo(true);
               $rol->setNombre($role);
               $this->entityManager->persist($rol);
               $io->text('Creado ROLE: ' . $role );

            }
        }

        $this->entityManager->flush();



        $io->success('Roles creados');

        return Command::SUCCESS;
    }
}
