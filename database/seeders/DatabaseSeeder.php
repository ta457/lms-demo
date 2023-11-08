<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ClassMembers;
use App\Models\Course;
use App\Models\CourseClass;
use App\Models\Faculty;
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

        $itFac = Faculty::create([
            'faculty_name' => 'Công nghệ thông tin'
        ]);
        $eduFac = Faculty::create([
            'faculty_name' => 'Sư phạm tin'
        ]);

        $admin = User::create([
            'username' => 'admin',
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '12345678',
            'role' => 1
        ]);
        $student1 = User::create([
            'username' => 'student1',
            'name' => 'student1',
            'email' => 'student1@gmail.com',
            'password' => '12345678',
            'role' => 2,
            'faculty_id' => $itFac->id
        ]);
        $student2 = User::create([
            'username' => 'student2',
            'name' => 'student2',
            'email' => 'student2@gmail.com',
            'password' => '12345678',
            'role' => 2,
            'faculty_id' => $eduFac->id
        ]);
        $teacher1 = User::create([
            'username' => 'teacher1',
            'name' => 'teacher1',
            'email' => 'teacher1@gmail.com',
            'password' => '12345678',
            'role' => 3,
            'faculty_id' => $itFac->id
        ]);
        $teacher2 = User::create([
            'username' => 'teacher2',
            'name' => 'teacher2',
            'email' => 'teacher2@gmail.com',
            'password' => '12345678',
            'role' => 3,
            'faculty_id' => $eduFac->id
        ]);
        $teacher3 = User::create([
            'username' => 'teacher3',
            'name' => 'teacher3',
            'email' => 'teacher3@gmail.com',
            'password' => '12345678',
            'role' => 3,
            'faculty_id' => $itFac->id
        ]);

        $java = Course::create([
            'course_name' => 'Lập trình Java',
            'faculty_id' => $itFac->id
        ]);
            $java1 = CourseClass::create([
                'course_id' => $java->id,
                'class_name' => 'Java 1'
            ]);
                ClassMembers::create([
                    'class_id' => $java1->id,
                    'user_id' => $student1->id
                ]);
                ClassMembers::create([
                    'class_id' => $java1->id,
                    'user_id' => $teacher1->id
                ]);
            $java2 = CourseClass::create([
                'course_id' => $java->id,
                'class_name' => 'Java 2'
            ]);
                ClassMembers::create([
                    'class_id' => $java2->id,
                    'user_id' => $student2->id
                ]);
                ClassMembers::create([
                    'class_id' => $java2->id,
                    'user_id' => $teacher2->id
                ]);

        $web = Course::create([
            'course_name' => 'Công nghệ web',
            'faculty_id' => $itFac->id
        ]);
            $web1 = CourseClass::create([
                'course_id' => $web->id,
                'class_name' => 'CNWeb 1'
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
            'course_name' => 'Cơ sở dữ liệu',
            'faculty_id' => $eduFac->id
        ]);
            $db1 = CourseClass::create([
                'course_id' => $db->id,
                'class_name' => 'CSDL 1'
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
                'class_name' => 'CSDL 2'
            ]);
                ClassMembers::create([
                    'class_id' => $db2->id,
                    'user_id' => $student2->id
                ]);
                ClassMembers::create([
                    'class_id' => $db2->id,
                    'user_id' => $teacher2->id
                ]);
    }
}
