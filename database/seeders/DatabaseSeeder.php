<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            $user = new User();
            $user->nickname = " nick$i";
            $user->name = "User$i";
            $user->lastName = "UserLastName$i";
            $user->nationality = "UK";
            $user->email = "user$i@gmail.com";
            $user->email_verified_at = "2023-01-07 20:48:38.000";
            $user->password = Hash::make("olaolaola$i");
            $user->save();
        }
        for ($j = 0; $j < 10;$j++){
            for ($i = 1; $i < 6; $i++) {
            $product = new Product();
            $product->userId = $j+5;
            $product->nameProduct = " nick$i";
            $product->categoryId = "$i";
            $product->price = "20$i";
            $product->state = "NEW";
            $product->description = "description$i description$i descriptionde$i scriptionde$i scriptionde$i scriptiondescri$i ptiondescription$i descript$i iondescription";
            $product->quantityStock = $i+$j;
            $product->photo = "/storage/images/1673112069MacBook_Pro_13_in_Space_Gray_PDP_Image_Position-1__WWEN_1024x1024.png";
            $product->save();
        }
        }
    }
}
