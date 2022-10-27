<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class BlogController extends Controller
{
    public function show(): Response
    {
        return Inertia::render('Home');
    }

    public function showPost(): Response
    {
        return Inertia::render('Post');
    }

    public function showTopicPosts(): Response
    {
        return Inertia::render('TopicPosts');
    }

    public function showAuthorPosts(): Response
    {
        return Inertia::render('AuthorPosts');
    }
}
