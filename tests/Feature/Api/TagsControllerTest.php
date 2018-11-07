<?php

namespace Tests\Feature\Api;

use App\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

/**
 * TODO
 * Class TagControllerTest.
 *
 * @package Tests\Feature\Api
 */
class TagsControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;
    /**
     * @test
     */
    public function can_show_a_tag()
    {
        $this->withoutExceptionHandling();
        $this->login('api');
        $tag = factory(Tag::class)->create();

        $response = $this->json('GET','/api/v1/tags/' . $tag->id);

        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals($tag->name, $result->name);
        $this->assertEquals($tag->description, $result->description);
        $this->assertEquals($tag->color, $result->color);
    }

    /**
     * @test
     */
    public function can_delete_tag()
    {
        $this->login('api');
        $tag = factory(Tag::class)->create();

        $response = $this->json('DELETE','/api/v1/tags/' . $tag->id);

        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals('', $result);

        $this->assertNull(Tag::find($tag->id));
    }

    /**
     * @test
     */
    public function cannot_create_tags_without_name()
    {
        $this->login('api');

        $response = $this->json('POST','/api/v1/tags/',[
            'name' => ''
        ]);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function can_create_tag()
    {
        $this->withoutExceptionHandling();
        $this->login('api');
        $response = $this->json('POST','/api/v1/tags/',[
            'name' => 'Homework',
            'description' => 'Bla bla bla',
            'color' => '#345678'
        ]);

        $result = json_decode($response->getContent());
        $response->assertSuccessful();

//        $this->assertDatabaseHas('tags', [ 'name' => 'Comprar pa' ]);
        $this->assertNotNull($tag = Tag::find($result->id));
        $this->assertEquals('Homework',$result->name);
        $this->assertEquals('Bla bla bla',$result->description);
        $this->assertEquals('#345678',$result->color);
    }

    /**
     * @test
     */
    public function can_list_tags()
    {
        $this->login('api');

        create_example_tags();

        $response = $this->json('GET','/api/v1/tags');
        $response->assertSuccessful();

        $result = json_decode($response->getContent());

        $this->assertCount(3,$result);

        $this->assertEquals('Tag1', $result[0]->name);
        $this->assertEquals('Bla bla bla', $result[0]->description);
        $this->assertEquals('#123456', $result[0]->color);

        $this->assertEquals('Tag2', $result[1]->name);
        $this->assertEquals('Bla bla bla', $result[1]->description);
        $this->assertEquals('#123456', $result[1]->color);

        $this->assertEquals('Tag3', $result[2]->name);
        $this->assertEquals('Bla bla bla', $result[2]->description);
        $this->assertEquals('#123456', $result[2]->color);

    }

    /**
     * @test
     */
    public function can_edit_tag()
    {
        $this->login('api');

        $oldTag = factory(Tag::class)->create([
            'name' => 'Tag1'
        ]);

        // 2
        $response = $this->json('PUT','/api/v1/tags/' . $oldTag->id, [
            'name' => 'Tag2',
            'description' => 'JORL',
            'color' => '#123456'
        ]);

        $result = json_decode($response->getContent());
        $response->assertSuccessful();

        $newTag = $oldTag->refresh();
        $this->assertNotNull($newTag);
        $this->assertEquals('Tag2',$result->name);
        $this->assertFalse((boolean) $newTag->completed);
    }

    /**
     * @test
     */
    public function cannot_edit_tag_without_name()
    {
        $this->login('api');

        $oldTag = factory(Tag::class)->create();
        $response = $this->json('PUT','/api/v1/tags/' . $oldTag->id, [
            'name' => ''
        ]);

        $response->assertStatus(422);
    }
}
