<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SettingSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(WorkflowActionTypeSeeder::class);
        $this->call(WorkflowStatusSeeder::class);
        $this->call(WorkflowObjectSeeder::class);
        $this->call(WorkflowObjectFieldSeeder::class);
        $this->call(WorkflowSeeder::class);
        $this->call(WorkflowStepSeeder::class);
        $this->call(WorkflowActionSeeder::class);
        $this->call(TypeDepartementSeeder::class);
    }
}
