<?php

declare(strict_types=1);

namespace Identity\Infrastructure\Ui\Cli\Command\User;

use Ddd\Application\Service\ApplicationService;
use Identity\Application\Service\User\ChangeFirstNameUserRequest;
use Identity\Domain\Model\User\Exception\UserDoesNotExistException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UserChangeFirstNameCommand extends Command
{
    protected static $defaultName = 'rwe:user:change-first-name';

    private $txUserService;

    public function __construct(ApplicationService $applicationService)
    {
        $this->txUserService = $applicationService;

        // you *must* call the parent constructor
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Change first name of user')
            ->addArgument('user_id', InputArgument::REQUIRED, 'user identifier.')
            ->addArgument('firstName', InputArgument::REQUIRED, 'user first name.')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     *
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $user_id = $input->getArgument('user_id');
        $firstName = $input->getArgument('firstName');

//        if ($userIdArg) {
//            $io->note(sprintf('You passed an user_id: %s', $userIdArg));
//        }
//
//        if ($firstNameArg) {
//            $io->note(sprintf('You passed an firs_name: %s', $firstNameArg));
//        }
//
//        if ($input->getOption('option1')) {
//            // ...
//        }

//        try {
//            $this->userService->changeFirstName($userIdArg, $firstNameArg);
//        } catch (UserDoesNotExistException $e) {
//            $io->error(sprintf('User with id: %s not found.', $userIdArg));
//
//            //return 1;
//        }

        $newUser = $this->txUserService->execute(
            new ChangeFirstNameUserRequest($user_id, $firstName)
        );
        $io->success(sprintf('FirstName changed for user with id: %s', $newUser->userId()->toString()));
    }
}
