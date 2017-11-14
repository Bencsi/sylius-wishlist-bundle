<?php

namespace Webburza\Sylius\WishlistBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RemoveExpiredPriceLocksCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        $this
            ->setName('webburza:sylius-wishlist-bundle:remove-expired-price-locks')
            ->setDescription('Removes price locks that have been idle for a configured period.')
            ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $expirationTime = $this->getContainer()->getParameter('webburza_sylius_wishlist.price_locks_expiration_period');
        $output->writeln(
            sprintf('Command will remove price locks that have been idle for <info>%s</info>.', $expirationTime)
        );

        $expiredPriceLocksRemover = $this->getContainer()->get('webburza_sylius_wishlist.expired_price_locks_remover');
        $expiredPriceLocksRemover->remove();

        $this->getContainer()->get('doctrine.orm.entity_manager')->flush();
    }
}
