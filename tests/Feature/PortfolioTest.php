<?php

namespace Tests\Feature;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortfolioTest extends TestCase
{
    use RefreshDatabase;

    private function seedPortfolio(): void
    {
        Profile::create([
            'name_ar' => 'حمزة كمال',
            'name_en' => 'Hamza Kamal',
            'headline_ar' => 'مطور ويب',
            'headline_en' => 'Web Developer',
            'bio_ar' => 'نبذة عني بالعربي',
            'bio_en' => 'About me in English',
            'email' => 'test@example.com',
        ]);

        Skill::create([
            'name_ar' => 'PHP',
            'name_en' => 'PHP',
            'category' => 'Backend',
            'proficiency' => 90,
            'sort_order' => 1,
            'is_visible' => true,
        ]);

        Experience::create([
            'company_ar' => 'شركة تقنية',
            'company_en' => 'Tech Company',
            'position_ar' => 'مطور',
            'position_en' => 'Developer',
            'description_ar' => 'وصف الخبرة',
            'description_en' => 'Experience description',
            'start_date' => '2024-01-01',
            'is_current' => true,
            'sort_order' => 1,
            'is_visible' => true,
        ]);

        Education::create([
            'institution_ar' => 'جامعة',
            'institution_en' => 'University',
            'degree_ar' => 'بكالوريوس',
            'degree_en' => 'Bachelor',
            'sort_order' => 1,
            'is_visible' => true,
        ]);

        Project::create([
            'title_ar' => 'مشروع تجريبي',
            'title_en' => 'Test Project',
            'slug' => 'test-project',
            'description_ar' => 'وصف المشروع بالعربي',
            'description_en' => 'Project description in English',
            'technologies' => ['Laravel', 'Livewire'],
            'sort_order' => 1,
            'is_featured' => true,
            'is_visible' => true,
        ]);
    }

    // =============================
    // Home Page Tests
    // =============================

    public function test_home_page_displays_with_portfolio_data(): void
    {
        $this->seedPortfolio();

        $response = $this->get('/ar');

        $response->assertOk();
        $response->assertSee('حمزة كمال');
        $response->assertSee('PHP');
        $response->assertSee('شركة تقنية');
        $response->assertSee('جامعة');
        $response->assertSee('مشروع تجريبي');
    }

    public function test_home_page_displays_in_english(): void
    {
        $this->seedPortfolio();

        $response = $this->get('/en');

        $response->assertOk();
        $response->assertSee('Hamza Kamal');
        $response->assertSee('Web Developer');
    }

    public function test_home_page_returns_503_without_profile(): void
    {
        $response = $this->get('/ar');

        $response->assertStatus(503);
    }

    // =============================
    // Project Pages Tests
    // =============================

    public function test_projects_index_page_loads(): void
    {
        $this->seedPortfolio();

        $response = $this->get('/ar/projects');

        $response->assertOk();
    }

    public function test_project_show_page_loads(): void
    {
        $this->seedPortfolio();

        $response = $this->get('/ar/projects/test-project');

        $response->assertOk();
        $response->assertSee('مشروع تجريبي');
    }

    public function test_hidden_project_returns_404(): void
    {
        $this->seedPortfolio();
        Project::query()->update(['is_visible' => false]);

        $response = $this->get('/ar/projects/test-project');

        $response->assertNotFound();
    }

    // =============================
    // Language Switch Tests
    // =============================

    public function test_language_switch_sets_session(): void
    {
        $response = $this->get('/language/en');

        $response->assertRedirect();
        $response->assertSessionHas('locale', 'en');
    }

    public function test_invalid_locale_returns_404(): void
    {
        $response = $this->get('/language/fr');

        $response->assertNotFound();
    }

    // =============================
    // SEO Tests
    // =============================

    public function test_home_page_has_seo_meta_tags(): void
    {
        $this->seedPortfolio();

        $response = $this->get('/ar');

        $response->assertOk();
        $response->assertSee('<meta property="og:title"', false);
        $response->assertSee('<meta property="og:description"', false);
        $response->assertSee('<meta name="description"', false);
        $response->assertSee('dir="rtl"', false);
    }

    public function test_english_page_has_ltr_direction(): void
    {
        $this->seedPortfolio();

        $response = $this->get('/en');

        $response->assertOk();
        $response->assertSee('dir="ltr"', false);
    }

    // =============================
    // Admin Authorization Tests
    // =============================

    public function test_admin_pages_require_authentication(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect('/login');
    }

    public function test_non_admin_user_cannot_access_admin(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertForbidden();
    }

    public function test_admin_user_can_access_admin_dashboard(): void
    {
        $user = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertOk();
    }

    public function test_admin_can_access_skills_management(): void
    {
        $user = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($user)->get('/admin/skills');

        $response->assertOk();
    }

    public function test_admin_can_access_projects_management(): void
    {
        $user = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($user)->get('/admin/projects');

        $response->assertOk();
    }

    public function test_admin_can_access_experience_management(): void
    {
        $user = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($user)->get('/admin/experience');

        $response->assertOk();
    }

    public function test_admin_can_access_education_management(): void
    {
        $user = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($user)->get('/admin/education');

        $response->assertOk();
    }

    public function test_admin_can_access_profile_editor(): void
    {
        $user = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($user)->get('/admin/profile');

        $response->assertOk();
    }

    // =============================
    // Livewire Component Tests
    // =============================

    public function test_contact_form_validates_required_fields(): void
    {
        $this->seedPortfolio();

        \Livewire\Livewire::test(\App\Livewire\Pub\ContactForm::class)
            ->call('send')
            ->assertHasErrors(['name', 'email', 'message']);
    }

    public function test_contact_form_submits_successfully(): void
    {
        $this->seedPortfolio();

        \Livewire\Livewire::test(\App\Livewire\Pub\ContactForm::class)
            ->set('name', 'Test User')
            ->set('email', 'test@example.com')
            ->set('message', 'This is a test message that is long enough.')
            ->call('send')
            ->assertHasNoErrors()
            ->assertSet('sent', true);
    }

    public function test_project_filter_displays_visible_projects(): void
    {
        $this->seedPortfolio();

        \Livewire\Livewire::test(\App\Livewire\Pub\ProjectFilter::class)
            ->assertSee('Test Project');
    }

    public function test_project_filter_searches_by_title(): void
    {
        $this->seedPortfolio();

        \Livewire\Livewire::test(\App\Livewire\Pub\ProjectFilter::class)
            ->set('search', 'NonExistentProject')
            ->assertDontSee('Test Project');
    }

    public function test_skills_manager_requires_admin(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $response = $this->actingAs($user)->get('/admin/skills');

        $response->assertForbidden();
    }
}
