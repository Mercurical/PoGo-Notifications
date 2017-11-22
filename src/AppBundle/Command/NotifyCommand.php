<?php

namespace AppBundle\Command;

use AppBundle\Entity\Configuration;
use AppBundle\Entity\Notify;
use AppBundle\Entity\Pokemon;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class NotifyCommand extends ContainerAwareCommand
{
    const MAX_NOTIFICATIONS = 5;

    protected function configure()
    {
        $this
            ->setName('app:notify')
            ->setDescription('Notifies about a pokemon on Skype.');
    }

    /**
     * TODO: clean up this and move to services
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();

        $bot = $container->get('app_bundle_skype_bot');
        $dataApi = $container->get('app_bundle_pokemon_data');
        $geocodeApi = $container->get('app_bundle_geo_location_data');
        $configRepo = $container->get('doctrine')->getRepository('AppBundle:Configuration');
        $notifyRepo = $container->get('doctrine')->getRepository('AppBundle:Notify');
        $em = $container->get('doctrine')->getManager();

        /** @var Notify $lastID */
        $lastID = $this->getLastID($notifyRepo, $em);
        $highestID = $lastID->getVal();

        $pokemons = $dataApi->getData($lastID->getVal());
        $configs = $configRepo->findBy(['isUsed' => 1]);
        $counters = [];

        /** @var Configuration $config */
        foreach ($configs as $config) {
            $counters[$config->getSkypeUsername()] = 0;
        }

        /** @var Pokemon $pokemon */
        foreach ($pokemons as $pokemon) {
            /** @var Configuration $config */
            foreach ($configs as $config) {
                if (
                    in_array($pokemon->getPokemonId(), json_decode($config->getPokemonIDs(), true)) &&
                    $config->getSkypeUsername() !== "" &&
                    $counters[$config->getSkypeUsername()] < self::MAX_NOTIFICATIONS
                ) {
                    $geoLocation = $geocodeApi->getData($pokemon);

                    $message = '#' . $pokemon->getPokemonId() . ' ' . $pokemon->getName() . ', ' .
                        $geoLocation->getLongRouteName() . ' ' . $geoLocation->getLongStreetNumber() .
                        ', ' . $pokemon->getTimeToExpire();
                    $bot->sendMessage($message, $config->getSkypeUsername());

                    echo 'Sent to "' . $config->getSkypeUsername() . '": ' . $message . "\n";

                    $counters[$config->getSkypeUsername()]++;
                }
            }

            $highestID = $pokemon->getId() > $highestID ? $pokemon->getId() : $highestID;
        }

        $lastID->setVal($highestID);
        $em->persist($lastID);
        $em->flush();
    }

    /**
     * TODO: move to repository
     * @param ObjectRepository $notifyRepo
     * @param ObjectManager $em
     * @return string
     */
    private function getLastID(ObjectRepository $notifyRepo, ObjectManager $em)
    {
        $obj = $notifyRepo->findOneBy(['key' => 'last_id']);

        if (null === $obj) {
            $obj = new Notify();
            $obj->setKey('last_id');
            $obj->setVal('0');

            $em->persist($obj);
            $em->flush();
        }

        return $obj;
    }
}