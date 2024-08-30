<?php
/*
 * Local configuration file to provide any overrides to your app.php configuration.
 * Copy and save this file as app_local.php and make changes as required.
 * Note: It is not recommended to commit files with credentials such as app_local.php
 * into source code version control.
 */
return [
    /*
     * Debug Level:
     *
     * Production Mode:
     * false: No error messages, errors, or warnings shown.
     *
     * Development Mode:
     * true: Errors and warnings shown.
     */
    'debug' => filter_var(env('DEBUG', true), FILTER_VALIDATE_BOOLEAN),

    /*
     * Security and encryption configuration
     *
     * - salt - A random string used in security hashing methods.
     *   The salt value is also used as the encryption key.
     *   You should treat it as extremely sensitive data.
     */
    'Security' => [
        'salt' => env('SECURITY_SALT', '1930a447f89468910737098961d5379f46ef247e247a0de40ae3db66e15aaa21'),
    ],

    /*
     * Connection information used by the ORM to connect
     * to your application's datastores.
     *
     * See app.php for more configuration options.
     */
    'Datasources' => [
        'default' => [
            'host' => 'localhost',
            'username' => 'root',
            'password' => "Ligt^@sM]=as",
            'database' => 'speedex',
            'url' => env('DATABASE_URL', null),
        ],

        /*
         * The test connection is used during the test suite.
         */
        'test' => [
            'host' => 'localhost',
            //'port' => 'non_standard_port_number',
            'username' => 'my_app',
            'password' => 'secret',
            'database' => 'test_myapp',
            //'schema' => 'myapp',
            'url' => env('DATABASE_TEST_URL', 'sqlite://127.0.0.1/tests.sqlite'),
        ],
    ],

    /*
     * Email configuration.
     *
     * Host and credential configuration in case you are using SmtpTransport
     *
     * See app.php for more configuration options.
     */
    'EmailTransport' => [
        // 'default' => [
        //     'host' => 'localhost',
        //     'port' => 25,
        //     'username' => null,
        //     'password' => null,
        //     'client' => null,
        //     'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
        // ],
    //   'default' => [
    //         'className' => 'Smtp',
    //         // The following keys are used in SMTP transports
    //         'host' => 'mail.enjazsys.com',
    //         'port' => 25,
    //         'timeout' => 30,
    //         'username' => 'noreply@enjazsys.com',
    //         'password' => '.)(7_pkvWV~.',
    //         'client' => null,
    //         'tls' => null,
    //         //'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
    //     ],
    
        'default' => [
            'className' => 'Smtp',
            // The following keys are used in SMTP transports
            /*
            'host' => 'host.damanservices.ae',
            'port' => 587,
            'timeout' => 30,
            'username' => 'portal@enjazsys.com',
            'password' => 'P@ssw0rd@@@',
            'client' => null,
            'tls' => null,
            */
            'host' => 'mail.enjazsys.com',
            'port' => 587,
            'username' => 'portal@enjazsys.com',
            'password' => 'portal@123enjaz',
            'client' => null,
            'tls' => true,
            'url' => null,
            'context' => [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ],
            ],
            //'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
        ],
    ],
];
