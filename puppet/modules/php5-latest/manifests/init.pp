class php5-latest {

    exec { 'php5-latest:update-php-add-repository':
        command => "add-apt-repository ppa:ondrej/php5",
        path => '/usr/bin:/usr/sbin:/bin',
    }

    exec { 'php5-latest:apt-get-update':
        path => '/usr/bin',
        command => 'apt-get update',
        require => [Exec['php5-latest:update-php-add-repository']]
    }

    package { 'php5':
        ensure => installed,
        require => [Exec['php5-latest:apt-get-update']]
    }

    package { 'php5-mysql':
        ensure => installed,
        require => Package['php5']
    }

    exec { 'php5-latest:mod-rewrite':
        path => '/usr/bin:/usr/sbin:/bin',
        command => 'a2enmod rewrite',
        require => [Package['php5']]
    }

    exec { 'php5-latest:restart':
        path => '/usr/bin:/usr/sbin:/bin',
        command => 'service apache2 restart',
        require => [Exec['php5-latest:mod-rewrite']]
    }

#ln -s /var/www/html inny
#    file { '/var/www/html':
#        path => '/var/www/html',
#        ensure => link,
#        force => true,
#        target => '/vagrant/web',
#        require => [Package['php5']]
#    }

    exec { 'change-apache-config':
      path => '/usr/bin:/usr/sbin:/bin',
      command => 'sed -i \'s/Require all denied/Require all granted/g\' /etc/apache2/apache2.conf',
      require => [Package['php5']]
    }

    exec { 'php-cli-set-timezone':
        path => '/usr/bin:/usr/sbin:/bin',
        command => 'sed -i \'s/^[; ]*date.timezone =.*/date.timezone = Europe\/London/g\' /etc/php5/cli/php.ini',
        onlyif => 'test "`php -c /etc/php5/cli/php.ini -r \"echo ini_get(\'date.timezone\');\"`" = ""',
        require => [Package['php5']]
    }

    exec { 'php-cli-set-phar-options':
        path => '/usr/bin:/usr/sbin:/bin',
        command => 'sed -i \'s/^[; ]*;phar.readonly *= *.*/phar.readonly = 0/g\' /etc/php5/cli/php.ini',
        require => [Package['php5']]
    }

    exec { 'php-cli-disable-short-open-tag':
        path => '/usr/bin:/usr/sbin:/bin',
        command => 'sed -i \'s/^[; ]*short_open_tag =.*/short_open_tag = Off/g\' /etc/php5/cli/php.ini',
        onlyif => 'test "`php -c /etc/php5/cli/php.ini -r \"echo ini_get(\'short_open_tag\');\"`" = "1"',
        require => [Package['php5']]
    }

}


include php5-latest