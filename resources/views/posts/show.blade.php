@extends('layouts.app')

@section('content')
<div style="max-width: 900px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif;">

    {{-- กระทู้ --}}
    <div style="background: #fff; border: 1px solid #ddd; border-radius: 12px; padding: 25px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 40px;">
        <h1 style="margin-bottom: 15px; font-size: 28px; color: #333;">{{ $post->title }}</h1>
        <p style="line-height: 1.7; color: #555; font-size: 16px;">{{ $post->content }}</p>
        <small style="color: #888;">โดย <strong>{{ $post->user->name }}</strong> | {{ $post->created_at->diffForHumans() }}</small>

        {{-- ภาพกระทู้ --}}
        @php
            $postImagePath = storage_path('app/public/' . $post->image);
        @endphp
        <div style="margin-top: 20px;">
            @if($post->image && file_exists($postImagePath))
                <img src="{{ asset('storage/' . $post->image) }}"
                     alt="Post Image"
                     style="max-width: 100%; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
            @else
                <img src="{{ asset('images/default-post.jpg') }}"
                     alt="Default Post Image"
                     style="max-width: 100%; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
            @endif
        </div>
    </div>

    <hr style="border-color: #eee; margin-bottom: 40px;">

    {{-- ความคิดเห็น --}}
    <div style="margin-top: 30px;">
        <h2 style="margin-bottom: 20px; font-size: 24px; color: #333;">💬 ความคิดเห็น</h2>

        @foreach($post->comments as $comment)
            <div style="background: #f9f9f9; border-left: 4px solid #4CAF50; padding: 15px; margin-bottom: 15px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
                    <strong style="color: #2c3e50;">{{ $comment->user->name }}</strong>
                    <span style="color: #aaa; font-size: 0.9em;">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                <p style="margin: 5px 0; color: #555; font-size: 15px;">{{ $comment->content }}</p>

                {{-- ลบความคิดเห็น ถ้าเป็นเจ้าของ --}}
                @if($comment->user_id === auth()->id())
                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display:inline; margin-top:5px;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                style="background: #ff4d4d; color: white; border: none; padding: 6px 12px; border-radius: 5px; cursor: pointer; font-size: 14px;">
                            🗑️ ลบ
                        </button>
                    </form>
                @endif
            </div>
        @endforeach

        {{-- ฟอร์มแสดงความคิดเห็น --}}
        <form action="{{ route('comments.store', $post) }}" method="POST" style="margin-top: 30px; border: 1px solid #ddd; padding: 20px; border-radius: 10px; background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.03);">
            @csrf
            <h3 style="margin-bottom: 10px; font-size: 20px; color: #333;">✍️ แสดงความคิดเห็นของคุณ</h3>
            <textarea name="content" rows="4" placeholder="เขียนความคิดเห็นของคุณ..." required
                style="width: 100%; padding: 12px; border-radius: 5px; border: 1px solid #ccc; resize: vertical; font-size: 15px;"></textarea>
            <button type="submit"
                    style="margin-top: 15px; background: #4CAF50; color: white; border: none; padding: 12px 20px; border-radius: 5px; cursor: pointer; font-size: 16px;">
                ส่งความคิดเห็น
            </button>
        </form>
    </div>

</div>
@endsection
