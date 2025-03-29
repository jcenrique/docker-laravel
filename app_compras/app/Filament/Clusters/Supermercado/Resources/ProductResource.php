<?php

namespace App\Filament\Clusters\Supermercado\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use App\Models\Section;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Actions\Action;

use Filament\Resources\Resource;
use Filament\Tables\Grouping\Group;
use App\Filament\Clusters\Supermercado;
use Filament\Forms\Components\Checkbox;
use Livewire\Component as Livewire;

use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\Supermercado\Resources\ProductResource\Pages;
use App\Filament\Clusters\Supermercado\Resources\SectionResource\RelationManagers\CategoryRelationManager;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Supermercado::class;

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        // dd($form->model);
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),


                Forms\Components\Select::make('supermarket_id')
                    ->relationship('supermarket', 'name')
                    ->live()
                    ->preload()
                    ->required()
                    ->searchable(),


                Forms\Components\Select::make('section_id')
                    ->relationship('category.section', 'name')
                    ->label(__('Section'))
                    ->dehydrated(false)
                    ->live()
                    ->options(
                        Section::orderBy('name')->pluck('name', 'id')
                    )

                    ->afterStateUpdated(fn(Set $set) => $set('category_id', null))

                    ->searchable()
                    ->required(),


                Forms\Components\Select::make('category_id')
                    ->label(__('Category'))
                    ->live()


                    ->placeholder(fn(Forms\Get $get): string => empty($get('country_id')) ? 'First select country' : 'Select an option')

                    ->options(function (?Product $record, Forms\Get $get, Forms\Set $set) {
                        if (! empty($record) && empty($get('section_id'))) {
                            $set('section_id', $record->category->section_id);
                            $set('category_id', $record->category_id);
                        }

                        return Category::where('section_id', $get('section_id'))->pluck('name', 'id');
                    })

                    ->required()
                    ->searchable()
                    ->preload(),






                Forms\Components\Select::make('unit_id')
                    ->relationship('unit', 'name')
                    ->live()
                    ->preload()
                    ->required()
                    ->searchable(),


                Forms\Components\TextInput::make('units_quantity')
                    ->required()
                    ->numeric()
                    ->default(1),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('€'),
                Forms\Components\FileUpload::make('image')
                    ->directory('product-images')
                    ->imageEditor()
                    ->image(),

                Checkbox::make('all')
                    ->label( __('Crear el mismo producto en todos los supermercados') )

                    // ->afterStateUpdated(function (Checkbox $component, $state) {

                    //     if($state){
                    //         $component->label( __('Crear el mismo producto en todos los supermercados') );
                    //     }else{
                    //         $component->label( __('Solo crear para el supermeracado elegido') );
                    //     }
                    // })
                    ->live()
                    ->default(true)
                    ->hiddenOn('edit'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('category.section.name')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('units_quantity')
                    ->label(__('Units'))
                    ->numeric()
                    ->description(fn(Product $record): string => $record->unit->name)
                    ->sortable(),


                Tables\Columns\TextColumn::make('price')
                    ->money('EUR')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->groups([
                Group::make('supermarket.name')
                    ->label(__('Supermarket'))

                    ->titlePrefixedWithLabel(false)
                    ->collapsible(),

                Group::make('category.name')
                    ->label(__('Categories'))
                    ->titlePrefixedWithLabel(false)
                    ->collapsible(),
            ])

            ->defaultGroup('supermarket.name')
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            //  'create' => Pages\CreateProduct::route('/create'),
            // 'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('generate')
                ->label('Generate')
                ->url('some url'),
        ];
    }
}
