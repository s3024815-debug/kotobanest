<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseModule;
use App\Models\CourseSection;
use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseCurriculumSeeder extends Seeder
{
    public function run(): void
    {
        $levels = [
            ['N5', 'Beginner Japanese: daily words, basic kanji, core grammar and simple communication.'],
            ['N4', 'Elementary Japanese for everyday situations and longer sentences.'],
            ['N3', 'Intermediate Japanese for practical reading, listening and conversation.'],
            ['N2', 'Upper-intermediate Japanese for work, study, news and complex communication.'],
            ['N1', 'Advanced Japanese for academic, professional and native-level materials.'],
        ];

        $sections = [
            ['Vocabulary', '📖', ['Core Words', 'Daily Life', 'Review & Practice']],
            ['Kanji', '🈶', ['Core Characters', 'Readings & Compounds', 'Review & Practice']],
            ['Grammar', '✍️', ['Core Patterns', 'Sentence Building', 'Review & Practice']],
            ['Reading', '📚', ['Short Texts', 'Practical Reading', 'Comprehension Practice']],
            ['Listening', '🎧', ['Short Conversations', 'Everyday Situations', 'Comprehension Practice']],
        ];

        foreach ($levels as $levelIndex => [$level, $description]) {
            $course = Course::updateOrCreate(
                ['slug' => strtolower($level)],
                ['title' => "JLPT {$level} Complete Course", 'level' => $level, 'description' => $description, 'position' => $levelIndex + 1, 'is_published' => true]
            );

            foreach ($sections as $sectionIndex => [$name, $icon, $modules]) {
                $section = CourseSection::updateOrCreate(
                    ['course_id' => $course->id, 'slug' => Str::slug($name)],
                    ['name' => $name, 'icon' => $icon, 'position' => $sectionIndex + 1]
                );

                foreach ($modules as $moduleIndex => $moduleTitle) {
                    $module = CourseModule::updateOrCreate(
                        ['course_section_id' => $section->id, 'position' => $moduleIndex + 1],
                        ['title' => $moduleTitle, 'description' => "{$level} {$name}: {$moduleTitle}"]
                    );

                    for ($lessonNumber = 1; $lessonNumber <= 3; $lessonNumber++) {
                        Lesson::updateOrCreate(
                            ['course_module_id' => $module->id, 'position' => $lessonNumber],
                            [
                                'title' => "{$moduleTitle} Lesson {$lessonNumber}",
                                'category' => $name,
                                'level' => $level,
                                'content' => "This is the starter content for {$level} {$name}, {$moduleTitle}, Lesson {$lessonNumber}. Replace it from the admin panel with your complete lesson content.",
                                'status' => 'published',
                                'estimated_minutes' => 10 + ($lessonNumber * 5),
                                'xp_reward' => 10,
                            ]
                        );
                    }
                }
            }
        }
    }
}
