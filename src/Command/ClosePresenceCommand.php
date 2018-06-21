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
            $p->setAutoClosed(true);

            $start = $p->getStart()->format('H:i:s');
            $end = $p->getEnd()->format('H:i:s');

            $hourmiliStart = (int)substr($start, 0, 2) * 3600000;
            $minutemiliStart = (int)substr($start, 3, 2) * 60000;
            $secondmiliStart = (int)substr($start, 6, 2) * 1000;

            $hourmiliEnd = (int)substr($end, 0, 2) * 3600000;
            $minutemiliEnd = (int)substr($end, 3, 2) * 60000;
            $secondmiliEnd = (int)substr($end, 6, 2) * 1000;

            $start = $hourmiliStart + $minutemiliStart + $secondmiliStart;
            $end = $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;

            if($this->isLessEightHours($start, $end)){
                $p->setEightHours(false);
            }else{
                $p->setEightHours(true);
            }

            $em->persist($p);

        }

        $em->flush();

        $output->writeln('Presences are closed');
    }

    function isLessEightHours($start, $end){
        if($end-$start<28800000){
            return true;
        }else {
            return false;
        }
    }

}