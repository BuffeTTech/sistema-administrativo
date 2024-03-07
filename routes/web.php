<?php

use App\Events\BuffetCreatedEvent;
use App\Http\Controllers\BuffetController;
use App\Http\Controllers\CommercialController;
use App\Http\Controllers\HandoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepresentativeController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Models\Address;
use App\Models\Buffet;
use App\Models\BuffetSubscription;
use App\Models\Phone;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;

Route::get('/', function () {
    return view('welcome');
})->name('landing_page');

Route::get('/dashboard', [SiteController::class, 'dashboard'])->middleware(['auth', 'verified', 'buffet.created'])->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified', 'buffet.created'])->name('dashboard');

Route::middleware(['auth', 'verified', 'buffet.not_created'])->group(function(){
    Route::get('/auth/create-buffet', [BuffetController::class, 'create_on_register'])->name('auth.buffet.create');
    Route::post('/auth/create-buffet', [BuffetController::class, 'store_on_register'])->name('auth.buffet.store');
    
    Route::get('/auth/create-buffet/payment', [BuffetController::class, 'create_payment_on_register'])->name('auth.buffet.create_payment');
    Route::post('/auth/create-buffet/payment', [BuffetController::class, 'store_payment_on_register'])->name('auth.buffet.store_payment');

    Route::get('/auth/create-buffet/subscription', [BuffetController::class, 'create_select_subscription_on_register'])->name('auth.buffet.select_subscription');
    Route::post('/auth/create-buffet/subscription', [BuffetController::class, 'store_select_subscription_on_register'])->name('auth.buffet.select_subscription');
});


Route::middleware(['auth', 'verified', 'buffet.created'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('representative', RepresentativeController::class);
    Route::resource('buffet', BuffetController::class);
    Route::resource('commercial', CommercialController::class);
    Route::resource('handout', HandoutController::class);

    // Subscription
    Route::get('/subscription/roles', [SubscriptionController::class, 'roles'])->name('buffet.roles.index');
    Route::get('/subscription/roles/{role}', [SubscriptionController::class, 'show_role'])->name('buffet.roles.show');
    
    Route::get('/subscription/permissions', [SubscriptionController::class, 'permissions'])->name('buffet.permissions.index');
    Route::get('/subscription/permissions/{permission}', [SubscriptionController::class, 'show_permission'])->name('buffet.permissions.show');
    
    Route::get('/subscription', [SubscriptionController::class, 'subscriptions'])->name('buffet.subscription.index');
    Route::get('/subscription/create', [SubscriptionController::class, 'create_subscription'])->name('buffet.subscription.create');
    Route::post('/subscription', [SubscriptionController::class, 'store_subscription'])->name('buffet.subscription.store');
    Route::get('/subscription/{subscription}', [SubscriptionController::class, 'show_subscription'])->name('buffet.subscription.show');
    Route::get('/subscription/{subscription}/edit', [SubscriptionController::class, 'edit_subscription'])->name('buffet.subscription.edit');
    Route::put('/subscription/{subscription}', [SubscriptionController::class, 'update_subscription'])->name('buffet.subscription.update');
    
});

