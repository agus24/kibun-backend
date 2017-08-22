<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class TruncateAll extends Seeder
{
    private $db;

    public function __construct()
    {
        $this->db = config('database.connections')[config('database.default')]['database'];
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $excepts = ['migrations'];
        $tables = $this->wrap();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        foreach ($tables as $name) {
            //if you don't want to truncate migrations
            if (in_array($name, $excepts)){
                continue;
            }

            DB::table($name)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    private function wrap()
    {
        $table = \DB::select('SHOW TABLES');
        $rs = array();

        foreach($table as $tbl)
        {
            $rs[] = $tbl->{"Tables_in_".$this->db};
        }
        return $rs;
    }
}
