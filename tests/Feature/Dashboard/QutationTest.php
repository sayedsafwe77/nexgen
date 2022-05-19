<?php

namespace Tests\Feature\Dashboard;

use Tests\TestCase;
use App\Models\Qutation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QutationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_a_list_of_qutations()
    {
        $this->actingAsAdmin();

        Qutation::factory()->create(['name' => 'Foo']);

        $this->get(route('dashboard.qutations.index'))
            ->assertSuccessful()
            ->assertSee('Foo');
    }

    /** @test */
    public function it_can_display_the_qutation_details()
    {
        $this->actingAsAdmin();

        $qutation = Qutation::factory()->create(['name' => 'Foo']);

        $this->get(route('dashboard.qutations.show', $qutation))
            ->assertSuccessful()
            ->assertSee('Foo');
    }

    /** @test */
    public function it_can_display_qutations_create_form()
    {
        $this->actingAsAdmin();

        $this->get(route('dashboard.qutations.create'))
            ->assertSuccessful();
    }

    /** @test */
    public function it_can_create_a_new_qutation()
    {
        $this->actingAsAdmin();

        $qutationsCount = Qutation::count();

        $response = $this->post(
            route('dashboard.qutations.store'),
            Qutation::factory()->raw([
                'name' => 'Foo'
            ])
        );

        $response->assertRedirect();

        $qutation = Qutation::all()->last();

        $this->assertEquals(Qutation::count(), $qutationsCount + 1);

        $this->assertEquals($qutation->name, 'Foo');
    }

    /** @test */
    public function it_can_display_the_qutations_edit_form()
    {
        $this->actingAsAdmin();

        $qutation = Qutation::factory()->create();

        $this->get(route('dashboard.qutations.edit', $qutation))
            ->assertSuccessful();
    }

    /** @test */
    public function it_can_update_the_qutation()
    {
        $this->actingAsAdmin();

        $qutation = Qutation::factory()->create();

        $response = $this->put(
            route('dashboard.qutations.update', $qutation),
            Qutation::factory()->raw([
                'name' => 'Foo'
            ])
        );

        $qutation->refresh();

        $response->assertRedirect();

        $this->assertEquals($qutation->name, 'Foo');
    }

    /** @test */
    public function it_can_delete_the_qutation()
    {
        $this->actingAsAdmin();

        $qutation = Qutation::factory()->create();

        $qutationsCount = Qutation::count();

        $response = $this->delete(route('dashboard.qutations.destroy', $qutation));

        $response->assertRedirect();

        $this->assertEquals(Qutation::count(), $qutationsCount - 1);
    }

    /** @test */
    public function it_can_filter_qutations_by_name()
    {
        $this->actingAsAdmin();

        Qutation::factory()->create([
            'name' => 'Foo',
        ]);

        Qutation::factory()->create([
            'name' => 'Bar',
        ]);

        $this->get(route('dashboard.qutations.index', [
            'name' => 'Fo',
        ]))
            ->assertSuccessful()
            ->assertSee(trans('qutations.filter'))
            ->assertSee('Foo')
            ->assertDontSee('Bar');
    }
}
