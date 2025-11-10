<?php

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */


    public $brand = [];
public $menuConfig = [];


    public $adminSection = [

        [
            'heading' => 'الرئيسية',
            'items' => [
                [
                    'text' => 'لوحة التحكم',
                    'route' => 'dashboard',
                    'icon' => 'fas fa-tachometer-alt',
                    'badge' => '٣',
                    'active_routes' => ['dashboard']
                ]
            ]
        ],
        [
            'heading' => 'بيانات المستخدم',
            'items' => [
                [
                    'text' => 'المستخدمين',
                    'route' => '',
                    'icon' => 'fas fa-users',
                    'badge' => '١٢',
                    'active_routes' => [],
                    'collapse_id' => 'usersCollapse',  // Added collapse_id for collapsible menu
                    'submenu' => [
                        [
                            'text' => 'الخريجين',
                            'route' => 'graduate.index',
                            'icon' => 'fas fa-user-graduate',
                            'badge' => '٨',
                            'active_routes' => ['graduate.index']
                        ],
                        [
                            'text' => 'المشرفين',
                            'route' => 'supervisor.index',
                            'icon' => 'fas fa-user-tie',
                            'badge' => 'جديد',
                            'active_routes' => ['supervisor.index']
                        ],
                        [
                            'text' => 'أصحاب العمل',
                            'route' => 'employer.index',
                            'icon' => 'fas fa-building',
                            'badge' => '٤',
                            'active_routes' => ['employer.index']
                        ]

                    ]
                ]
            ]
        ],


        [
            'heading' => 'الإدارة',
            'items' => [
                [
                    'text' => 'إدارة المستخدم',
                    'route' => 'users',
                    'icon' => 'fas fa-user',
                    'badge' => '٣',
                    'active_routes' => ['users']
                ],
                [
                    'text' => 'إدارة الصلاحيات والادوار',
                    'route' => 'laravelroles::roles.index' ,
                    'icon' => 'fas fa-shield-alt',
                    'active_routes' => ['laravelroles::roles.index']
                ],
                [
                    'text' => ' الاقسام',
                    'route' => 'divisions.index',
                    'icon' => 'fas fa-building',
                    'badge' => '٤',
                    'active_routes' => ['divisions.index']
                ]
            ]
        ],
        [
            'heading' => 'التحليلات',
            'items' => [

                [
                    'text' => 'الإحصائيات',
                    'route' => 'dashboard',
                    'icon' => 'fas fa-chart-pie',
                    'badge' => 'جديد',
                    'active_routes' => ['laravelroles::roles.index']
                ]
            ]
        ],
        [
            'heading' => 'النظام',
            'items' => [
                [
                    'text' => 'الإعدادات',
                    'route' => 'setting',
                    'icon' => 'fas fa-cog',
                    'active_routes' => ['laravelroles::roles.index']
                ],
                [
                    'text' => 'الدعم الفني',
                    'route' => 'setting',
                    'icon' => 'fas fa-life-ring',
                    'badge' => '٣',
                    'active_routes' => ['laravelroles::roles.index']
                ]
            ]
        ]

    ];


public $supervisorSection = [

    [
    'heading' => 'الرئيسية',
    'items' => [
    [
    'text' => 'لوحة التحكم',
    'route' => 'supervisor.dashboard',
    'icon' => 'fas fa-tachometer-alt',
    'badge' => '٣',
    'active_routes' => ['supervisor.dashboard']
    ]
    ]
    ],
    [
    'heading' => 'بيانات المستخدم',
    'items' => [
                    [
                    'text' => 'المستخدمين',
                    'route' => 'setting',
                    'icon' => 'fas fa-users',
                    'badge' => '١٢',
                    'active_routes' => ['setting'],
                    'collapse_id' => 'usersCollapse',  // Added collapse_id for collapsible menu
                    'submenu' => [

                    [
                        'text' => 'الخريجين ',
                        'route' => 'supervisor.university-data',
                        'icon' => 'fas fa-building',
                        'badge' => '٤',
                        'active_routes' => ['supervisor.university-data', 'supervisor.jobs', 'supervisor.updatejobs', 'supervisor.skils', 'supervisor.courses']
                    ],

                    [
                    'text' => 'أصحاب العمل',
                    'route' => 'employer.index',
                    'icon' => 'fas fa-building',
                    'badge' => '٤',
                    'active_routes' => ['employer.index']
                    ]

                    ]
                    ]
        ]
    ],

    [
        'heading' => 'الاستفسار',
        'items' => [
        [
        'text' => 'ادارة الاقسام',
        'route' => 'supervisor.divisons',
        'icon' => 'fas fa-chart-line',

        'active_routes' => ['supervisor.divisons']
        ],


        ]
        ],




    [
    'heading' => 'النظام',
    'items' => [
    [
    'text' => 'الإعدادات',
    'route' => 'setting',
    'icon' => 'fas fa-cog',
    'active_routes' => ['laravelroles::roles.index']
    ],

    ]
    ]

];


