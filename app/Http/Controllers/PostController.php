<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * แสดงกระทู้ทั้งหมด
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * แสดงฟอร์มสร้างกระทู้ใหม่
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * บันทึกกระทู้ใหม่ลง DB
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        Post::create([
            'user_id' => auth()->id(),
            'title'   => $request->title,
            'content' => $request->content,
            'image'   => $imagePath,
        ]);

        return redirect()->route('home')->with('success', 'สร้างกระทู้ใหม่เรียบร้อย ✅');
    }

    /**
     * แสดงรายละเอียดกระทู้
     */
    public function show(Post $post)
    {
        $post->load(['user', 'comments.user']); // โหลดความสัมพันธ์
        return view('posts.show', compact('post'));
    }

    /**
     * แสดงฟอร์มแก้ไขกระทู้
     */
    public function edit(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403, 'คุณไม่มีสิทธิ์แก้ไขกระทู้นี้');
        }

        return view('posts.edit', compact('post'));
    }

    /**
     * อัปเดตข้อมูลกระทู้
     */
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403, 'คุณไม่มีสิทธิ์แก้ไขกระทู้นี้');
        }

        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('posts', 'public');
        }

        $post->update([
            'title'   => $request->title,
            'content' => $request->content,
            'image'   => $post->image,
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'อัปเดตกระทู้เรียบร้อย ✨');
    }

    /**
     * ลบกระทู้
     */
    public function destroy(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403, 'คุณไม่มีสิทธิ์ลบกระทู้นี้');
        }

        $post->delete();

        return redirect()->route('home')->with('success', 'ลบกระทู้เรียบร้อย 🗑️');
    }
}
