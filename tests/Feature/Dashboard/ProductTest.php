<?php

namespace Tests\Feature\Dashboard;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Astrotomic\Translatable\Validation\RuleFactory;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_a_list_of_products()
    {
        $this->actingAsAdmin();

        Product::factory()->create(['name' => 'Foo']);

        $this->get(route('dashboard.products.index'))
            ->assertSuccessful()
            ->assertSee('Foo');
    }

    /** @test */
    public function it_can_display_the_product_details()
    {
        $this->actingAsAdmin();

        $product = Product::factory()->create(['name' => 'Foo']);

        $this->get(route('dashboard.products.show', $product))
            ->assertSuccessful()
            ->assertSee('Foo');
    }

    /** @test */
    public function it_can_display_products_create_form()
    {
        $this->actingAsAdmin();

        $this->get(route('dashboard.products.create'))
            ->assertSuccessful();
    }

    /** @test */
    public function it_can_create_a_new_product()
    {
        $this->actingAsAdmin();

        $productsCount = Product::count();

        $response = $this->post(
            route('dashboard.products.store'),
            Product::factory()->raw(
                RuleFactory::make([
                    '%name%' => 'Foo',
                ])
            )
        );

        $response->assertRedirect();

        $product = Product::all()->last();

        $this->assertEquals(Product::count(), $productsCount + 1);

        $this->assertEquals($product->name, 'Foo');
    }

    /** @test */
    public function it_can_display_the_products_edit_form()
    {
        $this->actingAsAdmin();

        $product = Product::factory()->create();

        $this->get(route('dashboard.products.edit', $product))
            ->assertSuccessful();
    }

    /** @test */
    public function it_can_update_the_product()
    {
        $this->actingAsAdmin();

        $product = Product::factory()->create();

        $response = $this->put(
            route('dashboard.products.update', $product),
            Product::factory()->raw(
                RuleFactory::make([
                    '%name%' => 'Foo',
                ])
            )
        );

        $product->refresh();

        $response->assertRedirect();

        $this->assertEquals($product->name, 'Foo');
    }

    /** @test */
    public function it_can_delete_the_product()
    {
        $this->actingAsAdmin();

        $product = Product::factory()->create();

        $productsCount = Product::count();

        $response = $this->delete(route('dashboard.products.destroy', $product));

        $response->assertRedirect();

        $this->assertEquals(Product::count(), $productsCount - 1);
    }

    /** @test */
    public function it_can_filter_products_by_name()
    {
        $this->actingAsAdmin();

        Product::factory()->create([
            'name' => 'Foo',
        ]);

        Product::factory()->create([
            'name' => 'Bar',
        ]);

        $this->get(route('dashboard.products.index', [
            'name' => 'Fo',
        ]))
            ->assertSuccessful()
            ->assertSee(trans('products.filter'))
            ->assertSee('Foo')
            ->assertDontSee('Bar');
    }
}
