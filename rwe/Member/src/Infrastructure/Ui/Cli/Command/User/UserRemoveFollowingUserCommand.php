<?php

declare(strict_types=1);

namespace Member\Infrastructure\Ui\Cli\Command\User;

use Ddd\Application\Service\ApplicationService;
use Member\Application\Service\UnfollowUserRequest;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UserRemoveFollowingUserCommand extends Command
{
    protected static $defaultName = 'rwe:user:remove-following';

    private $unfollowUserService;

    public function __construct(ApplicationService $applicationService)
    {
        $this->unfollowUserService = $applicationService;

        // you *must* call the parent constructor
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Change first name of user')
            ->addArgument('user_id', InputArgument::REQUIRED, 'user identifier.')
            ->addArgument('unfollowing_user_id', InputArgument::REQUIRED, 'identifier of user to remove from list of following users.')
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
        $unfollowingUserId = $input->getArgument('unfollowing_user_id');

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

        $userRelation = $this->unfollowUserService->execute(
            new UnfollowUserRequest($user_id, $unfollowingUserId)
        );

        $io->success(sprintf('Ok! User with id: %s stop follow user with id: %s.', $userRelation, $unfollowingUserId));
    }
}
