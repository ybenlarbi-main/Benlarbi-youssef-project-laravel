<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with filtered posts
     */
    public function index(Request $request): View
    {
        // Debug: Check if controller is being called
        \Log::info('DashboardController::index called with sort: ' . $request->get('sort', 'hot'));

        $sort = $request->get('sort', 'hot');

        try {
            // Get posts for the current user and their connections
            $userConnections = auth()->user()->getAllConnections()->pluck('id')->toArray();
            $userConnections[] = auth()->user()->id; // Include own posts

            $postsQuery = Post::with(['user', 'likes', 'comments'])
                ->whereIn('user_id', $userConnections);

            // Apply sorting based on filter
            switch ($sort) {
                case 'new':
                    $posts = $postsQuery->latest()->paginate(10);
                    break;

                case 'top':
                    // Sort by most likes + comments (engagement)
                    $posts = $postsQuery
                        ->withCount(['likes', 'comments'])
                        ->orderByRaw('(likes_count + comments_count) DESC')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
                    break;

                case 'hot':
                default:
                    // Hot: Recent posts with engagement (weighted by recency)
                    $posts = $postsQuery
                        ->withCount(['likes', 'comments'])
                        ->orderByRaw('
                            ((likes_count + comments_count) *
                            (1 + (86400 - TIMESTAMPDIFF(SECOND, created_at, NOW())) / 86400)) DESC
                        ')
                        ->paginate(10);
                    break;
            }

            \Log::info('Posts found: ' . $posts->count());

        } catch (\Exception $e) {
            \Log::error('Error in DashboardController: ' . $e->getMessage());

            // Fallback: return empty collection if there's an error
            $posts = Post::with(['user', 'likes', 'comments'])->paginate(10);
        }

        return view('dashboard', compact('posts', 'sort'));
    }
}
