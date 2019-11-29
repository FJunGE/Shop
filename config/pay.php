<?php

return [
    'alipay' => [
        'app_id'            => '2016092000552078',
        'ali_public_key'    => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAowJu4GXvXWz9K32nqzG3fWQJqTlVekZkw9tVzL0h/hS6zund+dfq+9ZSoKEi0QlqI6II3GF8nFhYN5BbL+Ic6CFYi0qD5GsK+AQj1UWOAtc0qDw9slm4lP3MDtq9NKmsmj9N4EyckrB9yEVrXs7BcR5fke7/Djiq38sFrAPob7TnYUG8bALvCK0aUkU0JxU+Gl39JBIgZBTKYeR6Cp49zHy5UpXGc/b1IMonz/X5spVKrqEU9OfF0J36P55WeQO0ZLu9acfXOB52cTnpYUV7bObwJ9tGhjM5GZrTs6ibFTHIKMJRrQfE6ftO5rIj/c+u3UbAwdiaG76wY/PKDM+NtwIDAQAB',
        'private_key'       => 'MIIEpAIBAAKCAQEAzGgD/kI1rXUn1F+USMbVMHTXAVgXyyhuAaI79zpaJvtg1W5LGU1XgQmCTxyukhHXs8nHhn05daiaBvNU7kVw3HRFB0sfqxbSUeKNb8CxmH9sinbn38j0CKfS94JtQ37nGgefzO/VL90g1qKj7MYYANg4xJBAhe4qy2t8ep4Q6Do/TgF0HNm7G7iDrIS/nV/q/lQ8tIq3xxxbmkRt5N36LCTRyS/UZTtBwsyJlUoNyCCsreD625GKR+s54Kud/JPIT/9TDRVoz1ywggYaD3IUcBZUtUINqjJD+Oe8sMbw095KIQIi884en7oGqXDh9JK2SJxUuCIYc34z8zfhrbyz0QIDAQABAoIBAQCLSsaN2aiij5eYzZlLDtPwtW5e6B0uwFpWmquqigUtU1hlmUdr8pySvlwidTUxLR+E0Rg6udMSLtbnraJOzNtgH4t6sOLfwCmKy4v+f52Ggi8BHI5enZ5O166YJDU5LZ1my5NGIJlyiIn8OdDjZQquaKomqPaPTgGzpYeqN1TmKrN3GnN8KgzKpVdzj/qLH1SFs7BeG7jUTkjlBFLUFdkeILtgiWXDHSRi3HNgYwcFB0RBp1BX9Zu/TBxvm50Pm3EVf15ZREXEua83Uf77bbkiuV0gEVwugMTwwvDJSYsVTt9QI9zk2rw73VuWO1obs3GQd+KWxtTnSGXXIKsTxYZRAoGBAOcxFhTV1iKg6qmSpNzxy/IWqI+5rv+1VzpMIP7nPCarEFLf1q9M47jGsGEzIJFzyre1PgvofFHXLz0CNZxWawE+2B0p7JVj5K/65pRZ8gucKWFUYIsmzEJqMmwOflOcY3YahfzTmZL19l1WL2Iji+b28qY1ti+chjaeprUaAUgfAoGBAOJXH+j+5OlSmQMR1G6QX6x6NRN7+EV+ewRxHurfaHlwpwZp1jVTY84L23Z5YAljFrwgH0+HoJs2YaB9kEdtBJGu8lCMxYy5f6M/ave/p07rKTs6pPQUlAEizlgnPABMcsyxm3a3Zl0UcV+FEDNO/Q7PMI3js0QJ0TvEps5n70YPAoGATjVCvQWhjNFW0Mp0zvFVBq43k3dDBem4elYqi1B5/rK7sO1b2K1wE5/TJu5+w/WhzAeZ17lr5NugdUj8DckGJcO2pBb8m4TRZd7AhcrvoJHRRcWfazNSwdze9cLpZStwUhGi5eZG+3oNP4HaQZ64wwcjCqr82JpgpLWCu5zydg0CgYAtHkD2KRloiVaHDh7Si2UG9LVv1N6Au9253PLUzwP8cUBaPu68Yosan7J3w2opdN8rURvstpSFXCnJ3D3OfyTSBZW4CNe4XaHb4OBp0oJ/cNEfRWlsXk3CjDWlzOxhAtw/gYgD+jslgtW2vMel8rDvKs36+tDZVzumNmUp7/36cQKBgQCrSGEUN+QtQDoBJtatV6hZYlSiDIDpNqJe3iOrkJBAXV0lfElqlXz3sQphVX2Pg4ZND4hGIy1xtJNzjUFr37BzTpvv/OJdlE7a/TijEtNsjyY2lYedFPCvRVbuKKFBfcXN2eqxvdUUdYyNS2R6tCn38LsRoLG4y7jVFNPVZJP6tQ==',
        'log'               => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],

    'wechat' => [
        'app_id'    =>  '',
        'mch_id'    =>  '',
        'key'       =>  '',
        'cert_client'   =>  '',
        'cert_key'  =>  '',
        'log'       =>  [
            'flie'  =>  storage_path('logs/wechat_pay.log'),
        ]
    ],
];