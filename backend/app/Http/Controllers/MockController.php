<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class MockController extends Controller
{
    // 時間割取得API
    // GET ex) http://localhost:8000/api/timetablesAcquire?date=
    public function getTimetables(Request $request)
    {
        $timetables = [
            [
                'date' => '2023/04/17',
                'dayOfWeek' => 1,
                'isHoliday' => 'false',
                'lessons' =>
                [
                    [
                        'subject' => '国語',
                        'teacher' => '佐藤'
                    ],
                    [
                        'subject' => '国語',
                        'teacher' => '佐藤'
                    ],
                    [
                        'subject' => '国語',
                        'teacher' => '佐藤'
                    ],
                    [
                        'subject' => '国語',
                        'teacher' => '佐藤'
                    ],
                    [
                        'subject' => '国語',
                        'teacher' => '佐藤'
                    ],
                    [
                        'subject' => '国語',
                        'teacher' => '佐藤'
                    ]
                ]
            ],
            [
                'date' => '2023/04/18',
                'dayOfWeek' => 2,
                'isHoliday' => 'false',
                'lessons' =>
                [
                    [
                        'subject' => '国語',
                        'teacher' => '佐藤'
                    ],
                    [
                        'subject' => '国語',
                        'teacher' => '佐藤'
                    ],
                    [
                        'subject' => '国語',
                        'teacher' => '佐藤'
                    ],
                    [
                        'subject' => '国語',
                        'teacher' => '佐藤'
                    ],
                    [
                        'subject' => '国語',
                        'teacher' => '佐藤'
                    ],
                    [
                        'subject' => '国語',
                        'teacher' => '佐藤'
                    ]
                ]
            ],
            [
                'date' => '2023/04/19',
                'dayOfWeek' => 3,
                'isHoliday' => 'false',
                'lessons' =>
                [
                    [
                        'subject' => '国語',
                        'teacher' => '佐藤'
                    ],
                    [
                        'subject' => '国語',
                        'teacher' => '佐藤'
                    ],
                    [
                        'subject' => '国語',
                        'teacher' => '佐藤'
                    ],
                    [
                        'subject' => '国語',
                        'teacher' => '佐藤'
                    ],
                    [
                        'subject' => '国語',
                        'teacher' => '佐藤'
                    ],
                    [
                        'subject' => '国語',
                        'teacher' => '佐藤'
                    ]
                ]
            ],
            [
                'date' => '2023/04/20',
                'dayOfWeek' => 4,
                'isHoliday' => 'true',
                'holidayTitle' => '憲法記念日'
            ],
            [
                'date' => '2023/04/21',
                'dayOfWeek' => 5,
                'isHoliday' => 'false',
                'lessons' =>
                [
                    [
                        'subject' => '国語',
                        'teacher' => '佐藤'
                    ],
                    [
                        'subject' => '国語',
                        'teacher' => '佐藤'
                    ],
                    [
                        'subject' => '国語',
                        'teacher' => '佐藤'
                    ],
                    [
                        'subject' => '国語',
                        'teacher' => '佐藤'
                    ],
                    [
                        'subject' => '国語',
                        'teacher' => '佐藤'
                    ],
                    [
                        'subject' => '国語',
                        'teacher' => '佐藤'
                    ]
                ]
            ],
            [
                'date' => '2023/04/22',
                'dayOfWeek' => 6,
                'isHoliday' => 'false',
                'lessons' =>
                [
                    [
                        'subject' => '',
                        'teacher' => ''
                    ],
                    [
                        'subject' => '',
                        'teacher' => ''
                    ],
                    [
                        'subject' => '',
                        'teacher' => ''
                    ],
                    [
                        'subject' => '',
                        'teacher' => ''
                    ],
                    [
                        'subject' => '',
                        'teacher' => ''
                    ],
                    [
                        'subject' => '',
                        'teacher' => ''
                    ]
                ]
            ],
            [
                'date' => '2023/04/23',
                'dayOfWeek' => 0,
                'isHoliday' => 'false',
                'lessons' =>
                [
                    [
                        'subject' => '',
                        'teacher' => ''
                    ],
                    [
                        'subject' => '',
                        'teacher' => ''
                    ],
                    [
                        'subject' => '',
                        'teacher' => ''
                    ],
                    [
                        'subject' => '',
                        'teacher' => ''
                    ],
                    [
                        'subject' => '',
                        'teacher' => ''
                    ],
                    [
                        'subject' => '',
                        'teacher' => ''
                    ]
                ]
            ]
        ];

        return Response::json($timetables);
    }

    // 時間割登録API
    // POST ex) http://localhost:8000/api/timetablesCreate
    public function createTimetables(Request $request)
    {
        $message = [
            'messages' => [
                'success'
                // その他のパターン例
                // 'failure'
                // 'validationError',
                // '教師を入力した場合、科目は必須項目です。月曜3時間目の科目を入力してください。'
            ]
        ];

        return Response::json($message);
    }
    // 教師ログインAPI
    // POST ex) http://localhost:8000/api/teachersLogin
    public function loginTeachers(Request $request)
    {
        $message = [
            'messages' => [
                'success'
                // その他のパターン例
                // 'failure'
                // 'validationError',
                // 'メールアドレスは必須項目です。'

            ]
        ];

        return Response::json($message);
    }
}
