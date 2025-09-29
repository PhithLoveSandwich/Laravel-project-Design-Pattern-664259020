@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif;">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>🍲 กระทู้เกี่ยวกับอาหาร</h1>
        <a href="{{ route('posts.create') }}"
           style="background: #007BFF; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none;">
           ✍️ สร้างกระทู้ใหม่
        </a>
    </div>

    @foreach($posts as $post)
        <div style="border: 1px solid #ddd; border-radius: 10px; padding: 15px; margin-bottom: 15px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); transition: transform 0.2s;">
            <h2 style="margin-bottom: 8px;">
                <a href="{{ route('posts.show', $post) }}" style="text-decoration: none; color: #333;">
                    {{ $post->title }}
                </a>
            </h2>
            <p style="color: #555; line-height: 1.5;">{{ Str::limit($post->content, 100) }}</p>
            <small style="color: #888;">โดย {{ $post->user->name }} | {{ $post->created_at->diffForHumans() }}</small>
        </div>
    @endforeach

    {{-- แบ่งหน้า --}}
    <div style="margin-top: 20px;">
        {{ $posts->links() }}
    </div>

</div>
@endsection
