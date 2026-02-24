<?php

namespace App\Filament\Resources\Supports\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class SupportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('full_name')
                    ->label('Full Name')
                    ->required()
                    ->maxLength(255)
                    ->icon(Heroicon::OutlinedUser),

                TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->icon(Heroicon::OutlinedEnvelope),

                TextInput::make('phone_number')
                    ->label('Phone Number')
                    ->tel()
                    ->maxLength(20)
                    ->icon(Heroicon::OutlinedDevicePhoneMobile),

                TextInput::make('subject')
                    ->label('Subject')
                    ->required()
                    ->maxLength(255)
                    ->icon(Heroicon::OutlinedChatBubbleLeftEllipsis),

                Select::make('priority')
                    ->label('Priority')
                    ->options([
                        'low' => 'Low',
                        'medium' => 'Medium',
                        'high' => 'High',
                        'urgent' => 'Urgent',
                    ])
                    ->required()
                    ->default('low')
                    ->icon(Heroicon::OutlinedFlag),

                Textarea::make('message')
                    ->label('Message')
                    ->required()
                    ->rows(5)
                    ->columnSpanFull(),

                FileUpload::make('attachments')
                    ->label('Attachments')
                    ->multiple()
                    ->directory('support-attachments')
                    ->maxSize(5120) // 5MB
                    ->acceptedFileTypes(['image/*', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                    ->columnSpanFull(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'in_progress' => 'In Progress',
                        'resolved' => 'Resolved',
                        'closed' => 'Closed',
                    ])
                    ->required()
                    ->default('pending')
                    ->icon(Heroicon::OutlinedCheckCircle),
            ]);
    }
}