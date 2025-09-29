<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * เก็บความคิดเห็นใหม่ลงใน DB
     */
    public function store(Request $request, Post $post)
    {
        // ตรวจสอบข้อมูลที่ส่งมา
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // สร้าง comment ใหม่
        Comment::create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return back()->with('success', 'แสดงความคิดเห็นเรียบร้อยแล้ว ✅');
    }

    /**
     * ลบความคิดเห็น
     */
    public function destroy(Comment $comment)
    {
        // ตรวจสอบว่าเป็นเจ้าของคอมเมนต์หรือไม่
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'คุณไม่มีสิทธิ์ลบความคิดเห็นนี้');
        }

        $comment->delete();

        return back()->with('success', 'ลบความคิดเห็นเรียบร้อยแล้ว 🗑️');
    }
}
