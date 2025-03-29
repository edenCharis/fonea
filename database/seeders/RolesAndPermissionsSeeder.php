<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

  $permissions = [
            'create users', 'read users', 'update users', 'delete users',
            'create formation qualifiante', 'read formation qualifiante', 'update formation qualifiante', 'delete formation qualifiante',
            'create formation continue', 'read formation continue', 'update formation continue', 'delete formation continue',
            'create apprentissage', 'read apprentissage', 'update apprentissage', 'delete apprentissage',
            'create TechniqueDeveloppementEntrepreunariat', 'read TechniqueDeveloppementEntrepreunariat', 'update TechniqueDeveloppementEntrepreunariat', 'delete TechniqueDeveloppementEntrepreunariat',
            'create financement', 'read financement', 'update financement', 'delete financement',
            'create formation', 'read formation', 'update formation', 'delete formation',
            'read stat_formation_qual','read statApprentissage','read statFormContinue', 'read direction','CRUD direction'
           
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        $permissionsFormQual=[  'create formation qualifiante', 'read formation qualifiante', 'update formation qualifiante', 'delete formation qualifiante'];

    $permissionsFormContinue=[ 'create formation continue', 'read formation continue', 'update formation continue', 'delete formation continue'
];

$permissionsDSIP=[  'create formation qualifiante', 'read formation qualifiante', 'update formation qualifiante', 'delete formation qualifiante',
'create formation continue', 'read formation continue', 'update formation continue', 'delete formation continue',
'create apprentissage', 'read apprentissage', 'update apprentissage', 'delete apprentissage',
'create TechniqueDeveloppementEntrepreunariat', 'read TechniqueDeveloppementEntrepreunariat', 'update TechniqueDeveloppementEntrepreunariat', 'delete TechniqueDeveloppementEntrepreunariat',
'create financement', 'read financement', 'update financement', 'delete financement',
'create formation', 'read formation', 'update formation', 'delete formation'
];

$permissionsTDE=['create TechniqueDeveloppementEntrepreunariat', 'read TechniqueDeveloppementEntrepreunariat', 'update TechniqueDeveloppementEntrepreunariat','delete TechniqueDeveloppementEntrepreunariat',
];

$permissionsApprentissage=[ 'create apprentissage', 'read apprentissage', 'update apprentissage', 'delete apprentissage',
];

$permissionsFormation=[ 'create formation', 'read formation', 'update formation', 'delete formation',
];

$permissionsFinancement=[   'create financement', 'read financement', 'update financement', 'delete financement',
];

       

       
        $roleAdmin = Role::firstOrCreate(['name' => 'administrateur']);
        $roleDirecteurGenerale = Role::firstOrCreate(['name' => 'directeur général']);
         $roleAGentDE =  Role::firstOrCreate(['name' => 'Agent DE']);
         $roleAGentDA =  Role::firstOrCreate(['name' => 'Agent DA']);
         $roleAGentDEAP=  Role::firstOrCreate(['name' => 'Agent DEAP']);
         $roleAGentDSIP =  Role::firstOrCreate(['name' => 'Agent DSIP']);
        $roleDirecteur =  Role::firstOrCreate(['name' => 'directeur']);


        $roleDirecteur->givePermissionTo( 'read stat_formation_qual','read statApprentissage','read statFormContinue');
        $roleDirecteur->givePermissionTo('read direction');
        $roleAdmin->givePermissionTo($permissions);
        $roleAGentDA->givePermissionTo($permissionsApprentissage);
        $roleAGentDE->givePermissionTo($permissionsFormQual,$permissionsFormContinue);
        $roleAGentDEAP->givePermissionTo($permissionsFormation,$permissionsFinancement,$permissionsTDE);
        $roleAGentDSIP->givePermissionTo($permissionsDSIP);
        $roleDirecteurGenerale->givePermissionTo('read stat_formation_qual','read statApprentissage','read statFormContinue');



        
    }
}

