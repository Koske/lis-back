<?php
/**
 * Created by PhpStorm.
 * User: milosa
 * Date: 4/26/2018
 * Time: 4:57 PM
 */

namespace App\Command;


use App\Entity\Presence;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ClosePresenceCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('lis:close:presences')
            ->setDescription('Closed presence');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');


        $presences = $em->getRepository(Presence::class)->findBy(["closed" => false]);

        foreach ($presences as $p) {
            $p->setClosed(true);
            $p->setEnd(new \DateTime());
            $p->setDateUpdated(new \DateTime());

            $em->persist($p);

        }

        $em->flush();

        $output->writeln('Presences are closed');
    }

}