<?php

namespace Database\Factories\Servicos;

use App\Models\Servicos\Servicos;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ServicosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Servicos::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cliente_id' => $this->faker->numberBetween(1,10),
            'valor'=> $this->faker->numberBetween(5,50), 
            'pago'=> $this->faker->numberBetween(0,1), 
            'servico'=> Str::random(15),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ];
    }
}
