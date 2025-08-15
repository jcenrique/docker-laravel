<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\ProductResource\Pages;
use App\Filament\App\Resources\ProductResource\RelationManagers;

use App\Models\Product;
use App\Tables\Columns\MarKetColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?int $navigationSort = 3;

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
        return __('common.product_resource_label');
    }
    public static function getPluralModelLabel(): string
    {
        return __('common.product_resource_plural_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('common.name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('active')
                    ->label(__('common.active'))
                    ->default(true)
                    ->inline(false)
                    ->required(),

                Forms\Components\Textarea::make('description')
                    ->label(__('common.description'))
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('price')
                    ->label(__('common.price'))
                    ->default(0)
                    ->required()
                    ->numeric()
                    ->prefix('€'),
                Forms\Components\TextInput::make('brand')
                    ->label(__('common.brand'))
                    ->maxLength(255),
                Forms\Components\Select::make('category_id')
                    ->label(__('common.category'))
                    ->relationship(
                        name: 'category',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn(Builder $query) => $query->active()->orderBy('name'),
                    )
                    ->searchable()
                    ->required()
                    ->preload(),
                Forms\Components\Select::make('market_id')
                    ->label(__('common.market'))
                    ->relationship(
                        name: 'market',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn(Builder $query) => $query->active()->orderBy('name'),
                    )
                    ->searchable()
                    ->required()
                    ->preload(),
                Forms\Components\FileUpload::make('image')
                    ->label(__('common.image'))
                    ->directory('images/products')
                    ->imageEditor()
                    ->image()
                    ->columnSpanFull(),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->striped()
             ->defaultPaginationPageOption(25)
             ->extremePaginationLinks()
            ->defaultGroup('category.name')
            ->defaultSort('name', 'asc')
            ->groups([
                Group::make('category.name')
                    ->titlePrefixedWithLabel(false)
                    ->getDescriptionFromRecordUsing(fn(Product $record): string => $record->category->description)
                    ->label(__('common.category'))
                    ->collapsible(),
                Group::make('market.name')
                    ->titlePrefixedWithLabel(false)
                    ->label(__('common.market'))
                    ->collapsible(),


            ])
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('common.name'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('price')
                    ->label(__('common.price'))
                    ->money('EUR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->hidden(function (Table $table) {
                        if ($table->getGrouping() && $table->getGrouping()->getId() === 'category.name') {
                            return true;
                        }
                    })
                    ->label(__('common.category'))

                    ->sortable(),
               MarKetColumn::make('market.name')
                    ->label(__('common.market')),
                    // ->hidden(function (Table $table) {
                    //     if ($table->getGrouping() &&  $table->getGrouping()->getId() === 'market.name') {
                    //         return true;
                    //     }
                    // }),



                // Tables\Columns\TextColumn::make('market.name')
                //     ->label(__('common.market'))
                //     ->hidden(function (Table $table) {
                //         if ($table->getGrouping() &&  $table->getGrouping()->getId() === 'market.name') {
                //             return true;
                //         }
                //     })

                //     ->sortable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label(__('common.image'))
                    ->circular()

                    ->size(50),

                Tables\Columns\ToggleColumn::make('active')
                    ->label(__('common.active')),
                Tables\Columns\TextColumn::make('brand')
                    ->label(__('common.brand'))
                    ->sortable()
                    ->searchable(),

            ])
            ->filters([
                Tables\Filters\Filter::make('active')
                    ->label(__('common.active'))
                    ->query(fn(Builder $query, array $data): Builder => $query->active()),

                Tables\Filters\SelectFilter::make('category_id')
                    ->label(__('common.category'))
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('market_id')
                    ->label(__('common.market'))
                    ->relationship('market', 'name')
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('brand')
                    ->label(__('common.brand'))
                    ->options(Product::query()->where('brand', '!=', '')->pluck('brand', 'brand')->unique())
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->tooltip(__('Edit'))
                    ->hiddenLabel(true),
                Tables\Actions\DeleteAction::make()
                    ->tooltip(__('Delete'))
                    ->hiddenLabel(true),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            // 'create' => Pages\CreateProduct::route('/create'),
            // 'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
