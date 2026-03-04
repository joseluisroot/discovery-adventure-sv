<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateServices extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'customer_id' => ['type' => 'INT', 'unsigned' => true, 'null' => true],

            'service_type' => ['type' => 'VARCHAR', 'constraint' => 30], // tour|corporate|airport|other
            'origin' => ['type' => 'VARCHAR', 'constraint' => 160, 'null' => true],
            'destination' => ['type' => 'VARCHAR', 'constraint' => 160, 'null' => true],

            // futuro: booking
            'service_date' => ['type' => 'DATE', 'null' => true],
            'service_time' => ['type' => 'TIME', 'null' => true],
            'passengers' => ['type' => 'INT', 'null' => true],
            'status' => ['type' => 'VARCHAR', 'constraint' => 30, 'default' => 'completed'], // requested|confirmed|completed|cancelled
            'notes' => ['type' => 'TEXT', 'null' => true],

            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('customer_id');
        $this->forge->addForeignKey('customer_id', 'customers', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('services', true);
    }

    public function down()
    {
        //
    }
}
