<?php

use Illuminate\Database\Seeder;

class InboxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inboxes')->insert([
         'name' => 'Okan Beydanol',
         'status' => 1,
         'sEmail' => 'okan.beydanol@gmail.com',
         'rEmail' => 'muzaffer@gmali.com',
         'topic' => 'Reply',
         'message' => 'asşlnflasbflsabgasbljfabsljbsagljbsa sdgknsdkjg askdnghoıadg hoıadgh oad',
         'created_at' => now(),
         'updated_at' => now(),
       ]);
        DB::table('inboxes')->insert([
         'name' => 'Okan muzaffer',
         'status' => 0,
         'sEmail' => 'okan.muzaffer@gmail.com',
         'rEmail' => 'muzaffer@gmali.com',
         'topic' => 'Reply',
         'message' => 'asşlnflasbflsabgasbljfabsljbsagljbsa sdgknsdkjg askdnghoıadg hoıadgh oad',
         'created_at' => now(),
         'updated_at' => now(),
       ]);
        DB::table('inboxes')->insert([
         'name' => 'muzaffer d',
         'status' => 0,
         'sEmail' => 'muzaffer.dd@gmail.com',
         'rEmail' => 'ddaf@gmali.com',
         'topic' => 'Reply',
         'message' => 'asşlnflasbflsabgasbljfabsljbsagljbsa sdgknsdkjg askdnghoıadg hoıadgh oad',
         'created_at' => now(),
         'updated_at' => now(),
       ]);
        DB::table('inboxes')->insert([
         'name' => 'asd muzafdfer',
         'status' => 0,
         'sEmail' => 'asdasd.muzaffer@gmail.com',
         'rEmail' => 'muzaffer@gmali.com',
         'topic' => 'Reply',
         'message' => 'asşlnflasbflsabgasbljfabsljbsagljbsa sdgknsdkjg askdnghoıadg hoıadgh oad',
         'created_at' => now(),
         'updated_at' => now(),
       ]);
        DB::table('inboxes')->insert([
         'name' => 'muzaffer Beydanol',
         'status' => 0,
         'sEmail' => 'okan.muzafferdd@gmail.com',
         'rEmail' => 'muzafddfer@gmali.com',
         'topic' => 'Bilgi',
         'message' => 'asşlnflasbflsabgasbljfabsljbsagljbsa sdgknsdkjg askdnghoıadg hoıadgh oad',
         'created_at' => now(),
         'updated_at' => now(),
       ]);
        DB::table('inboxes')->insert([
         'name' => 'muzaffer Beasdasdydanol',
         'status' => 0,
         'sEmail' => 'okan.muzaffermuzaffer@gmail.com',
         'rEmail' => 'muzaffermuzafferss@gmali.com',
         'topic' => 'Destek',
         'message' => 'asşlnflasbflsabgasbljfabsljbsagljbsa sdgknsdkjg askdnghoıadg hoıadgh oad',
         'created_at' => now(),
         'updated_at' => now(),
       ]);
    }
}
