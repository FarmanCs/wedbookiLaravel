<?php

namespace App\Filament\Resources\Supports\Schemas;

use Filament\Actions\SelectAction;
use Filament\Infolists\Components\Grid;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid as ComponentsGrid;
use Filament\Schemas\Components\Section as ComponentsSection;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class SupportInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ComponentsSection::make('Contact Information')
                    ->icon(Heroicon::OutlinedUser)
                    ->columns(2)
                    ->schema([
                        TextEntry::make('full_name')
                            ->label('Name')
                            ->weight('bold'),

                        TextEntry::make('email')
                            ->label('Email')
                            ->copyable()
                            ->icon(Heroicon::OutlinedEnvelope),

                        TextEntry::make('phone_number')
                            ->label('Phone')
                            ->icon(Heroicon::OutlinedDevicePhoneMobile),

                        TextEntry::make('subject')
                            ->label('Subject')
                            ->columnSpanFull()
                            ->weight('medium'),
                    ]),

                SelectAction::make('Query Details')
                    ->icon(Heroicon::OutlinedChatBubbleLeftEllipsis)
                    ->schema([
                        TextEntry::make('message')
                            ->label('Message')
                            ->markdown()
                            ->columnSpanFull(),

                        ComponentsGrid::make(2)
                            ->schema([
                                TextEntry::make('priority')
                                    ->label('Priority')
                                    ->badge()
                                    ->color(fn($state) => match ($state) {
                                        'low' => 'gray',
                                        'medium' => 'warning',
                                        'high', 'urgent' => 'danger',
                                        default => 'gray',
                                    })
                                    ->icon(fn($state) => match ($state) {
                                        'low' => Heroicon::OutlinedArrowDown,
                                        'medium' => Heroicon::OutlinedMinus,
                                        'high' => Heroicon::OutlinedArrowUp,
                                        'urgent' => Heroicon::OutlinedExclamationTriangle,
                                        default => null,
                                    }),

                                TextEntry::make('status')
                                    ->label('Status')
                                    ->badge()
                                    ->color(fn($state) => match ($state) {
                                        'pending' => 'warning',
                                        'in_progress' => 'info',
                                        'resolved' => 'success',
                                        'closed' => 'gray',
                                        default => 'gray',
                                    })
                                    ->icon(fn($state) => match ($state) {
                                        'pending' => Heroicon::OutlinedClock,
                                        'in_progress' => Heroicon::OutlinedCog,
                                        'resolved' => Heroicon::OutlinedCheckCircle,
                                        'closed' => Heroicon::OutlinedXCircle,
                                        default => null,
                                    }),

                                TextEntry::make('created_at')
                                    ->label('Submitted')
                                    ->dateTime('d M Y H:i')
                                    ->icon(Heroicon::OutlinedCalendar),

                                TextEntry::make('updated_at')
                                    ->label('Last Updated')
                                    ->dateTime('d M Y H:i')
                                    ->icon(Heroicon::OutlinedPencil),
                            ]),
                    ]),

                SelectAction::make('Attachments')
                    ->icon(Heroicon::OutlinedPaperClip)
                    ->visible(fn($record) => !empty($record->attachments))
                    ->schema([
                        RepeatableEntry::make('attachments')
                            ->schema([
                                TextEntry::make('file')
                                    ->label('')
                                    ->formatStateUsing(fn($state, $record) => basename($record))
                                    ->url(fn($state, $record) => asset('storage/' . $record), true)
                                    ->icon(Heroicon::OutlinedDocument),
                            ])
                            ->columns(1)
                            ->contained(false),
                    ]),
            ]);
    }
}