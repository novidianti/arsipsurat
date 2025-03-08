<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dokumen extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_dokumen' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'no_kop' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'file' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'disposisi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'keluar_masuk' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'belum_selesai' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'jenis' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'tanggal_dokumen' => [
                'type'       => 'date',
            ],
            'tentang' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'halaman' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('disposisi', 'disposisi', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('jenis', 'jenis', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('dokumen');

    }

    public function down()
    {
        $this->forge->dropTable('dokumen');
    }
}
