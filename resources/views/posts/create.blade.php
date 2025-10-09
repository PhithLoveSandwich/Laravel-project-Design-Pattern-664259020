@extends('layouts.app')

@section('content')
<div style="max-width: 700px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif;">

    @guest
        {{-- แจ้งเตือนให้เข้าสู่ระบบ --}}
        <div style="background: #ffcccc; color: #900; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-weight: bold; text-align: center;">
            ⚠️ กรุณาเข้าสู่ระบบก่อนที่จะสร้างกระทู้
        </div>
        <div style="text-align: center;">
            <a href="{{ route('login') }}"
               style="background: #007BFF; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                เข้าสู่ระบบ
            </a>
        </div>
    @else
        {{-- ฟอร์มสร้างกระทู้ --}}
        <h1 style="margin-bottom: 20px; font-size: 28px; font-weight: bold; color: #333;">✍️ เขียนกระทู้ใหม่</h1>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data"
              style="border: 1px solid #ddd; padding: 25px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); background: #fff;">
            @csrf

            {{-- หัวข้อ --}}
            <div style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px; font-weight:bold;">หัวข้อ:</label>
                <input type="text" name="title" required
                       style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
            </div>

            {{-- เนื้อหา --}}
            <div style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px; font-weight:bold;">เนื้อหา:</label>
                <textarea name="content" rows="6" required
                          style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; resize: vertical;"></textarea>
            </div>

            {{-- รูปภาพ --}}
            <div style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px; font-weight:bold;">รูปภาพ (ไม่บังคับ):</label>
                <input type="file" name="image"
                       style="width: 100%; padding: 5px; border-radius: 5px; border: 1px solid #ccc;">
            </div>

            {{-- ปุ่มส่ง --}}
            <button type="submit"
                    style="background: #4CAF50; color: white; border: none; padding: 12px 20px; border-radius: 5px; cursor: pointer; font-size: 16px;">
                โพสต์
            </button>
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
