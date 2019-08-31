<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('genres')->delete();
        
        \DB::table('genres')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '',
                'created_at' => '2019-08-28 12:51:01',
                'updated_at' => '2019-08-28 12:51:01',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '.Trash-1000',
                'created_at' => '2019-08-28 12:51:01',
                'updated_at' => '2019-08-28 12:51:01',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'files',
                'created_at' => '2019-08-28 12:51:01',
                'updated_at' => '2019-08-28 12:51:01',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Arizona Baby [BDremux 1080 px][DTS 5.1 Castellano-DTS 5.1 Ingles+Subs][ES-EN]',
                'created_at' => '2019-08-28 12:51:01',
                'updated_at' => '2019-08-28 12:51:01',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Series',
                'created_at' => '2019-08-28 12:51:03',
                'updated_at' => '2019-08-28 12:51:03',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'The Wire',
                'created_at' => '2019-08-28 12:51:03',
                'updated_at' => '2019-08-28 12:51:03',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Los Soprano',
                'created_at' => '2019-08-28 12:51:21',
                'updated_at' => '2019-08-28 12:51:21',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'True Detective',
                'created_at' => '2019-08-28 12:51:38',
                'updated_at' => '2019-08-28 12:51:38',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'The Bridge',
                'created_at' => '2019-08-28 12:51:39',
                'updated_at' => '2019-08-28 12:51:39',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Stranger Things',
                'created_at' => '2019-08-28 12:51:41',
                'updated_at' => '2019-08-28 12:51:41',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Temporada 3',
                'created_at' => '2019-08-28 12:51:41',
                'updated_at' => '2019-08-28 12:51:41',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Temporada 2',
                'created_at' => '2019-08-28 12:51:54',
                'updated_at' => '2019-08-28 12:51:54',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Temporada 1',
                'created_at' => '2019-08-28 12:52:08',
                'updated_at' => '2019-08-28 12:52:08',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Sherlock',
                'created_at' => '2019-08-28 12:52:21',
                'updated_at' => '2019-08-28 12:52:21',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Sobrenatural',
                'created_at' => '2019-08-28 12:52:22',
                'updated_at' => '2019-08-28 12:52:22',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Supergirl',
                'created_at' => '2019-08-28 12:52:47',
                'updated_at' => '2019-08-28 12:52:47',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Temporada 4',
                'created_at' => '2019-08-28 12:52:47',
                'updated_at' => '2019-08-28 12:52:47',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Prison Break',
                'created_at' => '2019-08-28 12:54:35',
                'updated_at' => '2019-08-28 12:54:35',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Mad Men',
                'created_at' => '2019-08-28 12:55:06',
                'updated_at' => '2019-08-28 12:55:06',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Sons of Anarchy',
                'created_at' => '2019-08-28 12:55:07',
                'updated_at' => '2019-08-28 12:55:07',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'The Knick',
                'created_at' => '2019-08-28 12:55:25',
                'updated_at' => '2019-08-28 12:55:25',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Masters of Sex',
                'created_at' => '2019-08-28 12:55:26',
                'updated_at' => '2019-08-28 12:55:26',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Hermanos de sangre',
                'created_at' => '2019-08-28 12:55:28',
                'updated_at' => '2019-08-28 12:55:28',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Modern Family',
                'created_at' => '2019-08-28 12:55:43',
                'updated_at' => '2019-08-28 12:55:43',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Lost',
                'created_at' => '2019-08-28 12:55:49',
                'updated_at' => '2019-08-28 12:55:49',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Ciencia ficción',
                'created_at' => '2019-08-28 12:56:24',
                'updated_at' => '2019-08-28 12:56:24',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Sagas',
                'created_at' => '2019-08-28 12:56:24',
                'updated_at' => '2019-08-28 12:56:24',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Star Trek',
                'created_at' => '2019-08-28 12:56:24',
                'updated_at' => '2019-08-28 12:56:24',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Aventuras',
                'created_at' => '2019-08-28 12:56:27',
                'updated_at' => '2019-08-28 12:56:27',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Acción',
                'created_at' => '2019-08-28 12:56:27',
                'updated_at' => '2019-08-28 12:56:27',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Fantástico',
                'created_at' => '2019-08-28 12:56:47',
                'updated_at' => '2019-08-28 12:56:47',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Terminator',
                'created_at' => '2019-08-28 12:56:51',
                'updated_at' => '2019-08-28 12:56:51',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Harry Potter',
                'created_at' => '2019-08-28 12:56:54',
                'updated_at' => '2019-08-28 12:56:54',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Harry Potter - Inglés',
                'created_at' => '2019-08-28 12:56:54',
                'updated_at' => '2019-08-28 12:56:54',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Drama',
                'created_at' => '2019-08-28 12:56:56',
                'updated_at' => '2019-08-28 12:56:56',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Harry Potter - Español',
                'created_at' => '2019-08-28 12:57:07',
                'updated_at' => '2019-08-28 12:57:07',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Infantil',
                'created_at' => '2019-08-28 12:57:16',
                'updated_at' => '2019-08-28 12:57:16',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'El corredor del laberinto',
                'created_at' => '2019-08-28 12:57:23',
                'updated_at' => '2019-08-28 12:57:23',
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'Percy Jackson',
                'created_at' => '2019-08-28 12:57:28',
                'updated_at' => '2019-08-28 12:57:28',
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'Comedia',
                'created_at' => '2019-08-28 12:57:29',
                'updated_at' => '2019-08-28 12:57:29',
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'Romance',
                'created_at' => '2019-08-28 12:57:31',
                'updated_at' => '2019-08-28 12:57:31',
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'Thriller',
                'created_at' => '2019-08-28 12:57:31',
                'updated_at' => '2019-08-28 12:57:31',
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'Crepúsculo',
                'created_at' => '2019-08-28 12:57:31',
                'updated_at' => '2019-08-28 12:57:31',
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'Star Wars',
                'created_at' => '2019-08-28 12:57:38',
                'updated_at' => '2019-08-28 12:57:38',
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'Bélico',
                'created_at' => '2019-08-28 12:57:48',
                'updated_at' => '2019-08-28 12:57:48',
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'X-Men',
                'created_at' => '2019-08-28 12:57:53',
                'updated_at' => '2019-08-28 12:57:53',
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'Alien',
                'created_at' => '2019-08-28 12:57:54',
                'updated_at' => '2019-08-28 12:57:54',
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'Marvel',
                'created_at' => '2019-08-28 12:57:57',
                'updated_at' => '2019-08-28 12:57:57',
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'Los juegos del hambre',
                'created_at' => '2019-08-28 12:58:40',
                'updated_at' => '2019-08-28 12:58:40',
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'Las Crónicas de Narnia',
                'created_at' => '2019-08-28 12:58:46',
                'updated_at' => '2019-08-28 12:58:46',
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'Matrix',
                'created_at' => '2019-08-28 12:58:50',
                'updated_at' => '2019-08-28 12:58:50',
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'El hobbit',
                'created_at' => '2019-08-28 12:58:55',
                'updated_at' => '2019-08-28 12:58:55',
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'Terror',
                'created_at' => '2019-08-28 12:59:00',
                'updated_at' => '2019-08-28 12:59:00',
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'Poltergeist',
                'created_at' => '2019-08-28 12:59:00',
                'updated_at' => '2019-08-28 12:59:00',
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'Regreso al futuro',
                'created_at' => '2019-08-28 12:59:04',
                'updated_at' => '2019-08-28 12:59:04',
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'Western',
                'created_at' => '2019-08-28 12:59:06',
                'updated_at' => '2019-08-28 12:59:06',
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'Gremlins',
                'created_at' => '2019-08-28 12:59:09',
                'updated_at' => '2019-08-28 12:59:09',
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'cSerie de TV',
                'created_at' => '2019-08-28 12:59:12',
                'updated_at' => '2019-08-28 12:59:12',
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'Animación',
                'created_at' => '2019-08-28 12:59:12',
                'updated_at' => '2019-08-28 12:59:12',
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'DC Cómics',
                'created_at' => '2019-08-28 12:59:12',
                'updated_at' => '2019-08-28 12:59:12',
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'Intriga',
                'created_at' => '2019-08-28 12:59:27',
                'updated_at' => '2019-08-28 12:59:27',
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'Spy Kids',
                'created_at' => '2019-08-28 12:59:27',
                'updated_at' => '2019-08-28 12:59:27',
            ),
            62 => 
            array (
                'id' => 63,
                'name' => 'Solo en casa',
                'created_at' => '2019-08-28 12:59:29',
                'updated_at' => '2019-08-28 12:59:29',
            ),
            63 => 
            array (
                'id' => 64,
                'name' => 'Divergente',
                'created_at' => '2019-08-28 12:59:33',
                'updated_at' => '2019-08-28 12:59:33',
            ),
            64 => 
            array (
                'id' => 65,
                'name' => 'La familia Addams',
                'created_at' => '2019-08-28 12:59:38',
                'updated_at' => '2019-08-28 12:59:38',
            ),
            65 => 
            array (
                'id' => 66,
                'name' => 'Los padres de ella',
                'created_at' => '2019-08-28 12:59:41',
                'updated_at' => '2019-08-28 12:59:41',
            ),
            66 => 
            array (
                'id' => 67,
                'name' => 'Cazafantasmas',
                'created_at' => '2019-08-28 12:59:46',
                'updated_at' => '2019-08-28 12:59:46',
            ),
            67 => 
            array (
                'id' => 68,
                'name' => 'Jurassic Park',
                'created_at' => '2019-08-28 12:59:49',
                'updated_at' => '2019-08-28 12:59:49',
            ),
            68 => 
            array (
                'id' => 69,
                'name' => 'Evil dead',
                'created_at' => '2019-08-28 12:59:57',
                'updated_at' => '2019-08-28 12:59:57',
            ),
            69 => 
            array (
                'id' => 70,
                'name' => 'Noche en el museo',
                'created_at' => '2019-08-28 13:00:00',
                'updated_at' => '2019-08-28 13:00:00',
            ),
            70 => 
            array (
                'id' => 71,
                'name' => 'Piratas del Caribe',
                'created_at' => '2019-08-28 13:00:07',
                'updated_at' => '2019-08-28 13:00:07',
            ),
            71 => 
            array (
                'id' => 72,
                'name' => 'Scary Movie',
                'created_at' => '2019-08-28 13:00:14',
                'updated_at' => '2019-08-28 13:00:14',
            ),
            72 => 
            array (
                'id' => 73,
                'name' => 'Jungla de cristal',
                'created_at' => '2019-08-28 13:00:23',
                'updated_at' => '2019-08-28 13:00:23',
            ),
            73 => 
            array (
                'id' => 74,
                'name' => 'Películas Momi',
                'created_at' => '2019-08-28 13:00:31',
                'updated_at' => '2019-08-28 13:00:31',
            ),
            74 => 
            array (
                'id' => 75,
                'name' => 'Musical',
                'created_at' => '2019-08-28 13:00:38',
                'updated_at' => '2019-08-28 13:00:38',
            ),
            75 => 
            array (
                'id' => 76,
                'name' => 'Películas pendientes de ver',
                'created_at' => '2019-08-28 13:01:04',
                'updated_at' => '2019-08-28 13:01:04',
            ),
            76 => 
            array (
                'id' => 77,
                'name' => 'Películas animación H&M',
                'created_at' => '2019-08-28 13:01:31',
                'updated_at' => '2019-08-28 13:01:31',
            ),
            77 => 
            array (
                'id' => 78,
                'name' => 'Universal',
                'created_at' => '2019-08-28 13:01:31',
                'updated_at' => '2019-08-28 13:01:31',
            ),
            78 => 
            array (
                'id' => 79,
                'name' => 'Cortos animación',
                'created_at' => '2019-08-28 13:01:37',
                'updated_at' => '2019-08-28 13:01:37',
            ),
            79 => 
            array (
                'id' => 80,
                'name' => 'Documental',
                'created_at' => '2019-08-28 13:01:40',
                'updated_at' => '2019-08-28 13:01:40',
            ),
            80 => 
            array (
                'id' => 81,
                'name' => 'Warner',
                'created_at' => '2019-08-28 13:02:01',
                'updated_at' => '2019-08-28 13:02:01',
            ),
            81 => 
            array (
                'id' => 82,
                'name' => 'Sony-Columbia',
                'created_at' => '2019-08-28 13:02:09',
                'updated_at' => '2019-08-28 13:02:09',
            ),
            82 => 
            array (
                'id' => 83,
                'name' => 'Otros',
                'created_at' => '2019-08-28 13:02:16',
                'updated_at' => '2019-08-28 13:02:16',
            ),
            83 => 
            array (
                'id' => 84,
                'name' => 'Disney',
                'created_at' => '2019-08-28 13:02:25',
                'updated_at' => '2019-08-28 13:02:25',
            ),
            84 => 
            array (
                'id' => 85,
                'name' => 'Dreamworks',
                'created_at' => '2019-08-28 13:03:45',
                'updated_at' => '2019-08-28 13:03:45',
            ),
            85 => 
            array (
                'id' => 86,
                'name' => 'Laika',
                'created_at' => '2019-08-28 13:04:04',
                'updated_at' => '2019-08-28 13:04:04',
            ),
            86 => 
            array (
                'id' => 87,
                'name' => 'Españolas',
                'created_at' => '2019-08-28 13:04:07',
                'updated_at' => '2019-08-28 13:04:07',
            ),
            87 => 
            array (
                'id' => 88,
                'name' => 'Pixar',
                'created_at' => '2019-08-28 13:04:12',
                'updated_at' => '2019-08-28 13:04:12',
            ),
            88 => 
            array (
                'id' => 89,
                'name' => 'Blue Sky',
                'created_at' => '2019-08-28 13:04:35',
                'updated_at' => '2019-08-28 13:04:35',
            ),
            89 => 
            array (
                'id' => 90,
                'name' => 'Películas Popi',
                'created_at' => '2019-08-28 13:04:43',
                'updated_at' => '2019-08-28 13:04:43',
            ),
            90 => 
            array (
                'id' => 91,
                'name' => 'Películas caseras Helena',
                'created_at' => '2019-08-28 13:06:52',
                'updated_at' => '2019-08-28 13:06:52',
            ),
            91 => 
            array (
                'id' => 92,
                'name' => 'Películas imagen real H&M',
                'created_at' => '2019-08-28 13:07:07',
                'updated_at' => '2019-08-28 13:07:07',
            ),
            92 => 
            array (
                'id' => 93,
                'name' => 'Cine negro',
                'created_at' => '2019-08-29 05:34:33',
                'updated_at' => '2019-08-29 05:34:33',
            ),
        ));
        
        
    }
}