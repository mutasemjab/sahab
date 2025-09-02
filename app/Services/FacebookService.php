<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class FacebookService
{
    protected $pageId;
    protected $appId;
    protected $appSecret;

    public function __construct()
    {
        $this->pageId = config('services.facebook.page_id');
        $this->appId = config('services.facebook.app_id');
        $this->appSecret = config('services.facebook.app_secret');
    }

    public function getPagePosts($limit = 10)
    {
        return Cache::remember('facebook_posts', 600, function () use ($limit) {
            try {
                // Use App Access Token (App ID|App Secret)
                $appAccessToken = $this->appId . '|' . $this->appSecret;
                
                Log::info('Facebook API Request with App Token', [
                    'page_id' => $this->pageId,
                    'limit' => $limit
                ]);

                $response = Http::get("https://graph.facebook.com/v18.0/{$this->pageId}/posts", [
                    'fields' => 'id,message,created_time,full_picture,permalink_url',
                    'limit' => $limit,
                    'access_token' => $appAccessToken
                ]);

                Log::info('Facebook API Response', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    return $data['data'] ?? [];
                }

                Log::error('Facebook API Error', [
                    'status' => $response->status(),
                    'error' => $response->body()
                ]);
                
                return [];
            } catch (\Exception $e) {
                Log::error('Facebook Service Exception: ' . $e->getMessage());
                return [];
            }
        });
    }
}