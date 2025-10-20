@extends('layouts.app')

@section('content')
<div style="max-width: 700px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif;">

    @guest
        {{-- แจ้งเตือนให้เข้าสู่ระบบ --}}
        <div style="background: #ffcccc; color: #900; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-weight: bold; text-align: center;">
            ⚠️ กรุณาเข้าสู่ระบบก่อนที่จะแก้ไขกระทู้
        </div>
        <div style="text-align: center;">
            <a href="{{ route('login') }}"
               style="background: #007BFF; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                เข้าสู่ระบบ
            </a>
        </div>
    @else
        {{-- ฟอร์มแก้ไขกระทู้ --}}
        <h1 style="margin-bottom: 20px; font-size: 28px; font-weight: bold; color: #333;">📝 แก้ไขกระทู้</h1>

        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data"
              style="border: 1px solid #ddd; padding: 25px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); background: #fff;">
            @csrf
            @method('PUT')

            {{-- หัวข้อ --}}
            <div style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px; font-weight:bold;">หัวข้อ:</label>
                <input type="text" name="title" value="{{ old('title', $post->title) }}" required
                       style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
            </div>

            {{-- เนื้อหา --}}
            <div style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px; font-weight:bold;">เนื้อหา:</label>
                <textarea name="content" rows="6" required
                          style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; resize: vertical;">{{ old('content', $post->content) }}</textarea>
            </div>

            {{-- รูปภาพเดิม --}}
            @if($post->image)
                <div style="margin-bottom: 15px;">
                    <label style="display:block; margin-bottom:5px; font-weight:bold;">รูปภาพปัจจุบัน:</label>
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image"
                         style="width: 100%; max-height: 300px; object-fit: cover; border-radius: 8px; margin-bottom: 10px;">
                </div>
            @endif

            {{-- อัปโหลดรูปใหม่ --}}
            <div style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px; font-weight:bold;">เปลี่ยนรูปภาพ (ถ้าต้องการ):</label>
                <input type="file" name="image"
                       style="width: 100%; padding: 5px; border-radius: 5px; border: 1px solid #ccc;">
            </div>

            {{-- ปุ่มบันทึก --}}
            <button type="submit"
                    style="background: #FFA500; color: white; border: none; padding: 12px 20px; border-radius: 5px; cursor: pointer; font-size: 16px;">
                💾 บันทึกการแก้ไข
            </button>

            {{-- ปุ่มยกเลิก --}}
            <a href="{{ route('posts.index') }}"
               style="margin-left: 10px; background: #6c757d; color: white; padding: 12px 20px; border-radius: 5px; text-decoration: none;">
                ยกเลิก
            </a>
        </form>
    @endguest
</div>

@if(session('success'))
    <script>
        alert("{{ session('success') }}");
        window.location.href = "{{ route('posts.index') }}";
    </script>
@endif
@endsection
