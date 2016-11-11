<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class FoodstandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('foodstands')->insert([
            [
                'name' => 'Mr Beenham',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum a nunc elementum, auctor est vitae, pharetra purus. Nulla lobortis massa ipsum, vitae congue elit dictum ut. Nunc dui metus, aliquet quis enim eget, euismod convallis ante. Sed accumsan neque in convallis varius. Curabitur maximus purus odio, et dignissim nunc dignissim in. Nulla risus lectus, dapibus a pellentesque vitae, consectetur sed tortor. Maecenas semper non erat non tristique.',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Roll or Bowl',
                'description' => 'Aliquam erat volutpat. Maecenas tristique tellus mollis urna accumsan sodales. Suspendisse sagittis sagittis felis id consectetur. Curabitur diam purus, laoreet eu massa ut, egestas ultricies nunc. Nulla euismod leo ex, eget malesuada nulla ultricies vel. Vestibulum id quam quis mauris varius maximus. Proin finibus cursus odio ac molestie. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas ut felis lorem. Sed nisi sem, euismod et malesuada vel, sodales at neque. Nam tempor ligula a arcu posuere maximus. Nunc sodales tortor massa, eu imperdiet orci mattis sit amet. Donec porttitor odio at nunc volutpat, non facilisis odio placerat. Etiam eleifend sagittis tincidunt. Integer id finibus sem, ut egestas magna.',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Voorbrood',
                'description' => 'Ut nibh eros, lacinia eget erat ac, cursus lobortis neque. Integer cursus erat felis, nec tempus orci fermentum ut. Donec ultricies consectetur sodales. Aenean convallis bibendum libero, eget aliquam nunc sodales a. Proin et dui velit. Morbi fermentum ligula ut purus molestie vulputate. Cras sagittis lacus a sem tincidunt aliquam. Suspendisse sagittis tincidunt ipsum, volutpat mattis magna.',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Sate Bak-Bar',
                'description' => 'Fusce imperdiet cursus finibus. Pellentesque vitae efficitur odio, a accumsan lacus. Praesent sit amet ligula finibus, aliquam urna et, gravida neque. Praesent euismod, felis ac pharetra euismod, metus ligula congue purus, ac dapibus neque nibh eu est. Fusce orci ligula, tincidunt in nisl in, suscipit eleifend augue. Curabitur auctor orci ante, quis efficitur purus porttitor ut. Cras finibus enim nec eros eleifend, ac ullamcorper urna semper. Fusce malesuada vitae massa quis accumsan. Phasellus in lectus finibus, iaculis nibh nec, imperdiet dolor.',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Rich Pork',
                'description' => 'Cras et vehicula est, aliquam facilisis mi. Morbi iaculis enim non est volutpat tempor. Fusce ut tortor et augue tempus iaculis ac a dolor. Duis blandit quam ac mattis dapibus. Duis ac purus magna. Quisque pretium ex eget mi ultrices viverra. Quisque aliquam dui in sem fringilla lobortis ac vehicula augue. Curabitur fringilla diam vel venenatis tempor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel nunc vitae eros scelerisque elementum id non erat. Quisque mattis, justo nec vulputate eleifend, libero nibh suscipit arcu, eu elementum risus arcu id ipsum. Vivamus non libero pulvinar, varius ligula eu, convallis metus.',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Indian Roast',
                'description' => 'Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam libero mauris, dictum et sodales vel, rhoncus varius lacus. Ut volutpat risus at ligula eleifend lacinia. Sed eget ullamcorper augue. Phasellus ac quam vel neque tincidunt porttitor eu quis lectus. Curabitur vulputate tellus mauris, eu malesuada urna imperdiet eu. Nulla dictum vehicula nulla, vitae tincidunt justo pharetra quis. In non placerat mi. Integer consequat fringilla lectus lacinia viverra. Curabitur venenatis urna sollicitudin imperdiet scelerisque. Proin lacinia risus non egestas pulvinar. Maecenas gravida augue non justo feugiat, id vehicula mi viverra. Nam vulputate mi a commodo sagittis. Quisque vel felis non odio efficitur consequat. Proin finibus dolor purus, id tempus nisi aliquet sed. Quisque id vulputate mauris.',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Wijn bij Robijn',
                'description' => 'Aenean quis magna vel dui cursus sodales sed eget urna. Cras sagittis scelerisque justo ut imperdiet. Integer ut lacus ipsum. Praesent convallis enim eros, ac malesuada mi tincidunt facilisis. Curabitur vestibulum elit sit amet risus tristique finibus. Nunc eget mauris dapibus, commodo felis eu, ullamcorper nulla. Suspendisse viverra in tortor eget sodales. Curabitur auctor mauris quis enim varius, a aliquet quam ornare. Phasellus volutpat commodo odio a mattis. Fusce feugiat nisi nisi, sed viverra neque bibendum in. Vivamus a tortor at diam laoreet interdum id sit amet sem. Nunc id nisi ac quam sagittis auctor. Quisque et pulvinar magna. Suspendisse accumsan viverra imperdiet. Proin ultricies, lacus in hendrerit tempor, ante diam condimentum turpis, ac consequat eros enim ac lacus. Phasellus vitae tellus nibh.',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Willy Nacho',
                'description' => 'Nunc elit neque, faucibus ut diam sed, molestie vulputate odio. Nunc viverra, nunc id porttitor faucibus, purus libero malesuada sem, sit amet sagittis nibh lacus non ex. Vivamus mattis nulla a tincidunt feugiat. Donec aliquet placerat consequat. Suspendisse luctus, ante id condimentum lacinia, augue justo rhoncus nunc, nec venenatis nisi neque eu risus. Aliquam lacinia lacus sit amet tortor viverra, et porttitor justo suscipit. Mauris ultricies mauris sed tincidunt accumsan.',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Lickm',
                'description' => 'Donec id mauris non mauris sagittis pharetra. Vivamus eu nulla felis. Ut id orci sollicitudin, efficitur purus ac, porta diam. Praesent metus erat, molestie et mattis at, suscipit non purus. Integer vehicula nisl id consectetur tincidunt. Mauris vitae velit dignissim, commodo ante vitae, cursus ipsum. Quisque pharetra ipsum ipsum, et dictum mauris posuere efficitur. Sed consectetur, diam vel auctor facilisis, mi felis tempus neque, a lacinia metus urna ut mauris. Praesent fringilla nisi sit amet mauris faucibus, id laoreet est tempus. Quisque tincidunt dui id auctor pulvinar. Nullam vel magna a lacus luctus pulvinar et at nulla. Duis ornare sit amet dui non dapibus. In id nibh augue. Suspendisse nec magna faucibus, aliquam odio et, sagittis enim. Aenean sem ipsum, mattis non ipsum vitae, dapibus rhoncus erat. Duis tempor blandit condimentum.',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Habibi Bussie',
                'description' => 'Vivamus rhoncus lacus id nulla lobortis lobortis. Cras accumsan iaculis velit sed tristique. Integer mollis sem feugiat semper tempor. Nunc imperdiet magna magna, at sollicitudin neque fringilla viverra. Nullam sit amet nisl dolor. Nulla ac arcu a sem laoreet cursus. Fusce sed euismod odio, ac dapibus massa. Duis scelerisque magna tellus, id accumsan turpis pretium in. Nunc in semper ligula. Nulla arcu ligula, blandit sed velit vitae, iaculis auctor nibh. Nulla cursus purus eu pharetra lobortis. Ut et mi sit amet velit viverra viverra id et sapien.',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]]);
    }
}
