@extends('layouts.app')

@section('content')
<div style="max-width: 900px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif;
            background: url('https://images.unsplash.com/photo-1510626176961-4b532f7d0b0a?fit=crop&w=1350&q=80') no-repeat center center / cover;
            min-height: 100vh;">

    {{-- ข้อความแจ้งเตือน --}}
    @if(session('success'))
        <div style="background: rgba(40, 167, 69, 0.9); color: white; padding: 12px; border-radius: 8px; margin-bottom: 20px; text-align: center; font-weight: bold;">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; background: rgba(255,255,255,0.9); padding: 15px; border-radius: 10px;">
        <h1 style="font-size: 28px;">🍲 กระทู้เกี่ยวกับอาหาร</h1>

        {{-- ปุ่มสร้างกระทู้ แสดงเฉพาะผู้ที่ล็อกอินแล้ว --}}
        @auth
            <a href="{{ route('posts.create') }}"
               style="background: #007BFF; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none; font-weight: bold;">
               ✍️ สร้างกระทู้ใหม่
            </a>
        @endauth
    </div>

    @foreach($posts as $post)
        <div style="background: rgba(255,255,255,0.95); border: 1px solid #ddd; border-radius: 10px; padding: 20px; margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); transition: transform 0.2s;">
            <h2 style="margin-bottom: 10px; font-size: 22px;">
                <a href="{{ route('posts.show', $post) }}" style="text-decoration: none; color: #333;">
                    {{ $post->title }}
                </a>
            </h2>
            <p style="color: #555; line-height: 1.6;">{{ Str::limit($post->content, 150) }}</p>
            <small style="color: #888;">
                โดย {{ $post->user->name }} | {{ $post->created_at->diffForHumans() }}
            </small>

            <div style="margin-top: 10px; display: flex; gap: 10px;">
                {{-- ลบกระทู้และแก้ไขกระทู้ เฉพาะเจ้าของกระทู้ --}}
                @auth
                    @if(Auth::id() === $post->user_id)
                        <form action="{{ route('posts.destroy', $post) }}" method="POST"
                              onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบกระทู้นี้?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    style="background: #dc3545; color: white; padding: 6px 12px; border-radius: 5px; border: none; cursor: pointer;">
                                🗑 ลบกระทู้
                            </button>
                        </form>

                        <a href="{{ route('posts.edit', $post) }}"
                           style="background: #ffc107; color: white; padding: 6px 12px; border-radius: 5px; text-decoration: none;">
                           ✏ แก้ไขกระทู้
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    @endforeach

    {{-- แบ่งหน้า --}}
    <div style="margin-top: 30px; background: rgba(255,255,255,0.9); padding: 10px; border-radius: 10px;">
        {{ $posts->links() }}
    </div>

</div>
@endsection
