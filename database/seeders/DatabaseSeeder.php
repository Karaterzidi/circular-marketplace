<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'admin',
            'password' => Hash::make('admin'),
            'telephone' => 'admin',
            'address' => 'admin',
            'role' => 'Admin',
            'is_activated' => 'Accepted'
        ]);

        DB::table('users')->insert([
            'email' => 'customer@customer.com',
            'password' => Hash::make('1'),
            'firstname' => 'Konstantinos',
            'Lastname' => 'Vaz',
            'telephone' => '2106134865',
            'address' => 'Wallstreet Av, 2756st',
            'role' => 'Customer',
            'is_activated' => 'Accepted'
        ]);

        DB::table('profiles')->insert([
            'uuid' => Str::uuid(),
            'user_id' => 2
        ]);

        DB::table('carts')->insert([
            'user_id' => 2
        ]);

        DB::table('users')->insert([
            'email' => 'company@company.com',
            'password' => Hash::make('1'),
            'company_name' => 'TechnoPOS',
            'telephone' => '2106134865',
            'address' => 'Athens, Ampelokipoi NeTon 12435',
            'role' => 'Company',
            'is_activated' => 'Accepted'
        ]);

        DB::table('profiles')->insert([
            'uuid' => Str::uuid(),
            'user_id' => 3
        ]);

        DB::table('carts')->insert([
            'user_id' => 3
        ]);

        User::factory()
            ->count(25)
            ->create();

        // Category::factory()
        //     ->count(10)
        //     ->has(Subcategory::factory()->count(6)->has(Product::factory()->count(20)))
        //     ->create();

        DB::table('categories')->insert([
            'title' => 'Ενδυση',
            'position' => 1,
            'slug' => 'endisi'
        ]);

        DB::table('categories')->insert([
            'title' => 'Αθλητικα ειδη',
            'position' => 2,
            'slug' => 'athlitika-idi'
        ]);

        DB::table('categories')->insert([
            'title' => 'Ειδη Σπιτιου',
            'position' => 3,
            'slug' => 'idi-spitiou'
        ]);

        DB::table('categories')->insert([
            'title' => 'Χομπυ',
            'position' => 4,
            'slug' => 'xompi'
        ]);

        DB::table('categories')->insert([
            'title' => 'Κατοικιδια',
            'position' => 5,
            'slug' => 'katoikidia'
        ]);


        DB::table('subcategories')->insert([
            'title' => 'Ανδρικα Ρουχα',
            'slug' => 'andrika-rouxa'
        ]);
        DB::table('subcategories')->insert([
            'title' => 'Γυναικεια Ρουχα',
            'slug' => 'gynaikeia-rouxa'
        ]);
        DB::table('subcategories')->insert([
            'title' => 'Παιδικα Ρουχα',
            'slug' => 'paidika-rouxa'
        ]);
        DB::table('subcategories')->insert([
            'title' => 'Παππουτσια',
            'slug' => 'pappoytsia'
        ]);
        DB::table('subcategories')->insert([
            'title' => 'Μηχανες Γκαζον',
            'slug' => 'mixanes-gazon'
        ]);
        
        DB::table('category_subcategory')->insert([
            'category_id' => 1,
            'subcategory_id' => 1
        ]);
        DB::table('category_subcategory')->insert([
            'category_id' => 1,
            'subcategory_id' => 2 
        ]);
        DB::table('category_subcategory')->insert([
            'category_id' => 1,
            'subcategory_id' => 3 
        ]);
        DB::table('category_subcategory')->insert([
            'category_id' => 1,
            'subcategory_id' => 4
        ]);
        DB::table('category_subcategory')->insert([
            'category_id' => 4,
            'subcategory_id' => 5
        ]);
    }
}
