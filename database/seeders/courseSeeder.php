<?php

namespace Database\Seeders;

use App\Models\Courses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class courseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'title' => 'Laravel for Beginners',
                'description' => 'Learn the basics of Laravel, a powerful PHP framework.',
                'cover_photo' => 'courses/laravel.jpg',
                'price' => 29.99,
                'duration' => '40',
                'start_date' => '2023-11-01',
                'level' => 'Beginner',
                'slug' => 'laravel-for-Beginners',
                'user_id' => 1,
            ],
            [
                'title' => 'Advanced JavaScript',
                'description' => 'Deep dive into advanced JavaScript concepts and techniques.',
                'cover_photo' => 'courses/javascript.jpg',
                'price' => 39.99,
                'duration' => '60',
                'start_date' => '2023-12-01',
                'level' => 'Mid',
                'slug' => 'advanced-javascript',
                'user_id' => 1,
            ],
            [
                'title' => 'Python Data Science',
                'description' => 'Explore data science using Python, including libraries like Pandas and NumPy.',
                'cover_photo' => 'courses/DataScience.png',
                'price' => 49.99,
                'duration' => '80',
                'start_date' => '2024-01-15',
                'level' => 'Advanced',
                'slug' => 'python-data-science',
                'user_id' => 1,
            ],
            [
                'title' => 'Web Development Bootcamp',
                'description' => 'A comprehensive bootcamp covering HTML, CSS, and JavaScript.',
                'cover_photo' => 'courses/bootcamp.png',
                'price' => 59.99,
                'duration' => '100',
                'start_date' => '2024-02-01',
                'level' => 'Mid',
                'slug' => 'web-development-bootcamp',
                'user_id' => 1,
            ],
            [
                'title' => 'Flutter for Mobile Apps',
                'description' => 'Learn to build beautiful mobile applications using Flutter.',
                'cover_photo' => 'courses/flutter.png',
                'price' => 34.99,
                'duration' => '50',
                'level' => 'Beginner',
                'start_date' => '2024-03-01',
                'slug' => 'flutter-for-mobile-apps',
                'user_id' => 1,
            ],

            [
                'title' => 'Laravel for yBeginners',
                'description' => 'Learn the basics of Laravel, a powerful PHP framework.',
                'cover_photo' => 'courses/laravel.jpg',
                'price' => 29.99,
                'level' => 'Mid',
                'duration' => '40',
                'start_date' => '2023-11-01',
                'slug' => 'laravel-fdor-Beginners',
                'user_id' => 1,
            ],
            [
                'title' => 'Advanced JavayScript',
                'description' => 'Deep dive into advanced JavaScript concepts and techniques.',
                'cover_photo' => 'courses/javascript.jpg',
                'price' => 39.99,
                'duration' => '60',
                'start_date' => '2023-12-01',
                'level' => 'Mid',
                'slug' => 'advanced-jdavascript',
                'user_id' => 1,
            ],
            [
                'title' => 'Python Data Scyience',
                'description' => 'Explore data science using Python, including libraries like Pandas and NumPy.',
                'cover_photo' => 'courses/DataScience.png',
                'price' => 49.99,
                'level' => 'Advanced',
                'duration' => '80',
                'start_date' => '2024-01-15',
                'slug' => 'python-datad-science',
                'user_id' => 1,
            ],
            [
                'title' => 'Web Developmenty Bootcamp',
                'description' => 'A comprehensive bootcamp covering HTML, CSS, and JavaScript.',
                'cover_photo' => 'courses/bootcamp.png',
                'price' => 59.99,
                'level' => 'Beginner',
                'duration' => '100',
                'start_date' => '2024-02-01',
                'slug' => 'web-developmdent-bootcamp',
                'user_id' => 1,
            ],
            [
                'title' => 'Flutter for Mobiyle Apps',
                'description' => 'Learn to build beautiful mobile applications using Flutter.',
                'cover_photo' => 'courses/flutter.png',
                'price' => 34.99,
                'level' => 'Mid',
                'duration' => '50',
                'start_date' => '2024-03-01',
                'slug' => 'flutter-for-mdobile-apps',
                'user_id' => 1,
            ],

            [
                'title' => 'Laravel for Begininers',
                'description' => 'Learn the basics of Laravel, a powerful PHP framework.',
                'cover_photo' => 'courses/laravel.jpg',
                'price' => 29.99,
                'duration' => '40',
                'level' => 'Mid',
                'start_date' => '2023-11-01',
                'slug' => 'laravgel-for-Beginners',
                'user_id' => 1,
            ],
            [
                'title' => 'Advanced JavaScripit',
                'description' => 'Deep dive into advanced JavaScript concepts and techniques.',
                'cover_photo' => 'courses/javascript.jpg',
                'price' => 39.99,
                'duration' => '60',
                'level' => 'Advanced',
                'start_date' => '2023-12-01',
                'slug' => 'advancgded-javascript',
                'user_id' => 1,
            ],
            [
                'title' => 'Python Data Sciencei',
                'description' => 'Explore data science using Python, including libraries like Pandas and NumPy.',
                'cover_photo' => 'courses/DataScience.png',
                'price' => 49.99,
                'duration' => '80',
                'level' => 'Mid',
                'start_date' => '2024-01-15',
                'slug' => 'python-gdata-science',
                'user_id' => 1,
            ],
            [
                'title' => 'Web Development Booticamp',
                'description' => 'A comprehensive bootcamp covering HTML, CSS, and JavaScript.',
                'cover_photo' => 'courses/bootcamp.png',
                'price' => 59.99,
                'duration' => '100',
                'level' => 'Beginner',
                'start_date' => '2024-02-01',
                'slug' => 'web-deveglopment-bootcamp',
                'user_id' => 1,
            ],
            [
                'title' => 'Flutter for Mobile Apips',
                'description' => 'Learn to build beautiful mobile applications using Flutter.',
                'cover_photo' => 'courses/flutter.png',
                'price' => 34.99,
                'level' => 'Mid',
                'duration' => '50',
                'start_date' => '2024-03-01',
                'slug' => 'flutter-fgor-mobile-apps',
                'user_id' => 1,
            ],

            [
                'title' => 'Laravel for Bejginners',
                'description' => 'Learn the basics of Laravel, a powerful PHP framework.',
                'cover_photo' => 'courses/laravel.jpg',
                'price' => 29.99,
                'level' => 'Beginner',
                'duration' => '40',
                'start_date' => '2023-11-01',
                'slug' => 'flaravel-for-Beginners',
                'user_id' => 1,
            ],
            [
                'title' => 'Advanced JavaScjript',
                'description' => 'Deep dive into advanced JavaScript concepts and techniques.',
                'cover_photo' => 'courses/javascript.jpg',
                'price' => 39.99,
                'duration' => '60',
                'level' => 'Advanced',
                'start_date' => '2023-12-01',
                'slug' => 'afdvanced-javascript',
                'user_id' => 1,
            ],
            [
                'title' => 'Python Data Sciejnce',
                'description' => 'Explore data science using Python, including libraries like Pandas and NumPy.',
                'cover_photo' => 'courses/DataScience.png',
                'price' => 49.99,
                'duration' => '80',
                'start_date' => '2024-01-15',
                'level' => 'Mid',
                'slug' => 'pyfthon-data-science',
                'user_id' => 1,
            ],
            [
                'title' => 'Web Development Bjootcamp',
                'description' => 'A comprehensive bootcamp covering HTML, CSS, and JavaScript.',
                'cover_photo' => 'courses/bootcamp.png',
                'price' => 59.99,
                'duration' => '100',
                'level' => 'Advanced',
                'start_date' => '2024-02-01',
                'slug' => 'webf-development-bootcamp',
                'user_id' => 1,
            ],
            [
                'title' => 'Flutter for Mobilej Apps',
                'description' => 'Learn to build beautiful mobile applications using Flutter.',
                'cover_photo' => 'courses/flutter.png',
                'price' => 34.99,
                'duration' => '50',
                'start_date' => '2024-03-01',
                'level' => 'Advanced',
                'slug' => 'flutfter-for-mobile-apps',
                'user_id' => 1,
            ],

        ];

        foreach ($courses as $course) {
            Courses::create($course);
        }


    }
}
