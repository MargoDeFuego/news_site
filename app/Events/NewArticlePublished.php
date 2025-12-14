<?php

namespace App\Events;

use App\Models\Article;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewArticlePublished implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public int $id;
    public string $title;
    public string $url;

    public function __construct(Article $article)
    {
        $this->id = $article->id;
        $this->title = $article->title;

        // Под твой роут
        $this->url = route('news.show', $article->id);
    }

    /**
     * Канал вещания (публичный)
     */
    public function broadcastOn(): Channel
    {
        return new Channel('articles');
    }

    /**
     * Имя события на фронте
     */
    public function broadcastAs(): string
    {
        return 'article.published';
    }

    /**
     * Данные, доступные во фронтенде
     */
    public function broadcastWith(): array
    {
        return [
            'id'    => $this->id,
            'title' => $this->title,
            'url'   => $this->url,
        ];
    }
}
