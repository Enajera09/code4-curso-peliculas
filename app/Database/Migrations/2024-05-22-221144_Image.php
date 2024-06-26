<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Image extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'imagen' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                ],
                'extension' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                ],
                'data' => [
                    'type' => 'VARCHAR',
                    'constraint' => 500,
                ]
            ]
        );

        $this->forge->addKey('id');
        $this->forge->createTable('image');
    }

    public function down()
    {
        $this->forge->dropTable('image');
    }
}