public $employerSection = [

    [
        'heading' => 'الرئيسية',
        'items' => [
            [
                'text' => 'لوحة التحكم',
                'route' => 'employerDashboard',
                'icon' => 'fas fa-tachometer-alt',
                'active_routes' => ['dashboard'],
                'badge' => 2
            ]
        ]
    ],

    [
        'items' => [
            [
                'text' => 'الوظائف الشاغرة',
                'icon' => 'fas fa-tasks',
                'collapse_id' => 'jobsCollapse',
                'active_routes' => ['jobs.*'],
                'submenu' => [
                    [
                        'text' => 'نشر وظيفة جديدة',
                        'route' => 'offers.create',
                        'icon' => 'fas fa-plus-circle',
                        'active_routes' => ['jobs.create']
                    ],
                    [
                        'text' => 'إدارة الوظائف',
                        'route' => 'employerDashboard',
                        'icon' => 'fas fa-edit',
                        'active_routes' => ['jobs.index', 'jobs.edit']
                    ]
                ]
            ]
        ]
    ]
    ,[
        'heading' => 'النظام',
        'items' => [
            [
                'text' => 'الإعدادات',
                'route' => 'setting',
                'icon' => 'fas fa-cog',
                'active_routes' => ['setting']
            ],

        ]
    ]


];

public $graduateSection = [

    [
    'heading' => 'الرئيسية',
    'items' => [
    [
    'text' => 'لوحة التحكم',
    'route' => 'graduate.dashboard',
    'icon' => 'fas fa-tachometer-alt',

    'active_routes' => ['graduate.dashboard']
    ]
    ]
    ],


[
'heading' => 'إدارة المعلومات',
'items' => [
[
'text' => 'إدارة المعلومات',
'route' => 'graduate.info-forms',
'icon' => 'fas fa-user',
'badge' => '٣',
'active_routes' => ['graduate.info-forms']
],
[
'text' => ' قصص نجاح ',
'route' => 'story.getAllStorys' ,
'icon' => 'fas fa-shield-alt',
'active_routes' => ['story.getAllStorys']
]
]
],
    [
    'heading' => 'فرص',
    'items' => [
    [
    'text' => 'فرص عمل',
    'route' => 'offers.show-offers',
    'icon' => 'fas fa-chart-line',
    'badge' => '٣',
    'active_routes' => ['offers.show-offers']
    ],
    [
    'text' => 'استفسار ',
    'route' => 'division.chats',
    'icon' => 'fas fa-chart-line',
    'badge' => '٣',
    'active_routes' => ['division.chats']
    ],

    ]
    ],
    [
    'heading' => 'النظام',
    'items' => [
    [
    'text' => 'الإعدادات',
    'route' => 'setting',
    'icon' => 'fas fa-cog',
    'active_routes' => ['laravelroles::roles.index']
    ],

    ]
    ]

];



    public function __construct($user)
    {
        if ($user->hasRole('admin')) {
            $this->menuConfig = $this->adminSection;
            $this->brand = ['brand-name' => 'نظام متابعة الخريجين', 'brand-icon' => 'fas fa-graduation-cap'];
        }
        elseif($user->hasRole('employer')) {
            $this->menuConfig = $this->employerSection;
            $this->brand = ['brand-name'=>'نظام إدارة التوظيف','brand-icon'=>'fas fa-briefcase'];
        }
        elseif($user->hasRole('supervisor')){

            $this->menuConfig = $this->supervisorSection;
            $this->brand = ['brand-name' => 'نظام متابعة الخريجين', 'brand-icon' => 'fas fa-graduation-cap'];
        }
        elseif($user->hasRole('user')){

            $this->menuConfig = $this->graduateSection;
            $this->brand = ['brand-name' => 'نظام متابعة الخريجين', 'brand-icon' => 'fas fa-graduation-cap'];
        }
        else{
            $this->menuConfig = $this->adminSection;
            $this->brand = ['brand-name' => 'نظام متابعة الخريجين', 'brand-icon' => 'fas fa-graduation-cap'];
        }



    }





    public function isActive($routes)
    {
        if (is_array($routes)) {
            foreach ($routes as $route) {
                if (Route::currentRouteNamed($route)) {
                    return true;
                }
            }
            return false;
        }
        return Route::currentRouteNamed($routes);
    }
    /**
     * Get the view / contents that represent the component.
     */

    public function render(): View|Closure|string
    {
        return view('components.layouts.sidebar',['component' => $this]);
    }

}
