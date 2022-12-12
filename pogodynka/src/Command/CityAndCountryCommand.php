<?php

namespace App\Command;
use App\Service\WeatherUtil;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'cityandcountry:command',
    description: 'Add a short description for your command',
)]
class CityAndCountryCommand extends Command
{
    private WeatherUtil $weatherUtil;
    protected static $defaultName = 'CityAndCountryCommand';
    protected static $defaultDescription = "Get city";

    public function __construct(WeatherUtil $weatherUtil)
    {
        $this->weatherUtil = $weatherUtil;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('city', null, InputOption::VALUE_REQUIRED, 'city')
            ->addArgument('country', null, InputOption::VALUE_REQUIRED, 'country');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $cityArg = $input->getArgument('city');
        $countryArg = $input->getArgument('country');

        if (!$cityArg) {
            $io->error("You need provide city!");
            return -1;
        }

        if (!$countryArg) {
            $io->error("You need provide country code!");
            return -1;
        }

        $results = $this->weatherUtil->getWeatherForCountryAndCity($cityArg);

        if (count($results) == 0) {
            $io->error("Empty result");
            return -1;
        }
        $data = array();
        foreach ($results as $result)

        $output->writeln(json_encode($results));

        $io->success('Success');

        return Command::SUCCESS;
    }
}
