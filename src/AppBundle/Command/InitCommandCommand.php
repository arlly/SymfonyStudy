<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Criteria\IdCriteriaBuilder;

class InitCommandCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this->setName('InitData')
            ->setDescription('カテゴリと商品の初期値を作成します')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('product', null, InputOption::VALUE_NONE, 'product=商品の初期データを作成します')
            ->addOption('category', null, InputOption::VALUE_NONE, 'category=カテゴリの初期データを作成します');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $argument = $input->getArgument('argument');

        if ($input->getOption('category')) {
            $this->initCategory();
            $output->writeln('カテゴリを作成した');
        } elseif ($input->getOption('product')) {
            $this->initProduct();
            $output->writeln('商品を作成した');
        } else {
            $output->writeln('オプションを指定してください');
        }
    }

    private function initCategory()
    {
        $category = [
            'ABU',
            'fenwick',
            'エバーグリーン',
            'ノリーズ'
        ];

        foreach ($category as $name) {
            $category = new Category();
            $category->setName($name);

            $this->getContainer()->get('app.category.create')->run($category);
        }
    }

    private function initProduct()
    {
        $sources = [
            ['name' => 'TAV-GP69CMJ', 'price' => '51000', 'description' => '琵琶湖のなんでもロッドです。', 'category_id' => 2]
        ];

        foreach ($sources as $val) {
            $category = $this->getContainer()->get('app.category.get_one')->run(new IdCriteriaBuilder($val['category_id']));

            $product = new Product();
            $product->setName($val['name']);
            $product->setPrice($val['price']);
            $product->setDescription($val['description']);
            $product->setCategory($category);

            $this->getContainer()->get('app.product.create')->run($product);

        }


    }

}
