<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Luis Antonio Parrado',
            'email' => 'luisprmat@gmail.com',
            'password' => '$2y$10$/gp4VYV8dGrSXJLYo.3lkO4cpSv.MjR99xu90l27YJATWDHGW9gLu', //lpklprplus
        ]);
    }
}
