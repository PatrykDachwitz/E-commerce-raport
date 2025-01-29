<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HistoryReport>
 */
class HistoryReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    const REPORT_NAMES = [
        'comparison-day',
        'result-day',
        'result-week',
    ];
    private function getRandomType() : string {
        return self::REPORT_NAMES[
            array_rand(self::REPORT_NAMES)
            ];
    }

    public function definition(): array
    {
        $date = fake()->date('Y-m-d');
        return [
            'date' => $date,
            'name' => $date,
            'type' => $this->getRandomType()
        ];
    }
}
