<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\{Permission, Role};
use App\User;
use Illuminate\Support\Facades\Schema;
use Areaseb\Estate\Models\{Calendar, Category, Client, Contact, Company, Expense, Product, NewsletterList, Template};

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
         $default_password = 'pwdtochange';


         $super = Role::create(['name' => 'super']);
         $fatt = Role::create(['name' => 'fatturazione']);
         $camp = Role::create(['name' => 'campagne']);
         $anag = Role::create(['name' => 'anagrafiche']);

         $actions = ['*','read','write','delete'];
         $models = ['companies', 'contacts', 'invoices', 'costs', 'products', 'expenses', 'stats', 'lists', 'templates', 'newsletters', 'users', 'roles'];

         foreach($models as $model)
         {
             foreach($actions as $action)
             {
                 Permission::create(['name' => $model.'.'.$action]);
             }
         }

         Client::create(['nome' => 'Prospect', 'contact' => 1, 'company' => 1, 'point' => 2]);
         Client::create(['nome' => 'Lead', 'contact' => 1, 'company' => 1, 'point' => 1]);
         Client::create(['nome' => 'Client', 'contact' => 1, 'company' => 1, 'point' => 3]);
         Client::create(['nome' => 'Referente', 'contact' => 0, 'company' => 1, 'point' => 4]);


         $client = Client::Client()->id;

         $user = User::create([
             'email' => $default_email,
             'password' => bcrypt($default_password)
         ]);

         $user->roles()->attach($super);

         $company = Company::create([
             'rag_soc' => 'AZIENDA BASE',
             'indirizzo' => 'INDIRIZZO BASE',
             'cap' => '10000',
             'citta' => 'Bassano del Grappa',
             'provincia' => 'Vicenza',
             'piva' => '01234567891',
             'partner' => 1,
             'telefono' => '+390424500994',
             'email' => $default_email,
         ]);

         $company->clients()->attach($client);

         $contact = Contact::create([
             'nome' => 'Mario',
             'cognome' => 'Rossi',
             'cellulare' => '+393421967852',
             'email' => $default_email,
             'indirizzo' => 'INDIRIZZO BASE',
             'cap' => '10000',
             'citta' => 'Bassano del Grappa',
             'provincia' => 'Vicenza',
             'user_id' => $user->id,
             'company_id' => $company->id,
             'city_id' => 2858
         ]);

         $contact->clients()->attach($client);

         Calendar::create(['user_id' => $user->id]);

         $default = Category::create(['nome' => 'Da Categorizzare']);
         $expense = Expense::create(['nome' => 'Da Categorizzare']);
         $expense->categories()->save($default);
         $product = Product::create(['nome' => 'Da Categorizzare', 'codice' => 'VUOTO']);
         $product->categories()->save($default);

         Template::create(['nome' => 'Default', 'owner_id' => 1]);

         NewsletterList::create(['nome' => 'Tutti']);

     }
}
