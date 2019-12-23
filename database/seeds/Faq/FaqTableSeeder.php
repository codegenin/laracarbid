<?php

use App\Models\Faq\Faq;
use Illuminate\Database\Seeder;

/**
 * Class FaqTableSeeder.
 */
class FaqTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->disableForeignKeys();

        factory(Faq::class, 10)->create();

        $this->enableForeignKeys();
    }
}
