<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'wallex@example.com'],
            [
                'name' => 'Wallex André',
                'password' => Hash::make('12345678'),
            ]
        );

        $user->profile()->updateOrCreate(
            [],
            [
                'phone' => '(11) 99999-9999',
                'bio' => 'Estudante de Desenvolvimento de Sistemas.',
            ]
        );

        $post1 = $user->posts()->firstOrCreate(
            ['title' => 'Introdução ao Laravel'],
            [
                'content' => 'Post sobre migrations e relacionamentos.',
                'published_at' => now(),
            ]
        );

        $post2 = $user->posts()->firstOrCreate(
            ['title' => 'Relacionamentos Eloquent'],
            [
                'content' => 'Exemplo de relacionamento entre Models.',
                'published_at' => now(),
            ]
        );

        $laravel = Tag::firstOrCreate(['name' => 'Laravel']);
        $php = Tag::firstOrCreate(['name' => 'PHP']);

        $post1->tags()->sync([$laravel->id, $php->id]);
        $post2->tags()->sync([$laravel->id]);
    }
}