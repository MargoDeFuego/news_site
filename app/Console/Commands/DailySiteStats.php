<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ArticleView;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class DailySiteStats extends Command
{
    protected $signature = 'stats:daily';
    protected $description = 'Отправка дневной статистики модераторам';

    public function handle()
    {
        $viewsToday = ArticleView::whereDate('created_at', today())->count();

        $commentsToday = Comment::whereDate('created_at', today())->count();

        $moderators = User::whereHas('role', fn ($q) =>
            $q->where('name', 'moderator')
        )->get();

        foreach ($moderators as $moderator) {
            Mail::raw(
                "📊 Статистика за день:\n\nПросмотры новостей: {$viewsToday}\nНовые комментарии: {$commentsToday}",
                fn ($message) => $message
                    ->to($moderator->email)
                    ->subject('Дневная статистика сайта')
            );
        }

        $this->info('Статистика отправлена');
    }
}
