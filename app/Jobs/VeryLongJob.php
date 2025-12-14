<?php

namespace App\Jobs;

use App\Models\Article;
use App\Models\User;
use App\Mail\NewArticleMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class VeryLongJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Article $article;

    /**
     * Create a new job instance.
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // ⏳ имитация долгой операции (для наглядности очереди)
        sleep(5);

        // Находим всех модераторов
        $moderators = User::whereHas('role', function ($q) {
            $q->where('name', 'moderator');
        })->get();

        // Отправляем письмо каждому модератору
        foreach ($moderators as $moderator) {
            Mail::to($moderator->email)
                ->send(new NewArticleMail($this->article));
        }
    }
}
