<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Item Product';
    protected static ?string $modelLabel = 'Item Product';
    protected static ?string $navigationGroup = 'Item Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nama')->required(),
                        Select::make('category_id')
                            ->label('Kategori Produk')
                            ->options(Category::all()->pluck('nama', 'id'))
                            ->searchable(),
                        RichEditor::make('deskripsi')
                            ->required()
                            ->disableToolbarButtons([
                                'attachFiles',
                                'blockquote',
                                // 'bold',
                                // 'bulletList',
                                'codeBlock',
                                'h2',
                                'h3',
                                // 'italic',
                                // 'link',
                                // 'orderedList',
                                // 'redo',
                                'strike',
                                // 'underline',
                                // 'undo',
                            ]),

                        RichEditor::make('spesifikasi')
                            ->required()
                            ->disableToolbarButtons([
                                'attachFiles',
                                'blockquote',
                                // 'bold',
                                // 'bulletList',
                                'codeBlock',
                                'h2',
                                'h3',
                                // 'italic',
                                // 'link',
                                // 'orderedList',
                                // 'redo',
                                'strike',
                                // 'underline',
                                // 'undo',
                            ]),
                        FileUpload::make('image')->multiple()
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->sortable()->searchable(),
                TextColumn::make('category.nama')->label('Kategori'),
                TextColumn::make('deskripsi'),
                // TextColumn::make('spesifikasi'),
                ImageColumn::make('image')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
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
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
