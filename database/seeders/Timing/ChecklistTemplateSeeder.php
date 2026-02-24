<?php

namespace Database\Seeders\Timing;

use App\Models\Timing\ChecklistTemplate;
use Illuminate\Database\Seeder;

class ChecklistTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            [
                'event_type' => 'Wedding',
                'checklist_items' => [
                    ['item' => 'Book venue', 'due_offset' => -180],
                    ['item' => 'Hire photographer', 'due_offset' => -150],
                    ['item' => 'Order invitations', 'due_offset' => -120],
                ],
            ],
            [
                'event_type' => 'Birthday',
                'checklist_items' => [
                    ['item' => 'Send invites', 'due_offset' => -30],
                    ['item' => 'Order cake', 'due_offset' => -14],
                ],
            ],
        ];
        foreach ($templates as $template) {
            ChecklistTemplate::firstOrCreate(
                ['event_type' => $template['event_type']],
                $template
            );
        }
    }
}