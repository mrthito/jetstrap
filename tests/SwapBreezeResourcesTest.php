<?php


namespace MrThito\Jetstrap\Tests;


use Illuminate\Filesystem\Filesystem;
use MrThito\Jetstrap\JetstrapFacade;

class SwapBreezeResourcesTest extends TestCase
{
    protected $filesystem;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->filesystem = new Filesystem();
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    protected function tearDown(): void
    {
        $this->cleanResourceDirectory(new Filesystem);
    }

    /** @test */
    public function breeze_swapped()
    {
        // Run the make command
        $this->artisan('jetstrap:swap breeze')
            ->expectsOutput('Breeze scaffolding swapped successfully.')
            ->expectsOutput('Please execute the "npm install && npm run dev" command to build your assets.')
            ->assertExitCode(0);

        $this->basicTests();
    }

    /** @test */
    public function breeze_inertia_swapped()
    {
        // Run the make command
        $this->artisan('jetstrap:swap breeze-inertia')
            ->expectsOutput('Breeze scaffolding swapped successfully.')
            ->expectsOutput('Please execute the "npm install && npm run dev" command to build your assets.')
            ->assertExitCode(0);

        $this->basicTests();
    }

    /** @test */
    public function breeze_admin_lte_swapped()
    {
        JetstrapFacade::useAdminLte3();

        // Run the make command
        $this->artisan('jetstrap:swap breeze')
            ->expectsOutput('Breeze scaffolding swapped successfully.')
            ->expectsOutput('Please execute the "npm install && npm run dev" command to build your assets.')
            ->assertExitCode(0);

        $this->basicTests();
    }

    /** @test */
    public function breeze_inertia_admin_lte_swapped()
    {
        JetstrapFacade::useAdminLte3();

        // Run the make command
        $this->artisan('jetstrap:swap breeze-inertia')
            ->expectsOutput('Breeze scaffolding swapped successfully.')
            ->expectsOutput('Please execute the "npm install && npm run dev" command to build your assets.')
            ->assertExitCode(0);

        $this->basicTests();
    }

    /** @test */
    public function breeze_core_ui_swapped()
    {
        JetstrapFacade::useCoreUi3();

        // Run the make command
        $this->artisan('jetstrap:swap breeze')
            ->expectsOutput('Breeze scaffolding swapped successfully.')
            ->expectsOutput('Please execute the "npm install && npm run dev" command to build your assets.')
            ->assertExitCode(0);

        $this->basicTests();
    }

    /** @test */
    public function breeze_inertia_core_ui_swapped()
    {
        JetstrapFacade::useCoreUi3();

        // Run the make command
        $this->artisan('jetstrap:swap breeze-inertia')
            ->expectsOutput('Breeze scaffolding swapped successfully.')
            ->expectsOutput('Please execute the "npm install && npm run dev" command to build your assets.')
            ->assertExitCode(0);

        $this->basicTests();
    }

    /**
     * Remove files generated by Jetstrap
     *
     * @param Filesystem $filesystem
     * @return void
     */
    protected function cleanResourceDirectory(Filesystem $filesystem)
    {
        if ($filesystem->exists(base_path('webpack.mix.js'))) {
            unlink(base_path('webpack.mix.js'));
        }
        if ($filesystem->isDirectory(resource_path('views/auth'))) {
            $filesystem->deleteDirectory(resource_path('views/auth'));
        }
        if ($filesystem->isDirectory(resource_path('views/layouts'))) {
            $filesystem->deleteDirectory(resource_path('views/layouts'));
        }
        if ($filesystem->isDirectory(base_path('public/css'))) {
            $filesystem->deleteDirectory(base_path('public/css'));
        }
        if ($filesystem->isDirectory(resource_path('sass'))) {
            $filesystem->deleteDirectory(resource_path('sass'));
        }
    }

    /**
     * Basic tests shared across all methods
     *
     * @return void
     */
    protected function basicTests()
    {
        $this->assertFalse($this->filesystem->exists(base_path('tailwind.config.js')));
        $this->assertFalse($this->filesystem->exists(resource_path('css')));
        $this->assertTrue($this->filesystem->exists(base_path('webpack.mix.js')));

        $this->assertTrue($this->filesystem->exists(resource_path('views/components/application-logo.blade.php')));
        $this->assertTrue($this->filesystem->exists(resource_path('views/components/auth-session-status.blade.php')));
        $this->assertTrue($this->filesystem->exists(resource_path('views/components/auth-card.blade.php')));
        $this->assertTrue($this->filesystem->exists(resource_path('views/components/auth-validation-errors.blade.php')));
        $this->assertTrue($this->filesystem->exists(resource_path('views/components/button.blade.php')));
        $this->assertTrue($this->filesystem->exists(resource_path('views/components/checkbox.blade.php')));
        $this->assertTrue($this->filesystem->exists(resource_path('views/components/dropdown.blade.php')));
        $this->assertTrue($this->filesystem->exists(resource_path('views/components/dropdown-link.blade.php')));
        $this->assertTrue($this->filesystem->exists(resource_path('views/components/input.blade.php')));
        $this->assertTrue($this->filesystem->exists(resource_path('views/components/input-error.blade.php')));
        $this->assertTrue($this->filesystem->exists(resource_path('views/components/label.blade.php')));
        $this->assertTrue($this->filesystem->exists(resource_path('views/components/nav-link.blade.php')));
        $this->assertTrue($this->filesystem->exists(resource_path('views/welcome.blade.php')));
        $this->assertTrue($this->filesystem->exists(resource_path('views/dashboard.blade.php')));
    }
}