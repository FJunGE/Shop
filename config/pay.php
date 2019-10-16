<?php

return [
    'alipay' => [
        'app_id'            => '2016092000552078',
        'ali_public_key'    => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAowJu4GXvXWz9K32nqzG3fWQJqTlVekZkw9tVzL0h/hS6zund+dfq+9ZSoKEi0QlqI6II3GF8nFhYN5BbL+Ic6CFYi0qD5GsK+AQj1UWOAtc0qDw9slm4lP3MDtq9NKmsmj9N4EyckrB9yEVrXs7BcR5fke7/Djiq38sFrAPob7TnYUG8bALvCK0aUkU0JxU+Gl39JBIgZBTKYeR6Cp49zHy5UpXGc/b1IMonz/X5spVKrqEU9OfF0J36P55WeQO0ZLu9acfXOB52cTnpYUV7bObwJ9tGhjM5GZrTs6ibFTHIKMJRrQfE6ftO5rIj/c+u3UbAwdiaG76wY/PKDM+NtwIDAQAB',
        'private_key'       => 'MIIEpAIBAAKCAQEAyDv/UO0mwEqOKOevzjmgFll4BQDYt2Pg/u7EzfLmrS6v61pfP+laMoYH3yl0pxANq5vwCszeldlXqaiqeLaLpnN9duMTiWl47UpcgceRvut1h9Gsks75NR9wPaGimGUmqSkGa7Vav4m9ar1lJVyN+hoA/6IMnYKWVYOmCMYMyx43EFn3AKVG9zVP86dEL/ia1vyzX/hwrDjyo7x611v8DuPbnjfAbMFTsGSi3G4531yWivejsg2mGTXVBYJ1Pyh9mbOLILOvrdCKZzIWywLSwwt3TgS3rxmacksmhOQMw2QHlBu5mA9FYw0ibd8YZDbCrMSHK4LpuGhSrwemnt+fOwIDAQABAoIBAAgUy9AjUh4OpEAoYaMMFlbwk3R4PUbhhBIl5tF9DSxOJxFzm0aED3zchfLOxIN9lV+osn5tGEqp8+zH/uFSVL6KCLVEouQ32oaRKryeJlazQBIUN0fRjKNFOo1yOZK2+mF3Y2fzcM8sKvXk4PEqFBzU8ddfXez5eUHIR2oxPBDye/WmMR+ku27ypFBiZG6S0awPVTltPc7v7AdaMuD6W1p9XNFkbmfp4Ln/3WKlKSyWNdkiebpmY/EbuExBz9U5FzYS5ezfRdS/0nBnPlFxvnRNzIAX4rXUZIVhL+X26l1VBsFPTqpT7NXUf02Df2i8jwo7xIMeOraz3z9ZvAEgpOkCgYEA5QK0gkATNLOMEix7w4LKCChAa9k9dA+yxXIp5BUQNo9iCKoR9g+lgVI4Y/LXCqIsmhsSd+wBdLk3hB6/2RGUnq0h4Yb/QD82RLjiXcdOxap29uF3ymUs+5qxSHn/peEVd0/olSNHkc3K8c674aflDq9gR/Y2i/PiB/yeNpnuJk0CgYEA39UbwEL0sHG5YRo9t102SsgwltFOwb99eBRq+xv+gPz4QsQFSi9l5e47BE6t8mKCgLXv7XSKwaKdfYWsPmN+urXG/exwIgAz82QCnGVa0uw6OAnKgIdG42OVGRFMUZEpfGSFODxkrFkGdbnesk8lr9kdhUroHKMTmtCDoeCur6cCgYEAzRhYGtJRoQAvsNL/4D/Que96ilvbKoconqW4mJi4lXRh4sqVHV4z5haBhBmmttI4yab3KklFoIiEDKIRRND23gjF8Bmbnak+69r8d+oYRPR+aGnSg4OK/qYyoWsJJkDnnZwF+xLGdPDuERMJtnVLsZQk0S3S+hHn2ylFdDb1Tn0CgYAqvyRBn4fjepSQutY2gpKvzXOaGfcUgWGQ4TVdJ4d/UtCGz7DC7jJjqw+STwRhWfbaZeSgULV/LXMuWaz/bTjyp2yNae4wUCGbxenJvIGP7pVfxl7qFOuw2X/L/cW5fiOSIhBfIQmI8KePLCQfoYXtA2Xj4t5ZObuwwUmiTKqP2QKBgQDZAjGoe7J/D8S1OMPMAevLz6KFSC0clqMn0nKwe8+P4DNbBLVavSOxJMyP5iZWfADNqt/AwpyzBy6wiJrKQCxOtHPMBWPKQw6jgLFKI7arQatMMSzaN0Yov7zbAj/7KrZLBRMp3nxHuMVxkBAZx2GNMmgayvEr1kvC154yFLwIzA==',
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