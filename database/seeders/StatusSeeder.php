<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;
use Ramsey\Uuid\Uuid;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = new Status;
        $status->external_id = Uuid::uuid4();
        $status->title = 'Open';
        $status->module_type = 'Basics';
        $status->color = '#2FA599';
        $status->save();

        $status = new Status;
        $status->external_id = Uuid::uuid4();
        $status->title = 'In-progress';
        $status->module_type = 'Basics';
        $status->color = '#2FA55E';
        $status->save();

        $status = new Status;
        $status->external_id = Uuid::uuid4();
        $status->title = 'Pending';
        $status->module_type = 'Basics';
        $status->color = '#EFAC57';
        $status->save();

        $status = new Status;
        $status->external_id = Uuid::uuid4();
        $status->title = 'Waiting client';
        $status->module_type = 'Basics';
        $status->color = '#60C0DC';
        $status->save();

        $status = new Status;
        $status->external_id = Uuid::uuid4();
        $status->title = 'Blocked';
        $status->module_type = 'Basics';
        $status->color = '#E6733E';
        $status->save();

        $status = new Status;
        $status->external_id = Uuid::uuid4();
        $status->title = 'Closed';
        $status->module_type = 'Basics';
        $status->color = '#D75453';
        $status->save();

        $status = new Status;
        $status->external_id = Uuid::uuid4();
        $status->title = 'Open';
        $status->module_type = 'Audi';
        $status->color = '#2FA599';
        $status->save();

        $status = new Status;
        $status->external_id = Uuid::uuid4();
        $status->title = 'Pending';
        $status->module_type = 'Audi';
        $status->color = '#EFAC57';
        $status->save();

        $status = new Status;
        $status->external_id = Uuid::uuid4();
        $status->title = 'Waiting client';
        $status->module_type = 'Audi';
        $status->color = '#60C0DC';
        $status->save();

        $status = new Status;
        $status->external_id = Uuid::uuid4();
        $status->title = 'Closed';
        $status->module_type = 'Audi';
        $status->color = '#D75453';
        $status->save();

        $status = new Status;
        $status->external_id = Uuid::uuid4();
        $status->title = 'Open';
        $status->module_type = 'Orders';
        $status->color = '#2FA599';
        $status->save();

        $status = new Status;
        $status->external_id = Uuid::uuid4();
        $status->title = 'In-progress';
        $status->module_type = 'Orders';
        $status->color = '#3CA3BA';
        $status->save();

        $status = new Status;
        $status->external_id = Uuid::uuid4();
        $status->title = 'Blocked';
        $status->module_type = 'Orders';
        $status->color = '#60C0DC';
        $status->save();

        $status = new Status;
        $status->external_id = Uuid::uuid4();
        $status->title = 'Cancelled';
        $status->module_type = 'Orders';
        $status->color = '#821414';
        $status->save();

        $status = new Status;
        $status->external_id = Uuid::uuid4();
        $status->title = 'Completed';
        $status->module_type = 'Orders';
        $status->color = '#D75453';
        $status->save();
    }
}
