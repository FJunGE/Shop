<?php

return [
    'alipay' => [
        'app_id'            => '2016092000552078',
        'ali_public_key'    => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAowJu4GXvXWz9K32nqzG3fWQJqTlVekZkw9tVzL0h/hS6zund+dfq+9ZSoKEi0QlqI6II3GF8nFhYN5BbL+Ic6CFYi0qD5GsK+AQj1UWOAtc0qDw9slm4lP3MDtq9NKmsmj9N4EyckrB9yEVrXs7BcR5fke7/Djiq38sFrAPob7TnYUG8bALvCK0aUkU0JxU+Gl39JBIgZBTKYeR6Cp49zHy5UpXGc/b1IMonz/X5spVKrqEU9OfF0J36P55WeQO0ZLu9acfXOB52cTnpYUV7bObwJ9tGhjM5GZrTs6ibFTHIKMJRrQfE6ftO5rIj/c+u3UbAwdiaG76wY/PKDM+NtwIDAQAB',
        'private_key'       => 'MIIEpAIBAAKCAQEAxgJZjr2WzjnXW8RWM/1aZogUpn8xsoPfG59yf0GixJ/wRrGyRzpEIes6cTDS+mFvm+QTzPjXNeat4Rj1QDcaXugy6GxV8SQfxJFvDuyVlOz/kwn80a8jfrydQRb8BvStoPeMHuFvnSETgo9vfKUnpF+SFSsKsTJb48zcvmPV2KunHXK1OYGMeesyihurMWycZKXeTPInYBcMbv5PXbZy9RRhRSacJKYp2JgeT/cG7mOhAW/ZgR072kGU7vg6nsbcK3aM7vcHSzlV013NqVbua0XDSqoA1ZKoQs+VAw16nZSFcEfXFxcSBB2udQtg0qpm+AlCeJREBTrNflhR8UBsFwIDAQABAoIBABqvNmKGKkygfuVfED7xZb1rmVzWx1vHacnPMx7zOXxGEZt1VxFCSOxJRxb5/XTArMnVctWss1QQQl6Tfnmo82TW5gVslChrNdzHvK/GMmJfjhHCxs97Ss1JneensU8+qieHNNr0hpYmXvq5WczydOUx+/3eTxKSNs/8S8NcsPUB7/DiKzZ/iqpOn/WmtOw/vr1XLjHqAeqZmKvD1CJS9ptBEF+6h17SBGseskcgFZeX2x2wF9kOq6ZRoToHia+wzEmXJ9qj/LwzNYvHq8es8zDyF6Uh+WSRIs4xZ6+fcUE5s1D3+gHUBChcmt7p3aT5StFXDmYWp6b63ZpNJtqsfAECgYEA/CDxApbVyTV/FZBYjWbROUBP8d6iENfrfF11ltooVuXsKlNl8S7ok7pHNtXy/CztsIVRQa5PgbCMXM4+CKBF3uS/jJtVoWWWpiDylJf6NBOM1RnpbSCq1dbP27ZwNFTluxUhRKO0WGkzEEbLizfHR9MCR/yCcnZHG6pLHdGQ9u0CgYEAyQytZ7exS1Riik0MFdJbEZpsxxDbkjl1q706z4YhyvOSi1PBY7t/WPvoKwSdLj5JzYqim0Sznqfugf4niW/SuqgBoEZNPgHtTWhL7muLQOV7dsrogPdiCwViVgXqPA/JF/W4zf4cDwsgUkCprF0BRcsAfkcNtc0GHM8aJ9bG6pMCgYEAyZbNHPTdGnPbmLJBG04KG2yAfzMzAaSidF2Fl4f2mQRdP7pO1/hZnURjjESkc1y471qpDYsBpwAyOkHs95iuRPlA7nuEi/dd7JaLXqPlOZ4oDHsbWFW2QiPvLg1AyZbX2C2c2/TITahPW8Q/GqEOhS8Bs+0Bn+NSF5yhUsYs0kECgYAhhJmMRxWpx2G+SOYQ5UcFgkdMUMUqdaXmgd/CJUyQ91ahH8+H/wRWI3krYtOJmBzZxZkiZavEcZ7T0TlqMlhhggzzWYUbJ1sWoqK2FvvaT+frgByPE68mwzkHumi4prER64dp4ElxQJuc2ubus3q41gU5CEOC4bF5MBXeOnJjPQKBgQCxP4DUzqefC459Y1GNye5BqzZPh1+dVZRoueV/yLEB0xbATp0gcdsmuSyY6O0a5hOFGki8xMneWeyMILpAUoRO+B9zHzd0faqwgkp3UuJsBGpRKyQwlZMoWEtoX5Vt9BPCMEKQcyIc79NL68B/Vn0S8keftWyTYa8erDxTaBQ08g==',
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