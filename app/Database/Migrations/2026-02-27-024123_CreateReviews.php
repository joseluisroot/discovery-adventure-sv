<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReviews extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'invite_id' => ['type' => 'INT', 'unsigned' => true],

            'rating_cleanliness' => ['type' => 'TINYINT', 'unsigned' => true],
            'rating_comfort' => ['type' => 'TINYINT', 'unsigned' => true],
            'rating_punctuality' => ['type' => 'TINYINT', 'unsigned' => true],
            'rating_attention' => ['type' => 'TINYINT', 'unsigned' => true], // prioridad

            'comment' => ['type' => 'TEXT', 'null' => true],
            'language' => ['type' => 'VARCHAR', 'constraint' => 2, 'default' => 'es'],

            'score_total' => ['type' => 'DECIMAL', 'constraint' => '5,2', 'null' => true], // calculado
            'published' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],

            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('invite_id');
        $this->forge->addForeignKey('invite_id', 'review_invites', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('reviews', true);
    }

    public function down()
    {
        //
    }
}
