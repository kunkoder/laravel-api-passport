<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\SuperAdmin;
use Tests\TestCase;

class SuperAdminTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testSuperAdminCreatedSuccessfully()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $superAdminData = [
            "name" => "Insani Nur",
            "company_name" => "Youtube",
            "year" => "2014",
            "company_headquarters" => "Depok",
            "what_company_does" => "Teaching alquran"
        ];

        $this->json('POST', 'api/superadmin', $superAdminData, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJson([
                "super_admin" => [
                    "name" => "Insani Nur",
                    "company_name" => "Youtube",
                    "year" => "2014",
                    "company_headquarters" => "Depok",
                    "what_company_does" => "Teaching alquran"
                ],
                "message" => "Created successfully"
            ]);
    }

    public function testSuperAdminListedSuccessfully()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        SuperAdmin::factory()->create([
            "name" => "Fahmi Nur",
            "company_name" => "Youtube",
            "year" => "2014",
            "company_headquarters" => "Leuwiliang",
            "what_company_does" => "Teaching computer"
        ]);
        SuperAdmin::factory()->create([
            "name" => "Noer Atni",
            "company_name" => "Youtube",
            "year" => "2014",
            "company_headquarters" => "Citeureup",
            "what_company_does" => "Teaching alquran"
        ]);

        $this->json('GET', 'api/superadmin', ['Accept' => 'applicatio/json'])
            ->assertStatus(200)
            ->assertJson([
                "super_admin" => [
                    [
                        "name" => "Fahmi Nur",
                        "company_name" => "Youtube",
                        "year" => "2014",
                        "company_headquarters" => "Leuwiliang",
                        "what_company_does" => "Teaching computer"
                    ],
                    [
                        "name" => "Noer Atni",
                        "company_name" => "Youtube",
                        "year" => "2014",
                        "company_headquarters" => "Citeureup",
                        "what_company_does" => "Teaching alquran"
                    ]
                ],
                "message" => "Retrieved successfully"
            ]);
    }

    public function testRetrieveSuperAdminSuccessfully()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        
        $superAdminData = SuperAdmin::factory()->create([
            "name" => "Noer Atni",
            "company_name" => "Youtube",
            "year" => "2014",
            "company_headquarters" => "Citeureup",
            "what_company_does" => "Teaching alquran"
        ]);

        $this->json('GET', 'api/superadmin/' . $superAdminData->id, [], ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "super_admin" => [
                    "name" => "Noer Atni",
                    "company_name" => "Youtube",
                    "year" => "2014",
                    "company_headquarters" => "Citeureup",
                    "what_company_does" => "Teaching alquran"
                ],
                "message" => "Retrieved successfully"
            ]);
    }

    public function testSuperAdminUpdateSuccessfully()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $superAdminData = SuperAdmin::factory()->create([
            "name" => "Noer Atni",
            "company_name" => "Youtube",
            "year" => "2014",
            "company_headquarters" => "Citeureup",
            "what_company_does" => "Teaching alquran"
        ]);

        $superAdminDataChanged = [
            "name" => "Pramudya Anantatour",
            "company_name" => "Youtube",
            "year" => "2014",
            "company_headquarters" => "Citeureup",
            "what_company_does" => "Teaching alquran"
        ];

        $this->json('PATCH', 'api/superadmin/' . $superAdminData->id, $superAdminDataChanged,
            ['Accept', 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "super_admin" => [
                    "name" => "Pramudya Anantatour",
                    "company_name" => "Youtube",
                    "year" => "2014",
                    "company_headquarters" => "Citeureup",
                    "what_company_does" => "Teaching alquran"
                ],
                "message" => "Updated successfully"
            ]);
    }

    public function testDeleteSuperAdmin()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $superAdminData = SuperAdmin::factory()->create([
            "name" => "Pramudya Anantatour",
            "company_name" => "Youtube",
            "year" => "2014",
            "company_headquarters" => "Citeureup",
            "what_company_does" => "Teaching alquran"
        ]);

        $this->json('DELETE', 'api/superadmin/' . $superAdminData->id, ['Accept' => 'application/json'])
            ->assertStatus(204);
    }
}
