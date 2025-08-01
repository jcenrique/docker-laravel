<?php

namespace App\Filament\App\Resources;

use App\Enum\OrderStatus;
use App\Filament\App\Resources\OrderResource\Pages;
use App\Filament\App\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static bool $canCreateAnother = false;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?int $navigationSort = 4;

    public static function getNavigationGroup(): ?string
    {
        return __('common.market_management_nav_group');
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return  'success';
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getModelLabel(): string
    {
        return __('common.order_resource_label');
    }
    public static function getPluralModelLabel(): string
    {
        return __('common.order_resource_plural_label');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('market_id')
                    ->label(__('common.market'))
                    ->relationship('market', 'name')
                    ->required(),
                Forms\Components\DatePicker::make('order_date')
                    ->label(__('common.order_date'))

                    ->displayFormat('d/m/Y')
                    ->required(),
                Forms\Components\ToggleButtons::make('status')
                    ->label(__('common.order_status'))
                    ->options(OrderStatus::class)
                    ->default(OrderStatus::PENDING)
                    ->inline()
                    ->grouped()
                    ->required(),

                Forms\Components\TextInput::make('total_price')
                    ->label(__('common.total_price'))
                    ->hiddenOn('create')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->prefix('€')
                    ->readOnly()
                    ->numeric(),
                Forms\Components\Textarea::make('notes')
                    ->label(__('common.notes'))
                    ->maxLength(500)
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('market.name')
                    ->label(__('common.name'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_date')
                    ->label(__('common.order_date'))
                    ->dateTime('d F y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->sortable()
                    ->label(__('common.order_status'))
                    ->badge(),

                Tables\Columns\TextColumn::make('items_count')
                    ->label(__('common.items_count'))
                    ->counts('items')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('total_price')
                    ->label(__('common.total_price'))

                    ->money('EUR')
                    ->getStateUsing(
                        function ($record): string {
                            if ($record->total_price === null) {
                                return '0.00';
                            }
                            if ($record->total_price === 0) {
                                return '0.00';
                            }
                            $total = 0;
                            foreach ($record->items as $item) {
                                if ($item->price != null && $item->quantity != null) {
                                    $total += $item->price * $item->quantity;
                                }
                            }
                            // return number_format($record->price * $record->quantity, 2);
                            return $total;
                            // return number_format($record->price * $record->quantity, 2);
                        }
                    )
                    ->money('EUR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('notes')
                    ->label(__('common.notes'))
                    ->limit(50)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('common.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('common.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label(__('common.order_status'))
                    ->multiple()
                    ->options(OrderStatus::class),
            ])

            ->actions([

                Tables\Actions\EditAction::make()
                    ->hiddenLabel(true)
                    ->tooltip(__('Edit')),
                Tables\Actions\DeleteAction::make()
                    ->hiddenLabel(true)
                    ->tooltip(__('Delete')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [


            RelationManagers\OrderItemsRelationManager::class,

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            // 'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
