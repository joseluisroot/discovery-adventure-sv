<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReviewInvites extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'service_id' => ['type' => 'INT', 'unsigned' => true],
            'token' => ['type' => 'VARCHAR', 'constraint' => 80],
            'sent_at' => ['type' => 'DATETIME', 'null' => true],
            'responded_at' => ['type' => 'DATETIME', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('token');
        $this->forge->addForeignKey('service_id', 'services', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('review_invites', true);
    }

    public function down()
    {
        //
    }
}
