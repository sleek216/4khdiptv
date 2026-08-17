<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Order;
use App\Models\User;
use App\Support\AdminSidebarCounts;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LiveHeartbeatController extends Controller
{
    /**
     * Return real-time live counts and latest event snapshots for the Admin Desk.
     */
    public function heartbeat(Request $request): JsonResponse
    {
        $counts = AdminSidebarCounts::get();

        $latestOrder = Order::with('package')->latest('id')->first();
        $latestUser = User::where('is_admin', false)->latest('id')->first();
        $latestContact = Contact::latest('id')->first();

        return response()->json([
            'status' => 'success',
            'timestamp' => now()->timestamp,
            'counts' => [
                'orders' => (int) ($counts['orders'] ?? 0),
                'users' => (int) ($counts['users'] ?? 0),
                'contacts' => (int) ($counts['contacts'] ?? 0),
                'affiliates' => (int) ($counts['affiliate_total'] ?? 0),
                'total' => (int) (($counts['orders'] ?? 0) + ($counts['contacts'] ?? 0) + ($counts['affiliate_total'] ?? 0)),
            ],
            'snapshots' => [
                'last_order_id' => $latestOrder ? $latestOrder->id : null,
                'last_order_info' => $latestOrder ? [
                    'id' => $latestOrder->id,
                    'order_number' => $latestOrder->order_number,
                    'customer_name' => $latestOrder->customer_name,
                    'package_name' => $latestOrder->package->name ?? 'IPTV Plan',
                    'amount' => '$' . number_format((float) $latestOrder->amount, 2),
                    'payment_status' => strtoupper($latestOrder->payment_status),
                    'created_at_human' => $latestOrder->created_at ? $latestOrder->created_at->diffForHumans() : '',
                    'is_read' => (bool) $latestOrder->is_read,
                ] : null,
                'last_user_id' => $latestUser ? $latestUser->id : null,
                'last_user_info' => $latestUser ? [
                    'id' => $latestUser->id,
                    'name' => $latestUser->name,
                    'email' => $latestUser->email,
                    'created_at_human' => $latestUser->created_at ? $latestUser->created_at->diffForHumans() : '',
                ] : null,
                'last_contact_id' => $latestContact ? $latestContact->id : null,
                'last_contact_info' => $latestContact ? [
                    'id' => $latestContact->id,
                    'name' => $latestContact->name,
                    'subject' => $latestContact->subject ?? 'General Inquiry',
                    'created_at_human' => $latestContact->created_at ? $latestContact->created_at->diffForHumans() : '',
                ] : null,
            ],
        ]);
    }
}
