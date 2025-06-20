<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipo>
 */
class EquipoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word(),
            'descripcion' => $this->faker->sentence(),
            'marca' => $this->faker->word(),
            'tipo_equipo' => $this->faker->word(),
            'estado' => $this->faker->randomElement(['Nuevo', 'Usado', 'Reparado']),
            'ubicacion' => $this->faker->city(),
            'responsable' => $this->faker->name(),
        ];
    }
}
