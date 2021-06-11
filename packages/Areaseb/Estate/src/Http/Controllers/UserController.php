<?php

namespace Areaseb\Estate\Http\Controllers;

use App\User;
use Areaseb\Estate\Models\{Calendar, City, Client, Company, Contact, Country, Setting};
use Areaseb\Estate\Mail\NewAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index()
    {
        if(request()->input())
        {
            $users = Role::find(request('role'))->users;
        }
        else
        {
            $users = User::all();
        }
        $roles = Role::all();
        return view('estate::core.users.index', compact('roles', 'users'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'id');
        $provinces = City::uniqueProvinces();
        $countries = Country::listCountries();
        $companies[''] = '';
        $companies += Client::pluck('rag_soc', 'id')->toArray();


        return view('estate::core.users.create', compact('roles', 'provinces', 'countries', 'companies'));
    }

    public function store()
    {
        $this->validate(request(),[
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'nome' => 'required',
            'cognome' => 'required',
            'role_id' => 'required'
        ]);

        $user = new User;
            $user->email = request('email');
            $user->password = bcrypt(request('password'));
        $user->save();


        $user->assignRole(Role::find(request('role_id')));

        $contact = Contact::createOrUpdate(new Contact, request()->input(), $user->id);

        Calendar::create(['user_id' => $user->id]);

        if(Schema::hasTable('testimonials'))
        {
            if(in_array(Role::where('name', 'testimonial')->first()->id, request('role_id')))
            {
                \Areaseb\Referrals\Models\Testimonial::create([
                    'user_id' => $user->id,
                    'contact_id' => $user->contact->id,
                    'company_id' => request('company_id')
                ]);
            }
        }

        if(Schema::hasTable('agents'))
        {
            if(in_array(Role::where('name', 'agent')->first()->id, request('agent_id')))
            {
                \Areaseb\Agents\Models\Agent::create([
                    'user_id' => $user->id,
                    'contact_id' => $user->contact->id,
                    'company_id' => request('company_id')
                ]);
            }
        }

        if(request('sendEmail'))
        {
            if(Setting::validSmtp(0))
            {
                return redirect(route('users.index'))->with('message', 'Utente Creato e ma non abbiamo spedito nessuna email perché non hai settato il server di posta');
            }
            else
            {
                $mailer = app()->makeWith('custom.mailer', Setting::smtp(0));
                $mailer->to($user->email)->send(new NewAccount($user, request('password')));
                return redirect(route('users.index'))->with('message', 'Utente Creato e Password inviata a '.$user->email);
            }
        }

        return redirect(route('users.index'))->with('message', 'Utente Creato');
    }

    public function edit($id)
    {
        $roles = Role::pluck('name', 'id');
        $provinces = City::uniqueProvinces();
        $countries = Country::listCountries();
        $companies[''] = '';
        $companies += Company::pluck('rag_soc', 'id')->toArray();
        $element = User::findOrFail($id);

        $clients = Client::contact()->pluck('nome', 'id')->toArray();
        $clientsSelected = [];
        if($element->contact()->exists())
        {
            $clientsSelected = $element->contact->clients()->pluck('id')->toArray();
        }

        return view('estate::core.users.edit', compact('roles', 'provinces', 'countries', 'companies', 'element', 'clients', 'clientsSelected'));
    }

    public function update($id)
    {
        $user = User::findOrFail($id);

        $this->validate(request(),[
            'email' => 'required|string|email|unique:users,email,'.$user->id.',id',
            'nome' => 'required',
            'cognome' => 'required',
            'role_id' => 'required'
        ]);

        if( request()->has('password') )
        {
            $user->password = bcrypt(request('password'));
        }

        $user->email = request('email');
        $user->save();

        $roles = Role::whereIn('id', request('role_id'))->pluck('name')->toArray();
        $user->syncRoles($roles);

        $contact = $user->contact;
        if(is_null($contact))
        {
            $contact = new Contact;
        }

        Contact::createOrUpdate($user->contact, request()->input(), $user->id);

        if(Schema::hasTable('testimonials'))
        {
            if(in_array(Role::where('name', 'testimonial')->first()->id, request('role_id')))
            {
                $testimonial = \Areaseb\Referrals\Models\Testimonial::where('user_id', $user->id)
                                ->where('contact_id', $user->contact->id)
                                ->where('company_id', request('company_id'))
                                ->first();

                if(is_null($testimonial))
                {
                    \Areaseb\Referrals\Models\Testimonial::create([
                        'user_id' => $user->id,
                        'contact_id' => $user->contact->id,
                        'company_id' => request('company_id')
                    ]);
                }
            }
        }
        if(Schema::hasTable('agents'))
        {
            if(in_array(Role::where('name', 'agent')->first()->id, request('role_id')))
            {
                $agent = \Areaseb\Agents\Models\Agent::where('user_id', $user->id)
                                ->where('contact_id', $user->contact->id)
                                ->where('company_id', request('company_id'))
                                ->first();

                if(is_null($agent))
                {
                    \Areaseb\Agents\Models\Agent::create([
                        'user_id' => $user->id,
                        'contact_id' => $user->contact->id,
                        'company_id' => request('company_id')
                    ]);
                }
            }
        }

        return redirect(route('users.index'))->with('message', 'Utente Modificato');
    }

    public function permissions($id)
    {
        $allPermissions = Permission::all();
        $permissions = [];
        foreach ($allPermissions as $permission)
        {
            $arr = explode('.',$permission->name);
            $permissions[$arr[0]][] = [
                'id' => $permission->id,
                'action' => $arr[1]
            ];
        }
        $utente = User::find($id);
        $role = $utente->roles()->first();


        return view('estate::core.users.permissions', compact('utente', 'role', 'permissions') );
    }

//api/direct-permissions/{user_id}
     public function permissionUpdate($id)
     {
         $user = User::find($id);
         $permission = Permission::find(request('id'));

         if(request('add') == 'true')
         {
             $user->givePermissionTo($permission->name);
             $azione = 'aggiunto';
         }
         else
         {
             $user->revokePermissionTo($permission->name);
             $azione = 'revocato';
         }

         $arr = explode('.',$permission->name);


         return 'Permesso '.trans('permissions.'.$arr[0]).' '.trans('permissions.'.$arr[1]).' '.$azione.' a '.$user->contact->fullname;
     }

     public function destroy($id)
     {
         $user = User::findOrFail($id);

         $contact = $user->contact;
         if($contact)
         {
             $contact->update(['user_id' => null]);
         }

         foreach($user->events as $event)
         {
             $event->delete();
         }

         foreach($user->calendars as $calendar)
         {
             $calendar->delete();
         }

         foreach($user->roles as $role)
         {

             if($role->name == 'testimonial')
             {
                 $testimonial = \Areaseb\Referrals\Models\Testimonial::where('user_id', $user->id)->first();
                 if($testimonial)
                 {
                     $testimonial->companies()->detach();
                     $testimonial->contacts()->detach();
                     $testimonial->delete();
                 }
             }

             if($role->name == 'agent')
             {
                 $agent = \Areaseb\Agents\Models\Agent::where('user_id', $user->id)->first();
                 if($agent)
                 {
                     $agent->companies()->detach();
                     $agent->contacts()->detach();
                     $agent->delete();
                 }
             }

             $user->removeRole($role->name);
         }

         foreach($user->permissions as $permission)
         {
             $user->revokePermissionTo($permission->name);
         }

         $user->delete();
         return 'done';
     }

     public function editPassword(User $user)
     {
         $userToC = $user;
         return view('estate::core.users.password', compact('userToC') );
     }

     public function updatePassword(Request $request, User $user)
     {
         $user->update(['password' => bcrypt($request->password)]);
         return redirect($request->origin)->with('message', 'Password Aggiornata');
     }




}
