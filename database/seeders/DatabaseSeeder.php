<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // 1. Users & Roles
            UserSeeder::class,

            // 2. Master Data
            CategorySeeder::class,
            BankSeeder::class,

            // 3. User Banks (depends on User & Bank)
            UserBankSeeder::class,

            // 4. Campaigns (depends on User & Category)
            CampaignSeeder::class,

            // 5. Campaign Updates (depends on Campaign)
            CampaignUpdateSeeder::class,

            // 6. Comments (depends on CampaignUpdate & User)
            CommentSeeder::class,

            // 7. Donations (depends on Campaign & User)
            DonationSeeder::class,

            // 8. Payouts (depends on Campaign & User)
            PayoutSeeder::class,

            // 9. Withdraws (depends on Campaign, User, UserBank)
            WithdrawSeeder::class,

            // 10. Notifications (depends on all)
            NotificationSeeder::class,
        ]);
    }
}
