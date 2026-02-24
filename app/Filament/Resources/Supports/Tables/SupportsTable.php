<?php

namespace App\Filament\Resources\Supports\Tables;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;

class SupportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')
                    ->label('Name')
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->icon(Heroicon::OutlinedUser),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->icon(Heroicon::OutlinedEnvelope)
                    ->copyable()
                    ->copyMessage('Email copied'),

                TextColumn::make('subject')
                    ->label('Subject')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(fn($record) => $record->subject),

                BadgeColumn::make('priority')
                    ->label('Priority')
                    ->colors([
                        'low' => 'gray',
                        'medium' => 'warning',
                        'high' => 'danger',
                        'urgent' => 'danger',
                    ])
                    ->icons([
                        'low' => Heroicon::OutlinedArrowDown,
                        'medium' => Heroicon::OutlinedMinus,
                        'high' => Heroicon::OutlinedArrowUp,
                        'urgent' => Heroicon::OutlinedExclamationTriangle,
                    ])
                    ->sortable(),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'pending' => 'warning',
                        'in_progress' => 'info',
                        'resolved' => 'success',
                        'closed' => 'gray',
                    ])
                    ->icons([
                        'pending' => Heroicon::OutlinedClock,
                        'in_progress' => Heroicon::OutlinedCog,
                        'resolved' => Heroicon::OutlinedCheckCircle,
                        'closed' => Heroicon::OutlinedXCircle,
                    ])
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->icon(Heroicon::OutlinedCalendar),

                IconColumn::make('attachments')
                    ->label('Files')
                    ->boolean()
                    ->trueIcon(Heroicon::OutlinedPaperClip)
                    ->falseIcon('')
                    ->trueColor('primary')
                    ->tooltip(fn($record) => $record->attachments ? count($record->attachments) . ' file(s)' : 'No attachments'),
            ])
            ->filters([
                SelectFilter::make('priority')
                    ->options([
                        'low' => 'Low',
                        'medium' => 'Medium',
                        'high' => 'High',
                        'urgent' => 'Urgent',
                    ]),

                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'in_progress' => 'In Progress',
                        'resolved' => 'Resolved',
                        'closed' => 'Closed',
                    ]),

                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            // ->recordAction([
            //     BulkActionGroup::make([
            //         DeleteBulkAction::make(),
            //         ForceDeleteBulkAction::make(),
            //         RestoreBulkAction::make(),
            //     ]),
            // ])
            ->defaultSort('created_at', 'desc');
    }
}