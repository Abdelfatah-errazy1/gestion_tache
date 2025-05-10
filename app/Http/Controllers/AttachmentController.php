<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function store(Request $request, $tacheId)
    {
        $request->validate([
            'attachment' => 'required|file|max:10240', // max 10MB
        ]);

        $file = $request->file('attachment');
        $filename = $file->getClientOriginalName();
        $path = $file->store('attachments', 'public');

        Attachment::create([
            'tache_id' => $tacheId,
            'filename' => $filename,
            'filepath' => $path,
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'Attachment uploaded.');
    }

    public function download($id)
    {
        $attachment = Attachment::findOrFail($id);
        return Storage::disk('public')->download($attachment->filepath, $attachment->filename);
    }

    public function destroy($id)
    {
        $attachment = Attachment::findOrFail($id);
        Storage::disk('public')->delete($attachment->filepath);
        $attachment->delete();

        return back()->with('success', 'Attachment deleted.');
    }
}
