<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactsTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    /** @test */
    public function an_unauthenticated_user_should_be_redirected_to_login()
    {
        $response = $this->post('/api/contacts', array_merge($this->data(), ['api_token' => '']));

        $response->assertRedirect('/login');
        $this->assertCount(0, Contact::all());
    }

    private function data()
    {
        return [
            'name' => 'Test Name',
            'email' => 'test@email.com',
            'birthday' => '05/14/1988',
            'company' => 'ABC String',
            'api_token' => $this->user->api_token,
        ];
    }

    /** @test */
    public function a_list_of_contacts_can_be_fetched_for_the_authenticated_user()
    {
        // $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $anotherUser = User::factory()->create();

        $contact = Contact::factory()->create([
            'user_id' => $user->id
        ]);

        $anotherContact = Contact::factory()->create([
            'user_id' => $anotherUser->id
        ]);

        $response = $this->get('/api/contacts?api_token=' .$user->api_token);
        $response->assertJsonCount(1)
            ->assertJson([['id' => $contact->id]]);
    }

    /** @test */
    public function an_authenticated_user_can_add_a_contact()
    {

        $this->post('/api/contacts', $this->data());

        $contact = Contact::first();

        $this->assertEquals('Test Name', $contact->name);
        $this->assertEquals('test@email.com', $contact->email);
        $this->assertInstanceOf(Carbon::class, Contact::first()->birthday);
        $this->assertEquals('05/14/1988', Contact::first()->birthday->format('m/d/Y'));
        $this->assertEquals('ABC String', $contact->company);
    }

    /** @test */
    public function fields_are_required()
    {
        foreach (['name', 'email', 'birthday', 'company'] as $field) {
            $response = $this->post(
                '/api/contacts',
                array_merge($this->data(), [$field => ''])
            );

            $response->assertSessionHasErrors($field);
            $this->assertCount(0, Contact::all());
        }
    }

    /** @test */
    public function email_must_be_a_valid_email()
    {
        $response = $this->post(
            '/api/contacts',
            array_merge($this->data(), ['email' => 'NOT AN EMAIL'])
        );

        $response->assertSessionHasErrors('email');
        $this->assertCount(0, Contact::all());
    }

    /** @test */
    public function birthdays_are_properly_stored()
    {
        $response = $this->post('/api/contacts', $this->data());

        $this->assertCount(1, Contact::all());
        $this->assertInstanceOf(Carbon::class, Contact::first()->birthday);
        $this->assertEquals('05-14-1988', Contact::first()->birthday->format('m-d-Y'));
    }

    /** @test */
    public function an_authenticated_user_can_retrieve_a_contact()
    {
        $contact = Contact::factory()->create();

        $response = $this->get('/api/contacts/'.$contact->id.'?api_token='.$this->user->api_token);

        $response->assertJsonFragment(
            [
                'name' => $contact->name,
                'email' => $contact->email,
                'birthday' => $contact->birthday,
                'company' => $contact->company,
            ]
        );
    }

    /** @test */
    public function an_authenticated_user_can_patch_a_contact()
    {
        $this->withoutExceptionHandling();
        $contact = Contact::factory()->create();

        $response = $this->put('/api/contacts/'.$contact->id, $this->data());

        $contact = $contact->fresh();

        $this->assertEquals('Test Name', $contact->name);
        $this->assertEquals('test@email.com', $contact->email);
        $this->assertInstanceOf(Carbon::class, Contact::first()->birthday);
        $this->assertEquals('05/14/1988', Contact::first()->birthday->format('m/d/Y'));
        $this->assertEquals('ABC String', $contact->company);
    }

    /** @test */
    public function an_authenticated_user_can_delete_a_contact()
    {
        $contact = Contact::factory()->create();

        $response = $this->delete(
            '/api/contacts/'.$contact->id,
            ['api_token' => $this->user->api_token]
        );

        $this->assertCount(0, Contact::all());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

    }
}
