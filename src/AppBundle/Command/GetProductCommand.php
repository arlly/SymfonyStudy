<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Criteria\IdCriteriaBuilder;

class GetProductCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('GetProduct')
            ->setDescription('...')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('productId', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $argument = $input->getArgument('argument');

        if (! $input->getOption('productId')) {
            $output->writeln('Command result.');
            exit();
        }

        $id = $input->getOption('productId');
        $product = $this->getContainer()->get('app.product.get_one')->run(new IdCriteriaBuilder($id));

        dump($product);
        $output->writeln($product->getCategory()->getName());


        $category = $this->getContainer()->get('app.category.get_one')->run(new IdCriteriaBuilder(1));
        $products = $category->getProducts();

        dump($products);

    }

}
