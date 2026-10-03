<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin user
        User::factory()->create([
            'name' => 'Hamza Kamal',
            'email' => 'admin@portfolio.test',
            'is_admin' => true,
        ]);

        // Profile
        Profile::create([
            'name_ar' => 'حمزة كمال',
            'name_en' => 'Hamza Kamal',
            'headline_ar' => 'مطور ويب متخصص في Laravel',
            'headline_en' => 'Web Developer Specialized in Laravel',
            'bio_ar' => 'مطور ويب شغوف بتطوير تطبيقات ويب حديثة وقابلة للتوسع باستخدام Laravel و Livewire. أسعى دائماً لتعلم التقنيات الجديدة وتطبيق أفضل الممارسات في مشاريعي.',
            'bio_en' => 'A passionate web developer focused on building modern, scalable web applications using Laravel and Livewire. I continuously strive to learn new technologies and apply best practices in my projects.',
            'email' => 'hamza@example.com',
            'phone' => '+966500000000',
            'location_ar' => 'المملكة العربية السعودية',
            'location_en' => 'Saudi Arabia',
            'github_url' => 'https://github.com/HamzaKamal10',
            'linkedin_url' => 'https://linkedin.com/in/hamzakamal',
        ]);

        // Skills
        $skills = [
            ['name_ar' => 'PHP', 'name_en' => 'PHP', 'category' => 'Backend', 'proficiency' => 90, 'sort_order' => 1],
            ['name_ar' => 'Laravel', 'name_en' => 'Laravel', 'category' => 'Backend', 'proficiency' => 85, 'sort_order' => 2],
            ['name_ar' => 'Livewire', 'name_en' => 'Livewire', 'category' => 'Backend', 'proficiency' => 80, 'sort_order' => 3],
            ['name_ar' => 'MySQL', 'name_en' => 'MySQL', 'category' => 'Database', 'proficiency' => 80, 'sort_order' => 4],
            ['name_ar' => 'جافاسكربت', 'name_en' => 'JavaScript', 'category' => 'Frontend', 'proficiency' => 75, 'sort_order' => 5],
            ['name_ar' => 'تيلويند CSS', 'name_en' => 'Tailwind CSS', 'category' => 'Frontend', 'proficiency' => 85, 'sort_order' => 6],
            ['name_ar' => 'HTML & CSS', 'name_en' => 'HTML & CSS', 'category' => 'Frontend', 'proficiency' => 90, 'sort_order' => 7],
            ['name_ar' => 'Git', 'name_en' => 'Git', 'category' => 'Tools', 'proficiency' => 80, 'sort_order' => 8],
            ['name_ar' => 'Alpine.js', 'name_en' => 'Alpine.js', 'category' => 'Frontend', 'proficiency' => 70, 'sort_order' => 9],
        ];

        foreach ($skills as $skill) {
            Skill::create(array_merge($skill, ['is_visible' => true]));
        }

        // Experiences
        Experience::create([
            'company_ar' => 'شركة تقنية المعلومات',
            'company_en' => 'IT Solutions Company',
            'position_ar' => 'مطور ويب',
            'position_en' => 'Web Developer',
            'description_ar' => 'تطوير وصيانة تطبيقات ويب باستخدام Laravel. تصميم وتنفيذ قواعد بيانات وواجهات برمجة التطبيقات RESTful. العمل ضمن فريق Agile.',
            'description_en' => 'Developing and maintaining web applications using Laravel. Designing and implementing databases and RESTful APIs. Working within an Agile team.',
            'start_date' => '2024-06-01',
            'end_date' => null,
            'is_current' => true,
            'sort_order' => 1,
            'is_visible' => true,
        ]);

        Experience::create([
            'company_ar' => 'مؤسسة الحلول الرقمية',
            'company_en' => 'Digital Solutions Foundation',
            'position_ar' => 'متدرب تطوير ويب',
            'position_en' => 'Web Development Intern',
            'description_ar' => 'تعلم أساسيات تطوير الويب باستخدام PHP و Laravel. المشاركة في تطوير مشاريع داخلية وتعلم أفضل ممارسات البرمجة.',
            'description_en' => 'Learning web development fundamentals using PHP and Laravel. Contributing to internal projects and learning programming best practices.',
            'start_date' => '2023-09-01',
            'end_date' => '2024-05-30',
            'is_current' => false,
            'sort_order' => 2,
            'is_visible' => true,
        ]);

        // Education
        Education::create([
            'institution_ar' => 'جامعة الملك عبدالعزيز',
            'institution_en' => 'King Abdulaziz University',
            'degree_ar' => 'بكالوريوس علوم الحاسب',
            'degree_en' => 'Bachelor of Computer Science',
            'description_ar' => 'دراسة علوم الحاسب مع التركيز على هندسة البرمجيات وتطوير تطبيقات الويب.',
            'description_en' => 'Studying Computer Science with a focus on Software Engineering and Web Application Development.',
            'start_date' => '2020-09-01',
            'end_date' => '2024-06-01',
            'sort_order' => 1,
            'is_visible' => true,
        ]);

        Education::create([
            'institution_ar' => 'Udemy',
            'institution_en' => 'Udemy',
            'degree_ar' => 'دورة Laravel المتقدمة',
            'degree_en' => 'Advanced Laravel Course',
            'description_ar' => 'دورة متقدمة في إطار عمل Laravel تشمل التصميم المعماري وأفضل الممارسات.',
            'description_en' => 'Advanced course in Laravel framework covering architectural design and best practices.',
            'start_date' => '2024-01-01',
            'end_date' => '2024-03-01',
            'certificate_url' => 'https://udemy.com/certificate/example',
            'sort_order' => 2,
            'is_visible' => true,
        ]);

        Education::create([
            'institution_ar' => 'منصة سطر',
            'institution_en' => 'Satr Platform',
            'degree_ar' => 'دورة تطوير واجهات المستخدم',
            'degree_en' => 'Frontend Development Course',
            'description_ar' => 'دورة في تطوير واجهات المستخدم باستخدام HTML, CSS, JavaScript و Tailwind CSS.',
            'description_en' => 'A course in frontend development using HTML, CSS, JavaScript, and Tailwind CSS.',
            'start_date' => '2023-06-01',
            'end_date' => '2023-08-01',
            'sort_order' => 3,
            'is_visible' => true,
        ]);

        // Projects
        Project::create([
            'title_ar' => 'نظام إدارة المهام',
            'title_en' => 'Task Management System',
            'slug' => 'task-management-system',
            'description_ar' => 'نظام لإدارة المهام والمشاريع مبني بـ Laravel و Livewire. يتيح للمستخدمين إنشاء المهام وتعيينها وتتبع حالتها مع لوحة تحكم شاملة.',
            'description_en' => 'A task and project management system built with Laravel and Livewire. Allows users to create, assign, and track tasks with a comprehensive dashboard.',
            'project_url' => 'https://tasks.example.com',
            'github_url' => 'https://github.com/HamzaKamal10/task-manager',
            'technologies' => ['Laravel', 'Livewire', 'Tailwind CSS', 'MySQL'],
            'completed_at' => '2024-08-01',
            'sort_order' => 1,
            'is_featured' => true,
            'is_visible' => true,
        ]);

        Project::create([
            'title_ar' => 'متجر إلكتروني',
            'title_en' => 'E-Commerce Store',
            'slug' => 'ecommerce-store',
            'description_ar' => 'متجر إلكتروني متكامل مع سلة مشتريات، بوابة دفع، ونظام إدارة المنتجات. مبني بـ Laravel مع واجهة مستخدم حديثة.',
            'description_en' => 'A full-featured e-commerce store with shopping cart, payment gateway, and product management. Built with Laravel with a modern UI.',
            'github_url' => 'https://github.com/HamzaKamal10/ecommerce',
            'technologies' => ['Laravel', 'Alpine.js', 'Tailwind CSS', 'Stripe', 'MySQL'],
            'completed_at' => '2024-05-01',
            'sort_order' => 2,
            'is_featured' => true,
            'is_visible' => true,
        ]);

        Project::create([
            'title_ar' => 'مدونة شخصية',
            'title_en' => 'Personal Blog',
            'slug' => 'personal-blog',
            'description_ar' => 'مدونة شخصية مع نظام إدارة محتوى مبسط، دعم Markdown، ونظام تعليقات. مبنية بـ Laravel و Livewire.',
            'description_en' => 'A personal blog with a simplified CMS, Markdown support, and comment system. Built with Laravel and Livewire.',
            'github_url' => 'https://github.com/HamzaKamal10/blog',
            'technologies' => ['Laravel', 'Livewire', 'Tailwind CSS', 'SQLite'],
            'completed_at' => '2024-02-01',
            'sort_order' => 3,
            'is_featured' => true,
            'is_visible' => true,
        ]);
    }
}
