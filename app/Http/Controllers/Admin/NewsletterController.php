<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BroadcastNewsletter;
use Illuminate\Support\Facades\Log;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the newsletter subscribers.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = NewsletterSubscriber::query();

        if ($request->has('trashed')) {
            $query->onlyTrashed();
        }

        $subscribers = $query->latest()->paginate(20);

        return view('admin.newsletter.index', compact('subscribers'));
    }

    /**
     * Remove the specified subscriber (Soft Delete).
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $subscriber = NewsletterSubscriber::findOrFail($id);
        $subscriber->delete();

        return redirect()->route('admin.newsletter.index')
            ->with('success', __('admin.newsletter.messages.removed'));
    }

    /**
     * Restore the specified soft-deleted subscriber.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $subscriber = NewsletterSubscriber::onlyTrashed()->findOrFail($id);
        $subscriber->restore();

        return redirect()->route('admin.newsletter.index')
            ->with('success', __('admin.newsletter.messages.restored'));
    }

    /**
     * Show the broadcast form.
     *
     * @return \Illuminate\View\View
     */
    public function broadcast()
    {
        return view('admin.newsletter.broadcast');
    }

    /**
     * Send the newsletter broadcast to all active subscribers.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendBroadcast(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $subscribers = NewsletterSubscriber::where('is_active', true)->get();

        if ($subscribers->isEmpty()) {
            return redirect()->back()->withErrors(['message' => __('admin.newsletter.messages.no_active')]);
        }

        $sentCount = 0;
        $failCount = 0;

        foreach ($subscribers as $subscriber) {
            try {
                Mail::to($subscriber->email)->send(new BroadcastNewsletter(
                    $request->subject,
                    $request->content,
                    $subscriber
                ));
                $sentCount++;
            } catch (\Exception $e) {
                Log::error("Broadcast failed for {$subscriber->email}: " . $e->getMessage());
                $failCount++;
            }
        }

        $message = __('admin.newsletter.messages.broadcast_success', ['count' => $sentCount]);
        if ($failCount > 0) {
            $message .= ' ' . __('admin.newsletter.messages.broadcast_failed', ['count' => $failCount]);
        }

        return redirect()->route('admin.newsletter.index')
            ->with('success', $message);
    }
}
