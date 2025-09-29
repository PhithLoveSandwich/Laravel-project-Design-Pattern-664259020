@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif;">

    {{-- กระทู้ --}}
    <div style="border: 1px solid #ddd; border-radius: 10px; padding: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin-bottom: 30px;">
        <h1 style="margin-bottom: 10px;">{{ $post->title }}</h1>
        <p style="line-height: 1.6; color: #333;">{{ $post->content }}</p>
        <small style="color: #888;">โดย {{ $post->user->name }} | {{ $post->created_at->diffForHumans() }}</small>

        {{-- ภาพกระทู้ --}}
        @php
            $postImagePath = storage_path('app/public/' . $post->image);
        @endphp
        @if($post->image && file_exists($postImagePath))
            <div style="margin-top: 15px;">
                <img src="{{ asset('storage/' . $post->image) }}"
                     alt="Post Image"
                     style="max-width: 100%; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.2);">
            </div>
        @else
            <div style="margin-top: 15px;">
                <img src="{{ asset('images/default-post.jpg') }}"
                     alt="Default Post Image"
                     style="max-width: 100%; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.2);">
            </div>
        @endif
    </div>

    <hr>

    {{-- ความคิดเห็น --}}
    <div style="margin-top: 30px;">
        <h2 style="margin-bottom: 15px;">💬 ความคิดเห็น</h2>

        @foreach($post->comments as $comment)
            @php
                $commentImagePath = isset($comment->image) ? storage_path('app/public/' . $comment->image) : null;
            @endphp
            <div style="border-left: 4px solid #4CAF50; padding: 10px 15px; margin-bottom: 10px; background: #f9f9f9; border-radius: 5px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <strong>{{ $comment->user->name }}</strong>
                    <span style="color: #888; font-size: 0.9em;">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                <p style="margin: 5px 0 0 0;">{{ $comment->content }}</p>

                {{-- ลบความคิดเห็น ถ้าเป็นเจ้าของ --}}
                @if($comment->user_id === auth()->id())
                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display:inline; margin-top:5px;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                style="background: #ff4d4d; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;">
                            🗑️ ลบ
                        </button>
                    </form>
                @endif
            </div>
        @endforeach

        {{-- ฟอร์มแสดงความคิดเห็น --}}
        <form action="{{ route('comments.store', $post) }}" method="POST" style="margin-top: 20px; border: 1px solid #ddd; padding: 15px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            @csrf
            <textarea name="content" rows="3" placeholder="เขียนความคิดเห็นของคุณ..." required
                style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; resize: vertical;"></textarea>
            <button type="submit"
                    style="margin-top: 10px; background: #4CAF50; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                ส่งความคิดเห็น
            </button>
        </form>
    </div>

</div>
@endsection
