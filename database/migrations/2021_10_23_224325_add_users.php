<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use App\User;

class AddUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user1 = User::create([
                    'name' => 'Locale',
                    'email' => 'locale@locale.com',
                    'phone' => '0166666666',
                    'password' => Hash::make('Choicefood2021')
                ]);
        $user1->createToken('PassportToken@App.com');
        $user2 = User::create([
            'name' => 'Locale',
            'email' => 'locale2@locale.com',
            'phone' => '0266666666',
            'password' => Hash::make('Choicefood2021')
        ]);
        $user2->createToken('PassportToken@App.com');
        $user3 = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'phone' => '0366666666',
            'password' => Hash::make('Choicefood2021')
        ]);
        $user3->createToken('PassportToken@App.com');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
