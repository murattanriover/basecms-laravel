<?php
use Illuminate\Database\Seeder;

class initSeed extends Seeder{
    public function run(){

        \App\Model\Groups::create(['name'=>"yonetici",'value'=>"Yönetici",'status'=>1]);
        \App\Model\Groups::create(['name'=>"editor",'value'=>"Editör",'status'=>1]);

        \App\Model\GroupPerms::create(['group_id'=>1,'controller'=>null,'action'=>null]);



        $user = new \App\User();
        $user->name = "John";
        $user->surname = "DOE";
        $user->email = "admin@admin.com";
        $user->password = bcrypt("admin");
        $user->status = 1;
        $user->save();

        \App\Model\UserGroup::create(['user_id'=>1,'group_id'=>1]);
    }
}