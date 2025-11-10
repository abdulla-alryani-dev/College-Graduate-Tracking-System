<?php
namespace Database\Seeders;
use App\Models\TechnicalTool;
use Illuminate\Database\Seeder;

class TechnicalToolsSeeder extends Seeder
{
    public function run()
    {
        $tools = [
            ['tool_name' => 'PHP', 'tool_category' => 'Programming Language'],
            ['tool_name' => 'JavaScript', 'tool_category' => 'Programming Language'],
            ['tool_name' => 'Python', 'tool_category' => 'Programming Language'],
            ['tool_name' => 'Java', 'tool_category' => 'Programming Language'],
            ['tool_name' => 'C#', 'tool_category' => 'Programming Language'],


            ['tool_name' => 'Laravel', 'tool_category' => 'Framework'],
            ['tool_name' => 'React', 'tool_category' => 'Framework'],
            ['tool_name' => 'Vue.js', 'tool_category' => 'Framework'],
            ['tool_name' => 'Django', 'tool_category' => 'Framework'],
            ['tool_name' => 'Spring Boot', 'tool_category' => 'Framework'],


            ['tool_name' => 'MySQL', 'tool_category' => 'Database'],
            ['tool_name' => 'PostgreSQL', 'tool_category' => 'Database'],
            ['tool_name' => 'MongoDB', 'tool_category' => 'Database'],
            ['tool_name' => 'Redis', 'tool_category' => 'Database'],


            ['tool_name' => 'Docker', 'tool_category' => 'DevOps'],
            ['tool_name' => 'Kubernetes', 'tool_category' => 'DevOps'],
            ['tool_name' => 'AWS', 'tool_category' => 'DevOps'],
            ['tool_name' => 'Azure', 'tool_category' => 'DevOps'],

            ['tool_name' => 'Git', 'tool_category' => 'Version Control'],
            ['tool_name' => 'REST API', 'tool_category' => 'API'],
        ];

        foreach ($tools as $tool) {
            TechnicalTool::create($tool);
        }
    }
}

