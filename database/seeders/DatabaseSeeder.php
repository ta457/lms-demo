<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ClassMembers;
use App\Models\Course;
use App\Models\CourseClass;
use App\Models\Faculty;
use App\Models\Section;
use App\Models\Subsection;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        $default = Faculty::create([
            'faculty_name' => 'Unassigned'
        ]);
        $csFac = Faculty::create([
            'faculty_name' => 'Computer Science'
        ]);
        $mathFac = Faculty::create([
            'faculty_name' => 'Mathematics'
        ]);

        $admin = User::create([
            'username' => 'admin',
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '12345678',
            'role' => 1,
            'faculty_id' => $default->id
        ]);
        $student1 = User::create([
            'username' => 'student1',
            'name' => 'student1',
            'email' => 'student1@gmail.com',
            'password' => '12345678',
            'role' => 2,
            'faculty_id' => $csFac->id
        ]);
        $student2 = User::create([
            'username' => 'student2',
            'name' => 'student2',
            'email' => 'student2@gmail.com',
            'password' => '12345678',
            'role' => 2,
            'faculty_id' => $mathFac->id
        ]);
        $teacher1 = User::create([
            'username' => 'teacher1',
            'name' => 'teacher1',
            'email' => 'teacher1@gmail.com',
            'password' => '12345678',
            'role' => 3,
            'faculty_id' => $csFac->id
        ]);
        $teacher2 = User::create([
            'username' => 'teacher2',
            'name' => 'teacher2',
            'email' => 'teacher2@gmail.com',
            'password' => '12345678',
            'role' => 3,
            'faculty_id' => $mathFac->id
        ]);
        $teacher3 = User::create([
            'username' => 'teacher3',
            'name' => 'teacher3',
            'email' => 'teacher3@gmail.com',
            'password' => '12345678',
            'role' => 3,
            'faculty_id' => $csFac->id
        ]);

        $da = Course::create([
            'course_name' => 'Data Structures & Algorithms',
            'faculty_id' => $csFac->id
        ]);
            $da1 = CourseClass::create([
                'course_id' => $da->id,
                'class_name' => 'DA 1'
            ]);
                ClassMembers::create([
                    'class_id' => $da1->id,
                    'user_id' => $student1->id
                ]);
                ClassMembers::create([
                    'class_id' => $da1->id,
                    'user_id' => $teacher1->id
                ]);
            $da2 = CourseClass::create([
                'course_id' => $da->id,
                'class_name' => 'DA 2'
            ]);
                ClassMembers::create([
                    'class_id' => $da2->id,
                    'user_id' => $student2->id
                ]);
                ClassMembers::create([
                    'class_id' => $da2->id,
                    'user_id' => $teacher2->id
                ]);

        $web = Course::create([
            'course_name' => 'Web Development',
            'faculty_id' => $csFac->id
        ]);
            $web1 = CourseClass::create([
                'course_id' => $web->id,
                'class_name' => 'WebDev 1'
            ]);
                ClassMembers::create([
                    'class_id' => $web1->id,
                    'user_id' => $student1->id
                ]);
                ClassMembers::create([
                    'class_id' => $web1->id,
                    'user_id' => $teacher3->id
                ]);

        $db = Course::create([
            'course_name' => 'Database',
            'faculty_id' => $mathFac->id
        ]);
            $db1 = CourseClass::create([
                'course_id' => $db->id,
                'class_name' => 'DB 1'
            ]);
                ClassMembers::create([
                    'class_id' => $db1->id,
                    'user_id' => $student1->id
                ]);
                ClassMembers::create([
                    'class_id' => $db1->id,
                    'user_id' => $teacher1->id
                ]);
            $db2 = CourseClass::create([
                'course_id' => 2,
                'class_name' => 'DB 2'
            ]);
                ClassMembers::create([
                    'class_id' => $db2->id,
                    'user_id' => $student2->id
                ]);
                ClassMembers::create([
                    'class_id' => $db2->id,
                    'user_id' => $teacher2->id
                ]);
    
        User::factory(10)->create([
            'faculty_id' => 1,
            'role' => 2
        ]);

        // subsection type: 1 => text, 2 => file, 3 => link, 4 => assignment
        $sec1 = Section::create([
            'class_id' => $da1->id,
            'section_title' => 'Week 1: Example title'
        ]);
            Subsection::create([
                'section_id' => $sec1->id,
                'type' => 2,
                'title' => 'Lecture 1 pdf file',
                'file' => 'section-files/SWTM-2088_Atlassian-Git-Cheatsheet.pdf'
            ]);
            Subsection::create([
                'section_id' => $sec1->id,
                'type' => 3,
                'title' => 'Link to suplement learning materials',
                'url' => 'https://www.theodinproject.com/'
            ]);
            Subsection::create([
                'section_id' => $sec1->id,
                'type' => 1,
                'title' => 'Text content example',
                'text_content' => '<b>This is a list:</b><div>-<i> item 1</i></div><div>- <i>item 2</i></div><div>- <i>item 3</i></div>'
            ]);
            Subsection::create([
                'section_id' => $sec1->id,
                'type' => 4,
                'title' => 'Assignment for week 1',
                'deadline' => '2023-11-24 17:03:00',
                'instruction' => 'All students are required to submit files in .zip format.'
            ]);
        Section::create([
            'class_id' => $da1->id,
            'section_title' => 'Week 2: Example title'
        ]);
    }
}