Route::get('/aaa', function(){
    $buffet_alegria = Buffet::where('slug', 'buffet-alegria')->get()->first();
    $data = [
        [
            'buffet'=>$buffet_alegria,
            'owner'=>[
                'name' => "José",
                'email' => "josé@dono.com",
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
                    'photos'=>[]
                ],
                [
                    "name_food"=>"Pacote Felicidade",
                    "food_description"=>"coxinha, bolinha de queijo, batata frita, pastel, churros, bolo da sua escolha",
                    "beverages_description"=>"coca/zero, guarana, água, suco de laranja, uva",
                    "status"=>"ACTIVE",
                    "price"=>35,
                    "slug"=>"pacote-felicidade",
                    'photos'=>[]
                ],
                [
                    "name_food"=>"Pacote Familia",
                    "food_description"=>"escondidinho de carne, mesa de frios, batata frita, cachorro quente, nhoque, churros, sorvete de creme, creme de papaia, bolo da sua escolha",
                    "beverages_description"=>"coca/zero, guarana, água, suco de laranja, uva, cerveja stela, coquetel de morango",
                    "status"=>"ACTIVE",
                    "price"=>65,
                    "slug"=>"pacote-familia",
                    'photos'=>[]
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
                    'photos'=>[]
                ],
                [
                    "main_theme"=>"Minnie",
                    "slug"=>"minnie",
                    "description"=>"Decoração com bonecos e personagens da Minnie",
                    "price"=>30,
                    "status"=>"ACTIVE",
                    'photos'=>[]
                ],
                [
                    "main_theme"=>"Moana",
                    "slug"=>"moana",
                    "description"=>"Decoração com bonecos e personagens da Moana",
                    "price"=>30,
                    "status"=>"ACTIVE",
                    'photos'=>[]
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
                ],
                [
                    'day_week'=>"SUNDAY",
                    'start_time'=>'19:00',
                    'duration'=>240,
                ],
                [
                    'day_week'=>"MONDAY",
                    'start_time'=>'18:00',
                    'duration'=>240,
                ],
                [
                    'day_week'=>"TUESDAY", 
                    'start_time'=>'15:10',
                    'duration'=>120,
                ],
                [
                    'day_week'=>"WEDNESDAY",
                    'start_time'=>'18:00',
                    'duration'=>240,
                ],
                [
                    'day_week'=>"THRUSDAY",
                    'start_time'=>'18:00',
                    'duration'=>240,
                ],
                [
                    'day_week'=>"FRIDAY",
                    'start_time'=>'14:00',
                    'duration'=>240,
                ],
                [
                    'day_week'=>"FRIDAY",
                    'start_time'=>'19:00',
                    'duration'=>240,
                ],
                [
                    'day_week'=>"SATURDAY",
                    'start_time'=>'14:00',
                    'duration'=>240,
                ],
                [
                    'day_week'=>"SATURDAY",
                    'start_time'=>'19:00',
                    'duration'=>240,
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
            'bookings'=>[
                [
                    'name_birthdayperson'=>'Tasso',
                    'years_birthdayperson'=>15,
                    'num_guests'=>50,
                    'party_day'=>'2024-02-26',
                    'food_id'=>0,
                    'price_food'=>55,
                    'decoration_id'=>0,
                    'price_decoration'=>30,
                    'schedule_id'=>6,
                    'price_schedule'=>0,
                    'discount'=>0,
                    'status'=>"FINISHED",
                    'user_id'=>0,
                    'guests'=>[
                        [
                            [
                                'name'=> 'João',
                                'document'=>'292.795.610-30',
                                'age'=> 32,
                                'status'=>"CONFIRMED"
                            ],
                            [
                                'name'=> 'Hamilton',
                                'document'=>'280.244.380-11',
                                'age'=> 55,
                                'status'=>"PRESENT"
                            ],
                            [
                                'name'=> 'Maria Flor',
                                'document'=>'000.841.410-69',
                                'age'=> 6,
                                'status'=>"ABSENT"
                            ],
                            [
                                'name'=> 'Robson',
                                'document'=>'030.410.060-90',
                                'age'=> 40,
                                'status'=>"BLOCKED"
                            ],
                            [
                                'name'=> 'Fernanda',
                                'document'=>'195.544.410-29',
                                'age'=> 20,
                                'status'=>"CONFIRMED"
                            ],
                            [
                                'name'=> 'Prado',
                                'document'=>'425.114.870-39',
                                'age'=> 18,
                                'status'=>"PENDENT"
                            ]
                        ]
                    ],
                    'survey_answers'=>[
                        [
                            "question_id"=>0,
                            "answer"=>"0-25",
                        ],
                    ],
                ],
                [
                    'name_birthdayperson'=>'Luiza',
                    'years_birthdayperson'=>6,
                    'num_guests'=>100,
                    'party_day'=>'2024-03-23',
                    'food_id'=>2,
                    'price_food'=>65,
                    'decoration_id'=>2,
                    'price_decoration'=>30,
                    'schedule_id'=>6,
                    'price_schedule'=>0,
                    'discount'=>0,
                    'status'=>"PENDENT",
                    'user_id'=>0,
                    'survey_answers'=>[
                        [
                            "question_id"=>0,
                            "answer"=>"0-25",
                        ],
                    ],
                ],
                [
                    'name_birthdayperson'=>'Silvia',
                    'years_birthdayperson'=>10,
                    'num_guests'=>70,
                    'party_day'=>'2024-03-23',
                    'food_id'=>2,
                    'price_food'=>35,
                    'decoration_id'=>2,
                    'price_decoration'=>30,
                    'schedule_id'=>6,
                    'price_schedule'=>0,
                    'discount'=>0,
                    'status'=>"PENDENT",
                    'user_id'=>1,
                    'survey_answers'=>[
                        [
                            "question_id"=>0,
                            "answer"=>"0-25",
                        ],
                    ],
                ],
                [
                    'name_birthdayperson'=>'André',
                    'years_birthdayperson'=>15,
                    'num_guests'=>50,
                    'party_day'=>'2024-03-12',
                    'food_id'=>0,
                    'price_food'=>65,
                    'decoration_id'=>0,
                    'price_decoration'=>30,
                    'schedule_id'=>4,
                    'price_schedule'=>0,
                    'discount'=>0,
                    'status'=>"APPROVED",
                    'user_id'=>0,
                    'survey_answers'=>[
                        [
                            "question_id"=>0,
                            "answer"=>"0-25",
                        ],
                    ],
                ],
                [
                    'name_birthdayperson'=>'Yuri',
                    'years_birthdayperson'=>15,
                    'num_guests'=>50,
                    'party_day'=>'2024-04-26',
                    'food_id'=>0,
                    'price_food'=>55,
                    'decoration_id'=>0,
                    'price_decoration'=>30,
                    'schedule_id'=>6,
                    'price_schedule'=>0,
                    'discount'=>0,
                    'status'=>"APPROVED",
                    'user_id'=>1,
                    'survey_answers'=>[
                        [
                            "question_id"=>0,
                            "answer"=>"0-25",
                        ],
                    ],
                ]
            ],
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
        ]
    ];
    $response = Http::acceptJson()->post(config('app.commercial_url').'/api/presentation', ['data'=>$data]);
    dd($response->body());
    dd($data);
});

require __DIR__.'/auth.php';
