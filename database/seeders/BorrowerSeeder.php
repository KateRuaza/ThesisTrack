<?php

namespace Database\Seeders;

use App\Models\Borrower;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BorrowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $isFirstWarningSent = fake()->boolean();
            $isLastWarningSent = fake()->boolean();
            $createdAt = Carbon::now()->subDays(6);

            // first warning not sent, both warnings should null
            if (! $isFirstWarningSent) {
                $isFirstWarningSent = null;
                $isLastWarningSent = null;

            // first warning sent, last warning not sent
            } elseif ($isFirstWarningSent && ! $isLastWarningSent) {
                $isLastWarningSent = null;
                $createdAt = Carbon::now()->subDays(7);

            // first and last warnings sent
            } else {
                $createdAt = Carbon::now()->subDays(8);
            }

            Borrower::create([
                'name' => fake()->name(),
                'email' => fake()->email(),
                'contact_number' => fake()->phoneNumber(),
                'address' => fake()->address(),
                'thesis_name' => fake()->name(),
                'status' => 'active',
                'first_warning' => $isFirstWarningSent,
                'last_warning' => $isLastWarningSent,
                'created_at' => $createdAt,
            ]);
        }
    }
}
