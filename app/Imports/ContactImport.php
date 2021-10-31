<?php

namespace App\Imports;

use App\Contacts;
use App\Notification;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ContactImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $i=0;
        $count = 0;
        foreach ($rows as $row) {
            if($i > 0) {
                $contact = Contacts::where('mobile_number', $row[1]);
                if ($contact->count() <= 0) {
                    Contacts::create([
                        'name' => $row[0],
                        'mobile_number' => $row[1],
                        'user_id' => auth()->user()->id
                    ]);
                $count++;
                }
            }
            $i++;
        }
        Notification::create([
            'title' => 'Imported ' .$count .' contacts',
            'description' => 'Imported ' .$count .' contacts',
            'user_id' => auth()->user()->id
            ]);
    }
}
