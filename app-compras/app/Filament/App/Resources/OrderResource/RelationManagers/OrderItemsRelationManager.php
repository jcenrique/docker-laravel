<?php

namespace App\Filament\App\Resources\OrderResource\RelationManagers;

use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\Summarizers\Summarizer;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;
use Filament\Tables\Actions\Action ;

class OrderItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';



    public function form(Form $form): Form
    {
        return $form
            ->columns([
        'sm' => 1,
        'xl' => 2,
        '2xl' => 4,
    ])
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->columnSpan(2)

                    ->label(__('common.product'))
                    ->getSearchResultsUsing(fn (string $search): array => Product::where('name', 'like', "%{$search}%")->limit(50)->pluck('name', 'id')->toArray())
                    ->options(function () {
                        $options = [];
                        $market_id = $this->getOwnerRecord()->market_id;
                        $items = $this->getOwnerRecord()->items;
                        $product_ids = $items->pluck('product_id')->toArray();
                        $categories = Category::orderBy('name')->with(['products'])->get();
                        foreach ($categories as $category) {
                             if ($category->products->isEmpty()) {
                                    continue;
                                }
                            $options[$category->name] = collect(Product::where('category_id', $category->id)
                                ->where('market_id', $market_id)->active()->get())
                                ->whereNotIn('id', $product_ids)
                                ->mapWithKeys(function ($product) {
                                    return [$product->id => $product->name];
                                })->toArray();
                        }

                        return $options;
                    })
                    ->live()
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        $set('price', Product::find($get('product_id'))->price);
                    })
                    ->searchable()
                    ->required(),

                Forms\Components\TextInput::make('quantity')
                    ->label(__('common.quantity'))
                    ->default(1)
                    ->maxWidth(MaxWidth::Small)
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->label(__('common.price'))
                    ->readonly()
                    ->prefix('€')
                    ->maxWidth(MaxWidth::Small)
                    ->numeric()
                    ->required(),


            ]);
    }

    public function table(Table $table): Table
    {
        return $table

            ->striped()
            ->extremePaginationLinks()
            ->defaultPaginationPageOption('all')
            ->heading(__('common.order_items_plural_label'))
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->label(__('common.product')),
                Tables\Columns\ImageColumn::make('product.image')
                    ->label(__('common.image'))
                    ->circular()

                    ->size(50),
                   Tables\Columns\TextColumn::make('quantity')
                    ->label(__('common.quantity'))
                    ->tooltip(__('common.change_quantity_tooltip'))
                    ->action(
                        Action::make('change_quantity')

                            ->icon('heroicon-o-pencil')
                            ->label(__('common.change_quantity'))
                            ->form(fn($record) => [
                                Forms\Components\TextInput::make('quantity')
                                    ->label(__('common.quantity'))
                                    ->default($record->quantity)
                                    ->numeric()
                                    ->required(),

                            ])
                            ->modalWidth(MaxWidth::Medium)
                            ->action(fn($record, array $data) => $record->update(['quantity' => $data['quantity']]))
                        //->visible(fn() => auth()->user()->can('edit_name'))
                    )
                    ->badge(),

                Tables\Columns\TextColumn::make('price')
                    ->label(__('common.price'))
                    ->money('EUR'),

                Tables\Columns\TextColumn::make('total')

                    ->label(__('common.subtotal'))
                    ->state(function (OrderItem $record): float {
                        return $record->price * $record->quantity;
                    })
                    ->summarize(
                        Summarizer::make()
                            ->prefix(new HtmlString('<strong class="danger">' .  __('common.total') . ': </strong>'))

                            ->using(function ($query) {
                                $items = $query->get();
                                $total = 0;
                                foreach ($items as $item) {
                                    $total += $item->price * $item->quantity;
                                }
                                return $total;
                            })
                            ->money('EUR')
                    )
                    ->money('EUR'),

                Tables\Columns\IconColumn::make('is_basket')
                    ->boolean()
                    ->label(__('common.basket'))
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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



    public static function getModelLabel(): string
    {
        return __('common.order_items_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.order_items_label');
    }

}
