
<?php

class UserTableSeeder extends Seeder
{

	public function run()
	{
	    DB::table('users')->delete();
	    User::create(array(
	        'nome'     => 'admin',
	        'permissao'     => 'admin',
	        'email'    => 'admin@financeiro.com.br',
	        'password' => Hash::make('123'),
	    ));
	}

}