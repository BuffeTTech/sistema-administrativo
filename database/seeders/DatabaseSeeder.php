<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\BuffetStatus;
use App\Enums\DocumentType;
use App\Enums\UserStatus;
use App\Events\BuffetCreatedEvent;
use App\Models\Address;
use App\Models\Buffet;
use App\Models\BuffetSubscription;
use App\Models\Phone;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            UserSeeder::class,
            HandoutSeeder::class,
            BuffetSeeder::class,
            BuffetScheduleSeeder::class,
            BookingSeeder::class,
            SubscriptionSeeder::class
        ]);

        $phone = Phone::create(['number'=>'(19) 99999-9999']);
        $user = User::create([
            'name' => 'José',
            'email' => 'jose@dono.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password = 'teste123'
            'remember_token' => Str::random(10),
            'document_type'=>DocumentType::CPF->name,
            'document'=>'393.492.780-73',
            'status'=>UserStatus::ACTIVE->name,
            'phone1'=>$phone->id
        ]);
        $user->assignRole('buffet');
        
        $buffet_alegria_address = Address::create([
            "zipcode"=>fake()->postcode(),
            "street"=>fake()->streetName(),
            "number"=>fake()->buildingNumber(),
            "neighborhood"=>fake()->secondaryAddress(),
            "state"=>fake()->state(),
            "city"=>fake()->city(),
            "country"=>fake()->country(),
            "complement"=>""
        ]);
      
        $buffet_alegria_phone1 = Phone::create(['number'=>'(19) 99999-9999']);
      
        $buffet_alegria = Buffet::create([
            'trading_name' => 'Buffet Alegria',
            'email' => 'buffet@alegria.com',
            'slug' => 'buffet-alegria',
            'document' => "47.592.257/0001-43",
            'owner_id' => $user->id,
            'status' => BuffetStatus::ACTIVE->name,
            'phone1'=>$buffet_alegria_phone1->id,
            'address'=>$buffet_alegria_address->id
        ]);
        $subscription = Subscription::where('slug', 'pacote-basico')->get()->first();
        $buffet_subscription = BuffetSubscription::create([
            'buffet_id'=>$buffet_alegria->id,
            'subscription_id'=>$subscription->id,
            'expires_in'=>Carbon::now()->addMonth(3)
        ]);
        event(new BuffetCreatedEvent(buffet: $buffet_alegria, subscription: $subscription, buffet_subscription: $buffet_subscription));
        $buffet_fazendinha_address = Address::create([
            "zipcode"=>fake()->postcode(),
            "street"=>fake()->streetName(),
            "number"=>fake()->buildingNumber(),
            "neighborhood"=>fake()->secondaryAddress(),
            "state"=>fake()->state(),
            "city"=>fake()->city(),
            "country"=>fake()->country(),
            "complement"=>""
        ]);
      
        $buffet_fazendinha_phone1 = Phone::create(['number'=>'(19) 99999-9999']);

        $buffet_fazendinha = Buffet::create([
            'trading_name' => 'Buffet Fazendinha',
            'email' => 'buffet@fazendinha.com',
            'slug' => 'buffet-fazendinha',
            'document' => "89.500.215/0001-85",
            'owner_id' => $user->id,
            'status' => BuffetStatus::ACTIVE->name,
            'phone1'=>$buffet_fazendinha_phone1->id,
            'address'=>$buffet_fazendinha_address->id
        ]);
        $subscription = Subscription::where('slug', 'pacote-basico')->get()->first();
        $buffet_subscription = BuffetSubscription::create([
            'buffet_id'=>$buffet_fazendinha->id,
            'subscription_id'=>$subscription->id,
            'expires_in'=>Carbon::now()->addMonth(3)
        ]);
        event(new BuffetCreatedEvent(buffet: $buffet_fazendinha, subscription: $subscription, buffet_subscription: $buffet_subscription));
        
        sleep(5);
        $data = [
            [
                'buffet'=>$buffet_alegria,
                'owner'=>[
                    'name' => "José",
                    'email' => "jose@dono.com",
                    'password' => 'password',
                    'document' => "393.492.780-73",
                    'document_type' => "CPF",
                    'status' => "ACTIVE",
                    'phones'=>[
                        ['number'=>'(19) 99999-9999']
                    ],
                    'address'=>[
                        "zipcode"=>"a",
                        "street"=>"a",
                        "number"=>5,
                        "complement"=>"a",
                        "neighborhood"=>"a",
                        "state"=>"a",
                        "city"=>"a",
                        "country"=>"a",
                    ]
                ],
                'users'=>[
                    [
                        'user'=>[
                            'name' => "Maria",
                            'email' => "maria@teste.com",
                            'password' => 'password',
                            'document' => "269.803.080-11",
                            'document_type' => "CPF",
                            'status' => "ACTIVE",
                            'role' => 'user'
                        ],
                        'address'=>[],
                        'phones'=>[
                            ['number'=>'(19) 99999-9999']
                        ]
                    ],
                    [
                        'user'=>[
                            'name' => "Paula",
                            'email' => "paula@teste.com",
                            'password' => 'password',
                            'document' => "317.573.220-86",
                            'document_type' => "CPF",
                            'status' => "ACTIVE",
                            'role'=>"user"
                        ],
                        'address'=>[],
                        'phone'=>[
                            ['number'=>'(19) 99999-9999']
                        ]
                    ],
                    [
                        'user'=>[
                            'name' => "Guilherme",
                            'email' => "guilherme@adm.com",
                            'password' => 'password',
                            'document' => "321.537.920-10",
                            'document_type' => "CPF",
                            'status' => "ACTIVE",
                            'role'=>"administrative"
                        ],
                        'address'=>[],
                        'phone'=>[
                            ['number'=>'(19) 99999-9999']
                        ]
                    ],
                    [
                        'user'=>[
                            'name' => "Luigi",
                            'email' => "luigi@com.com",
                            'password' => 'password',
                            'document' => "356.279.200-09",
                            'document_type' => "CPF",
                            'status' => "ACTIVE",
                            'role'=>'commercial'
                        ],
                        'address'=>[],
                        'phone'=>[
                            ['number'=>'(19) 99999-9999']
                        ]
                    ],
                    [
                        'user'=>[
                            'name' => "Taynara",
                            'email' => "taynara@ope.com",
                            'password' => 'password',
                            'document' => "828.244.150-37",
                            'document_type' => "CPF",
                            'status' => "ACTIVE",
                            'role'=>'operational'
                        ],
                        'address'=>[],
                        'phone'=>[
                            ['number'=>'(19) 99999-9999']
                        ]
                    ],
                    // [
                    //     'user'=>[],
                    //     'address'=>[],
                    //     'phone'=>[
                    //         ['number'=>'(19) 99999-9999']
                    //     ]
                    // ],
                ],
                'foods'=>[
                    [
                        "name_food"=>"Pacote Alegria",
                        "food_description"=>"bauru, batata frita, pastel, espetinho, churros, fundoe, petit gateu, bolo da sua escolha",
                        "beverages_description"=>"coca/zero, guarana, fanta, água, suco de laranja, morango, uva, maracúja",
                        "status"=>"ACTIVE",
                        "price"=>55,
                        "slug"=>"pacote-alegria",
                        'photos'=>[
                            [
                                'file_name'=>'batata1.jpeg',
                                'file_path'=>'/batata1.jpeg',
                                'file_extension'=>'jpeg',
                                'mime_type'=>'image/jpeg',
                                'file_size'=>'40847',
                            ],
                            [
                                'file_name'=>'bolo1.webp',
                                'file_path'=>'/bolo1.webp',
                                'file_extension'=>'webp',
                                'mime_type'=>'image/webp',
                                'file_size'=>'31904',
                            ],
                            [
                                'file_name'=>'suco1.avif',
                                'file_path'=>'/suco1.avif',
                                'file_extension'=>'avif',
                                'mime_type'=>'image/avif',
                                'file_size'=>'31904',
                            ]
                        ]
                    ],
                    [
                        "name_food"=>"Pacote Felicidade",
                        "food_description"=>"coxinha, bolinha de queijo, batata frita, pastel, churros, bolo da sua escolha",
                        "beverages_description"=>"coca/zero, guarana, água, suco de laranja, uva",
                        "status"=>"ACTIVE",
                        "price"=>35,
                        "slug"=>"pacote-felicidade",
                        'photos'=>[
                            [
                                'file_name'=>'batata2.jpeg',
                                'file_path'=>'/batata2.jpeg',
                                'file_extension'=>'jpeg',
                                'mime_type'=>'image/jpeg',
                                'file_size'=>'40847',
                            ],
                            [
                                'file_name'=>'bolinha de queijo2.jpeg',
                                'file_path'=>'/bolinha de queijo2.jpeg',
                                'file_extension'=>'jpeg',
                                'mime_type'=>'image/jpeg',
                                'file_size'=>'31904',
                            ],
                            [
                                'file_name'=>'bolo2.webp',
                                'file_path'=>'/bolo2.webp',
                                'file_extension'=>'webp',
                                'mime_type'=>'image/webp',
                                'file_size'=>'31904',
                            ]
                        ]
                    ],
                    [
                        "name_food"=>"Pacote Familia",
                        "food_description"=>"escondidinho de carne, mesa de frios, batata frita, cachorro quente, nhoque, churros, sorvete de creme, creme de papaia, bolo da sua escolha",
                        "beverages_description"=>"coca/zero, guarana, água, suco de laranja, uva, cerveja stela, coquetel de morango",
                        "status"=>"ACTIVE",
                        "price"=>65,
                        "slug"=>"pacote-familia",
                        'photos'=>[
                            [
                                'file_name'=>'batata3.jpeg',
                                'file_path'=>'/batata3.jpeg',
                                'file_extension'=>'jpeg',
                                'mime_type'=>'image/jpeg',
                                'file_size'=>'40847',
                            ],
                            [
                                'file_name'=>'mesafrios3.jpeg',
                                'file_path'=>'/mesafrios3.jpeg',
                                'file_extension'=>'jpeg',
                                'mime_type'=>'image/jpeg',
                                'file_size'=>'31904',
                            ],
                            [
                                'file_name'=>'bolo3.webp',
                                'file_path'=>'/bolo3.webp',
                                'file_extension'=>'webp',
                                'mime_type'=>'image/webp',
                                'file_size'=>'31904',
                            ]
                        ]
                    ],
                    // [
                    //     "name_food"=>"",
                    //     "food_description"=>"",
                    //     "beverages_description"=>"",
                    //     "status"=>"ACTIVE",
                    //     "price"=>"",
                    //     "slug"=>"",
                    // ],
                ],
                'decorations'=>[
                    [
                        "main_theme"=>"Marvel",
                        "slug"=>"marvel",
                        "description"=>"Decoração com bonecos e personagens da Marvel",
                        "price"=>30,
                        "status"=>"ACTIVE",
                        'photos'=>[
                            [
                                'file_name'=>'marvel1.jpeg',
                                'file_path'=>'/marvel1.jpeg',
                                'file_extension'=>'jpeg',
                                'mime_type'=>'image/jpeg',
                                'file_size'=>'191250',
                            ],
                            [
                                'file_name'=>'marvel2.webp',
                                'file_path'=>'/marvel2.webp',
                                'file_extension'=>'webp',
                                'mime_type'=>'image/webp',
                                'file_size'=>'113155',
                            ],
                            [
                                'file_name'=>'marvel3.webp',
                                'file_path'=>'/marvel3.webp',
                                'file_extension'=>'webp',
                                'mime_type'=>'image/webp',
                                'file_size'=>'113155',
                            ]
                        ]
                    ],
                    [
                        "main_theme"=>"Minnie",
                        "slug"=>"minnie",
                        "description"=>"Decoração com bonecos e personagens da Minnie",
                        "price"=>30,
                        "status"=>"ACTIVE",
                        'photos'=>[
                            [
                                'file_name'=>'minnie1.webp',
                                'file_path'=>'/minnie1.webp',
                                'file_extension'=>'webp',
                                'mime_type'=>'image/webp',
                                'file_size'=>'191250',
                            ],
                            [
                                'file_name'=>'minnie2.webp',
                                'file_path'=>'/minnie2.webp',
                                'file_extension'=>'webp',
                                'mime_type'=>'image/webp',
                                'file_size'=>'113155',  
                            ],
                            [
                                'file_name'=>'minnie 3.jpeg',
                                'file_path'=>'/minnie 3.jpeg',
                                'file_extension'=>'jpeg',
                                'mime_type'=>'image/jpeg',
                                'file_size'=>'113155',
                            ]
                        ]
                    ],
                    [
                        "main_theme"=>"Moana",
                        "slug"=>"moana",
                        "description"=>"Decoração com bonecos e personagens da Moana",
                        "price"=>30,
                        "status"=>"ACTIVE",
                        'photos'=>[
                            [
                                'file_name'=>'moana.jpeg',
                                'file_path'=>'/moana.jpeg',
                                'file_extension'=>'jpeg',
                                'mime_type'=>'image/jpeg',
                                'file_size'=>'191250',
                            ],
                            [
                                'file_name'=>'moana2.jpeg',
                                'file_path'=>'/moana2.jpeg',
                                'file_extension'=>'jpeg',
                                'mime_type'=>'image/jpeg',
                                'file_size'=>'113155',
                            ],
                            [
                                'file_name'=>'moana3.jpeg',
                                'file_path'=>'/moana3.jpeg',
                                'file_extension'=>'jpeg',
                                'mime_type'=>'image/jpeg',
                                'file_size'=>'113155',
                            ]
                        ]
                    ],
                    // [
                    //     "main_theme"=>"",
                    //     "slug"=>"",
                    //     "description"=>"",
                    //     "price"=>"",
                    //     "status"=>"",
                    // ],
                ],
                'schedules'=>[
                    [
                        'day_week'=>"SUNDAY",
                        'start_time'=>'12:00',
                        'duration'=>120,
                        'status'=>'ACTIVE'
                    ],
                    [
                        'day_week'=>"SUNDAY",
                        'start_time'=>'18:00',
                        'duration'=>240,
                        'status'=>'ACTIVE'
                    ],
                    [
                        'day_week'=>"MONDAY",
                        'start_time'=>'18:00',
                        'duration'=>240,
                        'status'=>'ACTIVE'
                    ],
                    [
                        'day_week'=>"TUESDAY", 
                        'start_time'=>'15:10',
                        'duration'=>120,
                        'status'=>'ACTIVE'
                    ],
                    [
                        'day_week'=>"WEDNESDAY",
                        'start_time'=>'18:00',
                        'duration'=>240,
                        'status'=>'ACTIVE'
                    ],
                    [
                        'day_week'=>"THURSDAY",
                        'start_time'=>'12:00',
                        'duration'=>240,
                        'status'=>'ACTIVE'
                    ],
                    [
                        'day_week'=>"FRIDAY",
                        'start_time'=>'14:00',
                        'duration'=>240,
                        'status'=>'ACTIVE'
                    ],
                    [
                        'day_week'=>"FRIDAY",
                        'start_time'=>'19:00',
                        'duration'=>240,
                        'status'=>'ACTIVE'
                    ],
                    [
                        'day_week'=>"SATURDAY",
                        'start_time'=>'14:00',
                        'duration'=>240,
                        'status'=>'ACTIVE'
                    ],
                    [
                        'day_week'=>"SATURDAY",
                        'start_time'=>'19:00',
                        'duration'=>240,
                        'status'=>'ACTIVE'
                    ]
                ],
                'survey_questions'=>[
                    [
                        "question"=>"Qual a sua opinião sobre a comida",
                        "status"=>true,
                        "answers"=>0,
                        "question_type"=>"M",
                    ],
                    [
                        "question"=>"O quão boa foi a festa",
                        "status"=>true,
                        "answers"=>0,
                        "question_type"=>"M",
                    ],
                    [
                        "question"=>"Descreva sua opinião sobre a comida",
                        "status"=>true,
                        "answers"=>0,
                        "question_type"=>"D",
                    ],
                    [
                        "question"=>"A decoração estava boa?",
                        "status"=>true,
                        "answers"=>0,
                        "question_type"=>"M",
                    ],
                    [
                        "question"=>"Deixe-nos saber mais sobre sua experiência. O que você achou mais notável ou o que poderia ser melhorado?",
                        "status"=>true,
                        "answers"=>0,
                        "question_type"=>"D",
                    ],
                    [
                        "question"=>"O atendimento da equipe atendeu as suas expectativas?",
                        "status"=>true,
                        "answers"=>0,
                        "question_type"=>"M",
                    ],
                    // [
                    //     "question"=>"",
                    //     "status"=>"",
                    //     "answers"=>"",
                    //     "question_type"=>"",
                    // ],
                ],
                // 'bookings'=>[
                //     [
                //         'name_birthdayperson'=>'Tasso',
                //         'years_birthdayperson'=>15,
                //         'num_guests'=>50,
                //         'party_day'=>'2024-09-02',
                //         'food_id'=>0,
                //         'price_food'=>55,
                //         'decoration_id'=>0,
                //         'price_decoration'=>30,
                //         'schedule_id'=>2,
                //         'price_schedule'=>0,
                //         'discount'=>0,
                //         'status'=>"FINISHED",
                //         'user_id'=>0,
                //         'guests'=>[
                //             [
                //                 'name'=> 'João',
                //                 'document'=>'292.795.610-30',
                //                 'age'=> 32,
                //                 'status'=>"CONFIRMED"
                //             ],
                //             [
                //                 'name'=> 'Hamilton',
                //                 'document'=>'280.244.380-11',
                //                 'age'=> 55,
                //                 'status'=>"PRESENT"
                //             ],
                //             [
                //                 'name'=> 'Maria Flor',
                //                 'document'=>'000.841.410-69',
                //                 'age'=> 6,
                //                 'status'=>"ABSENT"
                //             ],
                //             [
                //                 'name'=> 'Robson',
                //                 'document'=>'030.410.060-90',
                //                 'age'=> 40,
                //                 'status'=>"BLOCKED"
                //             ],
                //             [
                //                 'name'=> 'Fernanda',
                //                 'document'=>'195.544.410-29',
                //                 'age'=> 20,
                //                 'status'=>"CONFIRMED"
                //             ],
                //             [
                //                 'name'=> 'Prado',
                //                 'document'=>'425.114.870-39',
                //                 'age'=> 18,
                //                 'status'=>"PENDENT"
                //             ]
                //         ],
                //         'survey_answers'=>[
                //             [
                //                 "question_id"=>0,
                //                 "answer"=>"0-25",
                //             ],
                //         ],
                //     ],
                //     [
                //         'name_birthdayperson'=>'Luiza',
                //         'years_birthdayperson'=>6,
                //         'num_guests'=>100,
                //         'party_day'=>'2024-09-20',
                //         'food_id'=>2,
                //         'price_food'=>65,
                //         'decoration_id'=>2,
                //         'price_decoration'=>30,
                //         'schedule_id'=>6,
                //         'price_schedule'=>0,
                //         'discount'=>0,
                //         'status'=>"PENDENT",
                //         'user_id'=>0,
                //         'survey_answers'=>[ ],
                //     ],
                //     [
                //         'name_birthdayperson'=>'Silvia',
                //         'years_birthdayperson'=>10,
                //         'num_guests'=>70,
                //         'party_day'=>'2024-09-20',
                //         'food_id'=>2,
                //         'price_food'=>35,
                //         'decoration_id'=>2,
                //         'price_decoration'=>30,
                //         'schedule_id'=>6,
                //         'price_schedule'=>0,
                //         'discount'=>0,
                //         'status'=>"PENDENT",
                //         'user_id'=>1,
                //         'survey_answers'=>[],
                //     ],
                //     [
                //         'name_birthdayperson'=>'André',
                //         'years_birthdayperson'=>15,
                //         'num_guests'=>50,
                //         'party_day'=>'2024-09-26',
                //         'food_id'=>0,
                //         'price_food'=>65,
                //         'decoration_id'=>0,
                //         'price_decoration'=>30,
                //         'schedule_id'=>5,
                //         'price_schedule'=>0,
                //         'discount'=>0,
                //         'status'=>"APPROVED",
                //         'user_id'=>0,
                //         'survey_answers'=>[],
                //         'guests'=>[
                //             [
                //                 'name'=> 'Pedro',
                //                 'document'=>'292.795.610-30',
                //                 'age'=> 32,
                //                 'status'=>"CONFIRMED"
                //             ],
                //             [
                //                 'name'=> 'Hamilton',
                //                 'document'=>'280.244.380-11',
                //                 'age'=> 55,
                //                 'status'=>"PRESENT"
                //             ],
                //             [
                //                 'name'=> 'Maria Clara',
                //                 'document'=>'000.841.410-69',
                //                 'age'=> 6,
                //                 'status'=>"ABSENT"
                //             ],
                //             [
                //                 'name'=> 'Marcos',
                //                 'document'=>'030.410.060-90',
                //                 'age'=> 40,
                //                 'status'=>"BLOCKED"
                //             ],
                //             [
                //                 'name'=> 'Fernanda',
                //                 'document'=>'195.544.410-29',
                //                 'age'=> 20,
                //                 'status'=>"CONFIRMED"
                //             ],
                //             [
                //                 'name'=> 'Prado',
                //                 'document'=>'425.114.870-39',
                //                 'age'=> 18,
                //                 'status'=>"PENDENT"
                //             ]
                //         ],
                //     ],
                //     [
                //         'name_birthdayperson'=>'Yuri',
                //         'years_birthdayperson'=>15,
                //         'num_guests'=>50,
                //         'party_day'=>'2024-09-15',
                //         'food_id'=>0,
                //         'price_food'=>55,
                //         'decoration_id'=>0,
                //         'price_decoration'=>30,
                //         'schedule_id'=>0,
                //         'price_schedule'=>0,
                //         'discount'=>0,
                //         'status'=>"APPROVED",
                //         'user_id'=>1,
                //         'survey_answers'=>[
                //             [
                //                 "question_id"=>0,
                //                 "answer"=>"0-25",
                //             ],
                //         ],
                //     ]
                // ],
                'recommendations'=>[
                    [
                        'content'=>'<p>🎉 Prepare-se para a festa mais divertida do ano! Estamos animados para convidar todos os pequenos a se juntarem a nós em uma celebração cheia de cores, brincadeiras e sorrisos. Não perca essa festa incrível!</p>',
                        'status'=>'ACTIVE',
                    ],
                    [
                        'content'=>'<p>🎈 Seus amiguinhos estão convocados para uma festa cheia de magia e diversão! Teremos jogos, guloseimas deliciosas e, é claro, muita música para animar a pista de dança dos pequenos. Estamos ansiosos para compartilhar momentos mágicos juntos!</p>',
                        'status'=>'ACTIVE',
                    ],
                    [
                        'content'=>'<p>🌟 A aventura vai começar! Estamos preparando uma festa incrível para os pequenos aventureiros. Com decoração temática, atividades emocionantes e um bolo delicioso, garantimos sorrisos do início ao fim. Esperamos por vocês!</p>',
                        'status'=>'ACTIVE',
                    ],
                    // [
                    //     'content'=>'',
                    //     'status'=>'',
                    // ],
                ],
            ],
            [
                'buffet'=>$buffet_fazendinha,
                'owner'=>[
                    'name' => "José",
                    'email' => "jose@dono.com",
                    'password' => 'password',
                    'document' => "393.492.780-73",
                    'document_type' => "CPF",
                    'status' => "ACTIVE",
                    'phones'=>[
                        ['number'=>'(19) 99999-9999']
                    ],
                    'address'=>[
                        "zipcode"=>"a",
                        "street"=>"a",
                        "number"=>5,
                        "complement"=>"a",
                        "neighborhood"=>"a",
                        "state"=>"a",
                        "city"=>"a",
                        "country"=>"a",
                    ]
                ],
                'users'=>[
                    [
                        'user'=>[
                            'name' => "Robson",
                            'email' => "robson@teste.com",
                            'password' => 'password',
                            'document' => "894.916.640-26",
                            'document_type' => "CPF",
                            'status' => "ACTIVE",
                            'role' => 'user'
                        ],
                        'address'=>[],
                        'phones'=>[
                            ['number'=>'(19) 99999-9999']
                        ]
                    ],
                ],
                'foods'=>[
                    [
                        "name_food"=>"Pacote Amizade",
                        "food_description"=>"<ul>
                            <li><strong>Entrada:</strong> Salada Caesar</li>
                            <li><strong>Prato Principal:</strong> Filé Mignon grelhado com molho de cogumelos</li>
                            <li><strong>Acompanhamento:</strong> Risoto de funghi</li>
                            <li><strong>Sobremesa:</strong> Cheesecake de morango</li>
                        </ul>",
                        "beverages_description"=>"<ul>
                            <li><strong>Vinho:</strong> Cabernet Sauvignon</li>
                            <li><strong>Cerveja:</strong> IPA Artesanal</li>
                            <li><strong>Refrigerante:</strong> Coca-Cola, Pepsi</li>
                            <li><strong>Água:</strong> Mineral com e sem gás</li>
                        </ul>",
                        "status"=>"ACTIVE",
                        "price"=>55,
                        "slug"=>"pacote-amizade",
                        'photos'=>[]
                    ],
                ],
                'decorations'=>[
                    [
                        "main_theme"=>"Heróis",
                        "slug"=>"herois",
                        "description"=>"<ul>
                            <li><strong>Temática:</strong> Super-Heróis</li>
                            <li><strong>Balões:</strong> Arcos de balões coloridos</li>
                            <li><strong>Mesas:</strong> Mesas decoradas com toalhas e enfeites temáticos</li>
                            <li><strong>Painéis:</strong> Painéis com imagens dos personagens favoritos</li>
                            <li><strong>Centros de Mesa:</strong> Centros de mesa com personagens em miniatura</li>
                            <li><strong>Bolo:</strong> Bolo temático de super-herói</li>
                        </ul>",
                        "price"=>30,
                        "status"=>"ACTIVE",
                        'photos'=>[]
                    ],
                ],
                'schedules'=>[
                    [
                        'day_week'=>"SUNDAY",
                        'start_time'=>'12:00',
                        'duration'=>120,
                        'status'=>'ACTIVE'
                    ]
                ],
                'survey_questions'=>[
                    [
                        "question"=>"Qual a sua opinião sobre a comida",
                        "status"=>true,
                        "answers"=>0,
                        "question_type"=>"M",
                    ],
                ],
                'bookings'=>[
                ],
                'recommendations'=>[
                    [
                        'content'=>'<p>🎉 Prepare-se para a festa mais divertida do ano! Estamos animados para convidar todos os pequenos a se juntarem a nós em uma celebração cheia de cores, brincadeiras e sorrisos. Não perca essa festa incrível!</p>',
                        'status'=>'ACTIVE',
                    ],
                ],
            ]
        ];
        $response = Http::acceptJson()->post(config('app.commercial_url').'/api/presentation', ['data'=>$data]);
    }
}
