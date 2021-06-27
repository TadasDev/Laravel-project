<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Service\PostMailService;
use App\Mail\PostsAboutToExpire;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotifyExpiringPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'donatas:notify:expiring_posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends notifications to users about expiring posts';
    /**
     * @var PostMailService
     */
    private $postMailService;
    /**
     * @var PostRepository
     */
    private $postRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        UserRepository $userRepository,
        PostRepository $postRepository,
        PostMailService $postMailService
    )
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->postRepository = $postRepository;
        $this->postMailService = $postMailService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $log = [];
        foreach ($this->userRepository->findUsersWithExpiringPosts() as $user) {
            $expiringPosts = $this->postRepository->findExpiringPostsForUser($user);

            $mail = new PostsAboutToExpire($user, $expiringPosts);
            Mail::to($user)->send($mail);
            $log[(int) $user->id] = $expiringPosts->pluck('id')->toArray();
        }

        Log::info('Post expiration emails sent to users:', $log);
        return 0;
    }
}
