<?php

namespace Database\Factories;

use App\Models\JobOffer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JobOffer>
 */
class JobOfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titlesEn = ['Software Engineer', 'Project Manager', 'DevOps Specialist', 'Data Scientist', 'Frontend Developer', 'Backend Architect'];
        $titlesEs = ['Ingeniero de Software', 'Gestor de Proyectos', 'Especialista DevOps', 'Científico de Datos', 'Desarrollador Frontend', 'Arquitecto Backend'];
        
        $locations = ['Remote', 'Madrid, ES', 'Barcelona, ES', 'Valencia, ES', 'Hybrid / Remote', 'London, UK', 'Berlin, DE'];
        $salaries = ['$40k - $60k', '$60k - $80k', '$80k - $120k', '€35k - €50k', '€50k - €75k'];

        return [
            'title' => [
                'en' => $this->faker->randomElement($titlesEn),
                'es' => $this->faker->randomElement($titlesEs),
            ],
            'description' => [
                'en' => "Role Overview\n\n" . $this->faker->paragraphs(4, true) . "\n\nKey Responsibilities\n\n- " . implode("\n- ", $this->faker->sentences(5)) . "\n\nRequirements & Skills\n\n" . $this->faker->paragraphs(3, true),
                'es' => "Resumen del Puesto\n\n" . $this->faker->paragraphs(4, true) . "\n\nResponsabilidades Clave\n\n- " . implode("\n- ", $this->faker->sentences(5)) . "\n\nRequisitos y Habilidades\n\n" . $this->faker->paragraphs(3, true),
            ],
            'location' => $this->faker->randomElement($locations),
            'salary_range' => $this->faker->randomElement($salaries),
            'status' => 'active',
            'created_by' => \App\Models\User::first()?->id ?? 1,
        ];
    }
}
