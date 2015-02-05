<?php

class UserTableSeeder extends Seeder {
    public function run(){
        User::create(array(
            'username'  => 'leonel',
            'nombre'  => 'Leonel',
            'apellido'  => 'Madrid',
            'email'     => 'leonel.madrid@hotmail.com',
            'password' => Hash::make('12345') 
        ));
    }
}