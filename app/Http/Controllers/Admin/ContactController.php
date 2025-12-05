<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminReplyMail;

use App\Models\ContactSubmission; 

class ContactController extends Controller
{
    public function index(): View
    {
        
        $submissions = ContactSubmission::latest()->paginate(10);
        return view('admin.contacts.index', compact('submissions'));
    }

    // Xóa liên hệ (DESTROY)
    public function destroy($id): RedirectResponse
    {
       
        $submission = ContactSubmission::findOrFail($id);
        $submission->delete();

        return redirect()->route('admin.contacts.index')->with('success', 'Xóa yêu cầu liên hệ thành công!');
    }

    // Trả lời Email
    public function reply(Request $request, $id): RedirectResponse
    {
        $request->validate(['message' => 'required|string']);

        $submission = ContactSubmission::findOrFail($id);
        
        // Gửi email phản hồi
        $details = [
            'name' => $submission->name,
            'body' => $request->message
        ];
       Mail::to($submission->email)->send(new AdminReplyMail($details));
        return back()->with('success', 'Email phản hồi đã được gửi thành công!');
    }
}