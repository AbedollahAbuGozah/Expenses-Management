<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
     $this->forge->addField([
         'id' => [
             'type'=>'INT',
             'constraint'=>5,
             'unsigned' => true,
             'auto_increment' => true,

         ] ,
         'first_name' => [
             'type' => 'VARCHAR' ,
             'constraint' => 100 ,
         ]
         ,
         'last_name' => [
             'type' => 'VARCHAR' ,
             'constraint' => 100 ,
         ] ,
         'password'=>[
             'type' => 'Varchar' ,
                 'constraint'=>350 ,
         ]
         ,
         'email'=>[
             'type' => 'VARCHAR',
             'constraint' => 100,
         ],
         'image' =>[
             'type' => 'VARCHAR',
             'constraint' => 300,
         ],

     ]) ;
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }

}
