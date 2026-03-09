<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as FacadesDB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [

            ['name'=>'Andhra Pradesh','slug'=>'andhra-pradesh','code'=>'AP','iso_code'=>'IN-AP','capital'=>'Amaravati','latitude'=>15.9129,'longitude'=>79.7400,'type'=>'state'],
            ['name'=>'Arunachal Pradesh','slug'=>'arunachal-pradesh','code'=>'AR','iso_code'=>'IN-AR','capital'=>'Itanagar','latitude'=>28.2180,'longitude'=>94.7278,'type'=>'state'],
            ['name'=>'Assam','slug'=>'assam','code'=>'AS','iso_code'=>'IN-AS','capital'=>'Dispur','latitude'=>26.2006,'longitude'=>92.9376,'type'=>'state'],
            ['name'=>'Bihar','slug'=>'bihar','code'=>'BR','iso_code'=>'IN-BR','capital'=>'Patna','latitude'=>25.5941,'longitude'=>85.1376,'type'=>'state'],
            ['name'=>'Chhattisgarh','slug'=>'chhattisgarh','code'=>'CG','iso_code'=>'IN-CG','capital'=>'Raipur','latitude'=>21.2787,'longitude'=>81.8661,'type'=>'state'],
            ['name'=>'Goa','slug'=>'goa','code'=>'GA','iso_code'=>'IN-GA','capital'=>'Panaji','latitude'=>15.2993,'longitude'=>74.1240,'type'=>'state'],
            ['name'=>'Gujarat','slug'=>'gujarat','code'=>'GJ','iso_code'=>'IN-GJ','capital'=>'Gandhinagar','latitude'=>22.2587,'longitude'=>71.1924,'type'=>'state'],
            ['name'=>'Haryana','slug'=>'haryana','code'=>'HR','iso_code'=>'IN-HR','capital'=>'Chandigarh','latitude'=>29.0588,'longitude'=>76.0856,'type'=>'state'],
            ['name'=>'Himachal Pradesh','slug'=>'himachal-pradesh','code'=>'HP','iso_code'=>'IN-HP','capital'=>'Shimla','latitude'=>31.1048,'longitude'=>77.1734,'type'=>'state'],
            ['name'=>'Jharkhand','slug'=>'jharkhand','code'=>'JH','iso_code'=>'IN-JH','capital'=>'Ranchi','latitude'=>23.6102,'longitude'=>85.2799,'type'=>'state'],
            ['name'=>'Karnataka','slug'=>'karnataka','code'=>'KA','iso_code'=>'IN-KA','capital'=>'Bengaluru','latitude'=>15.3173,'longitude'=>75.7139,'type'=>'state'],
            ['name'=>'Kerala','slug'=>'kerala','code'=>'KL','iso_code'=>'IN-KL','capital'=>'Thiruvananthapuram','latitude'=>10.8505,'longitude'=>76.2711,'type'=>'state'],
            ['name'=>'Madhya Pradesh','slug'=>'madhya-pradesh','code'=>'MP','iso_code'=>'IN-MP','capital'=>'Bhopal','latitude'=>22.9734,'longitude'=>78.6569,'type'=>'state'],
            ['name'=>'Maharashtra','slug'=>'maharashtra','code'=>'MH','iso_code'=>'IN-MH','capital'=>'Mumbai','latitude'=>19.7515,'longitude'=>75.7139,'type'=>'state'],
            ['name'=>'Manipur','slug'=>'manipur','code'=>'MN','iso_code'=>'IN-MN','capital'=>'Imphal','latitude'=>24.6637,'longitude'=>93.9063,'type'=>'state'],
            ['name'=>'Meghalaya','slug'=>'meghalaya','code'=>'ML','iso_code'=>'IN-ML','capital'=>'Shillong','latitude'=>25.4670,'longitude'=>91.3662,'type'=>'state'],
            ['name'=>'Mizoram','slug'=>'mizoram','code'=>'MZ','iso_code'=>'IN-MZ','capital'=>'Aizawl','latitude'=>23.1645,'longitude'=>92.9376,'type'=>'state'],
            ['name'=>'Nagaland','slug'=>'nagaland','code'=>'NL','iso_code'=>'IN-NL','capital'=>'Kohima','latitude'=>26.1584,'longitude'=>94.5624,'type'=>'state'],
            ['name'=>'Odisha','slug'=>'odisha','code'=>'OD','iso_code'=>'IN-OD','capital'=>'Bhubaneswar','latitude'=>20.9517,'longitude'=>85.0985,'type'=>'state'],
            ['name'=>'Punjab','slug'=>'punjab','code'=>'PB','iso_code'=>'IN-PB','capital'=>'Chandigarh','latitude'=>31.1471,'longitude'=>75.3412,'type'=>'state'],
            ['name'=>'Rajasthan','slug'=>'rajasthan','code'=>'RJ','iso_code'=>'IN-RJ','capital'=>'Jaipur','latitude'=>27.0238,'longitude'=>74.2179,'type'=>'state'],
            ['name'=>'Sikkim','slug'=>'sikkim','code'=>'SK','iso_code'=>'IN-SK','capital'=>'Gangtok','latitude'=>27.5330,'longitude'=>88.5122,'type'=>'state'],
            ['name'=>'Tamil Nadu','slug'=>'tamil-nadu','code'=>'TN','iso_code'=>'IN-TN','capital'=>'Chennai','latitude'=>11.1271,'longitude'=>78.6569,'type'=>'state'],
            ['name'=>'Telangana','slug'=>'telangana','code'=>'TG','iso_code'=>'IN-TG','capital'=>'Hyderabad','latitude'=>18.1124,'longitude'=>79.0193,'type'=>'state'],
            ['name'=>'Tripura','slug'=>'tripura','code'=>'TR','iso_code'=>'IN-TR','capital'=>'Agartala','latitude'=>23.9408,'longitude'=>91.9882,'type'=>'state'],
            ['name'=>'Uttar Pradesh','slug'=>'uttar-pradesh','code'=>'UP','iso_code'=>'IN-UP','capital'=>'Lucknow','latitude'=>26.8467,'longitude'=>80.9462,'type'=>'state'],
            ['name'=>'Uttarakhand','slug'=>'uttarakhand','code'=>'UK','iso_code'=>'IN-UK','capital'=>'Dehradun','latitude'=>30.0668,'longitude'=>79.0193,'type'=>'state'],
            ['name'=>'West Bengal','slug'=>'west-bengal','code'=>'WB','iso_code'=>'IN-WB','capital'=>'Kolkata','latitude'=>22.9868,'longitude'=>87.8550,'type'=>'state'],

            // Union Territories
            ['name'=>'Delhi','slug'=>'delhi','code'=>'DL','iso_code'=>'IN-DL','capital'=>'New Delhi','latitude'=>28.6139,'longitude'=>77.2090,'type'=>'union_territory'],
            ['name'=>'Chandigarh','slug'=>'chandigarh','code'=>'CH','iso_code'=>'IN-CH','capital'=>'Chandigarh','latitude'=>30.7333,'longitude'=>76.7794,'type'=>'union_territory'],
            ['name'=>'Andaman and Nicobar Islands','slug'=>'andaman-and-nicobar-islands','code'=>'AN','iso_code'=>'IN-AN','capital'=>'Port Blair','latitude'=>11.6234,'longitude'=>92.7265,'type'=>'union_territory'],
            ['name'=>'Lakshadweep','slug'=>'lakshadweep','code'=>'LD','iso_code'=>'IN-LD','capital'=>'Kavaratti','latitude'=>10.5667,'longitude'=>72.6417,'type'=>'union_territory'],
            ['name'=>'Puducherry','slug'=>'puducherry','code'=>'PY','iso_code'=>'IN-PY','capital'=>'Puducherry','latitude'=>11.9416,'longitude'=>79.8083,'type'=>'union_territory'],
            ['name'=>'Ladakh','slug'=>'ladakh','code'=>'LA','iso_code'=>'IN-LA','capital'=>'Leh','latitude'=>34.1526,'longitude'=>77.5771,'type'=>'union_territory'],
            ['name'=>'Jammu and Kashmir','slug'=>'jammu-and-kashmir','code'=>'JK','iso_code'=>'IN-JK','capital'=>'Srinagar','latitude'=>34.0837,'longitude'=>74.7973,'type'=>'union_territory'],
            ['name'=>'Dadra and Nagar Haveli and Daman and Diu','slug'=>'dadra-and-nagar-haveli-and-daman-and-diu','code'=>'DN','iso_code'=>'IN-DN','capital'=>'Daman','latitude'=>20.4283,'longitude'=>72.8397,'type'=>'union_territory'],
            ];

        FacadesDB::table('states')->insert($states);
    }
}
