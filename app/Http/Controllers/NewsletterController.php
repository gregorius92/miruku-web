<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeNewsletter;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    /**
     * Handle the newsletter subscription.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'g-recaptcha-response' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Please provide a valid email and complete the reCAPTCHA.',
            ], 422);
        }

        // Verify reCAPTCHA
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => config('services.recaptcha.secret'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        if (!$response->successful() || !$response->json('success')) {
            return response()->json([
                'status'  => 'error',
                'message' => 'reCAPTCHA verification failed. Please try again.',
            ], 422);
        }

        $email = $request->email;

        // Check if subscriber exists (including trashed)
        $subscriber = NewsletterSubscriber::withTrashed()->where('email', $email)->first();

        if ($subscriber) {
            if ($subscriber->trashed()) {
                $subscriber->restore();
                $subscriber->update(['is_active' => true]);
            } else {
                return response()->json([
                    'status'  => 'success', // Silently succeed if already subscribed
                    'message' => __('footer.already_subscribed' ?? 'You are already subscribed to our newsletter!'),
                ]);
            }
        } else {
            $subscriber = NewsletterSubscriber::create([
                'email' => $email,
            ]);
        }

        // Send Welcome Email
        try {
            Mail::to($email)->send(new WelcomeNewsletter($subscriber));
        } catch (\Exception $e) {
            // Log error but don't fail the user request
            Log::error('Newsletter Email Error: ' . $e->getMessage());
        }

        return response()->json([
            'status'  => 'success',
            'message' => __('footer.subscription_success' ?? 'Thank you for subscribing to our newsletter!'),
        ]);
    }

    /**
     * Unsubscribe the user from the newsletter.
     *
     * @param  string  $email
     * @param  string  $token
     * @return \Illuminate\View\View
     */
    public function unsubscribe($email, $token = null)
    {
        if (!$token) {
            return view('newsletter.unsubscribed', [
                'message' => 'Tautan tidak valid atau token tidak ditemukan.',
                'status'  => 'error'
            ]);
        }

        $subscriber = NewsletterSubscriber::where('email', $email)
            ->where('token', $token)
            ->first();

        if ($subscriber) {
            $subscriber->delete(); // Soft delete as requested

            return view('newsletter.unsubscribed', [
                'message' => 'Anda telah berhasil berhenti berlangganan dari newsletter kami.',
                'status'  => 'success'
            ]);
        }

        return view('newsletter.unsubscribed', [
            'message' => 'Tautan tidak valid atau Anda sudah berhenti berlangganan.',
            'status'  => 'error'
        ]);
    }
}
