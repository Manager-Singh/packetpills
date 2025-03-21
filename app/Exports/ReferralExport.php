<?php

namespace App\Exports;

use App\Models\UserReferal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReferralExport implements FromCollection, WithHeadings
{
    protected $type;

    public function __construct($type = 'new')
    {
        $this->type = $type;
    }

    public function collection()
    {
        $query = UserReferal::query();

        // Fetch only 'new' referrals if not exporting all
        if ($this->type !== 'all') {
            $query->where('status', 'new');
        }

        return $query->with(['user', 'referrer']) // Load user and referrer details
            ->get()
            ->map(function ($referral) {
                return [
                    'ID' => $referral->id,
                    'User ID' => $referral->user_id,
                    'User Name' => $referral->user->name ?? 'N/A',
                    'User Email' => $referral->user->email ?? 'N/A',
                    'Referrer ID' => $referral->refreal_user_id,
                    'Referrer Name' => $referral->referrer->name ?? 'N/A',
                    'Referrer Email' => $referral->referrer->email ?? 'N/A',
                    'From' => $referral->from_you_found,
                    'Referred By' => $referral->refred_by,
                    'Referral Name' => $referral->name,
                    'Referral Email' => $referral->email,
                    'Contact Number' => $referral->contact_number,
                    'Status' => $referral->status,
                    'Created At' => $referral->created_at,
                ];
            });
    }
    public function headings(): array
    {
        return ['ID', 'User ID', 'User Name', 'User Email', 'Referrer ID', 'Referrer Name', 'Referrer Email', 'From', 'Referred By', 'Referral Name', 'Referral Email', 'Contact Number', 'Status', 'Created At'];
    }
}