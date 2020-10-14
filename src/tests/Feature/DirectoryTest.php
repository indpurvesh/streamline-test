<?php

namespace Tests\Feature;

use App\Models\Directory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DirectoryTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * 
     *
     * @return void
     */
    public function testDirectoryRouteIndex()
    {
        $response = $this->createUser()
            ->actingAs($this->user)
            ->get('/directory');

        $response->assertStatus(200)
            ->assertViewIs('directory.index');
    }

    /**
     * 
     *
     * @return void
     */
    public function testDirectoryRouteCreate()
    {
        $response = $this->createUser()
            ->actingAs($this->user)
            ->get('/directory/create');

        $response->assertStatus(200)
            ->assertViewIs('directory.create');
    }

    /**
     * 
     *
     * @return void
     */
    public function testDirectoryRouteStore()
    {
        $this->createUser();
        $data = Directory::factory(1)->make(['name' => 'test directory name'])->first()->toArray();
        $data['user_id'] = $this->user->id;
     
        $response = $this->actingAs($this->user)
            ->post('/directory', $data);

        $this->assertDatabaseHas('directories', ['name' => 'test directory name']);
    }

    /**
     * 
     *
     * @return void
     */
    public function testDirectoryRouteEdit()
    {
        $this->createUser();
        $data = Directory::factory(1)->create([
            'name' => 'test directory name',
            'user_id' => $this->user->id])
            ->first();
        
       
        $response = $this->actingAs($this->user)
            ->get(route('directory.edit', $data->id));

        $response->assertStatus(200)
            ->assertViewIs('directory.edit');
    }
    /**
     * 
     *
     * @return void
     */
    public function testDirectoryRouteUpdate()
    {
        $this->createUser();
        $data = Directory::factory(1)->create([
            'name' => 'test directory name',
            'user_id' => $this->user->id])
            ->first();
        
        $data->name = 'updated directory name';
       
        $this->actingAs($this->user)
            ->put(route('directory.update', $data->id), $data->toArray());

        $this->assertDatabaseHas('directories', ['name' => 'updated directory name']);
    }
    /**
     * 
     *
     * @return void
     */
    public function testDirectoryRouteDestroy()
    {
        $this->createUser();
        $data = Directory::factory(1)->create([
            'name' => 'test directory name',
            'user_id' => $this->user->id])
            ->first();
        
       
        $this->actingAs($this->user)
            ->delete(route('directory.destroy', $data->id));

        $this->assertDatabaseMissing('directories', ['id' => $data->id]);
    }
   
}
