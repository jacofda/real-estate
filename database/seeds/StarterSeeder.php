<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\{Permission, Role};
use App\User;
use Illuminate\Support\Facades\Schema;
use Areaseb\Estate\Models\{Calendar, Category, Client, Contact, Expense, Product, NewsletterList, Template};

class StarterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {

         $default_email = 'giacomo.gasperini@gmail.com';
         $default_password = '83674trf%*9op[]';


         $super = Role::create(['name' => 'super']);

         $actions = ['*','read','write','delete'];
         $models = ['companies', 'contacts', 'invoices', 'costs', 'products', 'expenses', 'stats', 'lists', 'templates', 'newsletters', 'users', 'roles'];

         foreach($models as $model)
         {
             foreach($actions as $action)
             {
                 Permission::create(['name' => $model.'.'.$action]);
             }
         }

         \DB::table('client_types')->insert(['name' => 'Lead']);
         \DB::table('client_types')->insert(['name' => 'Prospect']);
         \DB::table('client_types')->insert(['name' => 'Client']);

         $user = User::create([
             'email' => $default_email,
             'password' => bcrypt($default_password)
         ]);

         $user->roles()->attach($super);

         $client = Client::create([
             'rag_soc' => 'AZIENDA BASE',
             'address' => 'INDIRIZZO BASE',
             'zip' => '10000',
             'city' => 'Bassano del Grappa',
             'province' => 'Vicenza',
             'piva' => '01234567891',
             'partner' => 1,
             'phone' => '+390424500994',
             'email' => $default_email,
             'type_id' => 3,
         ]);

         $contact = Contact::create([
             'nome' => 'Mario',
             'cognome' => 'Rossi',
             'cellulare' => '+393421967852',
             'email' => $default_email,
             'indirizzo' => 'INDIRIZZO BASE',
             'cap' => '10000',
             'citta' => 'Bassano del Grappa',
             'provincia' => 'Vicenza',
             'user_id' => 1,
             'city_id' => 2858,
             'client_id' => 1
         ]);

         Calendar::create(['user_id' => 1]);

         $default = Category::create(['nome' => 'Da Categorizzare']);
         $expense = Expense::create(['nome' => 'Da Categorizzare']);
         $expense->categories()->save($default);
         $product = Product::create(['nome' => 'Da Categorizzare', 'codice' => 'VUOTO']);
         $product->categories()->save($default);

         Template::create(['nome' => 'Default']);

         NewsletterList::create(['nome' => 'Tutti']);

     }
}
