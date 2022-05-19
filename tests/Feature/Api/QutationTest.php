<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Qutation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QutationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_all_qutations()
    {
        $this->actingAsAdmin();

        Qutation::factory()->count(2)->create();

        $this->getJson(route('api.qutations.index'))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                    ],
                ],
            ]);
    }

    /** @test */
    public function test_qutations_select2_api()
    {
        Qutation::factory()->count(5)->create();

        $response = $this->getJson(route('api.qutations.select'))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'text'],
                ],
            ]);

        $this->assertEquals($response->json('data.0.id'), 1);

        $this->assertCount(5, $response->json('data'));

        $response = $this->getJson(route('api.qutations.select', ['selected_id' => 4]))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'text'],
                ],
            ]);

        $this->assertEquals($response->json('data.0.id'), 4);

        $this->assertCount(5, $response->json('data'));
    }

    /** @test */
    public function it_can_display_the_qutation_details()
    {
        $this->actingAsAdmin();

        $qutation = Qutation::factory(['name' => 'Foo'])->create();

        $response = $this->getJson(route('api.qutations.show', $qutation))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                ],
            ]);

        $this->assertEquals($response->json('data.name'), 'Foo');
    }
}
